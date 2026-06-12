# Integration tests

Live tests against the real Telegram Bot API. The pre-configured launcher is
`scripts/test-integration.sh` — edit its credentials dictionary, uncomment the
suite you want, and run it.

## Environment variables

| Variable | Required | Purpose |
| --- | --- | --- |
| `TELEGRAM_BOT_TOKEN` | yes | Bot token; everything is skipped without it |
| `TELEGRAM_TEST_CHAT_ID` | yes | Group chat used for send/edit/delete tests |
| `TELEGRAM_TEST_USER_ID` | optional | Real human user for member, sticker-set and prepared-message tests |
| `TELEGRAM_BUSINESS_CONNECTION_ID` | optional | Telegram Business connection that authorized this bot |
| `TELEGRAM_PAYMENT_PROVIDER_TOKEN` | optional | Test payment provider token for invoice tests |
| `TELEGRAM_TEST_CHANNEL_ID` | optional | Channel where the bot is admin — paid media, subscription invite links |
| `TELEGRAM_TEST_GAME_SHORT_NAME` | optional | Game registered with BotFather — real sendGame/getGameHighScores chain |
| `TELEGRAM_TEST_ALLOW_DESTRUCTIVE` | optional | Explicit opt-in for `logOut`/`close` (locks the bot out for ~10 min) |
| `TELEGRAM_TEST_THROTTLE_MS` | optional | Minimum spacing between API requests (default 1500) |
| `TELEGRAM_TEST_MAX_RETRIES` | optional | Automatic retries on HTTP 429 honoring `retry_after` (default 3) |

## Groups

| Group | Composer script | Contents |
| --- | --- | --- |
| `integration` | — (umbrella; excluded by `composer test`) | every integration test |
| `integration:basic` | `test:integration:basic` | ClientTest, MediaClientTest, ChatManagementTest, BotProfileTest, StickerLifecycleTest |
| `integration:business` | `test:integration:business` | BusinessClientTest |
| `integration:payments` | `test:integration:payments` | PaymentsClientTest |
| `integration:channel` | `test:integration:channel` | ChannelClientTest (needs `TELEGRAM_TEST_CHANNEL_ID`) |
| `integration:destructive` | `test:integration:destructive` | DestructiveTest (needs `TELEGRAM_TEST_ALLOW_DESTRUCTIVE`; excluded from `test:integration:all`) |

PHPUnit 13 does not inherit `#[Group]` attributes from parent classes, so each
test class carries both `#[Group('integration')]` and its specific group.

## Rate limiting

`IntegrationTestCase` builds the shared `Client` with an `ApiClient` configured
from `TELEGRAM_TEST_THROTTLE_MS` / `TELEGRAM_TEST_MAX_RETRIES`. Requests are
spaced by the throttle, and 429 responses are retried automatically after the
`retry_after` interval Telegram reports (when it is ≤ 60 s). `ClientException`
exposes the parsed payload as `$e->parameters?->retry_after`.

## Test conventions

- **Real path** wherever the basic group + token suffice.
- **`attemptOrSkip(...)`** for operations whose success depends on bot rights or
  chat features (e.g. `setChatTitle`, reactions, drafts): a 4xx response skips
  the test with the API's explanation; 5xx/transport errors still fail.
- **`assertApiError(...)`** smoke tests for methods whose success path is not
  reachable with the test setup: the call must reach Telegram and come back as
  a 4xx, proving serialization and wiring are correct.
- Media fixtures in `Fixtures/` are tiny files generated with ffmpeg (silence,
  solid-color video). `sendSticker` generates a WEBP at runtime via GD.

## Environment-dependent skips

- An **externally configured webhook** makes `getUpdates`-based tests skip with
  409 Conflict (and the webhook lifecycle test refuses to clobber it).
- The **sticker lifecycle** needs a `TELEGRAM_TEST_USER_ID` who has started the
  bot in private; otherwise Telegram answers PEER_ID_INVALID and the chain skips.
- **Message drafts** (`sendMessageDraft`, `sendRichMessageDraft`) only stream to
  private chats, so they target the test user's chat and skip without one.
- A **basic group** (vs supergroup) skips member restriction, user chat boosts
  and forum-topic tests.

## Success paths that cannot be exercised

| Method(s) | Why |
| --- | --- |
| `logOut`, `close` | Invalidate the bot session for ~10 minutes; gated behind `integration:destructive` + env opt-in, run them last |
| `getManagedBotToken`, `replaceManagedBotToken`, `getManagedBotAccessSettings`, `setManagedBotAccessSettings` | The test bot does not manage any bots; 4xx smoke tests only |
| `answerWebAppQuery`, `answerChatJoinRequestQuery`, `answerGuestQuery`, `sendChatJoinRequestWebApp`, `answerInlineQuery`, `answerCallbackQuery`, `answerPreCheckoutQuery`, `answerShippingQuery` | Need a live inbound update (query id) that only exists while a user interacts with the bot |
| `setMyProfilePhoto`, `setBusinessAccountProfilePhoto`, `postStory`, `editStory` | `InputProfilePhoto*`/`InputStoryContent*` carry `attach://` file references, but the client sends these requests as JSON without multipart attachments — real uploads are currently impossible through this client (library limitation worth fixing separately) |
| `setPassportDataErrors` | Needs a user to submit Telegram Passport data first |
| `setUserEmojiStatus` | Needs a user-consent flow via a Mini App |
| `verifyUser`, `verifyChat`, `removeUserVerification`, `removeChatVerification` | Bot must be granted verification privileges by Telegram |
| `approveSuggestedPost`, `declineSuggestedPost` | Need a pending suggested post in a direct-messages chat |
