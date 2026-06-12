# API audit checklist

Conventions for comparing pechkin code against the documentation snapshots in
`docs/datatypes/*.md` and `docs/methods/*.md`.

## Type mapping (docs → PHP)

| Documentation type | PHP declaration |
| --- | --- |
| Integer (unique identifiers: user/chat/message-thread ids with the "may have more than 32 significant bits" warning) | `string` (or `int\|string` for method parameters), with a `// may not fit in a 32-bit integer` comment |
| Integer (everything else) | `int` |
| String | `string` |
| Boolean / True | `bool` |
| Float | `float` |
| SomeType | `SomeType` (a DataType class) |
| Array of X | `array` property with `#[ArrayOf(X::class)]` (or `#[ArrayOf('int')]` / `#[ArrayOf('string')]` for scalars); nested arrays use nested ArrayOf semantics — follow existing examples |
| "X or Y" unions | PHP union type `X\|Y` |
| RichText | `RichText\|array\|string` with `#[ArrayOf(RichText::class)]` — the RichText doc defines it as "a String for plain text, an Array of RichText, or any RichText* type", and the API returns all three forms |
| InputPollMedia / InputPollOptionMedia | the wider `InputMedia` base (their union members are InputMedia* subtypes that cannot also extend them), with an explanatory comment |
| Base type with subtypes selected by a field (e.g. MessageOrigin, ChatBoostSource) | class-level `#[Polymorphic(discriminator: '...', map)]` on the base DataType |

## Datatype checks (`docs/datatypes/{Name}.md` vs `src/F4/Pechkin/DataType/{Name}.php`)

1. Class exists, is `readonly`, extends `AbstractDataType`, namespace `F4\Pechkin\DataType`.
2. Every documented field is a promoted constructor property with the identical snake_case name.
3. Required fields (no "*Optional*." prefix in the description) come first and have no default; optional fields are nullable (`?type`) with `= null`.
4. Types follow the mapping table above.
5. Extra properties not in the docs are allowed **only** with an explanatory comment (existing precedents: `UserShared` — whole class kept although removed from docs; `Chat::$all_members_are_administrators` — "Undocumented property discovered through API interaction"). Flag uncommented extras.

## Method checks (`docs/methods/{name}.md` vs `Client.php`)

1. `public function {name}(...)` exists with the exact documented name.
2. Parameters match documented names; Required = Yes → no default value, listed first; Optional → nullable with `= null`.
3. Types follow the mapping table; `chat_id` style "Integer or String" → `int|string`.
4. Return type matches the "Returns ..." / "... is returned" sentence in the description (e.g. "a File object is returned" → `: File`; "Returns *True*" → `: bool`).

## Test and fixture checks (datatypes only)

Location: `tests/F4/Tests/DataType/{Name}Test.php`, fixtures in `tests/F4/Tests/DataType/Fixtures/`.

1. Test class exists: `final class {Name}Test extends TestCase`, uses `FixtureAwareTrait`.
2. Two fixtures exist, named after the snake_case of the type name:
   - `{snake_case}_full.json` — all fields including optional ones;
   - `{snake_case}_minimal.json` — required fields only.
3. Fixture fields must all exist in the documentation (no stale fields) with type-correct values; unique-identifier fields use string values (e.g. `"123456789"`).
4. The three standard tests exist, following `ChatTest.php` as the template:
   - `testFromArrayCreatesCorrectStructure` (full fixture, asserts field values),
   - `testFromArrayWithMinimalData` (minimal fixture, asserts optionals are null),
   - `testFromArrayToArrayRoundtrip` (minimal fixture, `fromArray`→`toArray` equality).
