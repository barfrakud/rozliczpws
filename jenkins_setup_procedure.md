# Jenkins Docker - procedura uruchomienia i konfiguracji

Ten dokument opisuje kroki, które musisz wykonać ręcznie, aby uruchomić Jenkins i podłączyć pipeline z tego repozytorium.

## 1. Uruchom Jenkins w Dockerze

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

Pobierz hasło startowe:

```bash
docker exec jenkins cat /var/jenkins_home/secrets/initialAdminPassword
```

## 2. Konfiguracja podstawowa Jenkins
1. Zaloguj się do `http://<IP_SERWERA>:8080`.
2. Zainstaluj sugerowane pluginy.
3. Sprawdź, że zainstalowane są:
- `Pipeline`
- `Git`
- `SSH Agent`
- `Credentials Binding`

## 3. Dodaj Credentials (bez sekretów w repo)
W `Manage Jenkins -> Credentials` dodaj:

1. `deploy-ssh-key`  
Typ: `SSH Username with private key`  
Cel: połączenie SSH podczas deploy/rollback.

2. `deploy-host`  
Typ: `Secret text`  
Cel: host/IP serwera docelowego.

3. `deploy-user`  
Typ: `Secret text`  
Cel: użytkownik SSH na serwerze docelowym.

## 4. Przygotuj serwer aplikacji
Uruchom na serwerze docelowym:

```bash
sudo mkdir -p /var/www/rozliczpws/releases
sudo mkdir -p /var/www/rozliczpws/shared/storage
sudo mkdir -p /var/www/rozliczpws/shared/bootstrap/cache
sudo nano /var/www/rozliczpws/shared/.env
```

Minimalne ustawienia w `.env` produkcyjnym:
- `APP_ENV=production`
- `APP_DEBUG=false`
- poprawna konfiguracja DB/mail/cache.

## 5. Utwórz job Pipeline
1. `New Item -> Pipeline`.
2. Wskaż repozytorium Git.
3. Branch: `main`.
4. Pipeline from SCM, plik: `Jenkinsfile`.
5. Zapisz i uruchom build.

## 6. Podłącz webhook GitHub
W repozytorium GitHub dodaj webhook:

- URL: `http://<IP_LUB_DOMENA_JENKINS>/github-webhook/`
- Content type: `application/json`
- Event: `push`

## 7. Jak działa deploy
Pipeline (gałąź `main`) wykonuje:
1. checkout,
2. `composer install --no-interaction --prefer-dist`,
3. `npm ci`,
4. `npm run production`,
5. `php artisan test`,
6. deploy przez SSH do nowego release + przełączenie symlinka `current`.

## 8. Jak wykonać rollback
1. W Jenkins uruchom pipeline z parametrem `RUN_ROLLBACK=true`.
2. Pipeline przełączy `current` na `previous` i odświeży cache Laravel.

## 9. Checklist po wdrożeniu
- aplikacja odpowiada po HTTPS,
- logi aplikacji są zapisywane i rotowane,
- backup bazy działa cyklicznie,
- monitoring HTTP/DB/dysku jest aktywny.
