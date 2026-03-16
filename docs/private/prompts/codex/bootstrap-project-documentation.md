# bootstrap-project-documentation

Use this as a reusable Codex prompt asset for existing repositories that need documentation bootstrap or migration.

Intended invocation:

`Zrealizuj bootstrap-project-documentation`

When executed, Codex should do the following:

- read the repository `AGENTS.md` first if it exists
- inspect existing repo-local skills before creating new skills or changing workflow behavior
- if documentation-related skills already exist, reuse or extend them instead of creating overlapping duplicates
- if `AGENTS.md` or skills already exist, keep new guidance consistent with their structure, naming, tone, and scope
- if `AGENTS.md` or the relevant skill is missing, add the minimum viable guidance needed to apply the workflow and then continue

Repository analysis:
- inspect the whole repository before writing important documentation
- review existing documentation in `README` files, `docs/`, manuals, notes, scripts, CI/CD configuration, deployment files, infrastructure files, and other likely sources of project knowledge
- identify what documentation already exists, what is outdated, what is missing, and what belongs in public vs private documentation
- preserve useful existing material and reorganize it into the correct destinations instead of rewriting blindly

Documentation workflow:
- use the repo-local `documentation-workflow` skill when it exists and is applicable
- create a migration or bootstrap plan in `docs/private/plans/YYYY-MM-DD-topic.md`
- if AI is used meaningfully, save the prompt in `docs/private/prompts/codex/YYYY-MM-DD-topic.md`
- create an implementation report in `docs/private/reports/YYYY-MM-DD-topic.md`
- move durable operational procedures into `docs/private/manuals/`
- move durable concepts into `docs/private/concepts/`
- move architecture or technology choices into `docs/private/decisions/`
- keep exploratory notes, raw analysis, and incomplete thinking in `docs/private/`
- publish only concise, professional, reader-facing material in `docs/public/` and `README.md`

Output expectations:
- create the missing documentation files that the repository actually needs
- update existing public docs only after the private documentation layer is established
- avoid placeholders unless a file is intentionally a stub
- include cross-links between related plan, prompt, report, manual, concept, and decision files when useful
- use kebab-case naming
- use `YYYY-MM-DD-topic.md` for plans, prompts, and reports

Execution quality bar:
- ground the documentation in the actual repository state
- do not generate generic template text detached from the codebase
- do not overwrite good existing guidance just because it uses different wording
- improve coherence across `AGENTS.md`, skills, and documentation if inconsistencies are found
