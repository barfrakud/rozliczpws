# Deployment

## Summary

Production deployment uses an in-place SSH update strategy driven by Jenkins and guarded by branch-based deploy rules.

## Architecture / Design

- Jenkins syncs code and built assets directly into `<deploy-path>`.
- Production configuration remains on the server in `.env`.
- Writable runtime paths such as `storage` and `bootstrap/cache` are preserved on the server.

## Setup or usage

- Prepare the target server directory at `<deploy-path>`.
- Keep production environment configuration outside the repository.
- Run migrations and Laravel cache commands during deploy.
- Ensure the website runtime in `<hosting-panel>` uses PHP `8.2`, not only the CLI on the server.

## Operational notes

- This pipeline version does not include automated rollback.
- After deploy, verify the homepage, the main calculator flow, and the PHP version assigned to the site in `<hosting-panel>`.
- Production hardening should include `APP_ENV=production`, `APP_DEBUG=false`, HTTPS, proxy awareness, log rotation, backups, and basic monitoring.

## Key decisions

- Deployment is automated only for `master`.
- In-place deployment is intentionally simpler for the first Jenkins rollout in this project.
