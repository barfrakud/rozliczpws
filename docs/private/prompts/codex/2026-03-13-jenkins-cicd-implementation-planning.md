# Jenkins CI/CD Implementation Planning

## Goal

Record the prompt used to prepare a Jenkins-first CI/CD implementation plan for `rozliczPWS`.

## Model / Tool

Codex CLI

## Context

The project owner wants to introduce CI/CD using Jenkins because a server and builder agent already exist. The repository already contains a working `Jenkinsfile`, but the next step is to plan a more explicit and production-ready Jenkins flow using `Jenkinsfile_reference` from another project as a reference document.

## Prompt

Prepare a private implementation plan for Jenkins-based CI/CD in this repository according to the `documentation-workflow` skill.

Requirements:
- use Jenkins, not GitHub Actions, as the primary CI/CD tool,
- treat `Jenkinsfile_reference` as a reference source from another working project,
- compare it with the current repository `Jenkinsfile`,
- reuse only the parts that fit this Laravel application and current SSH release deployment model,
- keep the plan practical and junior-friendly,
- store the result in `docs/private/plans/YYYY-MM-DD-topic.md`,
- identify open questions instead of inventing infrastructure details when they matter.

Expected topics:
- builder agent usage,
- CI stage order,
- deploy strategy for `main`,
- rollback,
- credential handling,
- selective adoption of ideas from the reference pipeline,
- documentation updates required after implementation.

## Expected outcome

- A private implementation plan for Jenkins CI/CD
- Clear open questions for production deploy mode and builder-agent details
- A practical migration path from the current `Jenkinsfile` to a more explicit and hardened one
