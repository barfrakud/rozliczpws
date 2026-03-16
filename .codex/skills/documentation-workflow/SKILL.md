---
name: documentation-workflow
description: Use this skill when the task is to create, update, organize, or promote project documentation such as private plans, prompts, implementation reports, manuals, concept notes, decisions, or public repository docs. Do not use it for code-only work that has no documentation impact.
---

# Purpose

Manage project documentation using a **private-first** workflow.

# Documentation layers

1. `docs/private/`
   - plans
   - prompts
   - reports
   - manuals
   - concept notes
   - decisions
   - research
   - journal notes

2. `docs/public/`
   - concise public-facing repository documentation

# Main rules

- Default to `docs/private/` unless public documentation is explicitly requested.
- Never copy private notes into public docs verbatim.
- When AI usage is substantial, treat prompts as reusable assets.
- When implementation work is meaningful, create or update:
  - a plan,
  - a prompt if appropriate,
  - a report.
- When durable knowledge appears, route it to:
  - manuals,
  - concepts,
  - decisions.

# Task classification

Classify the request as one or more of the following:

- private plan
- private prompt
- private report
- private manual
- private concept note
- private decision
- public documentation

# Destination rules

## Private plan
Write to:
`docs/private/plans/YYYY-MM-DD-topic.md`

## Private prompt
Write to:
`docs/private/prompts/<tool>/YYYY-MM-DD-topic.md`

## Private report
Write to:
`docs/private/reports/YYYY-MM-DD-topic.md`

## Private manual
Write to the best-fitting folder under:
`docs/private/manuals/`

## Private concept note
Write to:
`docs/private/concepts/`

## Private decision
Write to:
`docs/private/decisions/`

## Public documentation
Write to:
`docs/public/`

# Required process

## Step 1
Identify the correct artifact type.

## Step 2
Choose the correct destination path.

## Step 3
Use the matching template from `assets/`.

## Step 4
Write complete Markdown content, not a sketch.

## Step 5
Cross-link related files when useful:
- plan -> prompt
- prompt -> report
- report -> public doc candidate
- manual -> concept or decision

## Step 6
If writing public docs, compress and professionalize the content.

# Public documentation rules

Public docs must:
- be concise,
- remove scratch notes,
- remove beginner-only explanations unless useful to the audience,
- focus on architecture, setup, CI/CD, deployment, usage, and outcomes.

# Output expectations

When asked to create documentation:
- identify the artifact type,
- produce the correct Markdown,
- place it in the correct logical location,
- respect the private-first workflow.
