# Skill: jenkins-docker-cicd

## Goal
Implement phase D from `review-report.md` using Jenkins running as a Docker container.

## Inputs
- `review-report.md`
- existing release/update manuals
- repository build/test commands

## Workflow
1. Define CI pipeline stages in `Jenkinsfile`:
   - checkout
   - composer install
   - npm ci + production build
   - php artisan test
   - optional lint/style
2. Add deploy stage guarded to `main` branch only.
3. Document credentials usage via Jenkins Credentials (no secrets in repo).
4. Document rollback strategy.
5. Update deployment manuals to production-safe commands.

## Jenkins-in-Docker Baseline
- persistent volume for Jenkins home (`jenkins_home`)
- restart policy `always`
- GitHub webhook trigger
- optional: separate deploy user + SSH key from Jenkins credentials store

## Security Rules
- Never commit secrets, private keys, or plain-text credentials.
- Keep environment variables in Jenkins credentials or server env files.
- Ensure deploy actions are branch-gated and explicit.

## Validation
- Jenkins pipeline syntax valid
- local equivalent commands pass:
  - composer install
  - npm ci + build
  - php artisan test

## Deliverables
- `Jenkinsfile`
- updated deployment docs
- clear setup notes for Jenkins Docker runtime

