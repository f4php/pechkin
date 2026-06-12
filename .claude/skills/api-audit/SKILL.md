---
name: api-audit
description: Compare one Telegram Bot API datatype or method in pechkin against the downloaded official documentation and ensure unit tests and fixtures match. Use when asked to audit, verify, or check a specific datatype (e.g. Chat) or method (e.g. getFile) against the API docs.
---

Audit a single Telegram Bot API piece against the official documentation snapshot in `docs/`.

The piece to audit is given as the argument (`$ARGUMENTS`). All paths below are relative to the pechkin project root (the directory containing `composer.json`).

## Steps

1. Classify the argument: first letter uppercase → **datatype**, lowercase → **method**.
2. Locate the two sides:
   - Datatype: `docs/datatypes/{Name}.md` vs `src/F4/Pechkin/DataType/{Name}.php`
   - Method: `docs/methods/{name}.md` vs the `public function {name}(...)` in `src/F4/Pechkin/Client.php`
   - If the doc file is missing, run `php scripts/docs-downloader.php` first; if it is still missing afterwards, the piece does not exist in the current API — report that and check whether the code side is a known deviation (see checklist).
3. Compare field-by-field / parameter-by-parameter using [checklist.md](checklist.md). Read only the doc file and the relevant code, not the whole codebase.
4. For datatypes, verify tests and fixtures per the checklist, then run the single test:
   `vendor/bin/phpunit --bootstrap tests/F4/Config.php tests/F4/Tests/DataType/{Name}Test.php`
5. Fix discrepancies (code, tests, fixtures) so they match the documentation, preserving documented project deviations. If a fix would change a public signature in a breaking way, list it in the report and ask before applying.

## Report format

End with a compact verdict:

```
{Name}: OK | FIXED | NEEDS DECISION
- <each discrepancy found, and what was done about it>
```
