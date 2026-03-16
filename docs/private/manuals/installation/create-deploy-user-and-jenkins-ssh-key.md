# Create Deploy User And Jenkins SSH Key

## Goal

Create a dedicated deploy user for `rozliczPWS`, generate a dedicated SSH key pair for this project, add the public key to the production server, and store the private key in Jenkins as the `deploy-ssh-key` credential.

## Requirements

- Administrative access to the production server
- Access to Jenkins `Manage Credentials`
- A secure admin workstation or secure shell environment where you can generate the key pair

## Steps

1. Create the dedicated deploy user on the production server.

Recommended username:

```text
deploy
```

Create the user:

```bash
sudo adduser --disabled-password --gecos "" deploy
```

2. Add the deploy user to the web/application group.

Your current application directories use the `www` group, so add the new user to that group:

```bash
sudo usermod -aG www deploy
```

3. Prepare the deploy user's SSH directory on the production server.

```bash
sudo mkdir -p /home/deploy/.ssh
sudo chmod 700 /home/deploy/.ssh
sudo touch /home/deploy/.ssh/authorized_keys
sudo chmod 600 /home/deploy/.ssh/authorized_keys
sudo chown -R deploy:deploy /home/deploy/.ssh
```

4. Generate a dedicated key pair for this project on a secure admin machine.

Use a clear file name so you do not mix it with keys from other projects:

```bash
ssh-keygen -t ed25519 -C "rozliczpws deploy key" -f ~/.ssh/rozliczpws_deploy
```

This creates:
- private key: `~/.ssh/rozliczpws_deploy`
- public key: `~/.ssh/rozliczpws_deploy.pub`

5. Add the public key to the production server for the `deploy` user.

Append the public key contents to `authorized_keys`:

```bash
cat ~/.ssh/rozliczpws_deploy.pub
```

Copy the output and add it to:

```bash
/home/deploy/.ssh/authorized_keys
```

Example append command if you already copied the key onto the server:

```bash
cat /tmp/rozliczpws_deploy.pub | sudo tee -a /home/deploy/.ssh/authorized_keys
sudo chown deploy:deploy /home/deploy/.ssh/authorized_keys
sudo chmod 600 /home/deploy/.ssh/authorized_keys
```

6. Test SSH login with the new key before touching Jenkins.

From your admin machine:

```bash
ssh -i ~/.ssh/rozliczpws_deploy deploy@<deploy-host>
```

If it works, the key pair and user are correct.

7. Add the private key to Jenkins credentials.

In Jenkins:
- open `Manage Jenkins -> Credentials`
- choose the credentials scope you actually use for the pipeline
  - usually `System -> Global credentials (unrestricted)`
- click `Add Credentials`
- from the `Type` dropdown select:

```text
SSH Username with private key
```

Fill the form like this:
- `Scope`: `Global (Jenkins, nodes, items, all child items, etc)`
- `ID`: `deploy-ssh-key`
- `Description`: `rozliczpws deploy key`
- `Username`: `deploy`
- `Private Key`: choose `Enter directly`
- paste the full contents of the private key file `~/.ssh/rozliczpws_deploy`
  - it should start with something like:

```text
-----BEGIN OPENSSH PRIVATE KEY-----
```

  - and end with:

```text
-----END OPENSSH PRIVATE KEY-----
```

- leave passphrase empty only if the key was generated without passphrase
- otherwise Jenkins would also need the passphrase configured

Then click `Create`.

Use these values:
- `ID`: `deploy-ssh-key`
- `Username`: `deploy`
- `Private Key`: paste the contents of `~/.ssh/rozliczpws_deploy`
- `Description`: for example `rozliczpws deploy key`

8. Add or update the remaining Jenkins credentials for this project.

Create these three credentials in:

```text
Manage Jenkins -> Credentials -> System -> Global credentials (unrestricted) -> Add Credentials
```

1. `deploy-ssh-key`
   - `Type`: `SSH Username with private key`
   - `Scope`: `Global`
   - `ID`: `deploy-ssh-key`
   - `Description`: `rozliczpws deploy key`
   - `Username`: `deploy`
   - `Private Key`: `Enter directly`
   - paste the contents of `~/.ssh/rozliczpws_deploy`

2. `deploy-host`
   - `Type`: `Secret text`
   - `Scope`: `Global`
   - `Secret`: `<server-ip>` or `<server-hostname>`
   - `ID`: `deploy-host`
   - `Description`: `rozliczpws deploy host`

3. `deploy-user`
   - `Type`: `Secret text`
   - `Scope`: `Global`
   - `Secret`: `deploy`
   - `ID`: `deploy-user`
   - `Description`: `rozliczpws deploy user`

9. Confirm the deploy user can work with the application directory.

At minimum, test:

```bash
ssh -i ~/.ssh/rozliczpws_deploy deploy@<deploy-host>
cd <deploy-path>
php -v
composer --version
```

Also verify that the deploy user can write where needed:

```bash
touch <deploy-path>/deploy-write-test.tmp
rm <deploy-path>/deploy-write-test.tmp
```

If that fails, fix ownership or group permissions before running Jenkins deploys.

If the hosting panel manages immutable files such as `public/.user.ini`, do not try to hand them over to the deploy user. Keep them server-managed and exclude them from `rsync` in the pipeline.

## Verification

- `deploy` can log in through SSH using the new key
- Jenkins contains the `deploy-ssh-key` credential
- Jenkins also contains `deploy-host` and `deploy-user`
- The `deploy` user can access `<deploy-path>`

## Common problems

- `authorized_keys` has wrong permissions or ownership
- Jenkins stores the wrong private key or wrong username
- The deploy host in Jenkins points to a different server than the one you tested
- The `deploy` user can log in but cannot write into `<deploy-path>`
- The production server does not allow key-based login for the new user

## Rollback / cleanup

- If you created the wrong key pair, remove it from Jenkins and delete the matching public key line from `/home/deploy/.ssh/authorized_keys`
- If you created the wrong user, disable or remove it only after confirming no Jenkins job still depends on it
