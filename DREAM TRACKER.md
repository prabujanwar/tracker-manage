DREAM TRACKER

Technical Product & Development Blueprint

Version

1.0.0

Project Goal

Build Dream Tracker, a mobile-first personal life management application that helps users transform long-term dreams into concrete daily actions.

Core philosophy:

Dream → Goal → Target → Habit → Task → Reminder → Progress → Review → Improvement

The application must not feel like a simple To-Do List. It should function as a personal life operating system.

⸻

1. TECHNOLOGY STACK

Mobile Application

Use:

* React Native
* Expo
* TypeScript
* Expo Router
* Zustand
* TanStack Query
* NativeWind
* React Hook Form
* Zod
* Expo Notifications
* Expo Secure Store
* Expo SQLite
* Expo Haptics
* Expo Local Authentication
* Expo Device
* Expo Constants
* Date-fns

Recommended project initialization:

npx create-expo-app@latest dream-tracker

Use TypeScript.

Use Expo Router for navigation.

⸻

2. BACKEND

Backend must use Laravel.

Recommended:

* Laravel 13+
* PHP 8.4+
* Laravel Sanctum
* MySQL 8+
* Redis
* Laravel Queue
* Laravel Scheduler
* Laravel Notifications
* Laravel API Resources
* Laravel Policies
* Laravel Form Requests

Architecture:

React Native
      |
      | HTTPS / JSON
      v
Laravel REST API
      |
      +---- MySQL
      |
      +---- Redis
      |
      +---- Queue
      |
      +---- Scheduler
      |
      +---- Notification System

The React Native application must NOT contain important business logic that should belong to the backend.

Backend is the source of truth.

⸻

3. PROJECT ARCHITECTURE

Prefer separate repositories:

dream-tracker-mobile/
dream-tracker-api/

Optional later:

dream-tracker-admin/

⸻

4. MOBILE PROJECT STRUCTURE

Use:

dream-tracker-mobile/
├── app/
│   ├── _layout.tsx
│   ├── index.tsx
│   │
│   ├── (auth)/
│   │   ├── _layout.tsx
│   │   ├── login.tsx
│   │   ├── register.tsx
│   │   ├── forgot-password.tsx
│   │   └── verify-email.tsx
│   │
│   ├── (tabs)/
│   │   ├── _layout.tsx
│   │   ├── index.tsx
│   │   ├── goals.tsx
│   │   ├── habits.tsx
│   │   ├── stats.tsx
│   │   └── profile.tsx
│   │
│   ├── dream/
│   │   ├── index.tsx
│   │   ├── create.tsx
│   │   └── [id].tsx
│   │
│   ├── goal/
│   │   ├── create.tsx
│   │   ├── [id].tsx
│   │   └── edit/[id].tsx
│   │
│   ├── target/
│   │   ├── create.tsx
│   │   └── [id].tsx
│   │
│   ├── habit/
│   │   ├── create.tsx
│   │   └── [id].tsx
│   │
│   ├── task/
│   │   ├── create.tsx
│   │   └── [id].tsx
│   │
│   ├── reminder/
│   │   ├── create.tsx
│   │   └── [id].tsx
│   │
│   ├── review/
│   │   ├── morning.tsx
│   │   └── evening.tsx
│   │
│   ├── journal/
│   │   ├── create.tsx
│   │   └── [id].tsx
│   │
│   └── settings/
│       ├── index.tsx
│       ├── notifications.tsx
│       └── account.tsx
│
├── src/
│   ├── components/
│   ├── features/
│   ├── hooks/
│   ├── services/
│   ├── stores/
│   ├── api/
│   ├── types/
│   ├── schemas/
│   ├── utils/
│   ├── constants/
│   ├── database/
│   └── notifications/
│
├── assets/
├── constants/
├── tests/
└── package.json

Use feature-oriented organization where practical.

⸻

5. MOBILE NAVIGATION

