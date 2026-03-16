# Jenkins CI/CD Implementation

## Goal

Record the prompt used to implement the approved Jenkins CI/CD plan for `rozliczPWS`.

## Model / Tool

Codex CLI

## Context

The repository already had a Jenkins pipeline, but the approved implementation plan narrowed it to a simpler model: use `Jenkinsfile_reference` only as a structural reference, run on the `docker-builder` agent, deploy in place through SSH to `<deploy-path>`, use the dedicated SSH credential ID `deploy-ssh-key`, keep `deploy-host` and `deploy-user`, and skip rollback and release symlinks.

## Prompt

Implement the plan from `docs/private/plans/2026-03-13-jenkins-cicd-implementation-plan.md`.

Requirements:
- create the new `Jenkinsfile` using `Jenkinsfile_reference` only where it fits this repository,
- keep the pipeline simple and limited to necessary stages,
- use `docker-builder` as the Jenkins agent label,
- validate required tools on the builder,
- run Composer install, npm install, tests, and production asset build,
- deploy only from `master`,
- deploy in place via SSH to `<deploy-path>`,
- keep `.env` and runtime directories on the server,
- use the SSH credential ID `deploy-ssh-key` together with `deploy-host` and `deploy-user`,
- update private and public deployment documentation so it matches the new pipeline,
- create the matching implementation report.

## Expected outcome

- Updated `Jenkinsfile`
- Updated private manuals and public CI/CD docs
- Implementation report documenting the final pipeline shape and remaining manual actions
