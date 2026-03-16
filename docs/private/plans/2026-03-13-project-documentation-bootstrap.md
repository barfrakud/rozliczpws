# Project Documentation Bootstrap

## Goal

Bootstrap and reorganize the repository documentation so it matches the actual `rozliczPWS` Laravel project and follows the private-first workflow already present in the repository.

## Current state

The repository already contains `AGENTS.md`, repo-local skills, `docs/private/`, and `docs/public/`, but the documentation is mixed:
- public docs still describe a generic documentation-playbook repository instead of the Laravel application,
- durable procedures live in top-level `docs/*.md` files instead of `docs/private/manuals/`,
- implementation prompts and reports are stored in the public `docs/` root,
- `AGENTS.md` mentions an outdated skill path and does not clearly describe the actual project.

## Scope

- Create the required private bootstrap artifacts: plan, prompt, and report
- Move durable maintainer procedures into `docs/private/manuals/`
- Consolidate existing implementation prompts and reports into `docs/private/prompts/` and `docs/private/reports/`
- Rewrite `README.md`, `AGENTS.md`, and `docs/public/*` to describe the real application
- Preserve `docs/review-report.md` as the current implementation roadmap because active workflow instructions depend on it

## Steps

1. Inventory the repository and classify existing documentation by destination.
2. Create dated private bootstrap artifacts for this migration.
3. Migrate manuals, prompts, and reports from `docs/` root into the private structure.
4. Rewrite public documentation only after the private layer is established.
5. Verify command references, links, and remaining exceptions.

## Risks

- Public docs could accidentally overstate project maturity, especially for the foreign calculator.
- Moving documentation files could leave stale references behind.
- `docs/review-report.md` must remain compatible with the implementation workflow even if most other internal docs move under `docs/private/`.

## Definition of done

- The repository has dated private plan, prompt, and report files for the bootstrap task.
- Operational procedures live under `docs/private/manuals/`.
- Public docs and `README.md` describe `rozliczPWS` instead of the generic documentation workflow example.
- `AGENTS.md` is consistent with the actual skill paths and repository purpose.
- Old top-level manual and implementation-summary files are either migrated or removed without losing useful content.