Main navigation contains 5 tabs:

Home
Goals
Add
Habits
Stats

Profile/settings should be accessible from the Home header or profile button.

The Add button should open a quick action menu.

Quick actions:

+ Task
+ Habit
+ Goal
+ Dream
+ Target
+ Journal
+ Progress

⸻

6. AUTHENTICATION

Authentication uses Laravel Sanctum.

Required:

* Register
* Login
* Logout
* Forgot password
* Reset password
* Email verification
* Session persistence
* Token storage
* Automatic authentication check

Store sensitive authentication data using:

Expo Secure Store

Never store authentication tokens in plain AsyncStorage.

Create:

AuthService
AuthStore
AuthProvider

⸻

7. CORE DOMAIN MODEL

The main hierarchy:

Dream
  |
  +-- Goal
       |
       +-- Target
       |
       +-- Milestone
       |
       +-- Habit
       |
       +-- Task
       |
       +-- Reminder

Example:

DREAM
"Become financially independent"
        ↓
GOAL
"Build emergency fund"
        ↓
TARGET
"Save Rp50.000.000"
        ↓
MILESTONE
"First Rp10.000.000"
        ↓
HABIT
"Save money every payday"
        ↓
TASK
"Transfer Rp1.000.000"
        ↓
REMINDER
"Payday 09:00"
        ↓
PROGRESS
Rp12.000.000 / Rp50.000.000

⸻

8. LIFE AREAS

Users can organize their life into areas.

Default areas:

Health
Career
Finance
Education
Family
Relationship
Spiritual
Personal Growth
Hobbies
Travel
Other

Users can create custom areas.

Every Dream and Goal can optionally belong to a Life Area.

⸻

9. DREAM MANAGEMENT

Dream represents a long-term aspiration.

Dream fields:

id
user_id
life_area_id
title
description
image
color
priority
status
target_date
created_at
updated_at

Status:

active
paused
completed
archived

Features:

* Create dream
* Edit dream
* Delete dream
* Archive dream
* Set target date
* Attach goals
* View overall progress
* View associated habits/tasks
* View milestones

Dream detail must show:

Dream title
Description
Target date
Overall progress
Goals
Milestones
Related habits
Recent activity

⸻

10. GOAL MANAGEMENT

Goal is a concrete result required to achieve a Dream.

Goal fields:

id
user_id
dream_id
life_area_id
title
description
priority
status
start_date
target_date
progress
created_at
updated_at

Status:

not_started
active
paused
completed
cancelled

Goal features:

* Create
* Edit
* Delete
* Complete
* Pause
* Resume
* Assign priority
* Set deadline
* Add targets
* Add milestones
* Add habits
* Add tasks

⸻

11. TARGET SYSTEM

Target is measurable progress.

Supported types:

numeric
quantity
percentage
duration
frequency
binary

Examples:

Save Rp50.000.000
Read 24 books
Exercise 150 minutes/week
Complete 5 workouts/week
Lose 5 kg
Finish certification
Drink water 8 times/day

Target fields:

id
goal_id
title
type
unit
start_value
current_value
target_value
start_date
target_date
frequency
status

Progress calculation:

progress =
(current_value - start_value)
/
(target_value - start_value)
* 100

Clamp result:

0 <= progress <= 100

⸻

12. MILESTONE SYSTEM

Milestones break Goals into smaller achievements.

Example:

Goal:
Launch personal website
Milestones:
[ ] Design
[ ] Backend
[ ] Frontend
[ ] Testing
[ ] Deployment

Milestone fields:

id
goal_id
title
description
due_date
completed_at
sort_order
status

⸻

13. TASK / TODO SYSTEM

Task must support:

title
description
status
priority
due_date
due_time
estimated_minutes
life_area_id
goal_id
habit_id
reminder_id

Statuses:

pending
in_progress
completed
cancelled

Priorities:

low
medium
high
urgent

