# Alumni Portal

University alumni & student portal — verified alumni, jobs, mentorship, news/events, and administrative file tracking.

## Live demo

_Not deployed yet — add a production URL here after first host setup._

## Key features

- Role-aware users: admin, alumni, student (with verification gates)
- Alumni registration + admin verification before privileged actions
- Job/internship postings (verified alumni)
- Mentorship requests between students and alumni
- News & events management
- Student services and exam-result related admin flows
- File tracking / movement across departments (timestamped history)
- Laravel Feature tests (`tests/Feature/AlumniPortalTest.php` and auth suite)
- Product docs: SRS, UML, schema, UI flow under `docs/`

## Tech stack

| Layer | Choice |
| --- | --- |
| Backend | Laravel 13 (PHP 8.3) |
| Frontend | Blade + Vite + Tailwind + Alpine |
| Auth | Laravel session auth (Breeze-style controllers) |
| Tests | PHPUnit Feature/Unit |
| DB | SQLite/MySQL via Laravel config |

## Architecture (brief)

```
Blade views + Vite assets
    │
Laravel HTTP (controllers, Form Requests, middleware)
    ├─ AdminMiddleware / VerifiedAlumniMiddleware
    ├─ Models: AlumniProfile, JobPosting, MentorshipRequest, FileTrack, …
    └─ migrations + Feature tests
```

## Getting started

### Prerequisites

- PHP 8.3+, Composer, Node.js 18+
- SQLite (default) or MySQL/Postgres

### Install

```bash
git clone https://github.com/hafizabdullah1/alumni-portal.git
cd alumni-portal
composer setup
# equivalent manual steps:
# composer install
# create .env && php artisan key:generate
# php artisan migrate
# npm install && npm run build
```

Create `.env` with at least:

| Variable | Required | Description |
| --- | --- | --- |
| `APP_NAME` | No | App display name |
| `APP_ENV` | Yes | `local` / `production` |
| `APP_KEY` | Yes | `php artisan key:generate` |
| `APP_URL` | Yes | Base URL |
| `DB_CONNECTION` | Yes | e.g. `sqlite` or `mysql` |
| `DB_DATABASE` | Yes | DB name or sqlite path |
| `DB_USERNAME` / `DB_PASSWORD` | If MySQL | Credentials |

### Run

```bash
composer dev     # serve + queue + logs + vite (concurrently)
# or separately:
php artisan serve
npm run dev

composer test    # php artisan test
```

## Deployment

- Classic Laravel host (Forge, Vapor, shared PHP + Nginx) or Docker.
- Set production `.env`, run `php artisan migrate --force`, `npm run build`, point web root to `public/`.
- Add the live URL to the GitHub **Website** field once deployed.

## Roadmap

- [ ] Replace stock Laravel README with this project README
- [ ] MIT license, topics, social preview
- [ ] Deploy demo (Laravel Cloud / Forge / VPS)
- [ ] Complete checklist items in `docs/requirements_checklist.md`
- [ ] Expand Feature coverage for file-tracking and mentorship

## Author

**Hafiz Abdullah** — [GitHub](https://github.com/hafizabdullah1) · [hafizabdullah.site](https://hafizabdullah.site)
