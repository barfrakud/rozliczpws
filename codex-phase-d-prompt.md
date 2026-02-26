Implement only **Phase D** from `review-report.md` for this repository.

Scope:
- CI/CD with Jenkins running in Docker on server
- production-safe deployment process
- rollback strategy
- documentation updates

Rules:
1. Read `review-report.md` and apply only items from Phase D (points 11, 12, 13).
2. Do not refactor unrelated app logic from phases A/B/C/E.
3. Keep changes practical and maintainable (junior-friendly, no over-engineering).
4. Never commit secrets, keys, or credentials.

Required implementation:

1. Add Jenkins pipeline
- Create `Jenkinsfile` with stages:
  - Checkout
  - Install PHP deps (`composer install --no-interaction --prefer-dist`)
  - Install Node deps (`npm ci`)
  - Build production assets (chosen toolchain from repo)
  - Run tests (`php artisan test`)
  - Optional lint/style stage
- Add branch guard:
  - deploy stage runs only for `main`

2. Add deployment stage (main only)
- Deploy via SSH-based approach (rsync/scp + remote commands).
- Use Jenkins Credentials for SSH key and any sensitive values.
- Include safe sequence on server side:
  - fetch/sync release
  - install prod deps (`composer install --no-dev --prefer-dist --optimize-autoloader`)
  - run artisan optimization commands suitable for production
  - keep app available or minimize downtime

3. Add rollback strategy
- Document and implement simple rollback in pipeline/docs:
  - previous release pointer/symlink or backup directory
  - rollback command/step in Jenkins (manual or scripted)

4. Harden deployment docs
- Update `release_manual.md` and `update_manual.md`:
  - remove unsafe production commands (`composer update`, `npm audit fix --force` on prod)
  - document Jenkins Docker setup baseline:
    - persistent volume (`jenkins_home`)
    - restart policy `always`
    - GitHub webhook trigger
  - document required Jenkins credentials and environment variables

5. Add setup notes for server production config
- Add/update concise section covering:
  - `APP_ENV=production`, `APP_DEBUG=false`
  - HTTPS and proxy awareness
  - logs/backup/monitoring baseline

Deliverables:
1. `Jenkinsfile`
2. Updated deployment docs (`release_manual.md`, `update_manual.md`, and optionally README)
3. Clear list of required Jenkins credentials (names and purpose, no values)
4. Rollback procedure documented and linked to pipeline flow

Validation before final output:
- Pipeline file syntax is coherent
- Commands referenced in docs match repository toolchain
- `php artisan test` result reported

Final response format:
1. Implemented changes
2. Files changed
3. Validation results
4. Remaining manual actions for server/Jenkins admin

