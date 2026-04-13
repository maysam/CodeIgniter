# Plan

## Current Prompt
Fix deployment/runtime web 403 issues seen in container logs.

## Steps
1. Analyze Apache and deployment logs for root cause.
2. Adjust compose runtime mapping behavior.
3. Correct front-controller bootstrap if needed.
4. Update docs and tracking files.

## Status
- Completed on 2026-04-13.
- PHP syntax validated successfully.
- Converted static blog into a MySQL-backed training weblog with auth, comments, and admin CRUD.
- Imported official CodeIgniter 2.2.0 framework core from upstream release URL.
- Deployment compose configuration adjusted to avoid host port conflicts.
- Deployment runtime updated to avoid web-root mismatch and bootstrap header issue.
