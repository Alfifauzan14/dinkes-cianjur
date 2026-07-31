# Dinkes Cianjur — Repo Guide

## Project

Laravel 12 + Tailwind CSS v4 + Vite 7. PHP ^8.2. SQLite default.

## Commands

| Action | Command |
|--------|---------|
| Dev server + queue + logs + Vite | `composer dev` |
| Build assets | `npm run build` |
| Run tests | `composer test` (runs `config:clear` then `php artisan test`) |
| Lint (PSR-12) | `./vendor/bin/pint --test` |
| Fresh setup | `composer setup` (composer install, .env, key:generate, migrate, npm install & build) |
| Single test | `php artisan test --filter=TestName` |

## Architecture

- **No controllers yet** — only abstract `Controller.php`. Views driven by Blade.
- **No Livewire/Vue/React** — plain JS + Tailwind CSS.
- **Vite entry:** `resources/css/app.css` + `resources/js/app.js`
- **CSS strategy:** Tailwind v4 via `@import 'tailwindcss'` in `app.css`. Feature branches use separate CSS in `public/css/` loaded via `<link>` + cache-bust `?v={{ time() }}`. Keep consistent.
- **No `.env` committed** — copy `.env.example`, run `php artisan key:generate`.
- **DB sessions + queues + cache** (all `database` driver by default).
- **No `public/build/`** — run `npm run build` before deploy.

## Design System (from font.png)

### Font
- **Primary:** Plus Jakarta Sans (Google Fonts CDN)
- **Tailwind fallback:** Instrument Sans (via `@theme` in `app.css`)

### Typography Scale (px)
| Element | Size | Weight |
|---------|------|--------|
| Judul (title) | 48px | 700 |
| Sub judul (subtitle) | 24px | — |
| Judul card | 20px | — |
| Sub judul card / Btn card | 16px | — |
| Teks body | 16px | — |
| "Lihat Semua" | 20px | — |

### Colors
| Token | Hex |
|-------|-----|
| Judul | `#004F3B` |
| Sub judul / aksen | `#009966` |
| Judul card | `#FFFFFF` |
| Sub judul card | `#FFFFFF` at 80% opacity |

### Border Radius
| Element | Radius |
|---------|--------|
| Card luar | `1px` |
| Card dalam | `3px` |

### Page Layout
- **Page Margin / Gap (Kanan & Kiri):** `samakan dengan navbar dan footer` (desktop)

## Workflow

- **Feature branches** — work on separate branch per section (nav, hero, layanan, profile, sambutan).
- PRs merge to `main`. Only footer (`feature/footer-component`) merged so far.
- PRD docs exist per feature branch (`prd/nav-prd.md`, `prd/hero-prd.md`, `prd/profile-prd.md`) — check them for Figma specs.
- Uncommitted files in `public/images/` (`font.png`, etc.) — track if needed.

## Conventions

- Type hint all params + return types (PHP 8.2+).
- Eloquent: use relationships, eager loading, no N+1.
- No business logic in controllers — use services.
- Queue long-running tasks (`database` queue driver).
- Test >85% coverage. PHPUnit ^11.5.
- Follow PSR-12 (enforced via Pint).
