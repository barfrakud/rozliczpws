# Existing Project Docs Bootstrap Example

## Date
2026-03-13

## Related plan
`docs/private/plans/2026-03-13-existing-project-docs-bootstrap-example.md`

## Related prompt
`docs/private/prompts/codex/2026-03-13-existing-project-docs-bootstrap-example.md`

## Goal
Add a reusable example prompt for bootstrapping this documentation standard in an existing repository.

## What was done
- Reviewed the current examples and public usage documentation.
- Added a new example prompt for Codex to analyze an existing project and generate documentation according to the private-first workflow.
- Added a repository convention for executing reusable prompt assets by name.
- Refined the example so it also handles repositories that already contain `AGENTS.md` or repo-local skills.
- Updated public-facing documentation to reference the new example and invocation pattern.
- Recorded the work in matching private workflow artifacts.

## Files changed
- `README.md`
- `AGENTS.md`
- `docs/codex-cli-usage.md`
- `docs/public/usage.md`
- `examples/prompts/bootstrap-project-documentation.md`
- `docs/private/prompts/index.md`
- `docs/private/plans/2026-03-13-existing-project-docs-bootstrap-example.md`
- `docs/private/prompts/codex/2026-03-13-existing-project-docs-bootstrap-example.md`
- `docs/private/reports/2026-03-13-existing-project-docs-bootstrap-example.md`

## Result
- The repository now includes an example prompt for the migration/bootstrap scenario, not only for single-task planning.
- Users have a clearer path for applying the standard to repositories that already contain code and mixed documentation.
- The repository now documents how Codex should resolve and execute named prompt assets such as `Zrealizuj bootstrap-project-documentation`.

## Issues
- The example assumes the target repository can host `AGENTS.md` and the repo-local skill for best results.
- Individual projects may still require manual judgment for domain-specific public documentation structure.

## Conclusions
- The migration/bootstrap scenario is common enough that it should be represented in the examples directory.
- Cross-linking example prompts from public docs makes the template easier to adopt.
- Prompt assets are substantially more usable when the repository defines a stable name-based execution convention.

## Next steps
1. Add more examples for specific migration scenarios such as monorepos or infrastructure repositories.
2. Consider adding a public guide dedicated to "adopting the standard in an existing repository".
3. Expand examples to cover automated inventory and documentation gap analysis.
