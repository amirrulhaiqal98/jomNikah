---
stepsCompleted: [1, 2, 3, 4]
inputDocuments:
  - prd.md
  - project-proposal.md
  - implementation-readiness-report-2026-01-19.md
  - ux-design-specification.md
  - ux-design-directions.html
  - ux-journey-flows.md
  - ux-design-mockups.md
workflowType: 'architecture'
project_name: 'JomNikah'
user_name: 'Amirrul'
date: '2026-01-19'
documentCounts:
  briefs: 0
  research: 1
  projectDocs: 3
  other: 3
---

# Architecture Decision Document - JomNikah

**Author:** Amirrul
**Date:** 2026-01-19
**Status:** Step 4 Complete - Core Architectural Decisions

---

## Document Setup Summary

**Welcome Amirrul!** I've set up your Architecture workspace for JomNikah.

### Documents Found:

- **PRD:** 1 file loaded ✅ (REQUIRED)
  - `prd.md` - Complete Product Requirements Document with 75 FRs and 49 NFRs

- **Project Docs:** 3 files loaded
  - `project-proposal.md` - Technical stack and managed service model
  - `implementation-readiness-report-2026-01-19.md` - Assessment report
  - Architecture workspace: Ready to begin

- **UX Design:** 4 files loaded
  - `ux-design-specification.md` - Comprehensive UX design spec with psychology-driven principles
  - `ux-design-directions.html` - Interactive HTML showcase (8 design directions)
  - `ux-journey-flows.md` - Detailed user journey flows with Mermaid diagrams
  - `ux-design-mockups.md` - Visual mockups for mobile and desktop

- **Research:** 1 file loaded
  - Implementation readiness assessment

- **Project Context:** Not found (optional)

### Files Loaded:
`prd.md`, `project-proposal.md`, `implementation-readiness-report-2026-01-19.md`, `ux-design-specification.md`, `ux-design-directions.html`, `ux-journey-flows.md`, `ux-design-mockups.md`

---

## Ready to Begin Architectural Decision Making

You have excellent foundation documents:

✅ **Comprehensive PRD** with 75 functional requirements and 49 non-functional requirements
✅ **Complete UX Design** with emotional design principles, journey flows, and mockups
✅ **Technical Foundation** defined (Vue 3 + Inertia.js + Laravel 12)
✅ **Clear Business Context** (Managed service model, Malaysian wedding domain)

**No additional documents needed** - we can proceed!

---

**[C] Continue to project context analysis**

---

## Project Context Analysis

### Requirements Overview

**Functional Requirements:**

JomNikah has **75 Functional Requirements** organized into 10 capability areas:

**Core Capabilities:**
- **Account & Package Management (7 FRs):** Manual account creation by Super Admin, package tier assignment (Standard RM20 / Premium RM30), independent feature toggling for Wish Present and Digital Ang Pow
- **Wedding Card Configuration (8 FRs):** Dynamic subdomain generation with real-time availability checking, template switching engine (change designs without data loss), wedding details management, photo gallery with <2MB validation
- **Guest RSVP Management (5 FRs):** WhatsApp redirect + form-based RSVP, real-time RSVP tracking for couples
- **Guestbook & Wishes (7 FRs):** Message submission with approval workflow, moderation controls, PDF/Excel export functionality
- **Premium Features - Wish Present Registry (11 FRs):** CRUD operations for gift items, claim tracking with guest contact info, duplicate prevention, cancel/reclaim functionality
- **Premium Features - Digital Ang Pow (8 FRs):** QR code upload, bank account details storage, private monetary gift collection
- **Public Wedding Card Display (7 FRs):** Mobile-first responsive design, curtain animation ritual, real-time countdown timer, photo gallery
- **Admin & Monitoring (8 FRs):** Wedding account management, setup progress tracking, RSVP/wish monitoring
- **Data Management & Privacy (6 FRs):** 6-month automated data deletion (PDPA compliance), Privacy Policy and Terms of Service
- **Multi-Language Support (3 FRs):** English and Bahasa Malaysia interface switching
- **Feature Locking & Upgrade (5 FRs):** Premium feature locking for Standard couples, instant unlock on upgrade

**Key Architectural Implications from FRs:**
- **Multi-tenant isolation:** Each wedding needs isolated data access (Spatie Permissions)
- **Dynamic routing:** Subdomain-based routing (sarah-ahmad.jomnikah.com) with wildcard SSL
- **State management:** Template switching must preserve all wedding data
- **Real-time updates:** RSVP/wish tracking with near-instant dashboard updates
- **Feature gating:** Package-based access control with granular feature toggles
- **Data lifecycle:** Automated deletion jobs running 6 months post-wedding

**Non-Functional Requirements:**

JomNikah has **49 Non-Functional Requirements** across 5 categories:

**Performance (8 NFRs):**
- **Load Times:** <5s page load on 4G mobile (NFR-PERF-001), <3s TTI on desktop (NFR-PERF-002)
- **Validation Speed:** <2s subdomain lookup (NFR-PERF-004)
- **Concurrency:** 100 concurrent weddings (NFR-PERF-005), 50 concurrent guests per wedding (NFR-PERF-006)
- **Real-time:** Countdown timer updates every second (NFR-PERF-007), RSVP reflection in <5s (NFR-PERF-008)
- **Optimization:** Progressive image lazy loading (NFR-PERF-003)

**Security (17 NFRs):**
- **Data Protection:** bcrypt/Argon2 password hashing (NFR-SEC-001), HTTP-only session cookies (NFR-SEC-002)
- **Encryption:** Bank details and QR codes secure storage (NFR-SEC-003), guest contact info encryption at rest (NFR-SEC-004)
- **Access Control:** Role-based authentication (NFR-SEC-005, NFR-SEC-006, NFR-SEC-007), feature-level authorization (NFR-SEC-008)
- **Compliance:** Privacy Policy (NFR-SEC-009), implicit consent (NFR-SEC-010), 6-month auto-deletion (NFR-SEC-011, NFR-SEC-012)
- **Input Validation:** XSS prevention (NFR-SEC-013), file upload validation (NFR-SEC-014), SQL injection prevention (NFR-SEC-015)
- **Transmission:** HTTPS/TLS 1.2+ (NFR-SEC-016, NFR-SEC-017)

**Scalability (8 NFRs):**
- **Capacity:** 100 active wedding subdomains (NFR-SCALE-001), 1 Super Admin + 100 Couple accounts (NFR-SCALE-002)
- **Data Volume:** 500 RSVPs per wedding (NFR-SCALE-003), 10,000 guestbook messages (NFR-SCALE-005), 5,000 photos (NFR-SCALE-006)
- **Growth:** Manual DigitalOcean droplet upgrade path (NFR-SCALE-004)
- **Load Handling:** <7s page loads during peak traffic (NFR-SCALE-007), graceful handling of 20 simultaneous RSVPs (NFR-SCALE-008)

**Reliability (8 NFRs):**
- **Availability:** 95% uptime during weekends (NFR-REL-001), manual server restarts during low-traffic (NFR-REL-002)
- **Data Integrity:** No RSVP loss (NFR-REL-003), atomic guestbook saves (NFR-REL-004), photo validation before storage (NFR-REL-005)
- **Error Handling:** User-friendly error messages (NFR-REL-006), error logging for admin review (NFR-REL-007), frontend validation (NFR-REL-008)

**Usability (8 NFRs):**
- **Mobile-First:** All actions completable on smartphones (NFR-USE-001), 44×44px minimum touch targets (NFR-USE-002), 16px minimum font size (NFR-USE-003)
- **Clarity:** Clear error messages in English/BM (NFR-USE-004), immediate validation feedback (NFR-USE-005), visible upgrade prompts (NFR-USE-006)
- **Efficiency:** Setup completion <1 hour (NFR-USE-007), account creation <5 minutes (NFR-USE-008)

**Scale & Complexity:**

- **Primary domain:** Full-stack Web Application (SPA)
- **Complexity level:** Medium-High
- **Estimated architectural components:** 12-15 major components

**Breakdown:**
- Authentication & Authorization (Spatie Permissions)
- Multi-tenant Subdomain Routing
- Template System (Vue components)
- Wedding Configuration Engine
- RSVP Management System
- Guestbook with Moderation
- Wish Present Registry (Premium)
- Digital Ang Pow System (Premium)
- File Upload & Storage
- Real-time Updates (Polling/WebSocket consideration)
- Data Lifecycle Management (6-month deletion)
- Admin Dashboards (Super Admin + Couple)
- Public Wedding Card Display
- Export Functionality (PDF/Excel)

### Technical Constraints & Dependencies

**Technology Stack (Locked Decisions):**
- **Backend:** Laravel 12 (PHP 8.2+)
- **Frontend:** Vue 3 + Inertia.js + Tailwind CSS
- **Database:** MySQL 8+
- **Permissions:** Spatie Permission package
- **Local Dev:** Laravel Herd
- **Production:** DigitalOcean Droplets (manual setup)
- **Web Server:** Nginx (manual configuration)
- **Process Manager:** Supervisor (manual configuration)
- **SSL:** Certbot for wildcard SSL (*.jomnikah.com)

