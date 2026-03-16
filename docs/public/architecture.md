# Application Architecture

## Summary

The application is a classic Laravel 9 web app with Blade views, jQuery-based frontend behavior, and a thin-controller backend for domestic trip settlement logic.

## Architecture / Design

- Routes in `routes/web.php` expose page views and domestic settlement POST endpoints.
- `HomeController` renders views and delegates domestic trip calculations to `App\Services\NationalTripService`.
- `App\Classes\NationalTripClass` contains the calculation rules used by the domestic flow.
- `ContactController`, `StoreContactRequest`, and `ContactMessageMail` handle contact persistence and mail delivery.
- Frontend assets are built with Laravel Mix from `resources/js`, `resources/css`, and `resources/sass`.

## Setup or usage

- Domestic settlement uses validated backend endpoints and is covered by automated tests.
- Foreign settlement currently relies on client-side calculations and country-rate data embedded in `resources/views/foreign.blade.php`.

## Operational notes

- The test suite combines feature tests for routes and mail flow with unit tests for domestic calculation rules.
- Jenkins builds the same production assets that are served from `public/`.

## Key decisions

- Keep controllers thin and move business logic into service and calculator classes.
- Use server-side validation for the domestic calculator and contact form.
- Keep the foreign flow available as a browser-side tool until it receives a backend implementation.