Features:

* Create
* Edit
* Delete
* Complete
* Reschedule
* Set priority
* Set deadline
* Attach task to Goal
* Attach task to Dream
* Quick complete

⸻

14. HABIT SYSTEM

Habit is a repeated behavior.

Fields:

id
user_id
goal_id
title
description
frequency_type
frequency_value
target_count
start_date
end_date
reminder_time
color
icon
status

Frequency examples:

daily
weekly
monthly
specific_days

Habit tracking requires:

habit_logs

Habit log:

habit_id
date
completed
value
note

Features:

* Daily check-in
* Streak
* Best streak
* Completion percentage
* Calendar view
* Weekly statistics
* Monthly statistics

⸻

15. STREAK ENGINE

Calculate:

current_streak
longest_streak
completion_rate

Do not store calculated streak values unless performance requires caching.

Prefer calculating from habit logs.

Handle:

* missed day
* future date
* paused habit
* skipped habit
* weekly habits
* custom frequency

⸻

16. REMINDER SYSTEM

Reminder can belong to:

Task
Habit
Goal
Target
General reminder

Reminder fields:

id
user_id
type
reference_id
title
message
scheduled_at
timezone
repeat_rule
is_active

Repeat examples:

once
daily
weekly
monthly
specific_days
custom

⸻

17. IMPORTANT: NOTIFICATION ARCHITECTURE

Use two layers.

Local notification

For reminders that should fire on the user’s device.

Use:

Expo Notifications

Examples:

Drink water at 10:00
Workout at 18:00
Read book at 21:00

Server notification

Laravel handles:

push notification
scheduled notification
goal warnings
streak warnings
weekly summaries

Architecture:

Laravel Scheduler
      ↓
Laravel Queue
      ↓
Notification Service
      ↓
Expo Push Notification
      ↓
Mobile Device

Local notification should still work when the device is offline.

⸻

18. DASHBOARD

Home screen is the most important screen.

Display:

Good Morning, User
Today's Score
85%
Today's Focus
----------------
[ ] Workout
[ ] Finish API
[ ] Read 20 pages
Habits
----------------
✓ Drink Water
✓ Exercise
○ Read
Goals
----------------
Emergency Fund     45%
Learn English      70%
Build App          30%
Upcoming
----------------
18:00 Workout
21:00 Night Review

Dashboard should prioritize action over information.

Avoid excessive charts.

⸻

19. DAILY SCORE

Calculate Daily Score from:

Task completion       30%
Habit completion      30%
Goal progress         20%
Consistency            10%
Daily review           10%

Initial formula:

daily_score =
(task_score * 0.30)
+
(habit_score * 0.30)
+
(goal_score * 0.20)
+
(consistency_score * 0.10)
+
(review_score * 0.10)

Score range:

0 - 100

Do not make the score punitive.

It should motivate improvement.

⸻

20. MORNING BRIEF

Morning screen:

Good Morning 👋
Today's Focus
1. Most important task
2. Important habit
3. Goal progress
Today's schedule
Upcoming reminders
Daily intention

User can set:

Today's intention
Mood
Energy
Top 3 priorities

⸻

21. NIGHT REVIEW

Night Review asks:

What did you accomplish?
What went well?
What did not go well?
What should improve tomorrow?
Mood
Energy
Gratitude
Tomorrow's top priority

Save as:

daily_reviews

⸻

22. JOURNAL

Journal fields:

id
user_id
title
content
mood
energy
created_at
updated_at

Features:

* Create journal
* Edit journal
* Delete journal
* Search
* Filter by date
* Mood tracking

⸻

23. MOOD & ENERGY

Mood:

1 - 5

Energy:

1 - 5

Track daily.

Use data later for analytics.

Example:

Mood: 4/5
Energy: 2/5
Observation:
User tends to complete fewer tasks on low-energy days.

AI can use this data in future versions.

⸻

