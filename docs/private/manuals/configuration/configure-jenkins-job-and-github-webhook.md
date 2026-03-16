# Configure Jenkins Job And GitHub Webhook

## Goal

Describe the exact Jenkins and GitHub configuration required so that a push to `master` starts the `rozliczPWS` pipeline automatically.

## Requirements

- Jenkins is already running and reachable from the network
- The repository contains the target `Jenkinsfile`
- Jenkins credentials already exist:
  - `deploy-ssh-key`
  - `deploy-host`
  - `deploy-user`
- A Jenkins agent with label `docker-builder` is available
- GitHub repository admin access is available

## Steps

1. In Jenkins, create a new pipeline job.

- Open `New Item`
- Enter a job name, for example `rozliczpws`
- Select `Pipeline`
- Click `OK`

2. Configure the Jenkins job to read the pipeline from the repository.

- In `General`, keep the job enabled
- In `Build Triggers`, enable `GitHub hook trigger for GITScm polling`
- In `Pipeline`, choose `Pipeline script from SCM`
- Set `SCM` to `Git`
- Enter the GitHub repository URL
- If the repository is private, attach the correct Git credentials
- Set `Branch Specifier` to:

```text
*/master
```

- Set `Script Path` to:

```text
Jenkinsfile
```

3. Confirm the Jenkins job can use the expected build agent.

- Open the `docker-builder` agent in Jenkins
- Confirm it is online
- Confirm it has:
  - `php`
  - `composer`
  - `npm`
  - `ssh`
  - `rsync`

4. Save the Jenkins job and run it manually once.

What to confirm:
- repository checkout works
- build runs on the `docker-builder` agent
- test stage executes
- deploy stage runs in this job because the Jenkins job itself is pinned to `*/master`

5. In GitHub, add the Jenkins webhook.

- Open the repository
- Go to `Settings -> Webhooks -> Add webhook`
- Set `Payload URL` to the public Jenkins webhook endpoint, for example:

```text
https://<jenkins-host>/github-webhook/
```

- Set `Content type` to:

```text
application/json
```

- Choose `Just the push event`
- Save the webhook

6. Validate webhook delivery from GitHub.

- Open the webhook in GitHub after saving it
- Check `Recent Deliveries`
- Confirm GitHub receives a successful response from Jenkins

7. Push a commit to `master` and confirm the full path works.

What to confirm:
- GitHub sends the webhook
- Jenkins starts the correct job automatically
- the job checks out the latest commit from `master`

## Verification

- Manual Jenkins build succeeds through CI stages
- Webhook delivery in GitHub is successful
- Push to `master` starts Jenkins automatically

## Common problems

- Missing `GitHub hook trigger for GITScm polling` prevents webhook-triggered builds
- Wrong repository credentials prevent checkout for private repositories
- Wrong branch specifier causes Jenkins to ignore `master`
- Offline or misconfigured `docker-builder` agent blocks the job
- Firewall or reverse-proxy issues block access to `/github-webhook/`

## Rollback / cleanup

- Disable the webhook in GitHub if you need to stop automatic builds temporarily
- Disable the Jenkins job if you want to prevent deploys without deleting configuration
