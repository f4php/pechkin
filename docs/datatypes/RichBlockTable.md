# RichBlockTable

Source: https://core.telegram.org/bots/api#richblocktable

A table, corresponding to the HTML tag `<table>`.

| Field | Type | Description |
| --- | --- | --- |
| type | String | Type of the block, always “table” |
| cells | Array of Array of [RichBlockTableCell](https://core.telegram.org/bots/api#richblocktablecell) | Cells of the table |
| is_bordered | True | *Optional*. *True*, if the table has borders |
| is_striped | True | *Optional*. *True*, if the table is striped |
| caption | [RichText](https://core.telegram.org/bots/api#richtext) | *Optional*. Caption of the table |
