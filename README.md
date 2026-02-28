*ABOUT*


**F4 routing integration**
```php

  $bot = new Bot();

  $f4->addRoute(
    Route::post('/bot.json', function (): void {})
        // This will interrupt normal request processing 
        // and return an empty 204 response to Telegram webhook initiator
        ->before($bot->interceptWebhook(...)),
  );
```
**Simple configuration** 

```php
new Bot()
    ->register(
        On::command('/start', function(Context $ctx): void {
            // ...
        }),
    );
```

**Advanced configuration example** 

```php
new Bot()
    ->register(
        // Register handlers that do not require any grouping or special conditions
        On::command('/start', function(Context $ctx): void {
            $_SESSION['flow'] ='my-flow';
        })
          // Handler-level middleware
          ->before(fn(Context $ctx): Context => $ctx->withSession(/*...*/))
          ->onException(Throwable::class, function(Throwable $e, Context $ctx) {
              // ...
          }),
        On::command(When::equals('cancel'), function(Context $ctx): void {
            $_SESSION['flow'] ='';
            // $ctx->client->reply("Hey there!");
        }),

        // Flows are groups of handlers with common pre-condition
        Flow::when(fn(Context $context): bool =>
            $_SESSION['flow'] === 'my-flow'
        )
          // Flow-level middleware
          ->before(fn(Context $ctx): Context => $ctx->withUpdate(/*...*/))
          ->register(
              On::command(When::startsWith('command2'), function(Context $ctx): void {
                  // ...
              })
                ->before(fn(Context $ctx) => $ctx->withClient(/*...*/)),
              On::command(When::oneOf(['command3', 'command4']), function(Context $ctx): void {
                  // ...
              }),
              On::command(When::matches('/command[5-7]/'), function(Context $ctx): void {
                  // ...
              }),
              On::default(function(Context $ctx): void {
                  //...
              }),
          )
          ->onException(Throwable::class, function(Throwable $e, Context $ctx) {
              // ...
          }),
    )
      ->onException(Throwable::class, function(Throwable $e, Context $ctx) {
          // ...
      });
```

**Sessions**

Sessions are enabled by default. Each webhook call automatically gets a session keyed by context:
private chats are keyed by user ID, groups/supergroups/channels by chat ID.

Session data is available in the usual $_SESSION global. It does not rely on cookies.