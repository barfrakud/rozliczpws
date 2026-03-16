# Project Overview

## Summary

`rozliczPWS` is a Laravel application for preparing business trip settlements.
It supports domestic and foreign trip calculations, a contact workflow, and a production-oriented CI/CD setup aimed at a public portfolio deployment.

## Architecture / Design

- Domestic trip calculations use Laravel routes, `FormRequest` validation, and `NationalTripService`.
- Foreign trip calculations currently run in the browser with rates embedded in the Blade view.
- Contact submissions are stored and mailed with the application sender address plus user `replyTo`.

## Setup or usage

- Start with [setup.md](./setup.md) for local installation.
- See [usage.md](./usage.md) for the main calculator and contact flows.

## Operational notes

- CI/CD is summarized in [ci-cd.md](./ci-cd.md).
- Production release behavior is described in [deployment.md](./deployment.md).

## Key decisions

- Jenkins runs in Docker and deploys only from `master`.
- Laravel Mix remains the active asset pipeline for this codebase.
