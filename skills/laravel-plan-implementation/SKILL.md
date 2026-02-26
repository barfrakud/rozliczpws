# Skill: laravel-plan-implementation

## Goal
Implement phases A, B, C, and E from `review-report.md` in a safe and incremental way.

## Inputs
- `review-report.md`
- current Laravel codebase

## Workflow
1. Parse tasks from phases A/B/C/E.
2. Create a minimal execution order:
   - routing and validation,
   - mail safety,
   - test stabilization,
   - controller/service refactor,
   - frontend cleanup and build unification,
   - comment cleanup and README improvements.
3. Implement changes in small steps with verification after each step.

## Implementation Guidelines
- Use FormRequest for input validation.
- Keep controllers thin and move logic into services.
- Preserve existing behavior unless plan explicitly changes it.
- Avoid advanced patterns not needed at this project scale.
- Remove obvious/teaching comments; keep only business-rule comments in concise English.

## Validation
- `php artisan test`
- route check (`php artisan route:list`)
- asset build command from chosen toolchain

## Deliverables
- updated code for phases A/B/C/E
- updated tests
- updated README and environment examples
- short change summary

