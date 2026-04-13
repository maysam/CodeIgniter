# Changelog

## 2026-04-13
- Initialized project plan (`PLAN.md`) for CodeIgniter 2.2.0 weblog task.
- Created initial changelog file.
- Scaffolded minimal CodeIgniter bootstrap and core config files (`index.php`, `application/config/*`).
- Implemented weblog MVC (`application/controllers/blog.php`, `application/models/blog_model.php`, `application/views/blog/*`).
- Added shared template layout and autoloaded `text` helper for post excerpts.
- Added runtime and usage docs (`README.md`) plus container files (`Dockerfile`, `docker-compose.yaml`).
- Verified PHP syntax across project files with `php -l`.
- Updated `PLAN.md` status for the current prompt.
- Added MySQL initialization SQL with schema and seed data for users, posts, comments, and sessions.
- Configured CodeIgniter autoload, database connection, and database-backed session settings for MySQL runtime.
- Replaced static blog model with MySQL CRUD model and added user/comment models.
- Added auth/admin controllers, extended blog controller with comment posting, and created admin/auth/blog views.
- Updated controllers to use `$_SERVER['REQUEST_METHOD']` checks for CodeIgniter 2.2.0 compatibility.
- Added Docker MySQL service with automatic SQL initialization and updated README for full training demo usage.
- Re-ran PHP lint checks successfully after full MySQL-backed weblog implementation.
- Updated `PLAN.md` to reflect and close the current prompt scope.
- Imported official CodeIgniter `2.2.0` framework core into `system/` from the upstream release source.
- Updated `README.md` with the exact upstream release URL used for framework core sourcing.
- Replaced fixed host port bindings in `docker-compose.yaml` with `expose` to prevent deployment-time port collision (`8080 already allocated`).
- Removed `weblog` bind mount from `docker-compose.yaml` so deployment serves built image files and avoids runtime web-root mismatch.
- Fixed `index.php` front controller header (removed invalid `BASEPATH` direct-access guard).
