# sendChatJoinRequestWebApp

Source: https://core.telegram.org/bots/api#sendchatjoinrequestwebapp

Use this method to process a received chat join request query by showing a Mini App to the user before deciding the outcome. Returns *True* on success.

| Parameter | Type | Required | Description |
| --- | --- | --- | --- |
| chat_join_request_query_id | String | Yes | Unique identifier of the join request query |
| web_app_url | String | Yes | The URL of the Mini App to be opened |
