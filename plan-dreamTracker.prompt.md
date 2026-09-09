# Dream Tracker Plan

## Pemahaman inti
Dream Tracker adalah aplikasi mobile-first personal life management, bukan sekadar todo list. Alur produk: Dream -> Goal -> Target -> Habit -> Task -> Reminder -> Progress -> Review -> Improvement. Backend Laravel menjadi sumber kebenaran untuk business calculations; mobile Expo React Native menjadi client.

## Stack dan arsitektur
- Mobile: React Native, Expo, TypeScript strict, Expo Router, NativeWind, TanStack Query, Zustand, React Hook Form, Zod, Expo Secure Store/Notifications.
- Backend: Laravel 13+, PHP 8.4+, Sanctum, PostgreSQL, Redis, Queue, Scheduler, Notifications, Policies, Form Requests, API Resources.
- Repositories idealnya dipisah menjadi dream-tracker-mobile dan dream-tracker-api.
- TanStack Query untuk server state; Zustand hanya untuk auth/UI/onboarding/filter/local state.
- MVP online-first; offline sync, AI, gamification, social, subscription, advanced journaling/life score ditunda.

## Database connection
Gunakan PostgreSQL sebagai database utama untuk backend Laravel.

Konfigurasi development lokal:

```env
DB_CONNECTION=pgsql
DB_HOST=127.0.0.1
DB_PORT=5432
DB_DATABASE=dream_tracker
DB_USERNAME=postgres
DB_PASSWORD=postgresroot
```

`DB_PASSWORD` hanya untuk environment lokal dan tidak boleh dikomit ke repository. Sediakan nilai kosong atau placeholder di `.env.example`.

## MVP yang ditetapkan dokumen
Authentication, Life Areas, Dreams, Goals, Targets, Tasks, Habits, Habit Logs, Reminders, Dashboard, Daily Score, Basic Statistics.

## Roadmap fase kecil dan panjang
Setiap fase fokus pada satu kemampuan utama. Fase baru dimulai setelah Definition of Done fase sebelumnya tercapai. Estimasi bersifat relatif, sekitar 1-2 minggu per fase untuk implementasi dan verifikasi.

### Tahap A - Persiapan dan fondasi
1. **Fase 0: Keputusan teknis dan pemotongan scope**
   - Finalisasi batas MVP, repositori mobile/API, strategi Sanctum token, timezone default, format tanggal, standar API, soft delete, enum, ownership, pagination, error format, serta relasi task/reminder.
   - Output: keputusan tertulis dan checklist acceptance.

2. **Fase 1: Workspace dan repository foundation**
   - Buat struktur repository, `.env.example`, README awal, Git ignore, branch convention, dan command development.
   - Output: developer dapat menjalankan repository secara konsisten.

3. **Fase 2: Laravel API foundation**
   - Inisialisasi Laravel, koneksi PostgreSQL/Redis, `/api/v1`, response wrapper, exception handler, Form Request, API Resource, health check, dan CORS.
   - Output: endpoint health check dan format response stabil.

4. **Fase 3: Expo mobile foundation**
   - Inisialisasi Expo Router, strict TypeScript, NativeWind, theme tokens, lint, Prettier, testing, environment config, dan placeholder screens.
   - Output: app berjalan di web/iOS/Android dengan tab navigation dasar.

5. **Fase 4: Design system dan state architecture**
   - Bangun Button, Input, Card, ProgressBar, EmptyState, LoadingState, ErrorState, Modal/BottomSheet.
   - Konfigurasikan TanStack Query, Zustand, API client, typed error handling, dan query key conventions.
   - Output: screen baru memakai pola UI dan data yang sama.

