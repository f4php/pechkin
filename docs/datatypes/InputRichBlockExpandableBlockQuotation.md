# InputRichBlockExpandableBlockQuotation

Source: https://core.telegram.org/bots/api#inputrichblockexpandableblockquotation

A block quotation, corresponding to the HTML tag `<blockquote>` with custom attribute `"expandable"`.

| Field | Type | Description |
| --- | --- | --- |
| type | String | Type of the block, always “expandable_blockquote” |
| blocks | Array of [InputRichBlock](https://core.telegram.org/bots/api#inputrichblock) | Content of the block |
| credit | [RichText](https://core.telegram.org/bots/api#richtext) | *Optional*. Credit of the block |
