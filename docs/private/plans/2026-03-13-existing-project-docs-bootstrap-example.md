# Existing Project Docs Bootstrap Example

## Goal
Add a reusable example prompt that tells Codex how to analyze an existing repository and generate documentation according to this project's private-first standard.

## Current state
The repository contains only a simple example prompt focused on creating a single private implementation plan. There is no example covering documentation bootstrap for an already existing project with mixed or missing documentation.

## Scope
- Add a new example prompt under `examples/prompts/`
- Make the prompt convenient to execute with `Zrealizuj <prompt-name>`
- Define prompt-by-name execution behavior in `AGENTS.md`
- Update public-facing docs so the example is discoverable
- Keep the example aligned with `AGENTS.md` and the repo-local `documentation-workflow` skill

## Steps
1. Review existing examples and public documentation references.
2. Write a new Codex prompt example for analyzing and documenting an existing repository.
3. Add a repository convention for executing prompt assets by name.
4. Update public documentation to reference the new example and invocation pattern.
5. Record the change in matching prompt and report artifacts.

## Risks
- The prompt could be too generic and produce vague output.
- The prompt could assume the target repository already has all workflow files copied in.
- The prompt name could be too long or awkward for practical invocation.
- The prompt could ignore existing `AGENTS.md` or skills and create conflicting guidance.
- Public docs could mention the example without clearly explaining its purpose.

## Definition of done
- A new example prompt exists in `examples/prompts/`.
- The prompt has a short, practical name suitable for `Zrealizuj <prompt-name>`.
- `AGENTS.md` defines how prompt assets are resolved and executed by name.
- Public docs reference the example in a discoverable place.
- The example explicitly instructs Codex to analyze the whole project, classify existing documentation, use repository skills when available, and keep new `AGENTS.md` or skills consistent with existing ones.