24. CALENDAR

Calendar must show:

Tasks
Habits
Goals
Targets
Reminders
Reviews

Views:

Day
Week
Month

The calendar should allow users to tap a date and see all activities.

⸻

25. STATISTICS

Stats screen:

Daily Score
Weekly Score
Monthly Score
Task completion
Habit completion
Goal progress
Streaks
Life Area performance

Charts:

Daily score graph
Habit completion graph
Goal progress graph
Weekly consistency

⸻

26. LIFE SCORE

Calculate overall life score from Life Areas.

Example:

Health       82
Career       75
Finance      61
Education    90
Family       88

Overall:

Life Score = weighted average

Users should be able to configure Life Area weights later.

⸻

27. ACTIVITY LOG

Create an immutable activity log.

Examples:

goal_created
goal_completed
task_created
task_completed
habit_completed
habit_missed
target_progress_updated
dream_completed
review_completed

Fields:

id
user_id
type
entity_type
entity_id
metadata
created_at

This will later support:

* Timeline
* Analytics
* AI
* Notifications
* Audit history

⸻

28. DATABASE TABLES

Initial tables:

users
life_areas
dreams
goals
targets
milestones
habits
habit_logs
tasks
reminders
daily_reviews
journals
notifications
activity_logs
push_devices

Relationships:

users
 |
 +-- life_areas
 |
 +-- dreams
 |     |
 |     +-- goals
 |           |
 |           +-- targets
 |           |
 |           +-- milestones
 |           |
 |           +-- habits
 |           |
 |           +-- tasks
 |
 +-- habits
 |
 +-- tasks
 |
 +-- reminders
 |
 +-- daily_reviews
 |
 +-- journals
 |
 +-- activity_logs
 |
 +-- push_devices

⸻

29. API DESIGN

Use:

/api/v1

Authentication:

POST   /auth/register
POST   /auth/login
POST   /auth/logout
GET    /auth/me
POST   /auth/forgot-password
POST   /auth/reset-password

Dream:

GET    /dreams
POST   /dreams
GET    /dreams/{id}
PUT    /dreams/{id}
DELETE /dreams/{id}

Goals:

GET    /goals
POST   /goals
GET    /goals/{id}
PUT    /goals/{id}
DELETE /goals/{id}

Targets:

GET    /goals/{goal}/targets
POST   /goals/{goal}/targets
PUT    /targets/{id}
DELETE /targets/{id}
POST   /targets/{id}/progress

Habits:

GET    /habits
POST   /habits
GET    /habits/{id}
PUT    /habits/{id}
DELETE /habits/{id}
POST   /habits/{id}/check-in
GET    /habits/{id}/stats

Tasks:

GET    /tasks
POST   /tasks
GET    /tasks/{id}
PUT    /tasks/{id}
DELETE /tasks/{id}
POST   /tasks/{id}/complete

Dashboard:

GET /dashboard
GET /dashboard/today
GET /dashboard/upcoming

Reviews:

GET  /reviews/today
POST /reviews/morning
POST /reviews/evening

Journal:

GET    /journals
POST   /journals
GET    /journals/{id}
PUT    /journals/{id}
DELETE /journals/{id}

Statistics:

GET /statistics
GET /statistics/habits
GET /statistics/goals
GET /statistics/life-score

Notifications:

GET  /notifications
POST /push-devices
DELETE /push-devices/{id}

⸻

30. API RESPONSE FORMAT

Use consistent responses.

Success:

{
  "success": true,
  "data": {}
}

Error:

{
  "success": false,
  "message": "Validation failed",
  "errors": {}
}

Paginated:

{
  "success": true,
  "data": [],
  "meta": {
    "current_page": 1,
    "last_page": 5,
    "per_page": 20,
    "total": 100
  }
}

⸻

31. MOBILE API CLIENT

Create centralized API client.

Example structure:

