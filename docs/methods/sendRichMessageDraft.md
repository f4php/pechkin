# sendRichMessageDraft

Source: https://core.telegram.org/bots/api#sendrichmessagedraft

Use this method to stream a partial rich message to a user while the message is being generated. Note that the streamed draft is ephemeral and acts as a temporary 30-second preview - once the output is finalized, you **must** call [sendRichMessage](https://core.telegram.org/bots/api#sendrichmessage) with the complete message to persist it in the user's chat. Returns *True* on success.

| Parameter | Type | Required | Description |
| --- | --- | --- | --- |
| chat_id | Integer | Yes | Unique identifier for the target private chat |
| message_thread_id | Integer | Optional | Unique identifier for the target message thread |
| draft_id | Integer | Yes | Unique identifier of the message draft; must be non-zero. Changes to drafts with the same identifier are animated. |
| rich_message | [InputRichMessage](https://core.telegram.org/bots/api#inputrichmessage) | Yes | The partial message to be streamed. Direct upload of new files isn't supported. |
