# CI/CD

## Summary

The repository includes a Jenkins declarative pipeline that builds the application, runs tests, and deploys only from the `master` branch.

## Architecture / Design

- Jenkins is expected to run in Docker with a persistent `jenkins_home` volume.
- The pipeline uses the `docker-builder` agent label from the existing Jenkins setup.
- The pipeline stages are checkout, agent validation, Composer install, npm install, tests, production asset build, and deploy.
- Deploy uses SSH-based remote commands guarded by Jenkins credentials.

## Setup or usage

- The main verification commands are:
  - `composer install --no-interaction --prefer-dist`
  - `npm ci`
  - `npm run production`
  - `php artisan test`

## Operational notes

- The Jenkins job should be configured to build `*/master`, so deploy runs only for that branch.
- Jenkins should be configured with the `GitHub hook trigger for GITScm polling` trigger so push events start the pipeline automatically.
- Production deploy updates `<deploy-path>` in place.
- There is no automated rollback in the current pipeline.
- After each deploy, verify the homepage, core calculator flow, and the PHP version assigned to `<production-domain>` in `<hosting-panel>`.

## Key decisions

- The pipeline always proves the production asset build before deploy.
- Credentials stay in Jenkins, not in repository files.