src/api/
├── client.ts
├── auth.ts
├── dreams.ts
├── goals.ts
├── targets.ts
├── habits.ts
├── tasks.ts
├── reminders.ts
├── dashboard.ts
├── reviews.ts
├── journals.ts
└── statistics.ts

Use TanStack Query for server state.

Do NOT duplicate server state unnecessarily in Zustand.

⸻

32. STATE MANAGEMENT

Use:

TanStack Query

For:

API data
Dreams
Goals
Tasks
Habits
Statistics
Dashboard

Zustand

For:

Authentication state
UI preferences
Onboarding state
Temporary application state
Filters
Local settings

Rule:

Server state belongs to TanStack Query. UI/client state belongs to Zustand.

⸻

33. OFFLINE SUPPORT

Phase 1 can be online-first.

Phase 2 should implement offline-first capabilities.

Use:

Expo SQLite

Local database should store:

tasks
habits
habit_logs
goals
targets
reminders

Each mutation should have sync state:

pending
synced
failed

Architecture:

User Action
    ↓
Local SQLite
    ↓
Sync Queue
    ↓
Laravel API
    ↓
Success
    ↓
Mark synced

Conflict handling must be implemented carefully.

Never silently overwrite user data.

⸻

34. UI / UX PRINCIPLES

Dream Tracker should feel:

Calm
Clean
Focused
Motivating
Premium
Simple

Avoid:

Too many colors
Too many charts
Too many buttons
Information overload
Gamification overload

The application should encourage action.

⸻

35. DESIGN SYSTEM

Create reusable components:

Button
IconButton
Card
ProgressBar
ProgressRing
Badge
Avatar
Input
Textarea
Select
DatePicker
TimePicker
BottomSheet
Modal
Toast
EmptyState
LoadingState
ErrorState
Skeleton
Checkbox
Switch
Slider
Calendar
StatCard
GoalCard
HabitCard
TaskCard
DreamCard

Do not create duplicate UI components.

⸻

36. THEME

Support:

Light Mode
Dark Mode
System Mode

Use centralized theme tokens.

Example:

spacing
radius
font sizes
font weights
shadows
colors

Do not hard-code values throughout the application.

⸻

37. HOME SCREEN UX

Priority hierarchy:

1. What should I do today?
2. What is important?
3. How am I progressing?
4. What is coming next?

Do not put statistics above actionable items.

⸻

38. QUICK ADD UX

Pressing:

+

opens:

Task
Habit
Goal
Dream
Target
Journal
Progress

Creation should require minimum input.

Example Task:

Title
Due date
Priority
Save

Advanced options can be configured later.

⸻

39. GOAL DETAIL UX

Goal screen:

< Back
Goal Title
████████░░ 80%
Deadline
12 days remaining
Targets
----------------
Rp 40M / Rp 50M
Milestones
----------------
✓ Planning
✓ First implementation
○ Final testing
Habits
----------------
✓ Save money
✓ Study
Tasks
----------------
○ Finish documentation
✓ Setup database

⸻

40. HABIT DETAIL UX

Show:

Habit name
Current streak
Longest streak
Completion rate
Calendar
Weekly performance
Monthly performance

Quick action:

✓ Done

One-tap habit completion is critical.

⸻

41. PERFORMANCE REQUIREMENTS

Target:

Fast startup
Smooth 60 FPS UI
Minimal unnecessary re-renders
Paginated API requests
Image optimization
Lazy loading where appropriate

Avoid:

Large global state
Unnecessary API calls
Nested expensive components
Repeated database queries

Use React.memo only where profiling indicates it is useful.

⸻

42. SECURITY

Backend must implement:

Authentication
Authorization
Policies
Request validation
Rate limiting
Mass assignment protection
SQL injection protection
Input sanitization
HTTPS

Every resource must verify ownership.

Example:

User A must never access:

User B's goals
User B's tasks
User B's journals
User B's habits

⸻

