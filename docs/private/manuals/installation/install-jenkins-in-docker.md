# Install Jenkins In Docker

## Goal

Document the manual steps required to start Jenkins in Docker and connect it to the repository pipeline.

## Requirements

- Linux server with Docker installed
- Open ports for Jenkins UI and inbound agent traffic if needed
- Access to the GitHub repository and deployment host

## Steps

1. Create persistent storage and start Jenkins.

```bash
docker volume create jenkins_home

docker run -d \
  --name jenkins \
  --restart always \
  -p 8080:8080 \
  -p 50000:50000 \
  -v jenkins_home:/var/jenkins_home \
  -v /var/run/docker.sock:/var/run/docker.sock \
  jenkins/jenkins:lts
```

2. Read the initial admin password.

```bash
docker exec jenkins cat /var/jenkins_home/secrets/initialAdminPassword
```

3. In Jenkins UI, install suggested plugins and confirm that at least these plugins are available:
- Pipeline
- Git
- GitHub
- SSH Agent
- Credentials Binding

4. Create credentials in `Manage Jenkins -> Credentials`:
- `deploy-ssh-key`
- `deploy-host`
- `deploy-user`

5. Ensure the build agent used by this repository exists and has the label `docker-builder`.

The agent must have at least:
- `php`
- `composer`
- `npm`
- `ssh`
- `rsync`
- PHP extensions required by the project test suite

For the full package and extension checklist, use:

- `docs/private/manuals/installation/verify-build-agent-and-production-server-requirements.md`
- `docs/private/manuals/installation/create-deploy-user-and-jenkins-ssh-key.md`

6. Configure the Jenkins job and GitHub webhook using:

- `docs/private/manuals/configuration/configure-jenkins-job-and-github-webhook.md`

## Verification

- Jenkins UI is reachable
- The pipeline job can checkout the repository
- A manual build reaches the test stage successfully
- A push to `master` triggers the pipeline through GitHub webhook

## Common problems

- Missing persistent volume causes Jenkins state loss after container recreation.
- Missing Docker socket mount prevents container-side Docker usage if it is later needed.
- Firewall or reverse-proxy issues can block webhook delivery.

## Rollback / cleanup

- Stop and remove the container only if you intentionally want to rebuild Jenkins:

```bash
docker stop jenkins
docker rm jenkins
```

- Keep the `jenkins_home` volume unless you deliberately want to erase Jenkins state.
