# Laravel Code Refactoring - Analysis

# Findings

- **Monolityczny [HomeController](cci:2://file:///c:/Users/Bartek/Xampp/htdocs/rozliczpws/app/Http/Controllers/HomeController.php:8:0-144:1)**  
  [app/Http/Controllers/HomeController.php](cci:7://file:///c:/Users/Bartek/Xampp/htdocs/rozliczpws/app/Http/Controllers/HomeController.php:0:0-0:0) scala logikę widoków i biznesową (np. obliczenia delegacji). Metody [krajowaObliczPodroze()](cci:1://file:///c:/Users/Bartek/Xampp/htdocs/rozliczpws/app/Http/Controllers/HomeController.php:35:4-58:5) i [krajowaObliczRachunek()](cci:1://file:///c:/Users/Bartek/Xampp/htdocs/rozliczpws/app/Http/Controllers/HomeController.php:60:4-123:5) tworzą tablice wyników, formatują dane i wołają klasę [NationalTripClass](cci:2://file:///c:/Users/Bartek/Xampp/htdocs/rozliczpws/app/Classes/NationalTripClass.php:6:0-177:1), co utrudnia testowanie i ponowne użycie.

- **Duża klasa z logiką proceduralną**  
  [app/Classes/NationalTripClass.php](cci:7://file:///c:/Users/Bartek/Xampp/htdocs/rozliczpws/app/Classes/NationalTripClass.php:0:0-0:0) ma kilkanaście funkcji operujących na czystych tablicach, brak typów oraz walidacji. [ForeignTripClass.php](cci:7://file:///c:/Users/Bartek/Xampp/htdocs/rozliczpws/app/Classes/ForeignTripClass.php:0:0-0:0) jest pusty, co wskazuje na niedokończoną funkcjonalność.

- **Rozbudowane widoki Blade**  
  [resources/views/national.blade.php](cci:7://file:///c:/Users/Bartek/Xampp/htdocs/rozliczpws/resources/views/national.blade.php:0:0-0:0) i [resources/views/foreign.blade.php](cci:7://file:///c:/Users/Bartek/Xampp/htdocs/rozliczpws/resources/views/foreign.blade.php:0:0-0:0) zawierają setki linii HTML/JS, logikę walidacji i manipulację DOM. Brak komponentów Blade/Livewire, brak podziału na pliki JS/CSS (np. `console.log` w layoucie).

- **Routing i nazewnictwo**  
  W [routes/web.php](cci:7://file:///c:/Users/Bartek/Xampp/htdocs/rozliczpws/routes/web.php:0:0-0:0) ścieżki POST mają prefiks `public/…`, co nie jest typowe dla Laravela i może powodować problemy przy wersjonowaniu URL. Części kodu (komentarze) wskazują na nieużywane elementy Auth.

- **Model [Contact](cci:2://file:///c:/Users/Bartek/Xampp/htdocs/rozliczpws/app/Models/Contact.php:7:0-10:1) bez wypełniacza**  
  [app/Models/Contact.php](cci:7://file:///c:/Users/Bartek/Xampp/htdocs/rozliczpws/app/Models/Contact.php:0:0-0:0) nie definiuje `$fillable`, co w przyszłości utrudni masowe przypisanie. [ContactController::store()](cci:1://file:///c:/Users/Bartek/Xampp/htdocs/rozliczpws/app/Http/Controllers/ContactController.php:10:4-41:5) używa starszego API `\Mail::send` bez obsługi wyjątków.

- **Konfiguracja i środowisko**  
  [config/rozliczpws.php](cci:7://file:///c:/Users/Bartek/Xampp/htdocs/rozliczpws/config/rozliczpws.php:0:0-0:0) zawiera zakomentowane stare stawki. Brak plików migracji aktualizujących te wartości z poziomu bazy. Prawdopodobnie część logiki walidacyjnej przeniesiona na front, brak FormRequest.

# Problemy wymagające refaktoryzacji

- **Oddzielenie logiki biznesowej:** wydzielenie serwisów (np. `NationalTripService`, `SettlementCalculator`) i wprowadzenie warstw DTO/Response do formatowania danych.
- **Walidacja i obsługa błędów:** użycie `FormRequest` (np. `KrajowaPodrozRequest`) zamiast ręcznych `input()` w kontrolerze; dodanie wyjątków dla błędnych dat.
- **Porządki w widokach:** rozbicie formularzy na mniejsze komponenty, przeniesienie JS do `resources/js/…`, wykorzystanie `@push('scripts')`. Rozważyć Livewire/Inertia dla reaktywności.
- **Routing i struktura katalogów:** usunięcie prefiksów `public/…`, uporządkowanie namespacingu (np. `Trip` jako moduł z osobnymi kontrolerami). Dodanie route model binding gdzie to ma sens.
- **Testy jednostkowe:** brak testów dla obliczeń diet/noclegów; należy dodać testy `phpunit` i ewentualnie testy feature dla formularzy.
- **Konfiguracja i międzynarodowość:** wprowadzić wersjonowanie stawek przez bazę lub pliki konfiguracyjne per rok; rozważyć [lang/](cci:7://file:///c:/Users/Bartek/Xampp/htdocs/rozliczpws/lang:0:0-0:0) do komunikatów w widokach.

# Rekomendowany plan działania

1. **Moduł `Trip`**  
   - **Cel:** wydzielenie obszaru delegacji.  
   - **Kroki:** utworzyć katalog `app/Services/Trip`; przenieść logikę z [NationalTripClass](cci:2://file:///c:/Users/Bartek/Xampp/htdocs/rozliczpws/app/Classes/NationalTripClass.php:6:0-177:1) do serwisów z jasno nazwanymi metodami i typami zwracanych danych.

2. **Refaktoryzacja kontrolerów**  
   - Utworzyć `NationalTripController` i `ForeignTripController`.  
   - Użyć `FormRequest` (`StoreNationalJourneyRequest`, `CalculateNationalSettlementRequest`) do walidacji danych wejściowych.  
   - Zwracać struktury jednej odpowiedzialności (np. zasoby JSON).

3. **Front-end**  
   - Przenieść JS do `resources/js/modules/*.js`, wprowadzić Vite bundling (aktualizacja [package.json](cci:7://file:///c:/Users/Bartek/Xampp/htdocs/rozliczpws/package.json:0:0-0:0)).  
   - Użyć komponentów Blade (`resources/views/components/`) dla sekcji formularzy i tabel.

4. **Warstwa danych**  
   - Poszerzyć model [Contact](cci:2://file:///c:/Users/Bartek/Xampp/htdocs/rozliczpws/app/Models/Contact.php:7:0-10:1) o `$fillable`, migracje z kolumną `status`, obsługę soft deletes.  
   - Rozważyć dodanie modeli/encji dla przejazdów jeśli planowane jest ich zapisywanie.

5. **Testy i CI**  
   - Napisać testy jednostkowe dla obliczeń (`tests/Unit/NationalTripServiceTest.php`).  
   - Skonfigurować GitHub Actions / GitLab CI do uruchamiania `phpunit` i `npm run build`.

6. **Porządki w konfiguracji**  
   - Zastąpić zakomentowane stawki strukturą [config/rozliczpws.php](cci:7://file:///c:/Users/Bartek/Xampp/htdocs/rozliczpws/config/rozliczpws.php:0:0-0:0) z historią (`'rates' => ['2023-01-01' => [...]]`).  
   - Użyć [.env](cci:7://file:///c:/Users/Bartek/Xampp/htdocs/rozliczpws/.env:0:0-0:0) do ustawień docelowych e-mail, wprowadzić `config/mail.php` override.

# Kolejne kroki

- **Audyt front-endu:** ocenić aktualny stack JS (sprawdzić `public/js/app.js`) i zdecydować, czy refaktoryzować do frameworka (Vue/React) czy uprościć vanilla JS.
- **Zarządzanie treścią:** rozważyć przeniesienie dużych statycznych bloków ([resources/views/legal.blade.php](cci:7://file:///c:/Users/Bartek/Xampp/htdocs/rozliczpws/resources/views/legal.blade.php:0:0-0:0)) do CMS lub plików markdown z parserem.

Daj znać, jeśli chcesz, żebym rozpoczął konkretny etap refaktoryzacji albo przygotował szkic struktur katalogów/klas.