**Architectural Constraints:**
- **No Laravel Queues:** Synchronous processing only (simplifies architecture, reduces complexity)
- **Manual Server Management:** Full control over infrastructure, no automation tools (Forge, Envoyer)
- **No Payment Gateway:** Manual bank transfer processing (no Stripe, FPX integration)
- **No Automated Emails:** WhatsApp/Telegram communication only
- **No Self-Service Registration:** Admin-led onboarding model
- **Subdomain Routing:** Wildcard DNS + Nginx configuration required

**Business Constraints:**
- **Managed Service Model:** Quality control through manual account creation
- **6-Month Card Validity:** Automated data deletion for PDPA compliance
- **One-Time Fee Pricing:** RM20 Standard / RM30 Premium (no recurring revenue)
- **Solo Developer Operation:** Architecture must support single-person maintenance
- **Target Capacity:** 100 weddings for initial validation phase

**UX/Design Constraints:**
- **Mobile-First Priority:** 80%+ guest traffic on smartphones
- **Cross-Generational Accessibility:** Users aged 20-70 with varying tech comfort
- **Defining Experience:** Curtain animation ritual (<2s) - must work flawlessly
- **Design System:** Tailwind CSS + Headless UI + Custom emotional components (3-layer)
- **Performance Budget:** <5s page load on 4G mobile connections

### Cross-Cutting Concerns Identified

**Security (Highest Priority):**
1. **Multi-tenant Data Isolation:** Each couple's data must be strictly segregated
2. **Role-Based Access Control:** Super Admin vs Couple permissions enforcement
3. **Feature Gating:** Premium features locked for Standard package
4. **Sensitive Data Storage:** Bank details, QR codes, guest contact information encryption
5. **Input Validation:** All user inputs sanitized (XSS, SQL injection prevention)
6. **PDPA Compliance:** 6-month automated data deletion, privacy policy enforcement

**Performance (Critical for Mobile Users):**
1. **Page Load Optimization:** <5s target on 4G mobile (images, bundle size, CDN)
2. **Real-Time Features:** Countdown timer (client-side), RSVP updates (<5s reflection)
3. **Progressive Enhancement:** Lazy loading for photo galleries
4. **Frontend Validation:** Immediate feedback to prevent server round-trips
5. **Database Query Optimization:** Efficient subdomain lookups (<2s validation)

**Data Privacy & Compliance:**
1. **6-Month Data Retention:** Automated deletion jobs (photos, card content, guestbook)
2. **Credential Retention:** Account credentials kept separately from wedding data
3. **Export Before Deletion:** PDF/Excel export functionality for memories preservation
4. **Privacy Policy Accessibility:** Available from all pages

**Multi-Tenancy:**
1. **Subdomain Routing:** Dynamic routing (sarah-ahmad.jomnikah.com) with proper isolation
2. **Resource Segregation:** Database queries scoped by wedding_id
3. **Template Switching:** Data preserved when changing templates
4. **Concurrent Access:** 100 weddings without performance degradation

**User Experience:**
1. **Mobile-First Design:** Touch targets (44×44px), readable fonts (16px+), simplified navigation
2. **Emotional Design:** Curtain animation ritual, celebration milestones, warm error messages
3. **Progressive Disclosure:** Setup wizard with one section at a time
4. **Accessibility:** Cross-generational users (elderly guests like Auntie Fatimah, age 60)

**Maintainability (Solo Developer Context):**
1. **Code Organization:** Clear separation of concerns (Laravel services, Vue components)
2. **Monitoring & Logging:** Error tracking for Super Admin review
3. **Manual Infrastructure:** Simple enough for single-person server management
4. **No Queue Complexity:** Synchronous processing reduces operational overhead

**Integration Points:**
1. **WhatsApp Integration:** Deep links for RSVP, credential delivery
2. **Future Payment Gateway:** Architecture should support future FPX/Stripe addition
3. **Export Functionality:** PDF generation, Excel export (guestbook data)

---

## Starter Template Evaluation

### Primary Technology Domain

**Full-stack Web Application (SPA)** - JomNikah uses a monolithic Laravel backend with Vue 3 frontend connected via Inertia.js, providing SPA experience without separate API complexity.

### Stack Analysis

**Current Stack: Laravel 12 + Vue 3 + Inertia.js + Tailwind CSS + MySQL 8**

