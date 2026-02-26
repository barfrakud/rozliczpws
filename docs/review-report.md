# Review Report - rozliczPWS

## 1. Ogólna opinia

Projekt ma dobrą wartość praktyczną do publicznego portfolio, szczególnie pod profil SysAdmin/DevOps: rozwiązuje realny problem biznesowy, zawiera własną logikę obliczeń i ma dokumentację wdrożeniową.

Aktualny stan to „działający prototyp z potencjałem produkcyjnym”, ale przed publikacją na GitHubie/CV i wdrożeniem pod `rozliczpws.pl` wymaga uporządkowania w czterech obszarach:
- walidacja i struktura backendu,
- spójność frontendu/builda,
- jakość testów,
- twarde przygotowanie do produkcji.

Zakres zmian może pozostać na poziomie **Junior Laravel Developer**: czysto, przewidywalnie i bez over-engineeringu.

## 2. Najważniejsze ustalenia (wg wagi)

### Krytyczne

1. Niespójny routing/URL (`public/...` w trasach i AJAX) może powodować błędy między środowiskami.
2. Kluczowe endpointy obliczeń opierają się na kształcie danych z frontu i stringach typu `"true"` bez ścisłej walidacji backendowej.

### Wysokie

3. Formularz kontaktowy ustawia nadawcę maila z danych użytkownika (`from`), co jest ryzykowne dla SPF/DMARC i dostarczalności.
4. Pipeline builda jest niespójny: jednocześnie Mix i Vite, a wiele wejść JS trafia do jednego pliku wyjściowego.
5. Testy automatyczne są praktycznie startowe (example tests), a aktualny test feature nie przechodzi.
6. `minimum-stability` ustawione na `dev` podnosi ryzyko zależności w produkcji.

### Średnie

7. Frontend używa kruchego składania HTML przez stringi i globalnych stanów.
8. `foreign.blade.php` zawiera artefakty (`foo.php`, zduplikowane ID), co obniża niezawodność.
9. Instrukcje wdrożeniowe zawierają ryzykowne praktyki produkcyjne (`composer update`, `npm audit fix --force`).

### Niskie

10. W kodzie jest dużo komentarzy naukowych po polsku i literówki w nazewnictwie (`obiczOgolem`), co obniża profesjonalny odbiór repo.

## 3. Plan refaktoryzacji i modernizacji (wg priorytetów)

## Faza A - Krytyczna gotowość (blokery przed publikacją)

1. **Naprawa spójności routingu**
- Usunąć `public/...` z tras aplikacji.
- Używać nazwanych tras (`route()`) w Blade/JS.

2. **Walidacja backendowa requestów**
- Dodać klasy `FormRequest` dla:
  - obliczenia podsumowania podróży krajowej,
  - obliczenia końcowego rachunku krajowego,
  - formularza kontaktowego.
- Walidować typy, zakresy i pola wymagane po stronie serwera.

3. **Bezpieczna wysyłka maili kontaktowych**
- Ustawić `from` na adres aplikacji (`MAIL_FROM_ADDRESS`).
- Email użytkownika ustawiać jako `replyTo`.
- Dodać brakujące klucze do `.env.example` (w tym `MAIL_DESTINATION`).

4. **Stabilizacja środowiska testowego**
- Dodać `.env.testing` i przewidywalną konfigurację DB testów.
- Doprowadzić `php artisan test` do stanu zielonego.

## Faza B - Uporządkowanie backendu (utrzymanie)

5. **Refaktoryzacja odpowiedzialności kontrolerów**
- Przenieść logikę obliczeń z `HomeController` do dedykowanych serwisów.
- Zostawić w kontrolerach: walidacja + wywołanie serwisu + odpowiedź.

6. **Czyszczenie klas kalkulatora**
- Ujednolicić nazwy metod (angielski, bez literówek).
- Ograniczyć powtórne obliczenia tych samych danych.
- Dodać proste testy jednostkowe reguł biznesowych.