6. **Fase 5: Dummy data dan development seed**
   - Buat fixture/seed data aman untuk development dan testing, bukan data production.
   - Sediakan akun demo, life areas, dreams, goals, numeric/binary targets, milestones, tasks dengan berbagai status, habits, habit logs beberapa hari, reminders, daily reviews, dan journals.
   - Sediakan command reset database lalu mengisi dummy data secara konsisten, misalnya `migrate:fresh --seed` atau command seed khusus development.
   - Tambahkan mock response mobile untuk loading, empty, error, dan populated states bila API belum tersedia.
   - Output: screen utama dapat diuji dengan data realistis tanpa input manual berulang.

### Tahap B - Akses dan identitas pengguna
7. **Fase 6: Authentication backend**
   - Implementasi register, login, logout, me, password reset, email verification bila diperlukan, token lifecycle, policies dasar, rate limiting, dan tests.

8. **Fase 7: Authentication mobile**
   - Implementasi AuthService, AuthStore/AuthProvider, Secure Store, session restore, protected routes, auth screens, loading state, dan 401 handling.
   - Output: register, login, session persistence, dan logout berjalan benar.

9. **Fase 8: Profile, preferences, dan onboarding ringan**
   - Buat profile minimal, timezone, notification preference dasar, onboarding yang dapat dilewati, serta guided default life areas opsional.

### Tahap C - Hirarki impian sampai target
10. **Fase 9: Life Areas**
	- CRUD, default seed opsional, ownership policy, mobile list/create/edit, dan empty state.

11. **Fase 10: Dreams**
	- Migration, model, policy, API CRUD, mobile list/create/detail/edit, status, target date, priority, dan life area.

12. **Fase 11: Goals**
	- Goal terhubung ke dream, CRUD, status lifecycle, priority, dates, detail screen, dan basic progress placeholder.

13. **Fase 12: Target engine**
	- Mulai hanya dengan `numeric` dan `binary`; implementasi update progress, clamp 0-100, target menaik/menurun, validation, progress API, unit tests, dan boundary tests.
	- Tipe duration, frequency, dan custom quantity ditunda sampai semantics disepakati.

14. **Fase 13: Milestones dan progress summary**
	- CRUD milestones, sort order, complete/reopen, serta ringkasan progress dream/goal/target.

### Tahap D - Aktivitas harian
15. **Fase 14: Task core**
	- CRUD task, status, priority, due date/time, estimated minutes, filter, pagination, quick complete, dan hubungan goal/life area.

16. **Fase 15: Habit core**
	- CRUD habit, start/end date, status, color/icon, relasi goal, dan daily check-in sederhana.

17. **Fase 16: Habit logs dan calendar**
	- Habit log uniqueness, edit/check-in, calendar view, missed/future handling, serta completion rate dasar.

18. **Fase 17: Streak engine**
	- Tetapkan dan implementasikan timezone, daily/weekly/specific days, paused/skipped/missed, current streak, longest streak, dan completion rate.
	- Backend menjadi sumber nilai; mobile hanya menampilkan hasil. Tambahkan unit tests untuk boundary penting.

### Tahap E - Reminder dan dashboard
19. **Fase 18: Local reminders**
	- Reminder CRUD minimal, permission flow, schedule/cancel/reschedule melalui Expo Notifications, dan mapping reminder ke task/habit.

20. **Fase 19: Server notifications**
	- Push device registration, Laravel Scheduler/Queue, Expo push integration, retry/idempotency, quiet hours, preference, dan deadline notifications.

21. **Fase 20: Dashboard action-first**
	- Endpoint dashboard today/upcoming dan mobile Home: today's tasks, habits, goal progress, reminders, empty/loading/error states.

22. **Fase 21: Daily score**
	- Finalisasi formula dan timezone, implementasi task/habit/goal/consistency/review components, clamp score 0-100, dan non-punitive display.

### Tahap F - Review dan insight
23. **Fase 22: Morning brief dan night review**
	- Daily intention, mood, energy, top priorities, accomplishments, improvement, gratitude, dan review endpoints/screens.

24. **Fase 23: Journal dasar**
	- CRUD journal, mood/energy, date search/filter, detail/editor, dan empty state.

25. **Fase 24: Statistics dasar**
	- Daily/weekly/monthly task completion, habit completion, streak summary, goal progress, dan chart sederhana.

