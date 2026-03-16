# Public GitHub Sanitization Prompt

## Goal
Sanitize the dedicated public copy of the `rozliczPWS` repository before publishing it on GitHub.

## Model / Tool
Codex

## Context
The repository is a Laravel application prepared as a public portfolio project. The public copy must keep useful project documentation and setup guidance, but it must not expose local runtime artifacts, local database files, or documentation that assumes private maintainer-only context.

## Prompt
Review the repository as a public GitHub portfolio copy. Remove local generated artifacts that should not live in the public version, tighten ignore rules where needed, expand `.env.example` with safe project-specific placeholders, and rewrite public-facing documentation so it stands on its own without references to private maintainer-only docs.

## Expected outcome
- A clean public repo copy without local runtime artifacts.
- A safer `.env.example` for new contributors or reviewers.
- Public docs and README aligned with a portfolio-style repository.

## Notes
- Do not add real credentials or environment-specific values.
- Keep the changes practical and easy to maintain.
