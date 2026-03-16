# Project Documentation Bootstrap

## Goal

Execute the reusable `bootstrap-project-documentation` prompt against the current `rozliczPWS` repository and convert the mixed documentation set into a coherent private-first structure.

## Model / Tool

Codex CLI

## Context

The repository already contains `AGENTS.md`, repo-local skills, private/public documentation folders, and several project manuals. However, the public docs still describe a documentation template repository instead of the Laravel app, while manuals, prompts, and reports are scattered across the top-level `docs/` directory.

## Prompt

Bootstrap documentation for this repository by following these rules:
- read `AGENTS.md`, `docs/review-report.md`, and the repo-local `documentation-workflow` skill first
- inspect existing public docs, private docs, manuals, prompts, reports, CI/CD files, routes, and README content before writing
- keep `docs/review-report.md` as an active roadmap input because the repository workflow depends on it
- create a dated private plan, prompt, and report for this bootstrap task
- move durable operational procedures into `docs/private/manuals/`
- move historical implementation prompts and reports out of the top-level `docs/` directory into `docs/private/prompts/` and `docs/private/reports/`
- rewrite `README.md`, `AGENTS.md`, and `docs/public/*` so they describe the actual `rozliczPWS` application, its setup, architecture, usage, CI/CD, and deployment model
- preserve useful existing material and remove obvious duplicates instead of generating generic templates
- keep wording professional and concise in public docs, while retaining detailed maintainer instructions in private manuals

## Expected outcome

- A coherent private documentation layer for project plans, prompts, reports, and manuals
- Public-facing docs that describe the Laravel application instead of the documentation workflow example
- Updated repository guidance that points to `.codex/skills/...` and the real project workflows

## Notes

- Cross-link the bootstrap plan and report where useful.
- Keep the final public docs honest about the current state of the foreign-trip calculator and deployment workflow.