43. BACKEND BUSINESS RULE

Important business calculations should be backend-driven.

Examples:

Goal progress
Target progress
Habit streak
Daily score
Life score
Statistics

Mobile can display calculations for UX, but backend remains authoritative.

⸻

44. NOTIFICATION RULES

Notification engine must support:

Reminder
Habit reminder
Task deadline
Goal deadline
Streak warning
Weekly summary
Daily review reminder
Morning brief

Avoid notification spam.

User must be able to configure:

Notifications ON/OFF
Quiet hours
Reminder preferences
Morning brief
Night review
Weekly summary

⸻

45. ONBOARDING

Onboarding should ask:

What do you want to improve?
What are your biggest goals?
Which areas matter most?
What habits do you want to build?
When do you usually start your day?
When do you usually sleep?

The user should be able to skip onboarding.

Do not block the user from using the app.

⸻

46. INITIAL DEFAULT DATA

After registration optionally create:

Life Areas:

Health
Career
Finance
Education
Personal Growth
Family

Create an example experience:

Dream:
"Become a better version of myself"
Goal:
"Build a healthy daily routine"
Habit:
"Drink 8 glasses of water"

This should only happen if user chooses guided onboarding.

⸻

47. EMPTY STATES

Every list must have a meaningful empty state.

Example:

No dreams:

Your dreams start here.
What do you want to achieve?
+ Create Dream

No tasks:

Nothing planned for today.
Enjoy the moment or add something important.

Avoid generic:

No data.

⸻

48. ERROR HANDLING

Handle:

Network error
Timeout
401 Unauthorized
403 Forbidden
404 Not Found
422 Validation
429 Rate Limited
500 Server Error

Display friendly messages.

Never expose raw server exceptions to users.

⸻

49. LOADING STATES

Use skeletons instead of blocking spinners wherever possible.

Example:

DashboardSkeleton
GoalSkeleton
HabitSkeleton
TaskSkeleton

⸻

50. TESTING

Mobile:

Unit tests
Component tests
Integration tests
Navigation tests

Backend:

Feature tests
Unit tests
API tests
Authorization tests
Notification tests

Critical flows must have automated tests:

Register
Login
Create Dream
Create Goal
Create Task
Complete Task
Create Habit
Complete Habit
Update Target
Create Reminder
Daily Review

⸻

51. DEVELOPMENT PHASES

Phase 0 — Foundation

Build:

React Native
Expo
TypeScript
Expo Router
NativeWind
TanStack Query
Zustand
API Client
Laravel API
Database
Authentication

Definition of Done:

* App starts
* Laravel API works
* Login works
* Register works
* Auth persists
* Logout works

⸻

Phase 1 — Dream System

Implement:

Life Areas
Dreams
Goals
Targets
Milestones

Definition of Done:

User can:

Create Dream
Create Goal
Create Target
Update progress
Create milestone
Complete milestone
View Dream progress

⸻

Phase 2 — Daily System

Implement:

Tasks
Habits
Habit Logs
Streaks

Definition of Done:

User can:

Create task
Complete task
Create habit
Check habit
See streak
See calendar

⸻

Phase 3 — Reminder System

Implement:

Local notifications
Remote notifications
Reminder CRUD
Recurring reminders
Quiet hours
Notification preferences

⸻

Phase 4 — Dashboard

Implement:

Today's tasks
Today's habits
Today's goals
Upcoming reminders
Daily score
Progress summary

⸻

Phase 5 — Review System

Implement:

Morning Brief
Night Review
Mood
Energy
Journal

⸻

Phase 6 — Statistics

Implement:

Habit statistics
Goal statistics
Daily score
Weekly score
Monthly score
Life Score
Life Area statistics

⸻

Phase 7 — Offline

Implement:

SQLite
Offline cache
Mutation queue
Sync engine
Retry mechanism
Conflict handling

⸻

Phase 8 — Polish

