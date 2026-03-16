# Public GitHub Sanitization

## Goal
Prepare the dedicated public copy of `rozliczPWS` for first publication on GitHub without exposing local data, generated artifacts, or private operational context.

## Current state
The repository copy already separates `.env` through `.gitignore`, but it still contains local generated artifacts, a local SQLite database, and public-facing docs that reference maintainer-only material.

## Scope
- remove local generated artifacts from the public copy,
- tighten ignore rules for local database and framework cache files,
- expand `.env.example` with project-specific safe placeholders,
- simplify README and public docs for a public portfolio audience.

## Steps
1. Remove generated runtime files and local database artifacts from the working tree.
2. Update ignore rules and `.env.example` for safe public onboarding.
3. Rewrite public-facing documentation to avoid private-doc references.

## Risks
- Documentation can drift from actual deployment details if summaries become too generic.
- Removing local artifacts from the public copy requires the user to regenerate them locally after clone.

## Definition of done
- Public repo copy contains no local SQLite data, logs, sessions, compiled Blade views, or framework cache files.
- `.env.example` includes the project-specific non-secret keys needed for setup.
- README and public docs are suitable for a public GitHub portfolio repository.
