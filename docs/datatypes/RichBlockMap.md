# RichBlockMap

Source: https://core.telegram.org/bots/api#richblockmap

A block with a map, corresponding to the custom HTML tag `<tg-map>`.

| Field | Type | Description |
| --- | --- | --- |
| type | String | Type of the block, always “map” |
| location | [Location](https://core.telegram.org/bots/api#location) | Location of the center of the map |
| zoom | Integer | Map zoom level; 13-20 |
| width | Integer | Expected width of the map |
| height | Integer | Expected height of the map |
| caption | [RichBlockCaption](https://core.telegram.org/bots/api#richblockcaption) | *Optional*. Caption of the block |
