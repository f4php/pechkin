---
name: api-sync
description: Routine Telegram Bot API documentation sync for pechkin — download the latest official docs, find changed datatypes/methods via git diff, and audit each changed piece against code, tests, and fixtures. Use when asked to sync the API docs, check for API updates, or bring the library up to date with the latest Bot API.
---

Sync pechkin with the latest Telegram Bot API documentation. All paths are relative to the pechkin project root (the directory containing `composer.json`).

## Steps

1. **Pre-check.** `git status --short docs/` must be clean — the diff in step 3 is the change signal, so uncommitted doc changes mean a previous sync was not finished. If dirty, stop and ask the user.
2. **Download.** Run `php scripts/docs-downloader.php`. Expect a summary like `N datatypes, M methods written` and exit code 0. A failure or a drastic count change (±20% vs the previous run) means the page layout changed — investigate `src/F4/Pechkin/Utility/DocumentationParser.php` instead of proceeding.
3. **Detect changes.** From `git status --short docs/` and `git diff --name-only docs/`, build three lists: **modified**, **new** (untracked), and **deleted** doc files. If all three are empty, report "documentation unchanged, library is up to date" and stop.
4. **Check the API version.** `curl -s https://core.telegram.org/bots/api | grep -oE 'Bot API [0-9]+\.[0-9]+' | head -1` and compare with `API_VERSION` in `src/F4/Pechkin/Client.php`; update the constant if the API moved.
5. **Audit each changed piece** against [the api-audit checklist](../api-audit/checklist.md):
   - **Modified**: read `git diff` for that doc file first — usually only a field or two changed; fix code/tests/fixtures accordingly.
   - **New**: create the DataType class (or Client method), test, and fixtures following the checklist conventions; use an existing similar class as the template.
   - **Deleted**: do **not** delete the code. Flag it and decide with the user whether to keep it with an "undocumented" comment (precedent: `UserShared`) or remove it.
   - **Context discipline**: each piece needs only its doc file + its code/test/fixture files. If more than ~5 pieces changed, fan out general-purpose subagents in batches of up to 8 pieces each; give every agent the exact file paths, the absolute path to `.claude/skills/api-audit/checklist.md`, and require the per-piece verdict format from the api-audit skill. Never load the whole docs/ tree or Client.php into one context.
6. **Verify.** Run `composer test` (unit tests only; integration groups are excluded by default). Fix regressions before reporting.
7. **Report.** Summary table: piece, change kind (modified/new/deleted), verdict (OK / FIXED / NEEDS DECISION), one-line detail. Remind the user to commit `docs/` together with the code changes so the next sync diffs against this baseline.
