# AGENTS.md

## Purpose

This repository contains `rozliczPWS`, a Laravel application for settling business trip costs, plus a private-first documentation workflow used to maintain the project.

Codex should keep implementation work aligned with `docs/review-report.md` and keep documentation grounded in the actual repository state.

## Default working contract

1. Read `docs/review-report.md` before major implementation work.
2. Execute implementation phases in order: A -> B -> C -> D -> E.
3. Keep changes practical and junior-friendly.
4. Prefer safe refactors with tests over large rewrites.
5. Keep secrets, credentials, and environment values out of the repository.

## Documentation model

There are 3 documentation layers:

1. `docs/private/`
   - plans
   - prompts
   - reports
   - manuals
   - concepts
   - decisions
   - research and working notes

2. `docs/private/manuals/`
   - installation
   - configuration
   - operations
   - troubleshooting

3. `docs/public/`
   - concise reader-facing documentation for repository visitors
   - setup, architecture, usage, CI/CD, and deployment summaries

## Default documentation behavior

- Default destination is `docs/private/` unless the task clearly calls for public docs.
- Establish or update the private layer before rewriting `README.md` or `docs/public/`.
- Do not copy raw notes, prompts, or exploratory analysis into public docs verbatim.
- When AI is used meaningfully, save the prompt as a project asset in `docs/private/prompts/`.

## Required outputs for meaningful work

When work is substantial, create or update:

- a plan in `docs/private/plans/`
- a prompt in `docs/private/prompts/` when AI usage materially shaped the work
- a report in `docs/private/reports/`

When durable knowledge appears:

- procedures go to `docs/private/manuals/`
- concepts go to `docs/private/concepts/`
- architecture or technology choices go to `docs/private/decisions/`

## Naming conventions

- Use `kebab-case` for file names.
- Use `YYYY-MM-DD-topic.md` for plans, dated prompts, and reports.
- Use task-oriented names for manuals, such as `install-jenkins-in-docker.md`.

## Public documentation rules

Public docs must:
- stay concise,
- describe the actual application rather than internal scratch work,
- focus on architecture, setup, CI/CD, deployment, usage, and decisions,
- avoid private infrastructure details unless they are necessary for understanding the project.

Public docs must not expose:
- raw prompt transcripts,
- discarded experiments,
- secret values,
- private operational detail that is only relevant to maintainers.

## Working style

When asked to create or update documentation:
1. classify the artifact,
2. select the correct destination,
3. reuse repo-local skills and templates when they fit,
4. write complete Markdown content,
5. cross-link related plan, prompt, report, manual, concept, or decision files when useful.

## Prompt execution by name

When the user says:

`Zrealizuj <prompt-name>`

treat it as a request to find and execute a reusable prompt asset from the repository.

Prompt lookup order:
- first search `docs/private/prompts/`
- then search `examples/prompts/`

Resolution rules:
- match the exact file stem first, for example `bootstrap-project-documentation` -> `bootstrap-project-documentation.md`
- if no exact match exists, use the closest unambiguous kebab-case match
- after finding the file, read it fully and execute its instructions as the task
- continue to obey this `AGENTS.md`, `docs/review-report.md`, and any applicable skills while executing the prompt

## Skills

Prefer repo-local skills when they match the task:

- `.codex/skills/documentation-workflow/`
- `.codex/skills/laravel-plan-implementation/`
- `skills/jenkins-docker-cicd/`

Use `documentation-workflow` for plans, prompts, reports, manuals, and public/private doc restructuring.

Use `laravel-plan-implementation` for Laravel app code, tests, routes, validation, frontend cleanup, and README or environment updates tied to the review plan.

Use `jenkins-docker-cicd` for Jenkins, Docker, release pipeline, and deployment automation work.
