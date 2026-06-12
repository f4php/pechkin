# OwnedGifts

Source: https://core.telegram.org/bots/api#ownedgifts

Contains the list of gifts received and owned by a user or a chat.

| Field | Type | Description |
| --- | --- | --- |
| total_count | Integer | The total number of gifts owned by the user or the chat |
| gifts | Array of [OwnedGift](https://core.telegram.org/bots/api#ownedgift) | The list of gifts |
| next_offset | String | *Optional*. Offset for the next request. If empty, then there are no more results. |
