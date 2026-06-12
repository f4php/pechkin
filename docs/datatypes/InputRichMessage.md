# InputRichMessage

Source: https://core.telegram.org/bots/api#inputrichmessage

Describes a rich message to be sent. Exactly **one** of the fields *html* or *markdown* must be used.

| Field | Type | Description |
| --- | --- | --- |
| html | String | *Optional*. Content of the rich message to send described using HTML formatting. See [rich message formatting options](https://core.telegram.org/bots/api#rich-message-formatting-options) for more details. |
| markdown | String | *Optional*. Content of the rich message to send described using Markdown formatting. See [rich message formatting options](https://core.telegram.org/bots/api#rich-message-formatting-options) for more details. |
| is_rtl | Boolean | *Optional*. Pass *True* if the rich message must be shown right-to-left |
| skip_entity_detection | Boolean | *Optional*. Pass *True* to skip automatic detection of entities (e.g., URLs, email addresses, username mentions, hashtags, cashtags, bot commands, or phone numbers) in the text |