7. **Usunięcie martwego/niedokończonego kodu**
- Albo zaimplementować `ForeignTripClass`, albo usunąć.

## Faza C - Stabilność frontendu i builda

8. **Ujednolicenie narzędzia assetów**
- Wybrać jeden bundler (rekomendacja: Vite) i usunąć duplikację konfiguracji.
- Rozdzielić wejścia JS/CSS w czytelny sposób.

9. **Podniesienie jakości JS**
- Zastąpić ryzykowne `append`/`innerHTML` bezpieczniejszym podejściem.
- Ograniczyć zmienne globalne i niejawne side-effecty.

10. **Poprawa widoków**
- Usunąć placeholderowe akcje formularzy.
- Zapewnić unikalne identyfikatory `id`.
- Utrzymać szablony w lekkiej, czystej formie.

## Faza D - DevOps / przygotowanie produkcyjne

11. **Bezpieczny baseline wdrożeń**
- Zmienić manuale na bezpieczne komendy produkcyjne:
  - `composer install --no-dev --prefer-dist --optimize-autoloader`
  - build assetów wykonywać w Jenkins CI/CD.
- Nie używać `composer update` ani `npm audit fix --force` bezpośrednio na produkcji.

12. **Utwardzenie konfiguracji produkcyjnej**
- `APP_ENV=production`, `APP_DEBUG=false`,
- HTTPS, nagłówki bezpieczeństwa, poprawne trusted proxies,
- backupy bazy, rotacja logów, monitoring i alerting.

13. **CI/CD w Jenkins (Docker na serwerze)**
- Uruchomić Jenkins jako kontener Docker z trwałym wolumenem na dane (`jenkins_home`) oraz restart policy `always`.
- Skonfigurować webhook z GitHub do joba/pipeline (trigger po push do `main` oraz opcjonalnie po PR).
- Dodać `Jenkinsfile` do repo i zdefiniować minimalne etapy:
  - checkout kodu,
  - `composer install --no-interaction --prefer-dist`,
  - `npm ci` + build assetów produkcyjnych,
  - `php artisan test`,
  - opcjonalnie lint/style check.
- Skonfigurować bezpieczne sekrety w Jenkins Credentials (SSH key, zmienne środowiskowe, ewentualne tokeny), bez trzymania ich w repo.
- Dodać etap deploy tylko dla `main` (np. SSH + rsync/scp + komendy `artisan`) oraz prosty mechanizm rollbacku do poprzedniego release.

## Faza E - Dokumentacja i odbiór w CV

14. **Lepszy README (angielski)**
- Cel projektu,
- uruchomienie lokalne,
- testy,
- skrót procesu wdrożenia,
- stack technologiczny,
- screenshoty.

15. **Polityka komentarzy (zgodnie z wymaganiem)**
- Usunąć komentarze opisujące oczywistości.
- Zostawić tylko komentarze wyjaśniające reguły biznesowe/prawne.
- Wszystkie zachowane komentarze przepisać na zwięzły angielski.

## 4. Zasady optymalizacji komentarzy

Stosować prostą regułę:
- **Usuń** komentarz, jeśli opisuje oczywiste operacje.
- **Zostaw i przetłumacz**, jeśli wyjaśnia nieoczywistą regułę biznesową.
- **Pisz po angielsku**, krótko i technicznie.

Przykład:
- Było: `//Odebranie danych i przypisanie do zmiennych`
- Docelowo: *(usunąć komentarz)*

Przykład:
- Było: `// Obliczenie Diety`
- Docelowo: `// Calculate per-diem according to domestic travel rules.`

## 5. Sugerowana kolejność realizacji

1. Faza A (blokery publikacji)
2. Faza B (porządek backendu)
3. Faza C (frontend/build)
4. Faza D (utwardzenie wdrożeniowe)
5. Faza E (dokumentacja i polish pod CV)

Ta kolejność daje najszybszą drogę do bezpiecznej publikacji repo i pierwszego stabilnego wdrożenia produkcyjnego.
