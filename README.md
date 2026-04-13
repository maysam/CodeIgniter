# CodeIgniter 2.2.0 Training Weblog (MySQL)

This repository provides a realistic, MySQL-backed weblog demo built in CodeIgniter 2.2.0 style for student pentesting practice in a controlled environment.

## Framework Core Source
- CodeIgniter core `system/` directory is sourced from the official `2.2.0` release:
- `https://github.com/bcit-ci/CodeIgniter/releases/tag/2.2.0`

## Features
- Public blog with slug-based post pages
- Public comment submission on posts
- Login/logout flow with session storage in MySQL
- Admin dashboard with post CRUD (create/edit/delete)
- Draft/published post workflow
- Seeded demo data (users, posts, comments)

## Demo Routes
- Public blog: `http://localhost:8080/index.php/blog`
- Login: `http://localhost:8080/index.php/login`
- Admin dashboard: `http://localhost:8080/index.php/admin`

## Demo Credentials
- Admin user: `admin`
- Admin password: `admin123`

## Docker Setup
```bash
docker compose up --build
```

Services:
- App: Apache + PHP at `localhost:8080`
- MySQL: `localhost:33066` (db `ci_weblog`, user `ci_user`, pass `ci_password`)

MySQL schema + seed data load automatically from:
- `docker/mysql/init/01_schema.sql`

## Project Structure
- `application/controllers/blog.php` - public blog + comments
- `application/controllers/auth.php` - login/logout
- `application/controllers/admin.php` - admin CRUD
- `application/models/blog_model.php` - posts data access
- `application/models/comment_model.php` - comments data access
- `application/models/user_model.php` - user auth data access
- `application/views/blog/*` - public pages
- `application/views/auth/*` - auth pages
- `application/views/admin/*` - admin pages

## Training Note
This app is intentionally suitable for security training in non-production environments. Do not deploy it to public infrastructure.