Implement:

Animations
Haptics
Skeleton loading
Dark mode
Accessibility
Performance optimization
Error handling
Empty states

⸻

Phase 9 — AI COACH

AI should NOT be implemented in the initial MVP.

Future features:

AI Goal Breakdown
AI Daily Planning
AI Habit Suggestions
AI Goal Risk Detection
AI Weekly Review
AI Personal Coaching
AI Life Pattern Analysis

Example:

User:

I want to become healthier.

AI:

Dream
Become healthier
Goal
Improve physical health
Targets
Exercise 150 min/week
Sleep 7+ hours
Drink 2L water/day
Habits
Exercise 30 minutes
Drink water
Sleep before 23:00

AI should suggest, not automatically change important user data without confirmation.

⸻

52. AI ARCHITECTURE

Future architecture:

React Native
      ↓
Laravel API
      ↓
AI Service
      ↓
LLM Provider
      ↓
Structured JSON
      ↓
Laravel validation
      ↓
User confirmation
      ↓
Database

AI responses should be structured.

Never allow raw AI output to directly modify the database.

⸻

53. COPILOT DEVELOPMENT RULES

When generating code:

1. Use TypeScript strict mode.
2. Avoid any.
3. Use reusable components.
4. Follow feature-based architecture.
5. Do not duplicate business logic.
6. Keep API calls inside service/API layers.
7. Use TanStack Query for server state.
8. Use Zustand only for client state.
9. Validate forms with Zod.
10. Use React Hook Form.
11. Keep screens focused.
12. Avoid extremely large components.
13. Break components when complexity increases.
14. Add types for API responses.
15. Handle loading/error/empty states.
16. Write tests for important business logic.
17. Do not introduce dependencies without justification.
18. Prefer Expo-compatible libraries.
19. Do not eject from Expo unless there is a clear technical requirement.
20. Do not put secrets/API keys inside the mobile application.

⸻

54. COPILOT IMPLEMENTATION STRATEGY

Do NOT generate the entire application in one step.

Implement incrementally.

Recommended order:

1. Project initialization
2. Folder architecture
3. Theme
4. Navigation
5. API client
6. Authentication
7. Dashboard skeleton
8. Life Areas
9. Dreams
10. Goals
11. Targets
12. Milestones
13. Tasks
14. Habits
15. Habit logs
16. Streak engine
17. Reminders
18. Notifications
19. Morning Brief
20. Night Review
21. Journal
22. Statistics
23. Offline support
24. Testing
25. Performance
26. AI

After each stage:

Run
Test
Fix
Refactor
Commit
Continue

⸻

55. GIT STRATEGY

Branches:

