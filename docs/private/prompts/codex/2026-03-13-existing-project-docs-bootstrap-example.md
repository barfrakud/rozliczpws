# Existing Project Docs Bootstrap Example

## Goal
Create a public example prompt for Codex that can be reused in an existing repository to bootstrap documentation according to this project's standard.

## Model / Tool
Codex CLI

## Context
The repository already demonstrates a private-first documentation workflow, but it lacks a prompt example for the common migration case: an existing project with scattered, inconsistent, or missing documentation that needs to be reorganized and expanded using the same workflow. The prompt should also be practical to invoke via `Zrealizuj <prompt-name>`.

## Prompt
Create a reusable example prompt for Codex that:
- can be invoked comfortably by name, for example `Zrealizuj bootstrap-project-documentation`
- tells Codex to read existing `AGENTS.md` and repo-local skills before changing repository guidance
- starts with the repo-local `documentation-workflow` skill when it exists and fits the task
- tells Codex to inspect the whole repository before writing
- classifies existing docs into public docs, private working docs, manuals, concepts, decisions, plans, prompts, and reports
- handles missing documentation by generating the right files instead of leaving placeholders
- updates `README.md` and public docs only after the private layer is established
- avoids copying rough notes directly into public docs
- preserves and refines useful existing documentation instead of rewriting blindly
- keeps new or updated `AGENTS.md` and skills consistent with any existing repository guidance instead of creating conflicting duplicates

## Expected outcome
- A new example prompt in `examples/prompts/`
- A short prompt name suitable for direct execution by name
- A repository convention in `AGENTS.md` for resolving and executing prompt assets
- Public references to the example in repository docs
- Wording that is specific enough to be used in another repository with minimal edits

## Notes
- The example should be written in English to match the rest of the repository documentation.
- The prompt should mention the skill explicitly, but also degrade gracefully if the target repository has not copied the skill yet.
- The prompt should handle both cases: no `AGENTS.md` or skills yet, and repositories where they already exist and must stay coherent.
