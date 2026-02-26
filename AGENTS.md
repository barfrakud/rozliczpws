# AGENTS.md

## Purpose
This repository uses Codex CLI to implement and maintain changes based on `docs/review-report.md`.

## Default Working Contract
1. Read `docs/review-report.md` before major implementation work.
2. Execute work by phases (A -> B -> C -> D -> E).
3. Keep implementation level practical and junior-friendly.
4. Prefer safe refactors with tests over large rewrites.
5. Keep secrets out of repository.

## Available Local Skills
- `laravel-plan-implementation`  
  Description: Implements phases A, B, C, E from `docs/review-report.md` for Laravel app code, frontend cleanup, tests, and documentation.  
  File: `skills/laravel-plan-implementation/SKILL.md`

- `jenkins-docker-cicd`  
  Description: Implements phase D from `docs/review-report.md` with Jenkins in Docker, Jenkinsfile pipeline, deployment flow, and docs.  
  File: `skills/jenkins-docker-cicd/SKILL.md`

## Trigger Rules
Use `laravel-plan-implementation` when task touches app code, tests, routes, validation, or frontend cleanup.
Use `jenkins-docker-cicd` when task touches CI/CD, deployment automation, Jenkins, Docker, or release process.
Use both skills for end-to-end modernization tasks.

## Expected Delivery Style
1. Short implementation plan.
2. Code changes.
3. Verification output (tests/build).
4. Clear note of any unresolved blockers.
