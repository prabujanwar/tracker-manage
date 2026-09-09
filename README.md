# Dream Tracker

Foundation untuk Dream Tracker: Expo React Native mobile app dan Laravel API.

## Struktur

- `dream-tracker-mobile/` - Expo Router, TypeScript, NativeWind, TanStack Query, Zustand.
- `dream-tracker-api/` - Laravel 13 API, Sanctum, PostgreSQL, Redis.
- `DREAM TRACKER.md` - product blueprint.
- `plan-dreamTracker.prompt.md` - phased implementation plan.

## Prerequisites

- Node.js `22.22.2` atau lebih baru yang kompatibel dengan Expo SDK 57.
- PHP `8.4+`.
- Composer.
- PostgreSQL pada port `5432`.
- Redis pada port `6379`.

## Menjalankan API

```bash
cd dream-tracker-api
cp .env.example .env
php artisan key:generate
php artisan serve
```

Local database configuration:

```env
DB_CONNECTION=pgsql
DB_HOST=127.0.0.1
DB_PORT=5432
DB_DATABASE=dream_tracker
DB_USERNAME=postgres
DB_PASSWORD=postgresroot
```

Health check: `http://localhost:8000/api/v1/health`

Demo seed tersedia melalui:

```bash
php artisan migrate:fresh --seed
```

Akun demo: `demo@dream-tracker.test` / `password`.

## Menjalankan mobile

```bash
export PATH="$HOME/.nvm/versions/node/v22.22.2/bin:$PATH"
cd dream-tracker-mobile
npm install --legacy-peer-deps
npm run start
```

Web export:

```bash
npx expo export --platform web
```

## Validasi foundation

```bash
cd dream-tracker-mobile
npm run typecheck

cd ../dream-tracker-api
php artisan test
```

Fase ini hanya membangun foundation, route placeholder, API client, auth storage skeleton, theme, UI states, health check, dan dummy data. Domain CRUD berikutnya mengikuti plan secara bertahap.
