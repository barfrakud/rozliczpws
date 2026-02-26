Implement the modernization plan from `review-report.md` in this repository.

Execution rules:
1. Read `review-report.md` first and treat it as the source of truth.
2. Implement phases in order: A -> B -> C -> D -> E.
3. Keep solutions at Junior Laravel level: clean, correct, no over-engineering.
4. Prefer small, reviewable commits (if commit mode is enabled).
5. Do not remove existing functionality unless explicitly required by the plan.

Required outcomes:
1. Phase A:
- fix routing consistency (remove `public/...` style paths),
- add backend validation with FormRequest classes,
- secure contact email flow (`from` app address, user email as `replyTo`),
- add/update `.env.example` and `.env.testing`,
- make `php artisan test` pass.

2. Phase B:
- refactor heavy controller logic into services,
- clean calculator naming and obvious typos,
- remove dead code or implement missing class intentionally,
- add/extend unit tests for business calculations.

3. Phase C:
- unify frontend asset pipeline (one toolchain),
- remove fragile JS/DOM patterns where practical,
- fix invalid view artifacts (placeholder form action, duplicate IDs).

4. Phase D (Jenkins + Docker):
- add `Jenkinsfile` with CI stages:
  - checkout,
  - composer install,
  - npm ci + production build,
  - php artisan test,
  - optional lint/style check,
- add deployment documentation for Jenkins running in Docker container,
- update deployment/update manuals to production-safe commands,
- include secure handling of credentials (no secrets in repo),
- include basic rollback strategy in docs.

5. Phase E:
- improve README (English) with setup, test, deploy, stack,
- remove unnecessary Polish learning comments,
- keep only meaningful comments and translate them to concise English.

Validation checklist (run before final summary):
- `php artisan test`
- frontend build command from chosen toolchain
- route list check for corrected endpoints

Output format:
1. Summary of implemented changes by phase.
2. Files changed.
3. Test/build results.
4. Remaining risks or TODOs (if any).

