# Jenkins CI/CD Implementation

## Date

2026-03-13

## Related plan

`docs/private/plans/2026-03-13-jenkins-cicd-implementation-plan.md`

## Related prompt

`docs/private/prompts/codex/2026-03-13-jenkins-cicd-implementation.md`

## Goal

Implement a simple Jenkins-based CI/CD pipeline for `rozliczPWS` using the existing self-hosted builder agent and in-place SSH deployment.

## What was done

- Replaced the generic Jenkins agent with the `docker-builder` label taken from `Jenkinsfile_reference`.
- Added Jenkins job hardening with build retention, disabled concurrent builds, and explicit checkout.
- Added an early tool-validation stage for `php`, `composer`, `npm`, `ssh`, `rsync`, and required PHP extensions.
- Simplified the pipeline to the agreed stages: checkout, validation, install, tests, production asset build, and deploy.
- Removed rollback and release-symlink behavior from the pipeline.
- Switched deploy to in-place SSH sync under `<deploy-path>` while preserving server-side `.env` and runtime directories.
- Updated the deploy stage to use the dedicated Jenkins SSH credential ID `deploy-ssh-key`.
- Removed the extra branch `when` condition from the deploy stage after Jenkins job testing showed that the SCM-pipeline job already limited execution to `*/master`.
- Updated private and public documentation to describe the new deployment model.

## Files changed

- `Jenkinsfile`
- `README.md`
- `docs/private/manuals/operations/jenkins-release-process.md`
- `docs/private/manuals/operations/dependency-update-policy.md`
- `docs/private/decisions/use-jenkins-docker-release-pipeline.md`
- `docs/public/ci-cd.md`
- `docs/public/deployment.md`
- `docs/public/index.md`
- `docs/private/prompts/codex/2026-03-13-jenkins-cicd-implementation.md`
- `docs/private/reports/2026-03-13-jenkins-cicd-implementation.md`

## Result

- The repository now has a simpler Jenkins pipeline aligned with the current infrastructure and deployment preference.
- CI/CD documentation now matches the actual in-place deployment model instead of the earlier release-symlink design.

## Issues

- There is no automated rollback in this pipeline version.
- Production recovery still depends on manual redeploy of a known-good commit or server-side backup procedures.
- Local `composer install` validation from this workstation did not run because the local Composer wrapper points to a missing `C:\\ProgramData\\ComposerSetup\\bin\\composer.phar`; this looks like an environment issue outside the repository.

## Conclusions

- Using `Jenkinsfile_reference` selectively was enough to improve reliability without importing container-deployment complexity.
- The simplified in-place deploy is easier to understand and operate for the first production rollout.

## Next steps

1. Validate the pipeline on the real Jenkins instance and confirm builder tooling availability.
2. Run the first controlled deploy from `master`.
3. Decide later whether to add a manual approval gate or a more structured rollback path.