26. **Fase 25: Calendar terpadu**
	- Gabungkan task, habit, goal, target, reminder, dan review dalam day/week/month view dengan query terpaginated.

### Tahap G - Quality dan release MVP
27. **Fase 26: Hardening security dan authorization**
	- Audit policies, ownership isolation, validation, mass assignment, rate limit, 401/403/404/422/429/500 mapping, dan input handling.

28. **Fase 27: UX states dan accessibility**
	- Skeleton, empty/error states, keyboard handling, labels, contrast, touch target, haptics seperlunya, dark/light/system theme.

29. **Fase 28: Performance dan observability**
	- Profiling render, query pagination, image optimization, logging, crash/error tracking hooks, queue monitoring, dan API timing.

30. **Fase 29: Release readiness**
	- E2E critical flows, build Android/iOS/web, migration/seed deployment, `.env.example` final, backup/rollback notes, dan release checklist.

### Tahap H - Fitur pasca-MVP
31. **Fase 30: Offline read/cache**
	- Expo SQLite untuk cache read-only tasks, habits, goals, targets, reminders tanpa mutation queue terlebih dahulu.

32. **Fase 31: Offline mutations dan sync**
	- Pending/synced/failed queue, retry, ordering, conflict resolution, delete semantics, dan tidak overwrite diam-diam.

33. **Fase 32: Advanced scoring dan life score**
	- Life Area weighted score dan konfigurasi bobot setelah data statistik MVP stabil.

34. **Fase 33: AI Coach**
	- AI hanya menghasilkan structured suggestions; Laravel memvalidasi; user wajib mengonfirmasi sebelum data berubah.

## Hal yang harus diputuskan sebelum domain implementation
- Sanctum strategy untuk Expo: personal access token vs cookie/session.
- Target semantics/formulas untuk numeric, quantity, percentage, duration, frequency, binary, termasuk target menurun.
- Habit frequency/streak semantics: timezone, weekly/monthly/specific days, missed/skipped/paused/future dates.
- Reminder ownership: local vs server notifications, idempotency, timezone, quiet hours, retry.
- Daily score formula and authoritative period/timezone.
- Task/reminder relationship: direct reminder_id vs polymorphic reference model.
- API contracts: nullability, soft deletes, unique constraints, indexes, enum strategy, pagination/filtering, dates/timezones.
- MVP scope harus tetap sempit meskipun blueprint mencakup banyak fitur.

## Definition of Done foundation
App starts on Android/iOS/web, Laravel API works, register/login/logout work, auth persists, basic architecture/configuration/tests/lint/typecheck are in place. Setelah foundation, berhenti dan laporkan file, dependency, konfigurasi, command, known issues, dan next task.

## Aturan kerja setiap fase
1. Baca dan pahami arsitektur yang sudah ada.
2. Implementasikan satu slice kecil yang lengkap: migration/model -> API -> query/mutation -> screen -> test.
3. Gunakan dummy data untuk menguji loading, empty, error, populated, dan boundary states.
4. Jalankan typecheck, lint, test, dan smoke test platform yang relevan.
5. Perbaiki error lokal sebelum masuk fase berikutnya.
6. Jangan mengubah file yang tidak terkait atau menduplikasi business logic.
7. Dokumentasikan keputusan yang memengaruhi fase berikutnya.

## Scope boundary
Jangan mengimplementasikan semua fitur dalam satu pass. Jangan menambahkan AI/offline kompleks sebelum online MVP stabil. Jangan melakukan refactor besar atau install dependency baru tanpa alasan teknis.

## Verification expectations
Setiap fase harus memiliki Definition of Done dan test yang sesuai. Critical tests: auth/session, ownership authorization, progress boundaries, streaks, daily score, reminders, seed data, dan CRUD flow utama. Pada akhir release readiness, jalankan lint/typecheck/test serta smoke test register -> create dream -> goal -> target -> habit -> task -> reminder -> dashboard.
