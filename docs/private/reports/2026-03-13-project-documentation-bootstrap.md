# Project Documentation Bootstrap

## Date

2026-03-13

## Related plan

`docs/private/plans/2026-03-13-project-documentation-bootstrap.md`

## Related prompt

`docs/private/prompts/codex/2026-03-13-project-documentation-bootstrap.md`

## Goal

Reorganize repository documentation around the actual `rozliczPWS` application and align it with the private-first workflow already present in the repo.

## What was done

- Reviewed repository guidance, repo-local skills, public docs, manuals, prompts, reports, CI/CD files, routes, and core application files.
- Created dated private bootstrap artifacts for this documentation migration.
- Moved durable maintainer procedures into `docs/private/manuals/`.
- Moved implementation prompts and reports from the public `docs/` root into the private prompt/report structure.
- Rewrote `README.md`, `AGENTS.md`, and `docs/public/*` to describe the actual Laravel application, setup, usage, CI/CD, and deployment model.
- Added a private decision note for the Jenkins-in-Docker release pipeline.

## Files changed

- `AGENTS.md`
- `README.md`
- `docs/private/index.md`
- `docs/private/prompts/index.md`
- `docs/private/plans/2026-03-13-project-documentation-bootstrap.md`
- `docs/private/prompts/codex/2026-03-13-project-documentation-bootstrap.md`
- `docs/private/reports/2026-03-13-project-documentation-bootstrap.md`
- `docs/private/manuals/installation/install-jenkins-in-docker.md`
- `docs/private/manuals/operations/local-development-workflow.md`
- `docs/private/manuals/operations/jenkins-release-process.md`
- `docs/private/manuals/operations/dependency-update-policy.md`
- `docs/private/decisions/use-jenkins-docker-release-pipeline.md`
- `docs/public/index.md`
- `docs/public/overview.md`
- `docs/public/architecture.md`
- `docs/public/setup.md`
- `docs/public/ci-cd.md`
- `docs/public/deployment.md`
- `docs/public/usage.md`

## Result

- The repository now has a clear split between maintainer-facing private docs and concise public docs.
- Reader-facing documentation now matches the real application and its current architecture.
- Historical implementation prompts and reports are no longer mixed into the public documentation layer.

## Issues

- `docs/review-report.md` remains in the top-level `docs/` directory as a deliberate compatibility exception because current implementation workflow instructions still depend on that path.
- The foreign-trip calculator is still mostly a client-side flow, so the public docs explicitly avoid presenting it as fully backend-validated.

## Conclusions

- The repository already had the right documentation primitives, but they needed migration from template/example wording to project-specific wording.
- Keeping detailed release and update procedures private makes the public docs cleaner without losing operational knowledge.

## Next steps

1. Add screenshots to the public docs when stable UI captures are available.
2. Decide whether `docs/review-prompt.md` should remain a top-level historical artifact or move into `docs/private/prompts/generic/`.
3. Revisit the public architecture docs after any future backend implementation of the foreign-trip flow.
