# Usage

## Summary

The application exposes a small set of user-facing pages for domestic and foreign trip settlement plus a contact flow.

## Architecture / Design

- `/` presents the landing page and entry points to the calculators.
- `/krajowa` uses backend endpoints to calculate trip summary and final settlement.
- `/zagraniczna` performs foreign-trip calculations in the browser.
- `/kontakt` stores and mails contact messages.

## Setup or usage

- Domestic flow:
  - open `/krajowa`
  - enter trip start, end, and cost values
  - calculate trip summary and final settlement
- Foreign flow:
  - open `/zagraniczna`
  - select country and trip type
  - enter meals, accommodation, and other costs
  - calculate totals in the browser
- Contact flow:
  - open `/kontakt`
  - submit name, email, and message

## Operational notes

- Help and legal-information pages are available at `/pomoc` and `/podstawa`.
- The foreign flow is useful, but it is not yet covered by automated backend validation like the domestic flow.

## Key decisions

- Domestic calculations are the more production-ready part of the application.
- Foreign calculations remain visible in the UI even though they still rely on client-side logic.