main
develop
feature/*
fix/*

Example:

feature/authentication
feature/dream-management
feature/goal-management
feature/habit-tracking
feature/notifications

Commit examples:

feat(auth): implement login
feat(dream): add dream management
feat(goal): add goal progress
feat(habit): implement habit check-in
fix(auth): refresh expired session

⸻

56. ENVIRONMENT

Mobile:

EXPO_PUBLIC_API_URL=

Backend:

APP_ENV=
APP_KEY=
APP_URL=
DB_DATABASE=
DB_USERNAME=
DB_PASSWORD=
REDIS_HOST=
REDIS_PORT=
QUEUE_CONNECTION=redis
CACHE_STORE=redis

Never commit secrets.

Provide:

.env.example

⸻

57. DEVELOPMENT ENVIRONMENT

Recommended:

Node.js LTS
npm or pnpm
VS Code
Android Studio
Xcode on macOS
Git
GitHub

Initial mobile development can use Expo Go.

For native builds use:

EAS Build

⸻

58. DEPLOYMENT

Backend:

Linux server
Nginx
PHP-FPM
MySQL
Redis
Supervisor
Laravel Scheduler
SSL

Workers:

Laravel Queue Worker

Scheduler:

php artisan schedule:work

or server cron:

* * * * * php artisan schedule:run

Mobile:

Expo EAS
Google Play Store
Apple App Store

⸻

59. OBSERVABILITY

Future production stack should support:

Error tracking
API logging
Queue monitoring
Performance monitoring
Crash reporting

Possible tools:

Sentry
Laravel Telescope
Laravel Horizon

⸻

60. MVP DEFINITION

MVP must contain only:

Authentication
Life Areas
Dreams
Goals
Targets
Tasks
Habits
Habit Logs
Reminders
Dashboard
Daily Score
Basic Statistics

Do NOT implement initially:

AI Coach
Advanced offline sync
Complex gamification
Social features
Community
Subscription
Advanced journaling
Complex life scoring

Keep MVP simple.

⸻

61. MVP USER FLOW

New user:

Install App
   ↓
Onboarding
   ↓
Register
   ↓
Create Life Area
   ↓
Create Dream
   ↓
Create Goal
   ↓
Create Target
   ↓
Create Habit
   ↓
Create Task
   ↓
Set Reminder
   ↓
Dashboard
   ↓
Daily Activity
   ↓
Track Progress
   ↓
Night Review

⸻

62. CORE PRODUCT PRINCIPLE

Every feature must answer one of these questions:

What do I want?
Why do I want it?
What should I do?
When should I do it?
Did I do it?
How am I progressing?
What should I improve?

If a feature does not help answer these questions, do not prioritize it.

⸻

63. FINAL PRODUCT VISION

Dream Tracker should eventually become:

                    DREAM
                      │
                      ▼
                    GOAL
                      │
          ┌───────────┼───────────┐
          ▼           ▼           ▼
       TARGET      MILESTONE     HABIT
          │           │           │
          └───────────┼───────────┘
                      ▼
                    TASK
                      │
                      ▼
                  REMINDER
                      │
                      ▼
                  DAILY ACTION
                      │
                      ▼
                   PROGRESS
                      │
                      ▼
                    REVIEW
                      │
                      ▼
                 IMPROVEMENT
                      │
                      └───────────► DREAM

The goal is not to make users spend more time inside the application.

The goal is to help users spend less time planning and more time living and improving.

⸻

64. FIRST TASK FOR COPILOT

Start by creating the project foundation only.

Do NOT implement all features yet.

First:

1. Initialize Expo React Native project.
2. Configure TypeScript strict mode.
3. Configure Expo Router.
4. Configure NativeWind.
5. Configure TanStack Query.
6. Configure Zustand.
7. Configure React Hook Form.
8. Configure Zod.
9. Create the folder structure.
10. Create theme system.
11. Create API client abstraction.
12. Create authentication architecture.
13. Create reusable UI primitives.
14. Create bottom-tab navigation.
15. Create placeholder screens.
16. Create environment configuration.
17. Add ESLint.
18. Add Prettier.
19. Add basic testing setup.
20. Verify Android/iOS/web startup.

After completing these steps, stop and report:

- Files created
- Dependencies installed
- Configuration completed
- Commands to run
- Known issues
- Next recommended task

Do not proceed to the next feature until the foundation is working.

⸻

65. IMPORTANT COPILOT BEHAVIOR

Before implementing a feature:

1. Understand existing architecture.
2. Inspect related files.
3. Reuse existing components/services.
4. Do not create duplicate implementations.
5. Implement the smallest complete solution.
6. Run type checking.
7. Run lint.
8. Run tests.
9. Fix errors.
10. Summarize changes.

Never rewrite unrelated files.

Never change architecture without explaining why.

Never install a new dependency when the existing stack can solve the problem.

Prioritize maintainability over cleverness.

⸻

END

Product:

Dream Tracker

Positioning:

Turn your dreams into daily actions.

Technology:

React Native + Expo + TypeScript + Laravel API

Development philosophy:

Simple first. Reliable second. Powerful later.