**Current Versions (2025):**
- **Laravel:** Version 12.17.0 (Latest as of June 2025)
  - [Release Notes](https://laravel.com/docs/12.x/releases)
  - [Changelog](https://laravel.com/docs/changelog)
  - Key features: Performance enhancements, xxHash hashing, UUID v7 support, MariaDB optimizations

- **Vue 3 + Inertia.js:** Trending stack for 2025-2026
  - [Complete Modern SPA Guide](https://sadiqueali.medium.com/inertia-js-vue-3-in-laravel-2026-the-complete-modern-spa-guide-61c567d48084)
  - [Build SPAs with Inertia.js 2025 Guide](https://www.iflair.com/build-high-performance-spas-single-page-applications-without-using-laravel-inertia-js-2025-guide/)
  - [Beginner-Friendly Guide](https://blog.stackademic.com/getting-started-with-laravel-12-vue-3-inertia-js-a-beginner-friendly-guide-a62856f3ae7b)

- **Tailwind CSS:** Latest v4 with Vue 3 integration
  - [Install Tailwind v4 in Vue 3 Project](https://dev.to/osalumense/install-tailwind-css-v4-in-a-vue-3-vite-project-319g)
  - [Official Laravel Guide](https://tailwindcss.com/docs/guides/laravel)

- **Spatie Permission:** Multi-tenancy support
  - [Best Practices](https://spatie.be/docs/laravel-permission/v6/best-practices/performance)
  - [Multi-Tenant Role System](https://medium.com/@ilyaskazi/building-a-multi-tenant-role-system-in-laravel-with-dynamic-policies-129261d879ec)
  - [Data Safety for SaaS](https://dev.to/kamruljpi/laravel-for-saas-how-to-keep-multi-tenant-data-safe-3o7d)

- **Subdomain Routing:** Wildcard SSL configuration
  - [Multi-Tenancy Strategies](https://hafiz.dev/blog/laravel-multi-tenancy-database-vs-subdomain-vs-path-routing-strategies)
  - [Wildcard Subdomain Setup](https://pineco.de/adding-a-subdomain-to-your-laravel-application/)

### Selected Stack: Laravel 12 + Vue 3 + Inertia.js + Tailwind CSS

**Rationale for Selection:**

**1. Perfect for JomNikah's Requirements:**
- **SPA Performance with Monolith Simplicity:** Inertia.js provides SPA experience without needing separate REST API, reducing complexity for solo developer
- **Real-time Features:** Client-side countdown timer (JavaScript) + optional polling for RSVP/wish updates (no WebSockets needed, synchronous processing)
- **Mobile-First Optimization:** Vue 3 + Tailwind CSS enables <5s page loads on 4G mobile (NFR-PERF-001)
- **Progressive Enhancement:** Lazy loading for photo galleries (NFR-PERF-003)

**2. Multi-Tenancy Support:**
- **Subdomain Routing:** Dynamic routing (sarah-ahmad.jomnikah.com) with wildcard SSL - perfect fit for 100 weddings
- **Spatie Permissions:** Role-based access control (Super Admin vs Couple) with data isolation
- **Global Scopes:** Automatic tenant filtering prevents data leaks between weddings
- **Single Database:** Simpler than separate databases per tenant, suitable for 100-wedding scale

**3. Performance & Scalability:**
- **Laravel 12 Performance:** Automatic eager loading, xxHash hashing, MariaDB optimizations - supports 100 concurrent weddings (NFR-PERF-005)
- **No Queue Complexity:** Synchronous processing simplifies architecture while meeting <5s RSVP reflection requirement (NFR-PERF-008)
- **Database Query Optimization:** Efficient subdomain lookups <2s (NFR-PERF-004)

**4. Security & Compliance:**
- **Built-in Security:** bcrypt/Argon2 hashing (NFR-SEC-001), HTTP-only cookies (NFR-SEC-002), XSS prevention (NFR-SEC-013)
- **PDPA Compliance:** Easy to implement 6-month automated data deletion (NFR-SEC-011) with Laravel's scheduler
- **Access Control:** Spatie Permissions enforces role-based access (NFR-SEC-005, NFR-SEC-006, NFR-SEC-007, NFR-SEC-008)
- **Input Validation:** Laravel's validation system prevents SQL injection (NFR-SEC-015)

**5. Developer Experience (Solo Developer):**
- **Laravel Herd:** Fast local development (matches project proposal)
- **Manual Server Management:** Full control over DigitalOcean infrastructure (no SaaS costs like Forge)
- **Clear Conventions:** Laravel's opinionated structure reduces decision fatigue
- **Rich Ecosystem:** Spatie packages (Permissions, Laravel Toolkit) accelerate development

**6. UX Requirements Alignment:**
- **Tailwind CSS:** 44×44px touch targets (NFR-USE-002), 16px minimum fonts (NFR-USE-003), mobile-first breakpoints
- **Vue 3 Composition API:** Perfect for emotional components (curtain animation, celebration milestones)
- **Headless UI:** Accessible interactive components (modals, dropdowns) for cross-generational users
- **Three-Layer Design System:** Tailwind (utilities) + Headless UI (logic) + Custom emotional components

**7. Business Constraints Fit:**
- **No Payment Gateway:** Architecture supports future Stripe/FPX addition but doesn't require it now
- **Manual Onboarding:** Laravel's auth system supports admin-led account creation
- **6-Month Data Lifecycle:** Laravel scheduler can automate deletion jobs
- **WhatsApp Integration:** Easy to integrate deep links for RSVP and credential delivery

### Architectural Decisions Provided by This Stack

**Language & Runtime:**
- **PHP 8.2+** with Laravel 12
- **JavaScript** via Vue 3 (no TypeScript for simplicity, solo developer context)
- **Blade Templates** for initial server render, Inertia.js for SPA navigation

**Styling Solution:**
- **Tailwind CSS v4** with JIT compiler for performance
- **Design Tokens:** Rose (#F43F5E), Gold (#F59E0B), Emerald (#10B981) colors
- **Typography:** Inter (sans-serif) + Playfair Display (serif)
- **Responsive:** Mobile-first breakpoints (<640px, 640-1024px, >1024px)

**Build Tooling:**
- **Vite** for frontend asset compilation (fast HMR, optimized builds)
- **Laravel Mix** alternative (Vite is Laravel 12 default)
- **Code Splitting:** Route-based chunks for <3s TTI (NFR-PERF-002)

**Testing Framework:**
- **Pest** or **PHPUnit** for backend (Laravel default)
- **Vitest** or **Jest** for Vue components (optional for solo developer)
- **Playwright** or **Cypress** for E2E testing (recommended but not critical for MVP)

**Code Organization:**
```
app/
├── Http/Controllers/
│   ├── Admin/ (Super Admin dashboard)
│   ├── Couple/ (Couple dashboard)
│   └── Public/ (Wedding card display)
├── Models/
│   ├── User.php (with Spatie Roles)
│   ├── Wedding.php (multi-tenant scoping)
│   ├── Rsvp.php
│   ├── Guestbook.php
│   └── Present.php (Premium feature)
├── Services/ (business logic)
└── Middleware/ (authentication, subdomain routing)

resources/js/
├── components/
│   ├── jc-base/ (base UI components)
│   ├── jc-interactive/ (Headless UI wrappers)
│   └── jc-wedding/ (wedding-specific components)
├── layouts/ (admin, couple, public card)
└── pages/ (Inertia.js page components)
```

**Development Experience:**
- **Hot Module Replacement (HMR):** Instant frontend updates
- **Inertia.js:** No API building required, Laravel routes return Vue components
- **Laravel Telescope:** Debugging and monitoring (development)
- **Laravel Debugbar:** Query profiling and optimization
- **Manual Server Setup:** Nginx + PHP-FPM + Supervisor (full control)

### Why This Stack Fits JomNikah's NFRs

**Performance NFRs:**
- ✅ <5s page load on 4G (Tailwind JIT, Vite optimization, lazy loading)
- ✅ <3s TTI on desktop (Code splitting, minimal JavaScript)
- ✅ <2s subdomain validation (Database indexing, eager loading)
- ✅ 100 concurrent weddings (Laravel 12 performance optimizations)

**Security NFRs:**
- ✅ bcrypt/Argon2 hashing (Laravel default)
- ✅ HTTP-only cookies (Laravel session configuration)
- ✅ Role-based access (Spatie Permissions)
- ✅ PDPA compliance (6-month deletion via Laravel scheduler)
- ✅ Input validation (Laravel validation rules)
- ✅ HTTPS/TLS 1.2+ (Nginx configuration)

**Scalability NFRs:**
- ✅ 100 wedding subdomains (Single database with tenant_id scoping)
- ✅ 500 RSVPs per wedding (MySQL 8+ optimized for read-heavy workloads)
- ✅ 10,000 guestbook messages (Efficient pagination, index optimization)
- ✅ Manual droplet upgrade (DigitalOcean flexibility)

**Reliability NFRs:**
- ✅ 95% uptime (Manual server management, no queue worker failures)
- ✅ Atomic operations (Database transactions for RSVPs, guestbook)
- ✅ Error logging (Laravel logging channels)
- ✅ Frontend validation (Vue 3 reactive forms)

**Usability NFRs:**
- ✅ Mobile-first (Tailwind mobile-first approach)
- ✅ 44×44px touch targets (Tailwind spacing utilities)
- ✅ 16px minimum fonts (Tailwind typography scale)
- ✅ Clear error messages (Laravel validation + Vue components)

### Note: Project Initialization

Since JomNikah development is already complete, this stack documentation serves as:
1. **Architectural record** for future maintenance
2. **Onboarding reference** for any additional developers
3. **Technical rationale** for the stack choices made
4. **Foundation** for future enhancements (payment gateway, automated emails, etc.)

---

## Core Architectural Decisions

### Overview

JomNikah's architecture has been established through completed development. This section documents all architectural decisions made during implementation, organized by priority and impact.

**Decision Categories:**
1. **Already Decided** (Foundational choices from stack selection)
2. **Critical Decisions** (High impact on core functionality & security)
3. **Important Decisions** (Significant impact on UX & operations)
4. **Nice-to-Have Decisions** (Quality assurance & optimization)

---

## 1. Already Decided Items

These decisions were established in Step 3 during stack selection and are core to JomNikah's foundation.

### 1.1 Database: MySQL 8+

**Decision:** Use MySQL 8+ as the primary database for all JomNikah data storage.

**Rationale:**
- **Laravel Native Support:** MySQL is Laravel's default database with excellent Eloquent ORM support
- **Read-Heavy Workload:** Wedding card displays are read-intensive (guests viewing), MySQL 8 optimized for this
- **Multi-Tenancy Simplicity:** Single database with `wedding_id` scoping simpler than separate databases per tenant
- **JSON Columns:** MySQL 8's JSON type for flexible data (e.g., wedding metadata, template settings)
- **Full-Text Search:** Support for guestbook search functionality
- **Sufficient Scale:** MySQL 8 easily handles 100 weddings × 500 RSVPs = 50,000 records + photos, guestbook
- **Cost:** Open-source, no licensing fees

**Implementation:**
- **Version:** MySQL 8.0+ (InnoDB engine for ACID compliance)
- **Connection:** Via PDO with Laravel's database abstraction layer
- **Charset:** `utf8mb4` (full Unicode support for Malay/Arabic text)
- **Collation:** `utf8mb4_unicode_ci` (case-insensitive, culturally correct sorting)

**Key Tables:**
```sql
users (id, name, email, password, role)
weddings (id, user_id, subdomain, template_id, wedding_date, package_tier, created_at)
rsvps (id, wedding_id, guest_name, phone, status, created_at)
guestbook (id, wedding_id, guest_name, message, approved, created_at)
presents (id, wedding_id, item_name, description, claimed_by, status)
photos (id, wedding_id, path, size, display_order)
```

**NFR Alignment:**
- ✅ **Security:** ACID compliance prevents RSVP loss (NFR-REL-003)
- ✅ **Performance:** <2s subdomain validation with indexed queries (NFR-PERF-004)
- ✅ **Scalability:** 100 weddings × 500 RSVPs per wedding (NFR-SCALE-003)
- ✅ **Reliability:** Atomic operations for guestbook saves (NFR-REL-004)

**Alternatives Considered:**
- **PostgreSQL:** More advanced features, but MySQL sufficient for this scale
- **SQLite:** Too limited for multi-tenant concurrent access
- **MongoDB:** Overkill, SQL relational model better fits structured wedding data

---

### 1.2 Backend Framework: Laravel 12

**Decision:** Use Laravel 12 as the PHP backend framework.

**Rationale:**
- **Monolithic SPA:** Inertia.js provides SPA experience without API complexity
- **Ecosystem:** Spatie packages (Permissions, Laravel Toolkit) accelerate development
- **Convention over Configuration:** Reduces decision fatigue for solo developer
- **Security:** Built-in CSRF protection, password hashing, input validation
- **Scheduler:** Laravel Console Scheduler for 6-month data deletion jobs
- **Manual Infrastructure:** Full control over DigitalOcean deployment

**Implementation:**
- **Version:** Laravel 12.17.0 (June 2025)
- **PHP Version:** PHP 8.2+ (matched with Laravel 12 requirements)
- **Key Packages:**
  - `spatie/laravel-permission`: Role-based access control
  - `inertiajs/inertia-laravel`: SPA bridge
  - `laravel/framework`: Core framework

**NFR Alignment:**
- ✅ **Security:** bcrypt/Argon2 hashing (NFR-SEC-001), HTTP-only cookies (NFR-SEC-002)
- ✅ **Performance:** xxHash hashing, automatic eager loading (NFR-PERF-005)
- ✅ **Usability:** Clear error messages via validation (NFR-USE-004)

**Alternatives Considered:**
- **Laravel 9/10/11:** Older versions, Laravel 12 latest with performance improvements
- **Symfony:** More flexible but steeper learning curve
- **CodeIgniter:** Too basic, lacks Laravel's ecosystem

---

### 1.3 Frontend Framework: Vue 3 + Inertia.js

**Decision:** Use Vue 3 Composition API with Inertia.js for frontend.

**Rationale:**
- **SPA Experience:** No page reloads, smooth transitions for curtain animation
- **No API Building:** Inertia.js uses Laravel controllers directly, reduces code
- **Reactive State:** Perfect for countdown timer, real-time RSVP updates
- **Component Architecture:** Reusable wedding card components (curtain, gallery, RSVP)
- **Composition API:** Better for emotional components than Vue 2 Options API
- **Small Bundle:** Tree-shaking reduces JavaScript size for <3s TTI

**Implementation:**
- **Vue Version:** Vue 3.4+ (Composition API)
- **Inertia.js:** Latest version via `inertiajs/inertia-laravel`
- **State Management:** Vue 3 `ref()` and `reactive()` for local component state
- **Routing:** Laravel routes → Inertia page components (no Vue Router needed)

**NFR Alignment:**
- ✅ **Performance:** <3s TTI on desktop (NFR-PERF-002)
- ✅ **Usability:** Real-time validation feedback (NFR-USE-005)
- ✅ **Mobile-First:** Touch-friendly components (NFR-USE-001)

**Alternatives Considered:**
- **React + Laravel API:** More complex, requires building separate REST API
- **Blade Only:** No SPA experience, curtain animation less smooth
- **Alpine.js:** Too simple for complex wedding card interactions

---

### 1.4 Infrastructure: DigitalOcean Droplets

**Decision:** Use DigitalOcean droplets with manual Nginx + PHP-FPM + Supervisor setup.

**Rationale:**
- **Full Control:** No SaaS lock-in (Forge, Envoyer), solo developer prefers manual
- **Cost-Effective:** $6-20/month droplets sufficient for 100 weddings
- **Scalability:** Easy droplet upgrade (vertical scaling)
- **Manual Learning:** Valuable skills for solo developer
- **No Queue Workers:** Synchronous processing simplifies infrastructure

**Implementation:**
- **Droplet Size:** 4GB RAM / 2 vCPUs (sufficient for 100 concurrent weddings)
- **OS:** Ubuntu 22.04 LTS
- **Web Server:** Nginx 1.24+ (configured for wildcard subdomain routing)
- **PHP Process Manager:** PHP-FPM 8.2 (with Opcache for performance)
- **Process Monitoring:** Supervisor (keeps Laravel application alive)

**NFR Alignment:**
- ✅ **Reliability:** 95% uptime during weekends (NFR-REL-001)
- ✅ **Scalability:** Manual droplet upgrade path (NFR-SCALE-004)
- ✅ **Security:** HTTPS/TLS 1.2+ via Certbot (NFR-SEC-016, NFR-SEC-017)

**Alternatives Considered:**
- **Laravel Forge:** Automated but costs $12/month + DigitalOcean markup
- **AWS Lightsail:** More complex, larger learning curve
- **Shared Hosting:** Too limited for multi-tenant subdomain routing

---

## 2. Critical Decisions

These decisions have high impact on core functionality, security, and data isolation. They are **critical** to JomNikah's operation.

### 2.1 Multi-Tenancy: Single Database with wedding_id Scoping

**Decision:** Implement multi-tenancy using a single MySQL database with `wedding_id` foreign keys and Spatie Permissions for access control.

**Architecture:**
```
┌─────────────────────────────────────────────────────┐
│ MySQL 8 Database (jomnikah)                         │
├─────────────────────────────────────────────────────┤
│ users              ← Spatie Roles (Super Admin/Couple)
│ weddings           ← Tenant identifier (subdomain)
│ rsvps              ← wedding_id FK (tenant isolation)
│ guestbook          ← wedding_id FK (tenant isolation)
│ presents           ← wedding_id FK (Premium feature)
│ photos             ← wedding_id FK (tenant isolation)
└─────────────────────────────────────────────────────┘
```

**Rationale:**
- **Data Isolation:** Every query scoped by `wedding_id` prevents cross-wedding data leaks
- **Simplicity:** Single database easier to manage than 100 separate databases
- **Performance:** Indexes on `wedding_id` ensure fast queries (<2s validation)
- **Sufficient Scale:** 100 weddings × 500 RSVPs = 50k records, MySQL handles easily
- **Backup Simplicity:** Single database dump for all weddings

**Implementation:**

**Database Schema:**
```sql
-- Weddings table (tenant root)
CREATE TABLE weddings (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    user_id BIGINT UNSIGNED NOT NULL,  -- FK to users (Couple account)
    subdomain VARCHAR(255) UNIQUE NOT NULL,  -- sarah-ahmad
    template_id ENUM('modern-elegant', 'rustic-chic', 'floral-romance', 'minimalist') NOT NULL,
    wedding_date DATE NOT NULL,
    package_tier ENUM('standard', 'premium') NOT NULL,
    created_at TIMESTAMP,
    deleted_at TIMESTAMP NULL,  -- Soft deletes for 6-month retention
    INDEX idx_subdomain (subdomain),
    INDEX idx_user (user_id)
);

-- Example: RSVPs with tenant isolation
CREATE TABLE rsvps (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    wedding_id BIGINT UNSIGNED NOT NULL,  -- FK to weddings
    guest_name VARCHAR(255) NOT NULL,
    phone VARCHAR(20),
    status ENUM('confirmed', 'pending', 'declined') DEFAULT 'pending',
    created_at TIMESTAMP,
    FOREIGN KEY (wedding_id) REFERENCES weddings(id) ON DELETE CASCADE,
    INDEX idx_wedding (wedding_id),  -- Critical for performance
    INDEX idx_status (status)
);
```

**Application-Level Scoping (Global Scope):**
```php
// app/Models/Rsvp.php
class Rsvp extends Model
{
    protected static function booted()
    {
        // Automatically scope all queries by wedding_id
        static::addGlobalScope('wedding', function (Builder $query) {
            if (auth()->check() && auth()->user()->hasRole('Couple')) {
                $weddingId = auth()->user()->wedding->id;
                $query->where('wedding_id', $weddingId);
            }
        });
    }
}
```

**Subdomain Routing Middleware:**
```php
// app/Http/Middleware/CheckSubdomain.php
public function handle($request, Closure $next)
{
    // Extract subdomain from request (e.g., sarah-ahmad.jomnikah.com)
    $subdomain = explode('.', $request->getHost())[0];

    // Validate subdomain exists
    $wedding = Wedding::where('subdomain', $subdomain)->firstOrFail();

    // Share wedding with all views/controllers
    view()->share('wedding', $wedding);
    inertia()->share('wedding', $wedding);

    return $next($request);
}
```

**Security Measures:**
1. **Authorization Gates:** Every request checks `wedding_id` ownership
2. **Foreign Key Constraints:** Database-level referential integrity (ON DELETE CASCADE)
3. **Query Scoping:** Global scopes prevent accidental cross-tenant queries
4. **Spatie Permissions:** Role-based access (Super Admin sees all, Couple sees own wedding only)

**NFR Alignment:**
- ✅ **Security:** Multi-tenant data isolation (NFR-SEC-005, NFR-SEC-006, NFR-SEC-007)
- ✅ **Performance:** <2s subdomain validation with indexed lookups (NFR-PERF-004)
- ✅ **Scalability:** 100 concurrent weddings (NFR-PERF-005)
- ✅ **Reliability:** No RSVP loss (NFR-REL-003)

**Alternatives Considered:**
- **Separate Databases per Wedding:** Overkill for 100 weddings, backup nightmare
- **Row-Level Security (PostgreSQL):** More complex, MySQL sufficient
- **Shared Subdomain Paths:** (jomnikah.com/wedding/sarah-ahmad) Less professional than subdomains

**Trade-offs:**
- **Single Point of Failure:** All weddings in one database (mitigated by daily backups)
- **Future Scaling:** If >1000 weddings, may need separate databases (but not current concern)

---

### 2.2 Feature Locking: Package-Based Access Control

**Decision:** Implement Premium feature locking using Spatie Permissions with granular feature toggles (Wish Present, Digital Ang Pow).

**Architecture:**
```
┌──────────────────────────────────────────────────────┐
│ Spatie Laravel Permission System                     │
├──────────────────────────────────────────────────────┤
│ Roles:                                               │
│  - Super Admin (all access)                          │
│  - Couple (wedding-specific access)                  │
│                                                      │
│ Permissions (Granular Features):                     │
│  - access_wish_present_registry  (Premium only)      │
│  - access_digital_ang_pow        (Premium only)      │
│  - manage_rsvps                 (Standard + Premium) │
│  - manage_guestbook             (Standard + Premium) │
└──────────────────────────────────────────────────────┘
```

**Rationale:**
- **Clear Upsell Path:** Standard couples see locked Premium features, encouraged to upgrade
- **Independent Feature Toggling:** Super Admin can enable/disable Premium features per wedding
- **Database-Driven:** No code deployment needed to change access
- **Policy-Based Authorization:** Laravel Gates integrate with Spatie for clean checks

**Implementation:**

**Database Seeding (Default Permissions):**
```php
// database/seeders/PermissionSeeder.php
public function run()
{
    // Create Premium feature permissions
    $premiumFeatures = [
        'access_wish_present_registry',
        'access_digital_ang_pow',
    ];

    foreach ($premiumFeatures as $permission) {
        Permission::create(['name' => $permission]);
    }

    // Assign to Premium package (via wedding.package_tier check)
}
```

**Authorization Checks (Middleware):**
```php
// app/Http/Middleware/CheckPremiumFeature.php
public function handle($request, Closure $next, $feature)
{
    $user = auth()->user();
    $wedding = $user->wedding;

    // Check if Premium package OR has explicit permission
    if ($wedding->package_tier === 'premium' || $user->can($feature)) {
        return $next($request);
    }

    // Redirect to upgrade prompt
    return Inertia::render('Couple/UpgradePrompt', [
        'feature' => $feature,
        'currentTier' => $wedding->package_tier,
    ]);
}
```

**Route Protection:**
```php
// routes/web.php (Couple routes)
Route::middleware(['auth', 'verified', 'can:access_wish_present_registry'])
    ->group(function () {
        Route::resource('presents', PresentController::class);  // Premium only
    });

Route::middleware(['auth', 'verified'])
    ->group(function () {
        Route::resource('rsvps', RsvpController::class);  // Standard + Premium
        Route::resource('guestbook', GuestbookController::class);
    });
```

**Frontend Feature Detection (Inertia.js):**
```javascript
// resources/js/Shared/Data.js (Inertia shared data)
export default {
    wedding: {
        packageTier: 'standard',  // or 'premium'
        features: {
            wishPresentRegistry: false,  // Dynamically set
            digitalAngPow: false,
        },
    },
}

// Vue component conditional rendering
<template>
    <div>
        <!-- Standard + Premium -->
        <RSVPManager />

        <!-- Premium only -->
        <WishPresentRegistry v-if="wedding.features.wishPresentRegistry" />
        <DigitalAngPow v-if="wedding.features.digitalAngPow" />

        <!-- Upgrade prompt for locked features -->
        <UpgradePrompt
            v-if="!wedding.features.wishPresentRegistry"
            feature="Wish Present Registry"
            :upgradePrice="10"
        />
    </div>
</template>
```

**Upgrade Flow (Instant Unlock):**
```php
// app/Http/Controllers/Couple/UpgradeController.php
public function upgrade(Request $request)
{
    $wedding = auth()->user()->wedding;

    // Update package tier
    $wedding->update(['package_tier' => 'premium']);

    // Grant Premium permissions
    $user = auth()->user();
    $user->givePermissionTo(['access_wish_present_registry', 'access_digital_ang_pow']);

    // Redirect to dashboard with confetti celebration
    return redirect()->route('couple.dashboard')
        ->with('success', 'Premium features unlocked! Enjoy!');
}
```

**NFR Alignment:**
- ✅ **Security:** Feature-level authorization (NFR-SEC-008)
- ✅ **Usability:** Visible upgrade prompts (NFR-USE-006)

**Alternatives Considered:**
- **Hardcoded IF Statements:** Less flexible, requires code changes
- **Feature Flags Service:** Overkill, Spatie Permissions sufficient

---

### 2.3 Data Lifecycle: 6-Month Automated Deletion

**Decision:** Implement automated data deletion 6 months after wedding date using Laravel Console Scheduler, with separate retention for account credentials.

**Architecture:**
```
┌──────────────────────────────────────────────────────────┐
│ Data Lifecycle Management                                │
├──────────────────────────────────────────────────────────┤
│ Retention Policy:                                        │
│  - Wedding Data (RSVPs, guestbook, photos): 6 months    │
│  - Account Credentials (users table): Indefinite        │
│  - Wedding Metadata (weddings table): Soft-deleted      │
│                                                          │
│ Deletion Process:                                       │
│  1. Laravel Scheduler runs daily (03:00 UTC)            │
│  2. Find weddings where wedding_date + 6 months = today │
│  3. Export PDF/Excel memories (optional)                │
│  4. Cascade delete RSVPs, guestbook, photos             │
│  5. Soft-delete wedding record (keep subdomain history) │
│  6. Send notification to Couple (if desired)            │
└──────────────────────────────────────────────────────────┘
```

**Rationale:**
- **PDPA Compliance:** Malaysian Personal Data Protection Act requires data minimization
- **Cost Management:** Free up storage (photos) after wedding period
- **Privacy Assurance:** Guests' personal data (phone numbers) not stored indefinitely
- **Credential Retention:** Couples may reuse platform for future events
- **Soft Deletes:** Keep wedding record for analytics, prevent subdomain reuse

**Implementation:**

**Laravel Console Command:**
```php
// app/Console/Commands/DeleteExpiredWeddingData.php
public function handle()
{
    // Find weddings 6 months past wedding date
    $expiredWeddings = Wedding::where('wedding_date', '<=', now()->subMonths(6))
        ->whereNull('deleted_at')  // Not already soft-deleted
        ->get();

    foreach ($expiredWeddings as $wedding) {
        DB::transaction(function () use ($wedding) {
            // 1. Cascade delete related data (hard delete)
            $wedding->rsvps()->delete();
            $wedding->guestbook()->delete();
            $wedding->photos()->delete();
            $wedding->presents()->delete();  // Premium feature

            // 2. Soft-delete wedding record (keep for analytics)
            $wedding->delete();

            // 3. Log deletion
            Log::info('Deleted wedding data', [
                'wedding_id' => $wedding->id,
                'subdomain' => $wedding->subdomain,
                'wedding_date' => $wedding->wedding_date,
            ]);
        });
    }

    $this->info("Deleted {$expiredWeddings->count()} expired weddings.");
}
```

**Laravel Scheduler Configuration:**
```php
// app/Console/Kernel.php
protected function schedule(Schedule $schedule)
{
    // Run daily at 03:00 UTC (low-traffic period)
    $schedule->command('weddings:delete-expired')
        ->dailyAt('03:00')
        ->timezone('UTC')
        ->when(function () {
            // Only run on weekdays (avoid weekend disruptions)
            return now()->isWeekday();
        })
        ->onSuccess(function () {
            Log::info('Wedding deletion completed successfully');
        })
        ->onFailure(function () {
            Log::error('Wedding deletion failed - manual intervention needed');
        });
}
```

**Cron Job Setup (Server):**
```bash
# /etc/crontab (or via Supervisor)
* * * * * cd /path-to-jomnikah && php artisan schedule:run >> /dev/null 2>&1
```

**Export Before Deletion (Optional):**
```php
// app/Services/WeddingMemoryExporter.php
public function exportBeforeDeletion(Wedding $wedding)
{
    // Generate PDF memory book
    $pdf = PDF::loadView('exports.memory-book', [
        'wedding' => $wedding,
        'rsvps' => $wedding->rsvps,
        'guestbook' => $wedding->guestbook,
    ]);

    // Store in storage/app/exports/{wedding_id}.pdf
    $pdf->save(storage_path("app/exports/{$wedding->id}.pdf"));

    // Optionally email to couple
    Mail::to($wedding->user->email)->send(new WeddingMemoryExport($pdf));
}
```

**NFR Alignment:**
- ✅ **Security:** 6-month automated data deletion (NFR-SEC-011, NFR-SEC-012)
- ✅ **Reliability:** Atomic operations prevent partial deletion (NFR-REL-004)

**Alternatives Considered:**
- **Manual Deletion:** Too error-prone for 100 weddings
- **Immediate Deletion:** Too harsh, couples may want to access memories
- **Extended Retention (1 year):** Unnecessary storage cost, violates PDPA minimization

---

### 2.4 Real-Time Updates: Short Polling with Optimistic UI

**Decision:** Implement real-time RSVP and guestbook updates using short polling (every 5 seconds) with optimistic UI updates for instant feedback.

**Architecture:**
```
┌─────────────────────────────────────────────────────┐
│ Real-Time Updates Strategy                          │
├─────────────────────────────────────────────────────┤
│ 1. Guest RSVPs (Guest View):                        │
│    - Optimistic UI: Show success immediately        │
│    - Background sync: Send to server                │
│    - No polling needed (one-time action)            │
│                                                     │
│ 2. Couple Dashboard (RSVP/Guestbook Tracking):      │
│    - Short polling: Every 5 seconds via setInterval │
│    - Laravel backend: Check for new RSVPs/wishes    │
│    - Update UI: Incremental addition (no reload)    │
│                                                     │
│ 3. Countdown Timer (Public Card):                   │
│    - Client-side JavaScript: requestAnimationFrame  │
│    - No server polling needed                       │
└─────────────────────────────────────────────────────┘
```

**Rationale:**
- **No WebSockets:** Complex to set up manually, polling sufficient for <5s requirement
- **Optimistic UI:** Instant feedback (WhatsApp RSVP feels immediate)
- **Low Server Load:** 100 weddings × 5s polling = manageable for DigitalOcean droplet
- **Synchronous Processing:** No queue workers needed (simplifies infrastructure)
- **NFR Compliance:** <5s RSVP reflection requirement (NFR-PERF-008)

**Implementation:**

**Frontend Polling (Vue 3 Composition API):**
```javascript
// resources/js/components/Couple/Dashboard.vue
<script setup>
import { ref, onMounted, onUnmounted } from 'vue';

const rsvps = ref([]);
const guestbook = ref([]);
let pollingInterval = null;

const fetchUpdates = async () => {
    const response = await axios.get('/api/couple/updates');
    rsvps.value = response.data.rsvps;
    guestbook.value = response.data.guestbook;
};

onMounted(() => {
    fetchUpdates();  // Initial load

    // Poll every 5 seconds
    pollingInterval = setInterval(fetchUpdates, 5000);
});

onUnmounted(() => {
    clearInterval(pollingInterval);  // Cleanup
});
</script>

<template>
    <div>
        <h2>RSVPs ({{ rsvps.length }})</h2>
        <ul>
            <li v-for="rsvp in rsvps" :key="rsvp.id">
                {{ rsvp.guest_name }} - {{ rsvp.status }}
            </li>
        </ul>

        <h2>Guestbook ({{ guestbook.length }})</h2>
        <ul>
            <li v-for="wish in guestbook" :key="wish.id">
                "{{ wish.message }}" - {{ wish.guest_name }}
            </li>
        </ul>
    </div>
</template>
```

**Backend API Endpoint:**
```php
// routes/api.php
Route::middleware(['auth', 'can:view-couple-dashboard'])
    ->get('/couple/updates', [CoupleDashboardController::class, 'updates']);

// app/Http/Controllers/CoupleDashboardController.php
public function updates()
{
    $wedding = auth()->user()->wedding;

    return response()->json([
        'rsvps' => $wedding->rsvps()->latest()->take(10)->get(),
        'guestbook' => $wedding->guestbook()->where('approved', true)->latest()->take(10)->get(),
    ]);
}
```

**Optimistic UI (Guest RSVP):**
```javascript
// resources/js/components/Public/RSVPForm.vue
<script setup>
const form = reactive({
    guest_name: '',
    phone: '',
    status: 'confirmed',
});

const isSubmitting = ref(false);
const showSuccess = ref(false);

const submitRSVP = async () => {
    isSubmitting.value = true;

    // Optimistic UI: Show success immediately
    showSuccess.value = true;

    try {
        await axios.post(`/weddings/${wedding.subdomain}/rsvp`, form);
    } catch (error) {
        // Revert if failed
        showSuccess.value = false;
        alert('RSVP failed. Please try again.');
    } finally {
        isSubmitting.value = false;
    }
};
</script>

<template>
    <form @submit.prevent="submitRSVP">
        <input v-model="form.guest_name" placeholder="Your Name" />
        <input v-model="form.phone" placeholder="Phone Number" />
        <button type="submit" :disabled="isSubmitting">
            <span v-if="showSuccess">✅ RSVP Sent!</span>
            <span v-else>Send RSVP</span>
        </button>
    </form>
</template>
```

**Countdown Timer (Client-Side Only):**
```javascript
// resources/js/components/Public/Countdown.vue
<script setup>
import { ref, onMounted, onUnmounted } from 'vue';

const timeRemaining = ref({
    days: 0,
    hours: 0,
    minutes: 0,
    seconds: 0,
});

let timerInterval = null;

const updateCountdown = () => {
    const weddingDate = new Date(wedding.wedding_date);
    const now = new Date();
    const diff = weddingDate - now;

    if (diff > 0) {
        timeRemaining.value = {
            days: Math.floor(diff / (1000 * 60 * 60 * 24)),
            hours: Math.floor((diff % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60)),
            minutes: Math.floor((diff % (1000 * 60 * 60)) / (1000 * 60)),
            seconds: Math.floor((diff % (1000 * 60)) / 1000),
        };
    }
};

onMounted(() => {
    updateCountdown();
    timerInterval = setInterval(updateCountdown, 1000);  // Every second
});

onUnmounted(() => {
    clearInterval(timerInterval);
});
</script>
```

**NFR Alignment:**
- ✅ **Performance:** RSVP reflection in <5s (NFR-PERF-008)
- ✅ **Performance:** Countdown timer updates every second (NFR-PERF-007)

**Alternatives Considered:**
- **WebSockets (Pusher/Laravel Echo):** Overkill, polling sufficient for 100 weddings
- **Long Polling:** More complex, short polling simpler for solo developer
- **Server-Sent Events (SSE):** Good compromise but requires manual Nginx config

**Trade-offs:**
- **Server Load:** 100 weddings × 12 requests/minute = 1200 req/min (manageable)
- **Battery Usage:** Polling drains mobile battery (mitigated by 5s interval)
- **Stale Data:** 5-second delay acceptable for RSVP tracking (not real-time chat)

---

## 3. Important Decisions

These decisions significantly impact user experience and operational efficiency.

### 3.1 Frontend State Management: Vue 3 Reactive System (No Vuex/Pinia)

**Decision:** Use Vue 3 Composition API with `ref()` and `reactive()` for local component state, no centralized state management library (Vuex/Pinia).

**Rationale:**
- **Simplicity:** Most state is wedding-specific (no global app state)
- **Prop Drilling Acceptable:** Shallow component tree (max 3 levels)
- **Inertia.js Shared Data:** Already provides global data (auth, wedding, permissions)
- **Smaller Bundle:** No Vuex/Pinia reduces JavaScript size
- **Easier Debugging:** Local state easier to trace than global store

**Implementation:**

**Component State (Local):**
```javascript
// resources/js/components/Couple/WeddingDetailsEditor.vue
<script setup>
import { ref, watch } from 'vue';

const wedding = ref({
    wedding_date: '',
    venue: '',
    map_link: '',
});

const isSaving = ref(false);

// Local state, no store needed
const updateDetails = async () => {
    isSaving.value = true;
    await axios.put('/couple/wedding/details', wedding.value);
    isSaving.value = false;
};
</script>
```

**Inertia.js Shared Data (Global):**
```php
// app/Http/Middleware/HandleInertiaRequests.php
public function share(Request $request)
{
    return array_merge(parent::share($request), [
        // Global data available to all components
        'auth' => [
            'user' => $request->user(),
            'permissions' => $request->user() ? $request->user()->getAllPermissions() : [],
        ],
        'wedding' => fn() => $request->user()?->wedding,
        'flash' => [
            'success' => $request->session()->get('success'),
            'error' => $request->session()->get('error'),
        ],
    ]);
}
```

**Access Global Data in Components:**
```javascript
// resources/js/pages/Couple/Dashboard.vue
<script setup>
import { usePage } from '@inertiajs/vue3';

const page = usePage();
const user = page.props.auth.user;
const wedding = page.props.wedding;
</script>
```

**When to Use State Management (Future):**
- Shopping cart (not applicable, one-time payment)
- Multi-step wizard with back navigation (setup wizard uses URL state)
- Real-time collaboration (not applicable, single couple per wedding)

**NFR Alignment:**
- ✅ **Performance:** Smaller bundle size (<3s TTI) (NFR-PERF-002)

**Alternatives Considered:**
- **Pinia (Vue 3 Official):** Not needed, insufficient global state
- **Vuex:** Deprecated, Pinia replacement available
- **Reactive Built-in:** Sufficient for JomNikah's needs

---

### 3.2 Component Architecture: 3-Layer Design System

**Decision:** Implement a 3-layer component architecture: (1) Tailwind CSS utilities, (2) Headless UI wrappers, (3) Custom emotional components.

**Architecture:**
```
┌──────────────────────────────────────────────────────────┐
│ Layer 3: Custom Emotional Components (jc-wedding/)       │
│  - WeddingCurtain (curtain reveal animation)             │
│  - CountdownTimer (time remaining with emotional copy)   │
│  - CelebrationConfetti (confetti burst at 100% setup)    │
│  - PhotoGallery (lazy-loading, emotional layout)         │
├──────────────────────────────────────────────────────────┤
│ Layer 2: Headless UI Wrappers (jc-interactive/)          │
│  - JCModal (modal with accessibility)                    │
│  - JCDropdown (dropdown menu with keyboard nav)          │
│  - JCDatePicker (date selection with validation)         │
│  - JCToast (notification with auto-dismiss)              │
├──────────────────────────────────────────────────────────┤
│ Layer 1: Base UI Components (jc-base/)                   │
│  - JCButton (Tailwind: class="bg-rose-500 hover:bg-rose-600")
│  - JCInput (Tailwind: class="border-gray-300 focus:ring-rose-500")
│  - JCCard (Tailwind: class="bg-white rounded-lg shadow")  │
└──────────────────────────────────────────────────────────┘
```

**Rationale:**
- **Separation of Concerns:** Base components (styling) → Interactive (logic) → Emotional (UX)
- **Reusability:** Base components used across admin, couple, guest interfaces
- **Accessibility:** Headless UI provides ARIA attributes, keyboard navigation
- **Emotional Design:** Custom components create "Masya Allah, cantiknya!" moments
- **Consistent Design System:** Tailwind tokens (Rose, Gold, Emerald) enforced via layers

**Implementation:**

**Layer 1: Base Components (jc-base/)**
```vue
<!-- resources/js/components/jc-base/JCButton.vue -->
<template>
    <button
        :type="type"
        :disabled="disabled || loading"
        :class="classes"
        v-bind="$attrs"
    >
        <span v-if="loading">Loading...</span>
        <slot v-else />
    </button>
</template>

<script setup>
defineProps({
    type: { type: String, default: 'button' },
    variant: { type: String, default: 'primary' },  // primary, secondary, ghost
    disabled: Boolean,
    loading: Boolean,
});

const classes = computed(() => {
    const base = 'px-4 py-2 rounded-lg font-medium transition-all duration-200';

    const variants = {
        primary: 'bg-rose-500 text-white hover:bg-rose-600 disabled:bg-gray-300',
        secondary: 'bg-gold-500 text-white hover:bg-gold-600',
        ghost: 'bg-transparent text-rose-500 hover:bg-rose-50',
    };

    return `${base} ${variants[props.variant]}`;
});
</script>
```

**Layer 2: Headless UI Wrappers (jc-interactive/)**
```vue
<!-- resources/js/components/jc-interactive/JCModal.vue -->
<template>
    <HeadlessUI TransitionRoot :show="open" as="template">
        <Dialog as="div" class="relative z-50">
            <!-- Backdrop -->
            <TransitionChild
                enter="ease-out duration-300"
                enter-from="opacity-0"
                enter-to="opacity-100"
                leave="ease-in duration-200"
                leave-from="opacity-100"
                leave-to="opacity-0"
            >
                <div class="fixed inset-0 bg-black/50" />
            </TransitionChild>

            <!-- Modal Panel -->
            <div class="fixed inset-0 overflow-y-auto">
                <div class="flex min-h-full items-center justify-center p-4">
                    <TransitionChild
                        enter="ease-out duration-300"
                        enter-from="opacity-0 scale-95"
                        enter-to="opacity-100 scale-100"
                        leave="ease-in duration-200"
                        leave-from="opacity-100 scale-100"
                        leave-to="opacity-0 scale-95"
                    >
                        <DialogPanel class="bg-white rounded-lg shadow-xl max-w-md">
                            <slot />
                        </DialogPanel>
                    </TransitionChild>
                </div>
            </div>
        </Dialog>
    </HeadlessUI TransitionRoot>
</template>

<script setup>
import { Dialog, DialogPanel, TransitionChild, TransitionRoot } from '@headlessui/vue';

defineProps({ open: Boolean });
</script>
```

**Layer 3: Custom Emotional Components (jc-wedding/)**
```vue
<!-- resources/js/components/jc-wedding/WeddingCurtain.vue -->
<template>
    <div
        class="fixed inset-0 z-50 bg-gradient-to-br from-rose-500 to-rose-700"
        :class="{ 'curtain-open': isOpen }"
    >
        <div class="flex h-screen items-center justify-center text-white text-center">
            <div>
                <div class="text-6xl mb-4">💍</div>
                <h1 class="text-3xl font-serif font-bold mb-2">
                    {{ coupleNames }}
                </h1>
                <p class="text-xl opacity-90">Tap to Open Their Wedding Card</p>
            </div>
        </div>

        <!-- Curtain opening animation -->
        <transition @after-enter="onCurtainOpen">
            <div v-if="isOpen" class="curtain-left"></div>
            <div v-if="isOpen" class="curtain-right"></div>
        </transition>
    </div>
</template>

<script setup>
import { ref } from 'vue';

const isOpen = ref(false);

const onCurtainOpen = () => {
    // Emit event to load card content
    emit('curtain-opened');
};
</script>

<style scoped>
.curtain-left, .curtain-right {
    position: absolute;
    top: 0;
    bottom: 0;
    width: 50%;
    background: linear-gradient(to right, #e11d48, #be123c);
    transition: transform 1.8s cubic-bezier(0.4, 0, 0.2, 1);
}

.curtain-open .curtain-left {
    transform: translateX(-100%);
}

.curtain-open .curtain-right {
    transform: translateX(100%);
}
</style>
```

**NFR Alignment:**
- ✅ **Usability:** Accessible components for cross-generational users (NFR-USE-001)
- ✅ **Performance:** Reusable base components reduce bundle size (NFR-PERF-002)

**Alternatives Considered:**
- **2-Layer (Tailwind + Custom Only):** Duplicate accessibility code
- **Component Library (Vuetify/Buefy):** Too opinionated, harder to customize
- **Atomic Design (Atoms/Molecules/Organisms):** Overkill for this scale

---

### 3.3 Photo Upload & Storage: Local Storage with Validation

**Decision:** Implement photo uploads to local DigitalOcean storage (`storage/app/public/weddings/{wedding_id}/`) with client-side validation (<2MB limit) and automatic optimization.

**Rationale:**
- **Cost:** Local storage free (vs AWS S3 ~$0.023/GB)
- **Simplicity:** No external service dependencies
- **Privacy:** Photos not publicly accessible (via `storage:link` symlink)
- **Sufficient Scale:** 100 weddings × 50 photos × 1MB = 5GB (fits in droplet)
- **Validation:** Client-side prevents server waste (reject >2MB files immediately)

**Implementation:**

**Client-Side Validation:**
```vue
<!-- resources/js/components/Couple/PhotoUpload.vue -->
<script setup>
const validatePhoto = (file) => {
    // Check file size (2MB = 2 * 1024 * 1024 bytes)
    const maxSize = 2 * 1024 * 1024;

    if (file.size > maxSize) {
        const sizeInMB = (file.size / (1024 * 1024)).toFixed(1);
        alert(`This photo is ${sizeInMB}MB. Please choose under 2MB for best performance.`);
        return false;
    }

    // Check file type
    const allowedTypes = ['image/jpeg', 'image/png', 'image/webp'];
    if (!allowedTypes.includes(file.type)) {
        alert('Please upload JPEG, PNG, or WebP images only.');
        return false;
    }

    return true;
};

const uploadPhoto = async (file) => {
    if (!validatePhoto(file)) return;

    const formData = new FormData();
    formData.append('photo', file);
    formData.append('wedding_id', wedding.value.id);

    try {
        await axios.post('/couple/photos/upload', formData, {
            headers: { 'Content-Type': 'multipart/form-data' },
        });
    } catch (error) {
        alert('Upload failed. Please try again.');
    }
};
</script>
```

**Server-Side Handler:**
```php
// app/Http/Controllers/Couple/PhotoController.php
public function upload(Request $request)
{
    $request->validate([
        'photo' => 'required|image|max:2048',  // 2MB max
        'wedding_id' => 'required|exists:weddings,id',
    ]);

    $wedding = auth()->user()->wedding;

    // Store photo in storage/app/public/weddings/{wedding_id}/
    $path = $request->file('photo')
        ->store("weddings/{$wedding->id}", 'public');

    // Save to database
    $photo = $wedding->photos()->create([
        'path' => $path,
        'size' => $request->file('photo')->getSize(),
        'display_order' => $wedding->photos()->count() + 1,
    ]);

    return response()->json($photo);
}
```

**Filesystem Configuration:**
```php
// config/filesystems.php
'links' => [
    public_path('storage') => storage_path('app/public'),
],
```

**Nginx Configuration (Serve Photos):**
```nginx
# /etc/nginx/sites-available/jomnikah.com
server {
    location /storage/ {
        alias /var/www/jomnikah/storage/app/public/;
        expires 1y;  # Cache photos for 1 year
        add_header Cache-Control "public, immutable";
    }
}
```

**NFR Alignment:**
- ✅ **Reliability:** Photo validation before storage (NFR-REL-005)
- ✅ **Performance:** Lazy loading for photo galleries (NFR-PERF-003)

**Alternatives Considered:**
- **AWS S3:** Cost overkill for 5GB, unnecessary complexity
- **Cloudinary:** Excellent optimization but adds dependency
- **Image Resizing on Upload:** Better quality but increases server load

---

### 3.4 WhatsApp Integration: Deep Links (No API)

**Decision:** Integrate WhatsApp via deep links (`wa.me/` URLs) only, no official WhatsApp Business API.

**Rationale:**
- **Cost:** WhatsApp Business API costs per conversation (free tier limited)
- **Simplicity:** Deep links work immediately (no API setup, approval process)
- **Privacy:** Couples use personal WhatsApp numbers (no business number needed)
- **Malaysian Context:** Everyone has WhatsApp, deep links sufficient
- **RSVP Flow:** One-tap RSVP via WhatsApp (preferred Malaysian communication)

**Implementation:**

**Guest RSVP (WhatsApp Deep Link):**
```vue
<!-- resources/js/components/Public/RSVPButton.vue -->
<script setup>
const wedding = inject('wedding');

const openWhatsAppRSVP = () => {
    const couplePhone = wedding.couple_phone;  // e.g., '60123456789'
    const message = encodeURIComponent(
        `Assalamualaikum ${wedding.bride_name} & ${wedding.groom_name}! ` +
        `I'll be attending your wedding on ${wedding.wedding_date}. ` +
        `Looking forward!`
    );

    const whatsappURL = `https://wa.me/${couplePhone}?text=${message}`;
    window.open(whatsappURL, '_blank');
};
</script>

<template>
    <button @click="openWhatsAppRSVP" class="bg-green-500 text-white">
        RSVP via WhatsApp
    </button>
</template>
```

**Admin Credential Delivery:**
```php
// app/Services/AccountCreationService.php
public function sendCredentialsViaWhatsApp($user, $password)
{
    $loginURL = route('login');
    $message = encodeURIComponent(
        "Assalamualaikum! Your JomNikah account is ready.\n\n" .
        "Email: {$user->email}\n" .
        "Password: {$password}\n\n" .
        "Login: {$loginURL}\n\n" .
        "Let's create your beautiful wedding card together! 💍"
    );

    // Send to Amirrul's WhatsApp (manual forwarding)
    $amirrulPhone = '60123456789';
    $whatsappURL = "https://wa.me/{$amirrulPhone}?text={$message}";

    // Open in browser (Amirrul copies and forwards to couple)
    return redirect($whatsappURL);
}
```

**Fallback (Web Form if WhatsApp Unavailable):**
```vue
<template>
    <div>
        <button @click="openWhatsAppRSVP" class="bg-green-500">
            RSVP via WhatsApp (Preferred)
        </button>

        <button @click="showWebForm = true" class="bg-rose-500 ml-2">
            RSVP via Web Form
        </button>

        <RSVPWebForm v-if="showWebForm" @close="showWebForm = false" />
    </div>
</template>
```

**NFR Alignment:**
- ✅ **Usability:** Zero-login RSVP (no account creation needed)

**Alternatives Considered:**
- **WhatsApp Business API:** Cost prohibitive for 100 weddings (RM0.50+ per conversation)
- **Twilio SMS:** Higher cost, less preferred than WhatsApp in Malaysia
- **Email RSVP:** Lower engagement, slower response

---

### 3.5 Export Functionality: PDF (DomPDF) + Excel (Laravel Excel)

**Decision:** Implement PDF export via DomPDF for memory books and Excel export via Laravel Excel (FastExcel) for RSVP/guestbook data.

**Rationale:**
- **PDF Generation:** DomPDF free, sufficient for simple memory books
- **Excel Export:** FastExcel lightweight, faster than PhpSpreadsheet
- **Memories Preservation:** Couples can download guestbook before 6-month deletion
- **Admin Convenience:** Excel easier for data analysis than PDF

**Implementation:**

**PDF Export (Guestbook Memory Book):**
```php
// app/Http/Exports/GuestbookMemoryBookExport.php
use Barryvdh\DomPDF\Facade\Pdf;

public function download(Wedding $wedding)
{
    $data = [
        'wedding' => $wedding,
        'rsvps' => $wedding->rsvps,
        'guestbook' => $wedding->guestbook()->where('approved', true)->get(),
    ];

    $pdf = Pdf::loadView('exports.memory-book', $data);

    return $pdf->download("{$wedding->subdomain}-memory-book.pdf");
}
```

**Excel Export (RSVP List):**
```php
// app/Http/Exports/RsvpListExport.php
use function FastExcel\data;

public function download(Wedding $wedding)
{
    $rsvps = $wedding->rsvps()->get();

    return data($rsvps)
        ->export('RSVPs.xlsx');
}
```

**Route Definition:**
```php
// routes/web.php
Route::middleware(['auth', 'can:export-wedding-data'])
    ->get('/couple/export/guestbook', [ExportController::class, 'guestbookPDF']);

Route::middleware(['auth', 'can:export-wedding-data'])
    ->get('/couple/export/rsvps', [ExportController::class, 'rsvpsExcel']);
```

**NFR Alignment:**
- ✅ **Usability:** Export before deletion functionality

---

## 4. Nice-to-Have Decisions

These decisions improve quality assurance and operational efficiency but are not critical for MVP.

### 4.1 Testing: Pest (Backend) + Vitest (Frontend)

**Decision:** Use Pest for backend testing and Vitest for Vue component testing (minimal test coverage for MVP).

**Rationale:**
- **Solo Developer Context:** Extensive testing slows development
- **Critical Paths Only:** Test RSVP creation, multi-tenant isolation, photo upload
- **Pest:** Modern syntax, faster than PHPUnit
- **Vitest:** Native Vite integration, faster than Jest

**Implementation:**
```php
// tests/Feature/MultiTenantIsolationTest.php
test('couple cannot access other weddings rsvps', function () {
    $wedding1 = Wedding::factory()->create();
    $wedding2 = Wedding::factory()->create();

    $user = $wedding1->user;

    actingAs($user)
        ->get(route('rsvps.index', $wedding2))
        ->assertForbidden();
});
```

### 4.2 Monitoring: Laravel Logs + Manual Review

**Decision:** Use Laravel's built-in logging system with manual log review by Super Admin (no external monitoring service).

**Rationale:**
- **Cost:** No Sentry/Bugsnag subscription (saves $10-20/month)
- **Sufficient for Scale:** 100 weddings manageable via manual logs
- **Laravel Logs:** Stored in `storage/logs/laravel.log`

**Implementation:**
```php
// app/Exceptions/Handler.php
public function report(Throwable $e)
{
    Log::error('Exception occurred', [
        'message' => $e->getMessage(),
        'user_id' => auth()->id(),
        'url' => request()->fullUrl(),
    ]);
}
```

### 4.3 Error Handling: Kind Error Messages

**Decision:** Implement user-friendly error messages with warm, supportive tone (not technical jargon).

**Rationale:**
- **Cross-Generational Users:** Elderly guests (Auntie Fatimah, age 60) need clarity
- **Emotional Design:** Errors should feel supportive, not punitive
- **Malaysian Context:** Multilingual messages (English + Bahasa Malaysia)

**Implementation:**
```php
// app/Http/Exceptions/Handler.php
public function render($request, Throwable $e)
{
    if ($e instanceof ValidationException) {
        return back()->with('error', 'Maaf, sila isi semua maklumat yang diperlukan.');
    }

    return back()->with('error', 'Maaf, ada masalah teknikal. Sila cuba lagi.');
}
```

### 4.4 Performance Optimization: Lazy Loading + Caching

**Decision:** Implement progressive image lazy loading and MySQL query caching (no Redis for simplicity).

**Rationale:**
- **Lazy Loading:** Reduces initial page load (NFR-PERF-001: <5s on 4G)
- **MySQL Cache:** Sufficient for 100 weddings (Redis overkill)
- **CDN:** Not needed (DigitalOcean Singapore fast for Malaysia)

**Implementation:**
```vue
<!-- resources/js/components/Public/PhotoGallery.vue -->
<img
    v-for="photo in photos"
    :src="photo.path"
    loading="lazy"
    :alt="'Wedding photo'"
/>
```

---

## Decision Summary Table

| Category | Decision | Rationale | NFR Alignment |
|----------|----------|-----------|---------------|
| **Database** | MySQL 8+ | Laravel native, read-heavy optimized | NFR-REL-003, NFR-PERF-004 |
| **Backend** | Laravel 12 | Monolithic SPA, ecosystem | NFR-SEC-001, NFR-PERF-005 |
| **Frontend** | Vue 3 + Inertia.js | No API complexity, reactive | NFR-PERF-002, NFR-USE-005 |
| **Infrastructure** | DigitalOcean droplets | Full control, cost-effective | NFR-REL-001, NFR-SEC-016 |
| **Multi-Tenancy** | Single DB + wedding_id scoping | Simple isolation, sufficient scale | NFR-SEC-005, NFR-PERF-005 |
| **Feature Locking** | Spatie Permissions | Granular access control | NFR-SEC-008 |
| **Data Lifecycle** | 6-month auto-deletion | PDPA compliance | NFR-SEC-011, NFR-SEC-012 |
| **Real-Time** | Short polling (5s) | <5s RSVP reflection | NFR-PERF-008 |
| **State Management** | Vue 3 reactive (no Pinia) | Simplicity, smaller bundle | NFR-PERF-002 |
| **Component Architecture** | 3-layer (Tailwind + Headless UI + Custom) | Emotional design, accessibility | NFR-USE-001 |
| **Photo Storage** | Local storage | Free, simple | NFR-REL-005 |
| **WhatsApp** | Deep links (no API) | Cost-free, preferred channel | NFR-USE-001 |
| **Export** | DomPDF + FastExcel | Memory preservation | NFR-SEC-011 |

---

**Step 4 Complete:** All architectural decisions documented with rationale, implementation details, and NFR alignment.

**[C] Continue to Step 5: Implementation Patterns**