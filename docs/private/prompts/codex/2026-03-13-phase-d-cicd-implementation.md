# Phase D CI/CD Implementation

## Goal

Record the Codex prompt used to implement only Phase D from `docs/review-report.md`.

## Model / Tool

Codex CLI

## Context

Phase D focused on safe production deployment with Jenkins running in Docker, rollback support, and updated deployment manuals.

## Prompt

Implement only Phase D from `docs/review-report.md` for this repository.

Scope:
- CI/CD with Jenkins running in Docker on server
- production-safe deployment process
- rollback strategy
- documentation updates

Rules:
1. Read `docs/review-report.md` and apply only items from Phase D.
2. Do not refactor unrelated app logic from phases A, B, C, or E.
3. Keep changes practical and maintainable.
4. Never commit secrets, keys, or credentials.

Required implementation:
- declarative Jenkins pipeline
- deploy stage guarded to `main`
- SSH-based deploy with safe production commands
- rollback strategy
- updated deployment and update documentation
- concise production hardening notes

Validation:
- pipeline syntax should be coherent
- documented commands should match repository toolchain
- report `php artisan test` result

## Expected outcome

- `Jenkinsfile`
- deployment documentation updates
- list of required Jenkins credentials
- documented rollback procedure
