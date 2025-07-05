# COSC 4806 – Assignment 5: Reminders + Admin Reports (MVC PHP) - Rahith Ahsan

> **Repo & live Replit**: add the links here before submission → `https://github.com/rahithahsan/Assignment4`  |  `https://replit.com/@rahsan2/Assignment4#README.md`
>
> **Default credentials for marking**  
> *username*: `rahith`  |  *password*: `Test123!`
> *admin*: `admin`  |  *password*: `admin`

---

## 1  Project Summary
Building on Assignment 3’s secure login system, **Assignment 4 adds a full Create‑Read‑Update‑Delete (CRUD) workflow for personal reminders**.  Assignment 5 builds on both evolving the Assignment‑4 CRUD app into a mini SaaS dashboard: A logged‑in user can:

* refreshed public / private headers & footer (two navbars)
* Bootstrap components sprinkled throughout – Toast flash, alert banners, progress‑bar, pill filters, accordion FAQ
* Admin role (new is_admin flag) with a protected /reports area
* live KPIs, who owns the most reminders, per‑user login totals, Chart.js bar chart
* strict ACL: non‑admin & guests are 403‑blocked

All functionality follows the MVC pattern and every database query uses prepared PDO statements.

---

## 2  Folder Map
| Layer | Purpose | Key files |
|-------|---------|-----------|
| **Controllers** | route logic | `app/controllers/notes.php`, `login.php`, `home.php` |
| **Models** | DB helpers | `app/models/Note.php`, `User.php` |
| **Views** | UI (Bootstrap 5 + Feather icons) | `views/notes/*`, `views/templates/*` |
| **Core** | mini‑framework bootstrap | `core/App.php`, `core/Controller.php`, `database.php` |

---

## 3  Database Schema
```sql
-- A5: add admin flag
ALTER TABLE users
  ADD COLUMN is_admin TINYINT(1) NOT NULL DEFAULT 0
  AFTER password_hash;

-- seed built‑in administrator
INSERT INTO users (username, password_hash, is_admin)
VALUES ('admin', '$2y$10$Lry5vkTHvHnKTf/tulwsouPk..(hash)…', 1);
```
Notes table is unchanged from Assignment 4.
---

## 4  Requirement Checklist (A4)
| Requirement | 🚀 Implementation |
|-------------|------------------|
| **Headers & footers revamped** | New navbars (`header.php`, `headerPublic.php`) & glossy footer with icons |
| **Bootstrap components** | Toast flash `(templates/header*.php)`, alerts, card grid, progress‑bar, pill filters, accordion in Docs page |
| **Admin user** | Seeder SQL above; `User::authenticate()` now exposes `is_admin` in session |
| **/reports controller** | `Reports@index` aggregates stats & loads `views/reports/index.php` |
| **View all reminders** | Big filterable table (`data‑status` + JS pills) |
| **Top user** | `Note::mostActiveUser()` + KPI card |
| **Login totals** | `User::loginCounts()` – chart + mini table |
| **Chart bonus** | Chart.js bar chart of successful logins |
| **Admin menu item** | `Reports` link shows only when `$_SESSION['is_admin']=1` |
| **ACL** | Middleware inside `Reports` controller sends `403` if not admin |
| **PDO everywhere** | same pledge as A4 – prepared statements only |
| **Polished UI** | Dark‑primary navbar, shadow cards, responsive gutter, feather icons |

---

## 5 Demo / Marking Guide
### 5.1  Regular user
* Log in as rahith/Test123! → land on redesigned Home (Toast greets you).
* Create a couple reminders, mark some Done, archive, etc. – all A4 flows still intact.
### 5.2  Administrator
* Log in as admin/admin.
* Navbar now shows Reports. Click it → /reports.
* KPI cards show Total reminders & User with most reminders.
* Bar chart Logins per user renders (Chart.js). Hover bars for counts.
* Click pill filters (Open, Done, Archived) above the All‑Reminders table – rows hide/show instantly (Bootstrap pills + JS).
* Try hitting /reports in another browser not logged in → expects 403 Forbidden.

---

## 6 Bootstrap 5 Components Used

* Toast – session flash on login/create/update
* Alerts – success / danger banners everywhere
* Cards – KPI and Docs grids
* Progress – open vs done bar on Home dashboard
* Nav pills + JS filter – status selector in Reports table
* Accordion – FAQ section in Docs
* Badge – ADMIN badge beside username

---