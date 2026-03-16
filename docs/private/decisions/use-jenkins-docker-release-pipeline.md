# Use Jenkins Docker Release Pipeline

## Status

Accepted

## Context

The project needs a production-oriented deployment workflow that is understandable at junior level, keeps secrets outside the repository, and fits an existing single-server deployment target.

## Decision

Use a Jenkins declarative pipeline stored in `Jenkinsfile`, run Jenkins in Docker with a persistent `jenkins_home` volume, execute builds on the `docker-builder` agent, and deploy via SSH directly into `<deploy-path>`.

## Consequences

- CI verifies Composer install, npm install, production asset build, and tests before deploy.
- Deploys are gated to the `master` branch.
- Secrets remain in Jenkins Credentials and the production `.env` stored on the server.
- The pipeline stays simpler, but recovery from a failed deploy requires manual redeploy or backup restore because there is no automated rollback.

## Related docs

- `docs/public/ci-cd.md`
- `docs/public/deployment.md`
- `docs/private/manuals/installation/install-jenkins-in-docker.md`
- `docs/private/manuals/operations/jenkins-release-process.md`
