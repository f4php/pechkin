# InputRichBlockPhoto

Source: https://core.telegram.org/bots/api#inputrichblockphoto

A block with a photo, corresponding to the HTML tag `<img>`.

| Field | Type | Description |
| --- | --- | --- |
| type | String | Type of the block, always “photo” |
| photo | [InputMediaPhoto](https://core.telegram.org/bots/api#inputmediaphoto) | The photo. Caption is ignored. |
| caption | [RichBlockCaption](https://core.telegram.org/bots/api#richblockcaption) | *Optional*. Caption of the block |
