---
stepsCompleted: [1, 2, 3, 4, 5, 6, 7, 8]
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
**Status:** COMPLETE - Ready for Implementation
**CompletedAt:** 2026-01-19

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

---

## Implementation Patterns & Consistency Rules

### Overview

**Purpose:** Ensure all AI agents write compatible, consistent code that maintains JomNikah's architectural integrity.

**Critical Conflict Points:** 38 areas where AI agents could make different choices

**Enforcement:** These patterns are architecturally binding - deviations cause security vulnerabilities, performance degradation, or UX inconsistencies.

---

### 1. Naming Patterns

#### Database Naming Conventions

**Table Names:**
- **Pattern:** Singular, snake_case
- **Examples:** `users`, `weddings`, `rsvps`, `guestbook`, `presents`, `photos`
- **Rationale:** Laravel's Eloquent ORM convention, prevents ORM conflicts
- **Anti-Pattern:** ❌ `User`, `tbl_users`, `WeddingGuests`

**Column Names:**
- **Pattern:** snake_case with descriptive names
- **Examples:** `wedding_date`, `package_tier`, `created_at`
- **Foreign Keys:** `{table}_id` format (e.g., `wedding_id`, `user_id`)
- **Rationale:** MySQL compatibility, clear relationships
- **Anti-Pattern:** ❌ `weddingDate`, `fk_wedding`, `weddingId`

**Indexes:**
- **Pattern:** `idx_{table}_{column}` or `idx_{column}`
- **Examples:** `idx_weddings_subdomain`, `idx_rsvps_wedding_id`
- **Rationale:** Easy identification, Laravel migration conventions

#### Model Naming

**Pattern:**
- **Format:** Singular, PascalCase matching table name
- **Location:** `app/Models/{ModelName}.php`
- **Examples:**
  - Table `users` → Model `User`
  - Table `rsvps` → Model `Rsvp`
  - Table `guestbook` → Model `Guestbook`

**Rationale:** Laravel's Eloquent ORM expects singular model names

**Anti-Pattern:** ❌ `UsersModel`, `RsvpModel`, `GuestbookEntry`

#### Controller Naming

**Pattern:**
- **Organization:** By user role (Admin, Couple, Public)
- **Format:** Singular, PascalCase
- **Location:** `app/Http/Controllers/{Role}/{Controller}.php`

**Examples:**
```php
app/Http/Controllers/
├── Admin/
│   ├── WeddingController.php (Creates couple accounts)
│   └── DashboardController.php
├── Couple/
│   ├── WeddingController.php (Edits wedding details)
│   ├── RsvpController.php
│   ├── GuestbookController.php
│   └── PhotoController.php
└── Public/
    └── WeddingCardController.php
```

**Rationale:** Role-based organization prevents permission confusion, aligns with Spatie Permissions

**Anti-Pattern:** ❌ Feature-based organization (e.g., `AuthController`, `WeddingController` handling both admin and couple)

#### Vue Component Naming

**Pattern:**
- **Prefix:** `jc-` (JomNikah Component) to prevent conflicts
- **Format:** PascalCase, descriptive names
- **Organization:** 3-layer architecture

**Examples:**
```javascript
resources/js/components/
├── jc-base/              // Base UI components
│   ├── JCButton.vue
│   ├── JCInput.vue
│   └── JCCard.vue
├── jc-interactive/       // Headless UI wrappers
│   ├── JCModal.vue
│   ├── JCDropdown.vue
│   └── JCToast.vue
└── jc-wedding/          // Wedding-specific emotional components
    ├── WeddingCurtain.vue
    ├── CountdownTimer.vue
    └── PhotoGallery.vue
```

**Rationale:**
- `jc-` prefix prevents naming conflicts with third-party libraries
- 3-layer separation maintains architectural clarity
- Descriptive names aid discoverability

**Anti-Pattern:** ❌ `Button.vue`, `Modal.vue`, `Curtain.vue` (no prefix)

#### Route Naming

**Pattern:**
- **Convention:** Dot notation following Laravel standards
- **Format:** `{role}.{resource}.{action}`
- **Examples:**
  - `admin.weddings.store`
  - `couple.rsvps.index`
  - `couple.guestbook.update`
  - `wedding-card.show` (public)

**Rationale:** Laravel best practice, enables clean route generation

**Anti-Pattern:** ❌ `createWedding`, `rsvp-list`, `guestbook/update`

---

### 2. Structure Patterns

#### Controller Organization

**Pattern:**
- **Organization:** By user role, NOT by feature
- **Structure:**
  ```
  app/Http/Controllers/
  ├── Admin/     → Super Admin only
  ├── Couple/    → Authenticated couples
  └── Public/    → Unauthenticated guest access
  ```

**Examples:**
```php
// Admin: Creates couple accounts
Route::middleware(['auth', 'role:super-admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
        Route::resource('weddings', WeddingController::class);
    });

// Couple: Manages wedding card
Route::middleware(['auth', 'role:couple'])
    ->prefix('couple')
    ->name('couple.')
    ->group(function () {
        Route::resource('rsvps', RsvpController::class);
        Route::resource('guestbook', GuestbookController::class);
    });

// Public: Wedding card display
Route::domain('{subdomain}.jomnikah.com')
    ->group(function () {
        Route::get('/', [WeddingCardController::class, 'show']);
    });
```

**Rationale:** Aligns with Spatie Permissions, prevents cross-role access

**Anti-Pattern:** ❌ Feature-based controllers (e.g., `WeddingController` handling both admin and couple logic)

#### Vue Component Organization

**Pattern:**
- **Architecture:** 3-layer design system
- **Layer 1 (jc-base):** Reusable UI primitives (Tailwind utilities)
- **Layer 2 (jc-interactive):** Headless UI wrappers (accessibility)
- **Layer 3 (jc-wedding):** Emotional UX components

**Example Usage:**
```vue
<!-- Layer 1: Base component -->
<JCButton variant="primary">Click Me</JCButton>

<!-- Layer 2: Interactive component -->
<JCModal :open="isOpen" @close="isOpen = false">
    <WeddingDetailsForm />
</JCModal>

<!-- Layer 3: Wedding component -->
<WeddingCurtain
    :couple-names="wedding.bride_name + ' & ' + wedding.groom_name"
    @curtain-opened="loadCardContent"
/>
```

**Rationale:**
- Base components are reusable across all interfaces
- Interactive components ensure accessibility (ARIA, keyboard nav)
- Wedding components contain emotional design separate from UI

**Anti-Pattern:** ❌ Mixing layers (e.g., emotional logic in JCButton)

#### Services and Helpers

**Pattern:**
- **Services Location:** `app/Services/` for business logic
- **Helpers:** `app/helpers.php` for global utility functions
- **Usage:** Controllers delegate to services for complex operations

**Example:**
```php
// app/Services/AccountCreationService.php
class AccountCreationService
{
    public function createCoupleAccount(array $data, string $packageTier): User
    {
        return DB::transaction(function () use ($data, $packageTier) {
            $user = User::create([...]);
            $user->assignRole('couple');
            $wedding = Wedding::create([...]);

            if ($packageTier === 'premium') {
                $user->givePermissionTo(['access_wish_present_registry', ...]);
            }

            return $user;
        });
    }
}

// Controller (thin, delegates to service)
public function store(Request $request)
{
    $user = $this->accountService->createCoupleAccount($request->validated(), 'premium');
    return redirect()->route('admin.weddings.index');
}
```

**Rationale:** Keeps controllers thin, business logic reusable and testable

**Anti-Pattern:** ❌ Complex business logic in controllers

#### Test Organization

**Pattern:**
- **Structure:** Mirror application structure
- **Separation:** Feature tests (end-to-end) vs Unit tests (individual methods)

**Example:**
```
tests/
├── Feature/
│   ├── Auth/
│   │   └── LoginTest.php
│   ├── Admin/
│   │   └── WeddingCreationTest.php
│   ├── Couple/
│   │   └── RsvpManagementTest.php
│   └── MultiTenantIsolationTest.php  ← Critical security test
└── Unit/
    ├── Models/
    │   └── WeddingTest.php
    └── Services/
        └── AccountCreationServiceTest.php
```

**Rationale:** Feature tests validate user flows, unit tests validate individual methods

---

### 3. Format Patterns

#### API Response Formats

**Pattern:**
- **Framework:** Inertia.js (no REST API)
- **Shared Data:** Via `HandleInertiaRequests` middleware
- **Validation Errors:** Automatic via Inertia

**Example:**
```php
// app/Http/Middleware/HandleInertiaRequests.php
public function share(Request $request)
{
    return array_merge(parent::share($request), [
        'auth' => [
            'user' => $request->user(),
            'permissions' => $request->user()?->getAllPermissions(),
        ],
        'wedding' => fn() => $request->user()?->wedding,  // Lazy-loaded
        'flash' => [
            'success' => $request->session()->get('success'),
            'error' => $request->session()->get('error'),
        ],
    ]);
}
```

**Accessing in Vue:**
```javascript
const page = usePage();
const user = page.props.auth.user;
const wedding = page.props.wedding;
const flash = page.props.flash;
```

**Rationale:** Prevents N+1 queries, centralizes shared data

**Anti-Pattern:** ❌ Manual API calls for shared data

#### Data Exchange Formats

**Pattern:**
- **JSON Fields:** snake_case (Laravel default)
- **Dates:** ISO 8601 strings (e.g., `"2026-01-19T10:00:00Z"`)
- **Booleans:** `true`/`false` (not `1`/`0`)
- **Null:** Explicit `null` for missing values

**Examples:**
```json
{
  "id": 1,
  "wedding_date": "2026-06-15T14:00:00Z",
  "subdomain": "sarah-ahmad",
  "package_tier": "premium",
  "template_id": "modern-elegant",
  "created_at": "2026-01-19T10:30:00Z",
  "deleted_at": null
}
```

**Rationale:** Laravel's JSON serialization defaults, consistent with database naming

**Anti-Pattern:** ❌ camelCase JSON fields (`weddingDate`, `packageTier`)

---

### 4. Communication Patterns

#### Event System Patterns

**Pattern:**
- **Observers:** For model lifecycle events
- **Event Naming:** Past tense (e.g., `created`, `deleted`)
- **Usage:** Logging, notifications, cascading operations

**Example:**
```php
// app/Observers/WeddingObserver.php
class WeddingObserver
{
    public function created(Wedding $wedding)
    {
        Log::info('Wedding created', ['wedding_id' => $wedding->id]);
    }

    public function deleting(Wedding $wedding)
    {
        // Cascade delete before soft-delete
        $wedding->rsvps()->delete();
        $wedding->guestbook()->delete();
    }
}

// Register in AppServiceProvider
Wedding::observe(WeddingObserver::class);
```

**Rationale:** Keeps logic out of controllers, automatic execution

**Anti-Pattern:** ❌ Manual event dispatching in controllers

#### State Management Patterns

**Pattern:**
- **Local State:** Vue 3 `ref()` and `reactive()`
- **Global State:** Inertia.js shared data (no Pinia/Vuex)
- **Real-Time Updates:** Short polling (5s intervals)

**Example:**
```javascript
// Local state (most common)
const form = reactive({
    subdomain: '',
    wedding_date: '',
    venue: '',
});

// Global state via Inertia
const page = usePage();
const user = page.props.auth.user;
const wedding = page.props.wedding;

// Real-time polling
let pollingInterval = null;
onMounted(() => {
    pollingInterval = setInterval(fetchUpdates, 5000);  // Every 5s
});
onUnmounted(() => {
    clearInterval(pollingInterval);
});
```

**Rationale:** Simplicity, smaller bundle size, sufficient for JomNikah's needs

**Anti-Pattern:** ❌ Pinia/Vuex store (unnecessary complexity)

---

### 5. Process Patterns

#### Error Handling Patterns

**Pattern:**
- **Tone:** Kind, bilingual (English + Bahasa Malaysia)
- **Format:** Session flash messages with auto-dismiss
- **Validation Errors:** Automatic via Inertia

**Example:**
```php
// app/Http/Exceptions/Handler.php
public function render($request, Throwable $e)
{
    if ($e instanceof ValidationException) {
        return back()->with('error', 'Maaf, sila isi semua maklumat yang diperlukan.');
        // "Sorry, please fill in all required information."
    }

    if ($e instanceof AuthenticationException) {
        return redirect()->route('login')
            ->with('error', 'Sila log masuk untuk meneruskan.');
        // "Please log in to continue."
    }

    return back()->with('error', 'Maaf, ada masalah teknikal. Sila cuba lagi.');
    // "Sorry, there is a technical problem. Please try again."
}
```

**Vue Display:**
```vue
<template>
    <JCToast
        v-if="flash.error"
        :message="flash.error"
        type="error"
    />
</template>
```

**Rationale:** Cross-generational users need clear, warm error messages

**Anti-Pattern:** ❌ Technical jargon ("500 Internal Server Error", "Database query failed")

#### Loading State Patterns

**Pattern:**
- **Helper:** Inertia's `useForm` (handles loading, errors, redirects)
- **Naming:** `isProcessing` or generic `form.processing`
- **UI:** Loading spinners or disabled buttons

**Example:**
```vue
<script setup>
import { useForm } from '@inertiajs/vue3';

const form = useForm({
    subdomain: '',
    wedding_date: '',
    venue: '',
});

const submit = () => {
    form.put(route('couple.weddings.update', wedding.id), {
        onSuccess: () => {
            // Flash message handled automatically
        },
    });
};
</script>

<template>
    <form @submit.prevent="submit">
        <input v-model="form.subdomain" />
        <div v-if="form.errors.subdomain" class="text-red-500">
            {{ form.errors.subdomain }}
        </div>

        <button type="submit" :disabled="form.processing">
            {{ form.processing ? 'Saving...' : 'Save Changes' }}
        </button>
    </form>
</template>
```

**Rationale:** Inertia automatically handles loading state, no manual management needed

**Anti-Pattern:** ❌ Manual loading state with `isLoading` flags

---

### Enforcement Guidelines

#### All AI Agents MUST:

1. **Follow Laravel 12 Conventions**
   - PascalCase models, snake_case tables
   - Singular table names
   - Foreign keys: `{table}_id` format

2. **Use Vue 3 Composition API**
   - `<script setup>` syntax
   - `ref()` and `reactive()` for state
   - No Options API

3. **Organize Controllers by Role**
   - Admin/ (Super Admin only)
   - Couple/ (Authenticated couples)
   - Public/ (Unauthenticated guests)

4. **Implement Multi-Tenancy Correctly**
   - All queries scoped by `wedding_id`
   - Global scopes on models
   - Spatie Permissions for authorization

5. **Follow 3-Layer Component Architecture**
   - jc-base/ (UI primitives)
   - jc-interactive/ (Headless UI wrappers)
   - jc-wedding/ (Emotional components)

6. **Maintain Bilingual Error Messages**
   - English + Bahasa Malaysia
   - Warm, supportive tone
   - No technical jargon

7. **Use Inertia.js Helpers**
   - `useForm` for form handling
   - `usePage` for shared data
   - No manual API calls

#### Pattern Enforcement

**Verification:**
- Code reviews must check pattern compliance
- Automated tests should verify multi-tenant scoping
- Linting rules for naming conventions

**Documentation:**
- Pattern violations documented in code comments
- Architecture document is source of truth
- New patterns added via team discussion

**Updating Patterns:**
- Propose changes with rationale
- Test pattern changes in isolation
- Update architecture document before rollout

---

### Pattern Examples

#### Good Examples

**Database Migration:**
```php
// ✅ CORRECT: Singular table name, snake_case columns
Schema::create('rsvps', function (Blueprint $table) {
    $table->id();
    $table->foreignId('wedding_id')->constrained()->cascadeOnDelete();
    $table->string('guest_name');
    $table->string('phone')->nullable();
    $table->enum('status', ['confirmed', 'pending', 'declined'])->default('pending');
    $table->timestamps();

    $table->index('wedding_id');  // Performance
});
```

**Controller:**
```php
// ✅ CORRECT: Role-based organization, thin controller
// app/Http/Controllers/Couple/RsvpController.php
class RsvpController extends Controller
{
    public function index()
    {
        $rsvps = auth()->user()->wedding->rsvps()->latest()->paginate(20);
        return Inertia::render('Couple/Rsvps/Index', ['rsvps' => $rsvps]);
    }
}
```

**Vue Component:**
```vue
<!-- ✅ CORRECT: Composition API, script setup, jc- prefix -->
<!-- resources/js/components/jc-wedding/WeddingCurtain.vue -->
<script setup>
defineProps({
    coupleNames: { type: String, required: true },
});

const emit = defineEmits(['curtain-opened']);
</script>

<template>
    <div @click="emit('curtain-opened')">
        <h1>{{ coupleNames }}</h1>
        <p>Tap to Open Their Wedding Card</p>
    </div>
</template>
```

#### Anti-Patterns

**❌ WRONG: Plural table name**
```php
Schema::create('rsvp', function (Blueprint $table) {  // ❌ Should be 'rsvps'
    $table->id();
    $table->foreignId('weddingId')->constrained();  // ❌ Should be 'wedding_id'
    $table->string('guestName');  // ❌ Should be 'guest_name'
});
```

**❌ WRONG: Feature-based controller organization**
```php
// app/Http/Controllers/WeddingController.php
class WeddingController extends Controller
{
    public function create() { /* Admin logic */ }  // ❌ Conflicts with couple logic
    public function edit() { /* Couple logic */ }   // ❌ Should be in Couple/WeddingController
}
```

**❌ WRONG: No jc- prefix**
```vue
<!-- resources/js/components/Curtain.vue -->  <!-- ❌ Should be jc-wedding/WeddingCurtain.vue -->
<script setup>
// ❌ Missing descriptive name, conflicts with other curtains
</script>
```

---

**Step 5 Complete:** Implementation patterns and consistency rules documented.

---

## Project Structure & Boundaries

### Complete Project Directory Structure

```
jomnikah/
├── .env                                   # Environment configuration
├── .env.example                           # Environment template
├── .gitignore                             # Git ignore rules
├── artisan                                # Laravel command-line interface
├── composer.json                          # PHP dependencies
├── composer.lock                          # PHP dependency versions
├── package.json                           # NPM dependencies
├── phpunit.xml                            # PHPUnit configuration
├── psalm.xml                              # Psalm static analysis config
├── README.md                              # Project documentation
├── vite.config.js                         # Vite bundler configuration
├── tailwind.config.js                     # Tailwind CSS configuration
├── postcss.config.js                      # PostCSS configuration
├──
├── app/
│   ├── Actions/                           # Domain actions (single-purpose classes)
│   │   ├── DeleteExpiredWeddingData.php
│   │   └── SendCredentialsViaWhatsApp.php
│   │
│   ├── Console/
│   │   ├── Kernel.php                     # Artisan command scheduling
│   │   └── Commands/
│   │       └── DeleteExpiredWeddingData.php  # 6-month deletion job
│   │
│   ├── Events/                            # Domain events
│   │   ├── WeddingCreated.php
│   │   └── RsvpReceived.php
│   │
│   ├── Exceptions/
│   │   ├── Handler.php                    # Global exception handling
│   │   └── WeddingNotFoundException.php
│   │
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── Admin/                     # Super Admin dashboard
│   │   │   │   ├── DashboardController.php
│   │   │   │   ├── WeddingController.php
│   │   │   │   └── WeddingApprovalController.php
│   │   │   ├── Couple/                    # Couple dashboard
│   │   │   │   ├── DashboardController.php
│   │   │   │   ├── WeddingController.php
│   │   │   │   ├── RsvpController.php
│   │   │   │   ├── GuestbookController.php
│   │   │   │   ├── PresentController.php    # Premium feature
│   │   │   │   ├── AngPowController.php     # Premium feature
│   │   │   │   ├── PhotoController.php
│   │   │   │   └── UpgradeController.php
│   │   │   ├── Public/                    # Unauthenticated guests
│   │   │   │   └── WeddingCardController.php
│   │   │   └── Controller.php             # Base controller
│   │   │
│   │   ├── Middleware/
│   │   │   ├── Authenticate.php
│   │   │   ├── CheckSubdomain.php         # Wedding context middleware
│   │   │   ├── CheckPremiumFeature.php    # Feature gating
│   │   │   ├── HandleInertiaRequests.php  # Inertia shared data
│   │   │   ├── IsAdmin.php
│   │   │   └── IsCouple.php
│   │   │
│   │   └── Requests/
│   │       ├── Auth/
│   │       │   └── LoginRequest.php
│   │       ├── Couple/
│   │       │   ├── StoreWeddingRequest.php
│   │       │   ├── UpdateWeddingRequest.php
│   │       │   └── UploadPhotoRequest.php
│   │       └── Public/
│   │           └── StoreRsvpRequest.php
│   │
│   ├── Listeners/                         # Event listeners
│   │   ├── SendWeddingCreatedNotification.php
│   │   └── LogRsvpReceived.php
│   │
│   ├── Models/
│   │   ├── User.php                       # Spatie Roles
│   │   ├── Wedding.php                    # Multi-tenant root
│   │   ├── Rsvp.php
│   │   ├── Guestbook.php
│   │   ├── Present.php                    # Premium feature
│   │   ├── Photo.php
│   │   └── AngPow.php                     # Premium feature
│   │
│   ├── Observers/                         # Model lifecycle hooks
│   │   ├── WeddingObserver.php
│   │   └── RsvpObserver.php
│   │
│   ├── Providers/
│   │   ├── AppServiceProvider.php
│   │   └── AuthServiceProvider.php
│   │
│   └── Services/                          # Business logic
│       ├── AccountCreationService.php
│       ├── WeddingMemoryExporter.php
│       └── SubdomainValidationService.php
│
├── bootstrap/
│   ├── app.php                            # Application bootstrap
│   └── cache/                             # Framework cache
│
├── config/
│   ├── app.php                            # Application configuration
│   ├── auth.php                           # Authentication configuration
│   ├── database.php                       # Database configuration
│   ├── filesystems.php                    # File storage configuration
│   ├── inertia.php                        # Inertia.js configuration
│   ├── permissions.php                    # Spatie Permissions config
│   └── wedding.php                        # Wedding-specific config
│
├── database/
│   ├── migrations/
│   │   ├── 2024_01_01_000001_create_users_table.php
│   │   ├── 2024_01_01_000002_create_permissions_tables.php  # Spatie
│   │   ├── 2024_01_01_000003_create_weddings_table.php
│   │   ├── 2024_01_01_000004_create_rsvps_table.php
│   │   ├── 2024_01_01_000005_create_guestbook_table.php
│   │   ├── 2024_01_01_000006_create_presents_table.php
│   │   ├── 2024_01_01_000007_create_photos_table.php
│   │   └── 2024_01_01_000008_create_ang_pows_table.php
│   │
│   └── seeders/
│       ├── PermissionSeeder.php
│       ├── AdminSeeder.php
│       └── DemoWeddingSeeder.php
│
├── public/
│   ├── index.php                          # Application entry point
│   └── storage/                           # Symbolic link to storage/app/public
│
├── resources/
│   ├── css/
│   │   └── app.css                        # Tailwind CSS entry point
│   │
│   ├── js/
│   │   ├── app.js                         # Vue application entry point
│   │   ├── bootstrap.js                   # Laravel bootstrap
│   │   ├── components/
│   │   │   ├── jc-base/                   # Layer 1: Base UI components
│   │   │   │   ├── JCButton.vue
│   │   │   │   ├── JCInput.vue
│   │   │   │   ├── JCSelect.vue
│   │   │   │   ├── JCTextarea.vue
│   │   │   │   ├── JCCard.vue
│   │   │   │   └── JCBadge.vue
│   │   │   ├── jc-interactive/            # Layer 2: Headless UI wrappers
│   │   │   │   ├── JCModal.vue
│   │   │   │   ├── JCDropdown.vue
│   │   │   │   ├── JCDatePicker.vue
│   │   │   │   ├── JCToast.vue
│   │   │   │   └── JCConfirmationDialog.vue
│   │   │   └── jc-wedding/                # Layer 3: Emotional components
│   │   │       ├── WeddingCurtain.vue     # Curtain reveal animation
│   │   │       ├── CountdownTimer.vue     # Real-time countdown
│   │   │       ├── CelebrationConfetti.vue # Milestone celebrations
│   │   │       ├── PhotoGallery.vue       # Lazy-loading gallery
│   │   │       ├── RSVPButton.vue         # WhatsApp deep link
│   │   │       ├── GuestbookForm.vue
│   │   │       ├── WishPresentRegistry.vue  # Premium
│   │   │       └── DigitalAngPow.vue       # Premium
│   │   │
│   │   ├── layouts/
│   │   │   ├── AdminLayout.vue
│   │   │   ├── CoupleLayout.vue
│   │   │   ├── PublicLayout.vue
│   │   │   └── GuestLayout.vue
│   │   │
│   │   └── pages/
│   │       ├── admin/
│   │       │   ├── Dashboard.vue
│   │       │   ├── Weddings/
│   │       │   │   ├── Index.vue
│   │       │   │   ├── Create.vue
│   │       │   │   └── Edit.vue
│   │       │   └── Login.vue
│   │       ├── couple/
│   │       │   ├── Dashboard.vue
│   │       │   ├── Wedding/
│   │       │   │   ├── Edit.vue
│   │       │   │   ├── Details.vue
│   │       │   │   └── Photos.vue
│   │       │   ├── Rsvps/
│   │       │   │   ├── Index.vue
│   │       │   │   └── Show.vue
│   │       │   ├── Guestbook/
│   │       │   │   ├── Index.vue
│   │       │   │   └── Moderation.vue
│   │       │   ├── Presents/
│   │       │   │   ├── Index.vue
│   │       │   │   └── Create.vue
│   │       │   ├── AngPow/
│   │       │   │   ├── Index.vue
│   │       │   │   └── Create.vue
│   │       │   ├── Upgrade.vue
│   │       │   └── Settings.vue
│   │       └── public/
│   │           └── WeddingCard.vue       # Public wedding card display
│   │
│   └── views/
│       ├── emails/
│       │   └── credentials.blade.php
│       └── pdf/
│           └── memory-book.blade.php      # Guestbook export PDF
│
├── routes/
│   ├── api.php                            # API routes (not used, Inertia only)
│   ├── channels.php                       # Broadcasting channels (not used)
│   ├── console.php                        # Console routes
│   └── web.php                            # Web routes (Inertia)
│
├── storage/
│   ├── app/
│   │   └── public/
│   │       └── weddings/                  # Photo uploads per wedding
│   │           └── {wedding_id}/
│   │               ├── photo1.jpg
│   │               └── photo2.jpg
│   ├── exports/                           # PDF/Excel exports
│   │   └── {wedding_id}.pdf
│   ├── framework/
│   │   ├── cache/
│   │   ├── sessions/
│   │   └── views/
│   └── logs/
│       └── laravel.log
│
├── tests/
│   ├── Feature/
│   │   ├── Auth/
│   │   │   ├── LoginTest.php
│   │   │   └── LogoutTest.php
│   │   ├── Admin/
│   │   │   ├── WeddingCreationTest.php
│   │   │   └── DashboardAccessTest.php
│   │   ├── Couple/
│   │   │   ├── WeddingConfigurationTest.php
│   │   │   ├── RsvpManagementTest.php
│   │   │   ├── GuestbookModerationTest.php
│   │   │   └── PhotoUploadTest.php
│   │   ├── Public/
│   │   │   └── WeddingCardDisplayTest.php
│   │   └── MultiTenantIsolationTest.php  # Critical security test
│   │
│   └── Unit/
│       ├── Models/
│       │   ├── WeddingTest.php
│       │   ├── RsvpTest.php
│       │   └── GuestbookTest.php
│       └── Services/
│           ├── AccountCreationServiceTest.php
│           └── SubdomainValidationServiceTest.php
│
└── vendor/                                # Composer dependencies (gitignored)
```

---

### Architectural Boundaries

#### API Boundaries

**No REST API:** JomNikah uses Inertia.js (server-side routing, client-side rendering).

**Inertia.js Communication:**

```
┌─────────────────────────────────────────────────────┐
│ Inertia.js Request/Response Flow                   │
├─────────────────────────────────────────────────────┤
│ Frontend → Backend:                               │
│  1. User clicks link ("Navigate to Dashboard")    │
│  2. Inertia makes XHR request to Laravel route    │
│  3. Laravel auth + authorization middleware        │
│  4. Controller fetches data                       │
│  5. Inertia::render('Couple/Dashboard', $data)    │
│                                                     │
│ Backend → Frontend:                               │
│  6. Inertia returns JSON (props, page component)  │
│  7. Inertia.js swaps page component (no reload)   │
│  8. Vue component mounts with new props           │
└─────────────────────────────────────────────────────┘
```

**Route Boundaries:**

```php
// Admin routes (Super Admin only)
Route::middleware(['auth', 'role:super-admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
        Route::resource('weddings', WeddingController::class);
    });

// Couple routes (Authenticated couples)
Route::middleware(['auth', 'role:couple'])
    ->prefix('couple')
    ->name('couple.')
    ->group(function () {
        Route::resource('rsvps', RsvpController::class);
        Route::middleware(['can:access_wish_present_registry'])
            ->resource('presents', PresentController::class);
    });

// Public routes (Subdomain-based)
Route::domain('{subdomain}.jomnikah.com')
    ->group(function () {
        Route::get('/', [WeddingCardController::class, 'show']);
    });
```

#### Component Boundaries

**3-Layer Component Architecture:**

```
┌───────────────────────────────────────────────────────────┐
│ Layer 1: jc-base/ (Reusable UI Primitives)               │
│ ───────────────────────────────────────────────────────── │
│ Responsibility: Styling + Tailwind classes only           │
│ Props: variant (primary, secondary, ghost), size         │
│ Emits: click events                                      │
│ Dependencies: None (base layer)                          │
│                                                           │
│ Example: JCButton receives variant="primary"              │
│          → Returns <button class="bg-rose-500">          │
└───────────────────────────────────────────────────────────┘
                        ↓ uses
┌───────────────────────────────────────────────────────────┐
│ Layer 2: jc-interactive/ (Headless UI Wrappers)          │
│ ───────────────────────────────────────────────────────── │
│ Responsibility: ARIA, keyboard navigation, logic          │
│ Props: open, onClose, options, etc.                     │
│ Emits: close, select, change, etc.                       │
│ Dependencies: Headless UI (@headlessui/vue)              │
│                                                           │
│ Example: JCModal receives :open="isOpen"                 │
│          → Wraps Headless UI Dialog                      │
│          → Handles ESC key, focus trapping               │
└───────────────────────────────────────────────────────────┘
                        ↓ uses
┌───────────────────────────────────────────────────────────┐
│ Layer 3: jc-wedding/ (Emotional UX Components)           │
│ ───────────────────────────────────────────────────────── │
│ Responsibility: Wedding-specific logic, animations        │
│ Props: wedding, coupleNames, weddingDate                 │
│ Emits: curtain-opened, countdown-complete, etc.          │
│ Dependencies: jc-base, jc-interactive, business logic     │
│                                                           │
│ Example: WeddingCurtain loads couple data                │
│          → Displays curtain with animation               │
│          → On tap, emits @curtain-opened                 │
└───────────────────────────────────────────────────────────┘
```

**Component Communication Rules:**

- **Layer 3 can use Layer 2 and 1**
- **Layer 2 can use Layer 1**
- **Layer 1 cannot use higher layers** (prevents circular dependencies)
- **Props flow down** (parent → child)
- **Events flow up** (child → parent via `emit`)

#### Service Boundaries

**Service Layer Responsibilities:**

```php
// app/Services/AccountCreationService.php
class AccountCreationService
{
    // Boundary: Single-purpose operation (create couple account)
    // Input: Validated data array
    // Output: User model instance
    // Side Effects: Database transaction, role assignment, permissions grant
    // Dependencies: User model, Wedding model, Spatie Permissions

    public function createCoupleAccount(array $data, string $packageTier): User
    {
        return DB::transaction(function () use ($data, $packageTier) {
            // 1. Create user
            // 2. Assign role
            // 3. Create wedding
            // 4. Grant premium permissions (if applicable)
        });
    }
}
```

**Service Communication Rules:**

- **Services are stateless** (no persistent properties)
- **Services handle transactions** (atomic operations)
- **Services cannot access HTTP layer** (no Request/Response in services)
- **Controllers delegate to services** (thin controllers)
- **Services can call other services** (composition over inheritance)

#### Data Boundaries

**Multi-Tenancy Data Isolation:**

```
┌───────────────────────────────────────────────────────────┐
│ Database: jomnikah (Single Database, Tenant Isolation)   │
├───────────────────────────────────────────────────────────┤
│ Table: users                                             │
│  └─ id, name, email, password, role                     │
│                                                          │
│ Table: weddings (Tenant Root)                           │
│  ├─ id (PK)                                              │
│  ├─ user_id (FK → users.id)                             │
│  ├─ subdomain (UNIQUE: sarah-ahmad)                     │
│  └─ package_tier (standard/premium)                      │
│                                                          │
│ Table: rsvps (Tenant Data)                              │
│  ├─ id (PK)                                              │
│  ├─ wedding_id (FK → weddings.id) ← TENANT ISOLATION   │
│  ├─ guest_name                                           │
│  └─ status (confirmed/pending/declined)                  │
│                                                          │
│ Table: guestbook (Tenant Data)                          │
│  ├─ id (PK)                                              │
│  ├─ wedding_id (FK → weddings.id) ← TENANT ISOLATION   │
│  ├─ guest_name                                           │
│  └─ approved (boolean)                                   │
└───────────────────────────────────────────────────────────┘
```

**Data Access Rules:**

- **Global Scope on Models:** Automatic `wedding_id` scoping
- **Foreign Key Constraints:** ON DELETE CASCADE for related data
- **Queries Authenticated:** Spatie Permissions check ownership
- **No Cross-Tenant Queries:** Prevented by global scopes + gates

---

### Requirements to Structure Mapping

**Feature: Account & Package Management (FR-01 to FR-07)**

```
Location Breakdown:
├── Controllers: Admin/WeddingController.php
│   └─ Method: store() → Create couple account
├── Services: AccountCreationService.php
│   └─ Method: createCoupleAccount() → Transaction logic
├── Models: User.php (Spatie Roles), Wedding.php
├── Migrations: 2024_01_01_000001_create_users_table.php
│              2024_01_01_000003_create_weddings_table.php
├── Views (Inertia): resources/js/pages/admin/weddings/Create.vue
└── Routes: Route::prefix('admin')->resource('weddings')
```

**Feature: Wedding Card Configuration (FR-08 to FR-15)**

```
Location Breakdown:
├── Controllers: Couple/WeddingController.php
│   ├─ Method: edit() → Show configuration form
│   └─ Method: update() → Save wedding details
├── Middleware: CheckSubdomain.php
│   └─ Validates subdomain availability
├── Models: Wedding.php, Photo.php
├── Migrations: 2024_01_01_000006_create_photos_table.php
├── Components: jc-wedding/PhotoGallery.vue (upload, reorder)
├── Views (Inertia): resources/js/pages/couple/wedding/Edit.vue
└── Routes: Route::prefix('couple')->resource('weddings')
```

**Feature: Guest RSVP Management (FR-16 to FR-20)**

```
Location Breakdown:
├── Controllers: Public/WeddingCardController.php (display)
│              Couple/RsvpController.php (manage)
├── Models: Rsvp.php (global scope: wedding_id)
├── Migrations: 2024_01_01_000004_create_rsvps_table.php
├── Components: jc-wedding/RSVPButton.vue (WhatsApp deep link)
├── Views (Inertia): resources/js/pages/couple/rsvps/Index.vue
├── Routes: Route::domain('{subdomain}.jomnikah.com')
│              Route::prefix('couple')->resource('rsvps')
└── Real-Time: Polling every 5s (resources/js/pages/couple/Dashboard.vue)
```

**Feature: Premium - Wish Present Registry (FR-27 to FR-37)**

```
Location Breakdown:
├── Controllers: Couple/PresentController.php
│   └─ Middleware: can:access_wish_present_registry
├── Models: Present.php (wedding_id scoped)
├── Migrations: 2024_01_01_000006_create_presents_table.php
├── Components: jc-wedding/WishPresentRegistry.vue
│              Couple/UpgradePrompt.vue (locked state)
├── Views (Inertia): resources/js/pages/couple/presents/Index.vue
├── Routes: Route::middleware(['can:access_wish_present_registry'])
│              ->resource('presents')
└── Feature Lock: Spatie Permission 'access_wish_present_registry'
```

**Feature: Premium - Digital Ang Pow (FR-38 to FR-45)**

```
Location Breakdown:
├── Controllers: Couple/AngPowController.php
│   └─ Middleware: can:access_digital_ang_pow
├── Models: AngPow.php (wedding_id scoped, encrypted QR codes)
├── Migrations: 2024_01_01_000008_create_ang_pows_table.php
├── Components: jc-wedding/DigitalAngPow.vue
│              Couple/UpgradePrompt.vue (locked state)
├── Views (Inertia): resources/js/pages/couple/angpow/Index.vue
├── Routes: Route::middleware(['can:access_digital_ang_pow'])
│              ->resource('ang-pow')
└── Feature Lock: Spatie Permission 'access_digital_ang_pow'
```

**Feature: Data Lifecycle Management (FR-68 to FR-73, 6-Month Deletion)**

```
Location Breakdown:
├── Console Commands: app/Console/Commands/DeleteExpiredWeddingData.php
│   └─ Finds weddings where date + 6 months = today
│   └─ Cascade deletes RSVPs, guestbook, photos
│   └─ Soft deletes wedding record
├── Scheduler: app/Console/Kernel.php
│   └─ schedule:run daily at 03:00 UTC
├── Observers: WeddingObserver.php
│   └─ Method: deleting() → Cascade delete related data
├── Services: WeddingMemoryExporter.php
│   └─ Method: exportBeforeDeletion() → Generate PDF/Excel
└── Cron Job: * * * * * cd /path-to-jomnikah && php artisan schedule:run
```

---

### Integration Points

#### Internal Communication

**Component Communication (Vue 3):**

```javascript
// Parent → Child: Props
<WeddingCurtain
    :couple-names="wedding.bride_name + ' & ' + wedding.groom_name"
    :wedding-date="wedding.wedding_date"
/>

// Child → Parent: Events
const emit = defineEmits(['curtain-opened']);
emit('curtain-opened');

// Global State: Inertia Shared Data
const page = usePage();
const wedding = page.props.wedding;  // Available to all components
```

**Service Communication (Laravel):**

```php
// Controller → Service
public function store(StoreWeddingRequest $request)
{
    $wedding = $this->weddingService->createWedding(
        auth()->user(),
        $request->validated()
    );
    return redirect()->route('couple.dashboard');
}

// Service → Model
public function createWedding(User $user, array $data): Wedding
{
    return $user->wedding()->create($data);  // Eloquent relationship
}
```

#### External Integrations

**WhatsApp Integration (Deep Links):**

```
Integration Point: resources/js/components/jc-wedding/RSVPButton.vue
Method: window.open('https://wa.me/${phone}?text=${message}')
Flow:
  1. Guest clicks "RSVP via WhatsApp"
  2. JavaScript constructs WhatsApp URL
  3. Opens WhatsApp app (or web.whatsapp.com)
  4. Pre-fills message with guest name + RSVP
  5. Guest sends message to couple
  6. Couple receives in personal WhatsApp
```

**Email Integration (Future - Not Implemented):**

```
Planned Integration Point: app/Mail/WeddingCredentials.php
Trigger: Admin creates couple account
Method: Mail::to($user->email)->send(new WeddingCredentials($password))
Flow:
  1. Admin creates account via AccountCreationService
  2. Service fires WeddingCreated event
  3. SendWeddingCreatedNotification listener queues email
  4. Laravel Mailer sends email
  5. Couple receives credentials
Note: Currently using WhatsApp manual forwarding instead
```

**PDF Export (DomPDF):**

```
Integration Point: app/Services/WeddingMemoryExporter.php
Library: barryvdh/laravel-dompdf
Trigger: Couple clicks "Export Guestbook" before deletion
Method:
  1. Fetch wedding data (RSVPs, guestbook messages)
  2. Load Blade template (resources/views/pdf/memory-book.blade.php)
  3. Generate PDF using DomPDF
  4. Store in storage/exports/{wedding_id}.pdf
  5. Return download response
```

**Excel Export (FastExcel):**

```
Integration Point: app/Http/Controllers/Couple/RsvpController.php
Library: fastexcel/fastexcel
Trigger: Couple clicks "Export RSVPs"
Method:
  1. Fetch wedding RSVPs
  2. Format data for Excel
  3. Use FastExcel to generate XLSX
  4. Return download response
```

#### Data Flow

**Guest RSVP Flow:**

```
1. Guest opens wedding card (sarah-ahmad.jomnikah.com)
   └─ CheckSubdomain middleware extracts subdomain
   └─ Wedding model loaded via subdomain
   └─ Inertia::render('Public/WeddingCard', ['wedding' => $wedding])

2. Guest clicks "RSVP via WhatsApp"
   └─ RSVPButton.vue constructs WhatsApp URL
   └─ window.open('https://wa.me/60123456789?text=...')
   └─ WhatsApp app opens (external process)

3. Guest sends RSVP via WhatsApp (manual)
   └─ Couple receives message in personal WhatsApp
   └─ Couple manually records RSVP in JomNikah (optional)
   └─ Or: Guest uses web form (RSVPWebForm.vue)
       └─ POST to /weddings/{subdomain}/rsvp
       └─ RsvpController@store() validates and saves
       └─ Returns success via Inertia

4. Couple sees RSVP in dashboard
   └─ Couple/Dashboard.vue polls /api/couple/updates every 5s
   └─ CoupleDashboardController@updates returns latest RSVPs
   └─ Dashboard component updates UI reactively
```

**Wedding Setup Flow:**

```
1. Admin creates couple account
   └─ Admin/WeddingController@store() validates input
   └─ AccountCreationService@createCoupleAccount() executes transaction:
       ├─ Create user
       ├─ Assign 'couple' role (Spatie)
       ├─ Create wedding (with package_tier)
       └─ Grant premium permissions (if applicable)
   └─ Redirect to admin weddings index
   └─ Send credentials via WhatsApp (manual)

2. Couple logs in
   └─ POST /login (LoginRequest)
   └─ Auth::attempt() validates credentials
   └─ Session created
   └─ Redirect to couple dashboard

3. Couple configures wedding card
   └─ Couple/WeddingController@edit() shows form
   └─ Inertia::render('Couple/Wedding/Edit', ['wedding' => $wedding])
   └─ Couple fills subdomain, wedding_date, venue, template_id

4. Couple saves wedding details
   └─ PUT /couple/weddings/{wedding}
   └─ Couple/WeddingController@update() validates
   └─ Wedding model updated
   └─ Redirect back with success flash

5. Couple uploads photos
   └─ PhotoGallery.vue handles file upload
   └─ Client-side validation (<2MB check)
   └─ POST /couple/photos/upload
   └─ Couple/PhotoController@store() saves to storage/app/public/weddings/{wedding_id}/
   └─ Photo model created with path and display_order
   └─ Gallery updates reactively

6. Couple shares wedding card
   └─ Copy link: https://{subdomain}.jomnikah.com
   └─ Share via WhatsApp button (pre-filled message)
   └─ Guests receive link and can view card
```

---

### File Organization Patterns

#### Configuration Files

**Root Configuration:**

```
.env                    → Environment-specific settings (DB, APP_URL, etc.)
.env.example           → Template for .env (git-tracked)
composer.json          → PHP dependencies (laravel/framework, spatie/laravel-permission, etc.)
package.json           → NPM dependencies (vue, inertia, tailwindcss, etc.)
vite.config.js         → Vite bundler config (aliases, plugins, build output)
tailwind.config.js     → Tailwind theme (colors, fonts, breakpoints)
phpunit.xml            → PHPUnit test configuration
psalm.xml              → Static analysis configuration
```

**App Configuration:**

```
config/app.php          → Application name, timezone, locale
config/auth.php         → Authentication guards (web), providers
config/database.php     → MySQL connection settings
config/filesystems.php  → Storage disks (local, s3 for future)
config/inertia.php      → Inertia.js settings (SSR, version)
config/permissions.php  → Spatie Permissions configuration
config/wedding.php      → Wedding-specific settings (templates, package tiers)
```

#### Source Organization

**Laravel Backend Structure:**

```
app/
├── Actions/            → Single-purpose classes (DeleteExpiredWeddingData)
├── Console/            → Artisan commands (scheduled jobs)
├── Events/             → Domain events (WeddingCreated, RsvpReceived)
├── Exceptions/         → Custom exceptions (WeddingNotFoundException)
├── Http/
│   ├── Controllers/    → Role-based organization (Admin, Couple, Public)
│   ├── Middleware/     → Request processing (CheckSubdomain, CheckPremiumFeature)
│   └── Requests/       → Form request validation (StoreWeddingRequest)
├── Listeners/          → Event handlers (SendWeddingCreatedNotification)
├── Models/             → Eloquent models with relationships
├── Observers/          → Model lifecycle hooks (WeddingObserver)
├── Providers/          → Service providers (AppServiceProvider)
└── Services/           → Business logic (AccountCreationService)
```

**Vue Frontend Structure:**

```
resources/js/
├── components/
│   ├── jc-base/          → Base UI components (JCButton, JCInput)
│   ├── jc-interactive/   → Headless UI wrappers (JCModal, JCDropdown)
│   └── jc-wedding/       → Wedding-specific components (WeddingCurtain, PhotoGallery)
├── layouts/              → Page layouts (AdminLayout, CoupleLayout, PublicLayout)
└── pages/                → Inertia page components
    ├── admin/            → Admin dashboard pages
    ├── couple/           → Couple dashboard pages
    └── public/           → Public wedding card display
```

#### Test Organization

**Mirror Application Structure:**

```
tests/
├── Feature/              → End-to-end user flows
│   ├── Admin/
│   │   └── WeddingCreationTest.php  → Tests admin creates couple account
│   ├── Couple/
│   │   └── RsvpManagementTest.php   → Tests couple views RSVPs
│   └── MultiTenantIsolationTest.php → CRITICAL: Tests data isolation
└── Unit/                 → Individual method testing
    ├── Models/
    │   └── WeddingTest.php          → Tests model methods
    └── Services/
        └── AccountCreationServiceTest.php → Tests service logic
```

#### Asset Organization

**Public Assets:**

```
public/
├── index.php           → Application entry point
└── storage/            → Symbolic link to storage/app/public
    └── weddings/        → Photo uploads (per wedding)
        └── {wedding_id}/
            ├── photo1.jpg
            └── photo2.jpg
```

**Build Assets:**

```
resources/
├── css/
│   └── app.css         → Tailwind CSS entry point (@tailwind base; @tailwind components; @tailwind utilities)
└── js/
    ├── app.js          → Vue app entry point (createInertiaApp)
    └── components/     → Vue SFC components (.vue files)
```

**Vite Build Output:**

```
public/build/           → Vite-compiled assets (after npm run build)
├── assets/
│   ├── app-[hash].css   → Compiled Tailwind CSS
│   └── app-[hash].js    → Bundled Vue app
└── manifest.json       → Asset mapping for Laravel
```

---

### Development Workflow Integration

#### Development Server Structure

**Local Development (Laravel Herd):**

```
1. Install Laravel Herd (macOS) or Valet (Linux/Windows)
2. Clone repository: git clone https://github.com/...
3. Install dependencies:
   - composer install (PHP)
   - npm install (JavaScript)
4. Configure environment:
   - cp .env.example .env
   - php artisan key:generate
   - Configure database credentials in .env
5. Run migrations:
   - php artisan migrate
   - php artisan db:seed (permission seeder, admin seeder)
6. Start development server:
   - Herd: Automatically serves .test domains
   - Valet: valet park (serves current directory)
7. Run Vite dev server:
   - npm run dev (HMR enabled)
8. Access application:
   - https://jomnikah.test (local domain)
   - Login with admin credentials from seeder
```

**Subdomain Testing Locally:**

```
Method 1: Edit /etc/hosts
127.0.0.1 sarah-ahmad.jomnikah.test
127.0.0.1 john-jane.jomnikah.test

Method 2: Use Laravel Herd's automatic subdomain routing
- Access: https://{subdomain}.jomnikah.test
- Herd automatically routes wildcard subdomains to app
```

#### Build Process Structure

**Vite Build Pipeline:**

```
Development (npm run dev):
  1. Vite dev server starts (localhost:5173)
  2. Hot Module Replacement (HMR) enabled
  3. Tailwind JIT compiler generates CSS on-demand
  4. Vue components compiled in-memory (no disk write)
  5. Changes appear instantly in browser

Production (npm run build):
  1. Vite optimizes and minifies assets
  2. Tailwind generates purged CSS (only used classes)
  3. Vue components compiled to single JS bundle
  4. Assets written to public/build/
  5. manifest.json generated for Laravel asset versioning
  6. Laravel loads assets via {{ vite('resources/js/app.js') }}
```

**Asset Versioning:**

```
Development: No versioning (HMR)
Production: File hash-based versioning
  - app.js → app.abc123.js (hash from content)
  - app.css → app.def456.css
  - manifest.json maps original names to hashed names
  - Cache busting: Hash changes when content changes
```

#### Deployment Structure

**DigitalOcean Droplet Deployment:**

```
Server Setup:
1. Create droplet (Ubuntu 22.04 LTS, 4GB RAM, 2 vCPUs)
2. SSH into server: ssh root@droplet-ip
3. Install dependencies:
   - PHP 8.2+ (with FPM)
   - Composer
   - NPM/Node.js
   - Nginx
   - MySQL 8
   - Supervisor
   - Certbot (for SSL)

Application Deployment:
1. Clone repository: git clone https://github.com/... /var/www/jomnikah
2. Install dependencies:
   - composer install --optimize-autoloader --no-dev
   - npm ci && npm run build
3. Configure environment:
   - cp .env.example .env
   - php artisan key:generate
   - Edit .env (production database credentials, APP_URL=https://jomnikah.com)
4. Run migrations:
   - php artisan migrate --force
   - php artisan db:seed --force (permissions only)
5. Set permissions:
   - chown -R www-data:www-data /var/www/jomnikah
   - chmod -R 755 /var/www/jomnikah/storage
6. Configure storage link:
   - php artisan storage:link

Nginx Configuration:
/etc/nginx/sites-available/jomnikah.com:
  - Wildcard subdomain routing: server_name *.jomnikah.com jomnikah.com
  - Root: /var/www/jomnikah/public
  - PHP pass: unix:/var/run/php/php8.2-fpm.sock
  - SSL: Certbot certificate for *.jomnikah.com (wildcard SSL)
  - Static asset caching: location /storage/ { expires 1y; }

Supervisor Configuration:
/etc/supervisor/conf.d/jomnikah-worker.conf:
  - No queue workers needed (synchronous processing)
  - Only Laravel scheduler:
    [program:jomnikah-scheduler]
    command=php /var/www/jomnikah/artisan schedule:run
    autostart=true
    autorestart=true
    user=www-data

SSL Certificate:
- Certbot command: certbot certonly --nginx -d '*.jomnikah.com' -d 'jomnikah.com'
- Auto-renewal: Certbot manages via cron
- Wildcard SSL covers all subdomains (sarah-ahmad.jomnikah.com, etc.)

Monitoring:
- Laravel Logs: /var/www/jomnikah/storage/logs/laravel.log
- Nginx Logs: /var/log/nginx/jomnikah.access.log, error.log
- PHP-FPM Logs: /var/log/php8.2-fpm.log
- Manual review: Amirrul checks logs via SSH or file manager
```

**Backup Strategy:**

```
Automated Backups (Daily):
- Database: mysqldump -u root -p jomnikah > backup_$(date +%Y%m%d).sql
- Storage: rsync -avz /var/www/jomnikah/storage /backup/location/
- Retention: Keep 7 days, delete older backups
- Off-site: Upload to DigitalOcean Spaces or external drive

Manual Backup (Before major changes):
1. php artisan migrate:rollback --step=1  (if needed)
2. mysqldump full database
3. tar -czf jomnikah_backup_$(date +%Y%m%d).tar.gz /var/www/jomnikah
4. Download backup to local machine
```

---

**Step 6 Complete:** Project structure, architectural boundaries, and integration points documented.

---

## Architecture Validation Results

### Coherence Validation ✅

**Decision Compatibility:**

✅ **All technology choices work together without conflicts:**
- Laravel 12 + PHP 8.2+ → Compatible (Laravel 12 requires PHP 8.2+)
- Vue 3 + Inertia.js → Compatible (Inertia.js officially supports Vue 3)
- Tailwind CSS v4 → Compatible with Vite and Vue 3
- MySQL 8+ → Fully supported by Laravel 12
- Spatie Permissions → Compatible with Laravel 12 (v6.x branch)
- DigitalOcean droplets → Supports full stack (Nginx + PHP-FPM + MySQL)

✅ **Version compatibility verified:**
- Laravel 12.17.0 (latest June 2025)
- Vue 3.4+ (Composition API)
- Inertia.js latest via Laravel package
- No conflicting dependencies identified

✅ **No contradictory decisions found:**
- Synchronous processing aligns with "No Laravel Queues" constraint
- Single database multi-tenancy matches "100 weddings" scale requirement
- Manual infrastructure consistent with "solo developer" constraint
- WhatsApp deep links align with "no payment gateway" constraint

**Pattern Consistency:**

✅ **Implementation patterns support all architectural decisions:**
- Naming conventions (snake_case database, PascalCase models) → Laravel standards
- Role-based controller organization (Admin/Couple/Public) → Aligns with Spatie Permissions
- 3-layer component architecture (jc-base/jc-interactive/jc-wedding) → Supports emotional design
- Vue 3 Composition API with `<script setup>` → Matches Vue 3 best practices
- Inertia.js data passing → Consistent with "no REST API" decision

✅ **Naming conventions consistent:**
- Database: Singular tables (`weddings`, not `Wedding` or `tbl_weddings`)
- Foreign keys: `{table}_id` format (`wedding_id`, not `weddingId`)
- Routes: Dot notation (`admin.weddings.store`)
- Vue components: `jc-` prefix prevents conflicts
- All patterns follow Laravel and Vue 3 conventions

✅ **Communication patterns coherent:**
- State management: Local `ref()` + Inertia shared data (no Pinia needed)
- Real-time updates: Short polling (5s) matches synchronous processing
- Error handling: Bilingual messages (English + BM) support Malaysian context
- Props down, events up: Standard Vue 3 data flow

**Structure Alignment:**

✅ **Project structure supports all architectural decisions:**
- Role-based controllers (Admin/Couple/Public) → Enables multi-tenancy security
- Services layer → Keeps controllers thin, handles transactions
- Observers → Model lifecycle events (wedding deletion)
- Middleware → Cross-cutting concerns (subdomain validation, premium feature checks)
- 3-layer Vue components → Supports architectural separation of concerns

✅ **Boundaries properly defined:**
- API boundaries: Inertia.js only (no REST API)
- Component boundaries: 3-layer architecture (jc-base → jc-interactive → jc-wedding)
- Service boundaries: Stateless, transactional, no HTTP access
- Data boundaries: `wedding_id` foreign key scoping for multi-tenancy

✅ **Integration points properly structured:**
- WhatsApp deep links → RSVP flow (external process)
- DomPDF → Memory book exports (6-month deletion)
- FastExcel → RSVP/guestbook data export
- Vite build pipeline → Asset compilation for production

---

### Requirements Coverage Validation ✅

**Epic/Feature Coverage:**

✅ **All 10 FR categories fully architecturally supported:**

1. **Account & Package Management (7 FRs):**
   - Admin/WeddingController (account creation)
   - AccountCreationService (transaction logic)
   - Spatie Permissions (role assignment)
   - ✅ COMPLETE

2. **Wedding Card Configuration (8 FRs):**
   - Couple/WeddingController (CRUD operations)
   - CheckSubdomain middleware (availability validation)
   - Photo model + PhotoController (uploads)
   - ✅ COMPLETE

3. **Guest RSVP Management (5 FRs):**
   - Public/WeddingCardController (display)
   - RSVPButton.vue (WhatsApp deep link)
   - RsvpController (management)
   - Polling (real-time updates)
   - ✅ COMPLETE

4. **Guestbook & Wishes (7 FRs):**
   - GuestbookController (CRUD + moderation)
   - GuestbookForm.vue (submission)
   - Approval workflow (boolean `approved` field)
   - ✅ COMPLETE

5. **Premium - Wish Present Registry (11 FRs):**
   - PresentController (CRUD)
   - Spatie Permission `access_wish_present_registry` (feature locking)
   - UpgradePrompt.vue (upsell)
   - ✅ COMPLETE

6. **Premium - Digital Ang Pow (8 FRs):**
   - AngPowController (QR code management)
   - Spatie Permission `access_digital_ang_pow` (feature locking)
   - Encrypted storage for bank details
   - ✅ COMPLETE

7. **Public Wedding Card Display (7 FRs):**
   - Public/WeddingCardController (subdomain routing)
   - WeddingCurtain.vue (curtain animation)
   - CountdownTimer.vue (real-time countdown)
   - PhotoGallery.vue (lazy-loading)
   - ✅ COMPLETE

8. **Admin & Monitoring (8 FRs):**
   - Admin/DashboardController (overview)
   - Wedding model relationships (progress tracking)
   - Real-time updates (polling)
   - ✅ COMPLETE

9. **Data Management & Privacy (6 FRs):**
   - DeleteExpiredWeddingData command (6-month deletion)
   - Laravel Scheduler (daily cron job)
   - WeddingMemoryExporter (PDF/Excel before deletion)
   - ✅ COMPLETE

10. **Feature Locking & Upgrade (5 FRs):**
    - Spatie Permissions (granular feature access)
    - CheckPremiumFeature middleware (authorization)
    - UpgradeController (package tier upgrade)
    - ✅ COMPLETE

**Functional Requirements Coverage:**

✅ **All 75 FRs architecturally supported:**
- Multi-tenancy: Global scopes on models + Spatie Permissions
- Subdomain routing: CheckSubdomain middleware + wildcard Nginx config
- Template switching: Data preserved (no template hard-coding)
- Photo uploads: <2MB validation + local storage
- RSVP tracking: WhatsApp + web form + polling
- Premium features: Spatie Permission locking + upgrade flow
- Data lifecycle: Laravel Scheduler + soft deletes
- Real-time updates: Short polling (5s) + Inertia shared data
- Export: DomPDF (PDF) + FastExcel (XLSX)
- Admin monitoring: Dashboard + progress tracking

**Cross-Cutting FRs:**
- ✅ Multi-language support: Bilingual error messages (English + BM)
- ✅ Accessibility: Headless UI (ARIA, keyboard nav), 44×44px touch targets
- ✅ Mobile-first: Tailwind responsive design, <5s page load target
- ✅ Security: bcrypt/Argon2, HTTP-only cookies, Spatie Permissions

**Non-Functional Requirements Coverage:**

✅ **Performance (8 NFRs):**
- <5s page load on 4G (NFR-PERF-001): Lazy loading + Vite optimization
- <3s TTI on desktop (NFR-PERF-002): Code splitting + minimal JS
- <2s subdomain validation (NFR-PERF-004): Indexed queries
- 100 concurrent weddings (NFR-PERF-005): Single DB + efficient queries
- 50 concurrent guests (NFR-PERF-006): DigitalOcean 4GB droplet
- Real-time countdown (NFR-PERF-007): Client-side JavaScript
- RSVP reflection <5s (NFR-PERF-008): Short polling (5s intervals)
- Progressive lazy loading (NFR-PERF-003): Native lazy loading attribute

✅ **Security (17 NFRs):**
- bcrypt/Argon2 hashing (NFR-SEC-001): Laravel default
- HTTP-only cookies (NFR-SEC-002): Laravel session config
- Encrypted storage (NFR-SEC-003, NFR-SEC-004): Laravel encrypter
- Role-based auth (NFR-SEC-005, NFR-SEC-006, NFR-SEC-007): Spatie Permissions
- Feature-level auth (NFR-SEC-008): Spatie Permission checks
- Privacy Policy (NFR-SEC-009): Static page
- Implicit consent (NFR-SEC-010): Continued use = consent
- 6-month auto-deletion (NFR-SEC-011, NFR-SEC-012): Laravel Scheduler
- XSS prevention (NFR-SEC-013): Blade escaping + Inertia
- File upload validation (NFR-SEC-014): Client + server validation
- SQL injection prevention (NFR-SEC-015): Eloquent ORM
- HTTPS/TLS 1.2+ (NFR-SEC-016, NFR-SEC-017): Certbot SSL

✅ **Scalability (8 NFRs):**
- 100 active subdomains (NFR-SCALE-001): Single DB with `wedding_id` scoping
- 101 accounts (NFR-SCALE-002): 1 Super Admin + 100 Couple
- 500 RSVPs per wedding (NFR-SCALE-003): Optimized pagination
- 10,000 guestbook messages (NFR-SCALE-005): Efficient indexing
- 5,000 photos (NFR-SCALE-006): Local storage (5GB total)
- Manual droplet upgrade (NFR-SCALE-004): DigitalOcean flexibility
- <7s page loads during peak (NFR-SCALE-007): Caching + CDN-ready
- 20 simultaneous RSVPs (NFR-SCALE-008): Synchronous processing

✅ **Reliability (8 NFRs):**
- 95% uptime (NFR-REL-001): Manual server management
- Weekend restarts (NFR-REL-002): Low-traffic period maintenance
- No RSVP loss (NFR-REL-003): Database transactions
- Atomic guestbook saves (NFR-REL-004): Eloquent transactions
- Photo validation (NFR-REL-005): Client + server checks
- User-friendly errors (NFR-REL-006): Kind bilingual messages
- Error logging (NFR-REL-007): Laravel logging channels
- Frontend validation (NFR-REL-008): Inertia form validation

✅ **Usability (8 NFRs):**
- Mobile-first (NFR-USE-001): Tailwind responsive breakpoints
- 44×44px touch targets (NFR-USE-002): Tailwind spacing utilities
- 16px minimum fonts (NFR-USE-003): Tailwind typography scale
- Clear error messages (NFR-USE-004): Bilingual, warm tone
- Immediate validation (NFR-USE-005): Real-time feedback
- Visible upgrade prompts (NFR-USE-006): UpgradePrompt component
- <1 hour setup (NFR-USE-007): Progressive disclosure wizard
- <5 min account creation (NFR-USE-008): Admin form optimization

---

### Implementation Readiness Validation ✅

**Decision Completeness:**

✅ **All critical decisions documented with versions:**
- Technology stack: Laravel 12.17.0, Vue 3.4+, Inertia.js latest, MySQL 8+
- Infrastructure: DigitalOcean droplets, Nginx, PHP-FPM, Supervisor
- Multi-tenancy: Single DB + `wedding_id` scoping + Spatie Permissions
- Feature locking: Spatie Permission system + package tiers
- Data lifecycle: 6-month deletion via Laravel Scheduler
- Real-time updates: Short polling (5s) + optimistic UI
- Frontend state: Vue 3 `ref()` + Inertia shared data (no Pinia)
- Component architecture: 3-layer system (jc-base/jc-interactive/jc-wedding)
- Photo storage: Local storage + <2MB validation
- WhatsApp: Deep links (no API)
- Export: DomPDF + FastExcel

✅ **Implementation patterns comprehensive:**
- 38 potential conflict points identified and addressed
- Naming conventions: Database (snake_case), Models (PascalCase), Controllers (role-based)
- Structure patterns: Controller organization, Vue component layers, services location
- Format patterns: Inertia.js data passing, validation errors, JSON field naming
- Communication patterns: State management, event naming, service boundaries
- Process patterns: Bilingual error handling, loading states (useForm), validation timing

✅ **Consistency rules clear and enforceable:**
- All AI agents MUST follow 7 enforcement rules
- Pattern examples provided (good vs anti-patterns)
- Verification methods documented (code reviews, linting, automated tests)
- Documentation hierarchy: Architecture document → source of truth

✅ **Examples provided for major patterns:**
- Database migration: Singular table names, snake_case columns
- Controller: Role-based organization, thin delegation to services
- Vue component: Composition API, `<script setup>`, jc- prefix
- Anti-patterns shown for each category

**Structure Completeness:**

✅ **Project structure complete and specific:**
- Complete directory tree from root to vendor/
- All files named with specific paths
- Configuration files identified (`.env`, `composer.json`, `package.json`, etc.)
- Controllers organized by role (Admin/, Couple/, Public/)
- Vue components organized by layer (jc-base/, jc-interactive/, jc-wedding/)
- Migrations listed with timestamps
- Test structure mirrors application

✅ **Integration points clearly specified:**
- Internal: Component communication (props/events), service calls
- External: WhatsApp deep links, PDF export, Excel export
- Data flow: Guest RSVP flow, Wedding setup flow
- Boundaries: API (Inertia only), Component (3-layer), Service (stateless), Data (wedding_id scoping)

✅ **Component boundaries well-defined:**
- Layer 1 (jc-base): Styling only, no dependencies
- Layer 2 (jc-interactive): Headless UI wrappers, ARIA
- Layer 3 (jc-wedding): Emotional UX, business logic
- Communication rules: Props down, events up (no circular dependencies)

**Pattern Completeness:**

✅ **All potential conflict points addressed:**
- Naming: 12 areas (tables, columns, models, controllers, components, routes)
- Structure: 8 areas (controllers, Vue components, services, tests)
- Format: 7 areas (API responses, JSON fields, dates, booleans)
- Communication: 6 areas (events, state management, props/emits)
- Process: 5 areas (errors, loading, auth, validation, multi-tenancy)

✅ **Naming conventions comprehensive:**
- Database: Singular tables, snake_case columns, `{table}_id` foreign keys
- Models: PascalCase, singular, matching table names
- Controllers: Role-based organization (Admin/Couple/Public)
- Vue: `jc-` prefix, PascalCase, 3-layer architecture
- Routes: Dot notation (`admin.weddings.store`)

✅ **Communication patterns fully specified:**
- State management: Local `ref()` + Inertia shared data
- Events: Observers for model lifecycle, past tense naming
- Props/emits: Kebab-case events, explicit definitions
- Real-time: 5-second polling, optimistic UI

✅ **Process patterns complete:**
- Error handling: Bilingual (English + BM), warm tone, flash messages
- Loading states: Inertia `useForm` helper, `form.processing` flag
- Authentication: Spatie Permissions, role-based middleware
- Validation: Frontend + backend, real-time feedback
- Multi-tenancy: Global scopes, foreign key constraints

---

### Gap Analysis Results

**Critical Gaps:** NONE ✅

All essential architectural elements are documented:
- Technology stack fully specified with versions
- Multi-tenancy strategy complete (security + scalability)
- Feature locking mechanism defined (Spatie Permissions)
- Data lifecycle management detailed (6-month deletion)
- Real-time updates approach specified (polling)
- Project structure complete (all files/directories)
- Implementation patterns comprehensive (38 conflict points addressed)

**Important Gaps:** NONE ✅

All significant areas covered:
- Deployment strategy documented (DigitalOcean + Nginx)
- Backup strategy specified (daily automated + manual)
- Development workflow detailed (Laravel Herd + Vite)
- Testing structure defined (mirror application)
- Monitoring approach clarified (manual log review)
- Security measures comprehensive (17 NFRs covered)

**Nice-to-Have Gaps:** MINOR ✅

Optional enhancements for future consideration:
1. **Automated Testing Strategy:** Critical path tests defined but test execution plan not detailed
   - **Impact:** Low - manual testing sufficient for solo developer
   - **Future:** CI/CD pipeline when team grows

2. **Performance Monitoring:** No APM solution specified (e.g., Laravel Telescope)
   - **Impact:** Low - manual log review sufficient for 100 weddings
   - **Future:** Add Telescope if performance issues arise

3. **Caching Strategy:** No Redis/caching layer specified (MySQL query cache mentioned)
   - **Impact:** Low - synchronous processing, 100 weddings scale manageable
   - **Future:** Add Redis if >1000 weddings

4. **Email Templates:** Email integration not implemented (using WhatsApp manual forwarding)
   - **Impact:** None - intentional decision based on Malaysian context
   - **Future:** Optional enhancement if couples prefer email

5. **API Rate Limiting:** Not specified (no public API, only Inertia.js)
   - **Impact:** None - Inertia.js has built-in CSRF protection
   - **Future:** Add if public API endpoints added

---

### Validation Issues Addressed

**No critical issues found.** ✅

All architectural decisions are:
- Coherent (work together without conflicts)
- Complete (all requirements supported)
- Implementable (patterns clear and consistent)
- Scalable (matches 100-wedding target)
- Secure (multi-tenancy properly isolated)
- Performant (meets all NFRs)

**Minor refinements made during documentation:**
1. Clarified 3-layer component architecture with communication rules
2. Added anti-pattern examples for clarity
3. Detailed data flow diagrams (Guest RSVP, Wedding Setup)
4. Specified deployment steps for DigitalOcean
5. Added backup strategy (automated + manual)

---

### Architecture Completeness Checklist

**✅ Requirements Analysis**

- [x] Project context thoroughly analyzed (75 FRs, 49 NFRs identified)
- [x] Scale and complexity assessed (100 weddings, Medium-High complexity)
- [x] Technical constraints identified (manual infrastructure, no queues, no payment gateway)
- [x] Cross-cutting concerns mapped (security, performance, data privacy, multi-tenancy)

**✅ Architectural Decisions**

- [x] Critical decisions documented with versions (multi-tenancy, feature locking, data lifecycle)
- [x] Technology stack fully specified (Laravel 12.17.0, Vue 3.4+, MySQL 8+)
- [x] Integration patterns defined (Inertia.js, WhatsApp deep links, PDF/Excel export)
- [x] Performance considerations addressed (<5s page load, <3s TTI, lazy loading)

**✅ Implementation Patterns**

- [x] Naming conventions established (snake_case DB, PascalCase models, jc- prefix)
- [x] Structure patterns defined (role-based controllers, 3-layer Vue components)
- [x] Communication patterns specified (props down, events up, Inertia shared data)
- [x] Process patterns documented (bilingual errors, useForm loading, global scopes)

**✅ Project Structure**

- [x] Complete directory structure defined (root to vendor/, all files named)
- [x] Component boundaries established (3-layer architecture with communication rules)
- [x] Integration points mapped (WhatsApp, DomPDF, FastExcel, Nginx wildcard subdomain)
- [x] Requirements to structure mapping complete (10 FR categories → specific files)

---

### Architecture Readiness Assessment

**Overall Status:** ✅ **READY FOR IMPLEMENTATION**

**Confidence Level:** **HIGH**

**Validation Summary:**
- ✅ All decisions coherent and compatible
- ✅ All 75 FRs + 49 NFRs architecturally supported
- ✅ Implementation patterns comprehensive (38 conflict points addressed)
- ✅ Project structure complete (all files/directories defined)
- ✅ No critical gaps identified
- ✅ Documentation sufficient for AI agent consistency

**Key Strengths:**

1. **Multi-Tenancy Security:** Global scopes + Spatie Permissions prevent data leaks
2. **Performance Optimization:** Meets all 8 performance NFRs (<5s page load, lazy loading)
3. **Scalability:** Single DB architecture supports 100 weddings with room for growth
4. **Compliance:** 6-month auto-deletion (PDPA), bilingual support (Malaysian context)
5. **Developer Experience:** Clear patterns, comprehensive examples, solo-developer friendly
6. **Emotional Design:** 3-layer component system enables "Masya Allah, cantiknya!" moments
7. **Operational Simplicity:** No queues (synchronous processing), manual infrastructure control

**Areas for Future Enhancement:**

1. **Automated Testing:** Add CI/CD pipeline when team grows beyond solo developer
2. **APM Monitoring:** Consider Laravel Telescope if performance issues arise at scale
3. **Caching Layer:** Add Redis if scaling beyond 1000 weddings
4. **Email Integration:** Optional enhancement if couples prefer email over WhatsApp
5. **Public API:** Consider REST API if third-party integrations needed

---

### Implementation Handoff

**AI Agent Guidelines:**

1. **Follow Architectural Decisions Exactly:**
   - Use Laravel 12.17.0 (not older versions)
   - Implement multi-tenancy with `wedding_id` global scopes (CRITICAL for security)
   - Use Spatie Permissions for all authorization (no hardcoded role checks)
   - Follow 3-layer component architecture (jc-base → jc-interactive → jc-wedding)

2. **Use Implementation Patterns Consistently:**
   - Naming: Singular tables, snake_case columns, PascalCase models
   - Controllers: Organize by role (Admin/Couple/Public)
   - Vue components: Use `jc-` prefix, `<script setup>` syntax
   - State management: Local `ref()` + Inertia shared data (NO Pinia/Vuex)
   - Error messages: Bilingual (English + Bahasa Malaysia), warm tone

3. **Respect Project Structure and Boundaries:**
   - Controllers in role-based folders (app/Http/Controllers/Admin/)
   - Vue components in layer folders (resources/js/components/jc-base/)
   - Services for business logic (app/Services/)
   - Tests mirror application structure (tests/Feature/Admin/)

4. **Refer to This Document for All Questions:**
   - Stack decisions → Section "Starter Template Evaluation"
   - Multi-tenancy implementation → Section "Critical Decisions 2.1"
   - Feature locking → Section "Critical Decisions 2.2"
   - Data lifecycle → Section "Critical Decisions 2.3"
   - Component architecture → Section "Important Decisions 3.2"
   - Project structure → Section "Project Structure & Boundaries"

**First Implementation Priority:**

Since JomNikah is **already complete**, the architecture document serves as:

1. **Architectural Record:** Documents decisions made during development
2. **Onboarding Reference:** For any additional developers joining the project
3. **Maintenance Guide:** For solo developer to recall architectural decisions
4. **AI Agent Consistency:** Ensures all future AI agents follow established patterns

**For New Development or Refactoring:**

1. **Review PRD:** (_bmad-output/planning-artifacts/prd.md) - Understand feature requirements
2. **Check Architecture:** This document - Ensure architectural alignment
3. **Follow Patterns:** Implementation Patterns section - Maintain consistency
4. **Respect Structure:** Project Structure section - Place files in correct locations
5. **Validate Decisions:** Cross-check against NFRs (performance, security, scalability)

---

**Step 7 Complete:** Comprehensive architecture validation performed, all requirements verified, implementation readiness confirmed.

---

## Architecture Completion Summary

### Workflow Completion

**Architecture Decision Workflow:** COMPLETED ✅
**Total Steps Completed:** 8
**Date Completed:** 2026-01-19
**Document Location:** `_bmad-output/planning-artifacts/architecture.md`

---

### Final Architecture Deliverables

**📋 Complete Architecture Document**

- All architectural decisions documented with specific versions
- Implementation patterns ensuring AI agent consistency
- Complete project structure with all files and directories
- Requirements to architecture mapping
- Validation confirming coherence and completeness

**🏗️ Implementation Ready Foundation**

- **14 architectural decisions** made (4 already decided + 4 critical + 4 important + 2 nice-to-have)
- **38 implementation patterns** defined (naming, structure, format, communication, process)
- **8 architectural components** specified (Admin, Couple, Public, 3-layer Vue components, Services, etc.)
- **75 FRs + 49 NFRs** fully supported and validated

**📚 AI Agent Implementation Guide**

- Technology stack with verified versions (Laravel 12.17.0, Vue 3.4+, MySQL 8+)
- Consistency rules that prevent implementation conflicts (7 enforcement rules)
- Project structure with clear boundaries (role-based controllers, 3-layer components)
- Integration patterns and communication standards (Inertia.js, WhatsApp, DomPDF, FastExcel)

---

### Implementation Handoff

**For AI Agents:**

This architecture document is your complete guide for implementing JomNikah. Follow all decisions, patterns, and structures exactly as documented.

**Key Sections to Reference:**

1. **Technology Stack:** Section "Starter Template Evaluation"
   - Laravel 12.17.0 (not older versions)
   - Vue 3.4+ Composition API with `<script setup>`
   - MySQL 8+ with InnoDB engine

2. **Critical Architectural Decisions:**
   - Multi-tenancy: Section "Critical Decisions 2.1" (wedding_id global scopes)
   - Feature locking: Section "Critical Decisions 2.2" (Spatie Permissions)
   - Data lifecycle: Section "Critical Decisions 2.3" (6-month Laravel Scheduler)
   - Real-time updates: Section "Critical Decisions 2.4" (5s polling + optimistic UI)

3. **Implementation Patterns:**
   - Naming conventions: Section "Implementation Patterns 1"
   - Structure patterns: Section "Implementation Patterns 2"
   - Format patterns: Section "Implementation Patterns 3"
   - Communication patterns: Section "Implementation Patterns 4"
   - Process patterns: Section "Implementation Patterns 5"

4. **Project Structure:**
   - Complete directory tree: Section "Project Structure & Boundaries"
   - Component boundaries: 3-layer architecture (jc-base → jc-interactive → jc-wedding)
   - Integration points: WhatsApp, DomPDF, FastExcel, Nginx wildcard subdomain

**Development Sequence:**

Since JomNikah is **already complete**, this architecture serves as:

1. **Architectural Record:** Documents all decisions made during development
2. **Onboarding Reference:** For any additional developers joining the project
3. **Maintenance Guide:** For solo developer to recall architectural decisions
4. **AI Agent Consistency:** Ensures all future AI agents follow established patterns

**For New Development or Refactoring:**

1. Review PRD (`_bmad-output/planning-artifacts/prd.md`) - Understand feature requirements
2. Check Architecture (this document) - Ensure architectural alignment
3. Follow Implementation Patterns - Maintain consistency (38 conflict points addressed)
4. Respect Project Structure - Place files in correct locations (role-based organization)
5. Validate Decisions - Cross-check against NFRs (performance, security, scalability)

---

### Quality Assurance Checklist

**✅ Architecture Coherence**

- [x] All decisions work together without conflicts
- [x] Technology choices are compatible (Laravel 12 + PHP 8.2+ + Vue 3.4+)
- [x] Patterns support the architectural decisions
- [x] Structure aligns with all choices (role-based controllers, 3-layer components)

**✅ Requirements Coverage**

- [x] All 75 functional requirements are supported (10 FR categories mapped)
- [x] All 49 non-functional requirements are addressed (Performance, Security, Scalability, Reliability, Usability)
- [x] Cross-cutting concerns are handled (multi-language, accessibility, mobile-first, security)
- [x] Integration points are defined (WhatsApp, DomPDF, FastExcel, Nginx)

**✅ Implementation Readiness**

- [x] Decisions are specific and actionable (versions documented with rationale)
- [x] Patterns prevent agent conflicts (38 conflict points + 7 enforcement rules)
- [x] Structure is complete and unambiguous (all files/directories defined)
- [x] Examples are provided for clarity (good patterns vs anti-patterns)

---

### Project Success Factors

**🎯 Clear Decision Framework**

Every technology choice was documented with clear rationale:
- **Why Laravel 12?** Monolithic SPA without API complexity
- **Why Vue 3 + Inertia.js?** No REST API needed, reactive state for countdown/RSVP
- **Why single DB multi-tenancy?** 100 weddings scale, simpler than separate databases
- **Why Spatie Permissions?** Granular feature locking (Standard vs Premium)
- **Why manual infrastructure?** Solo developer prefers full control, no SaaS lock-in

**🔧 Consistency Guarantee**

Implementation patterns and rules ensure that multiple AI agents produce compatible code:
- 38 potential conflict points identified and addressed
- 7 enforcement rules all AI agents MUST follow
- Pattern examples: Good patterns vs anti-patterns for each category
- Verification methods: Code reviews, linting, automated tests

**📋 Complete Coverage**

All project requirements are architecturally supported:
- 10 FR categories mapped to specific files/directories
- 49 NFRs aligned with architectural decisions
- Cross-cutting concerns: Multi-language (English + BM), accessibility (ARIA, keyboard nav), mobile-first (<5s on 4G)
- Integration points: WhatsApp deep links, PDF/Excel export, Nginx wildcard subdomain routing

**🏗️ Solid Foundation**

The chosen architecture provides a production-ready foundation:
- Laravel 12 (latest June 2025) with modern PHP 8.2+ features
- Vue 3 Composition API with `<script setup>` (current best practice)
- Multi-tenancy security via global scopes + Spatie Permissions (prevents data leaks)
- Performance optimization meets all NFRs (<5s page load, <3s TTI, lazy loading)
- Solo-developer friendly (manual infrastructure, synchronous processing, no queues)

---

### Architecture Highlights

**🔐 Security First:**

- Multi-tenancy: Global scopes on all models prevent cross-tenant data leaks
- Authorization: Spatie Permissions for role-based + feature-level access control
- Data privacy: 6-month automated deletion (PDPA compliance)
- Encryption: Laravel encrypter for sensitive data (Ang Pow bank details)
- HTTPS: Certbot wildcard SSL for all subdomains (*.jomnikah.com)

**⚡ Performance Optimized:**

- Lazy loading: Progressive image load, <5s page load on 4G
- Real-time updates: 5-second polling + optimistic UI (no WebSockets complexity)
- Efficient queries: Indexed foreign keys, Eloquent relationship loading
- Asset optimization: Vite build pipeline, Tailwind JIT compilation
- Caching: Nginx static asset caching (1 year for photos)

**🌱 Malaysian Context:**

- Bilingual error messages (English + Bahasa Malaysia)
- WhatsApp integration (preferred Malaysian communication channel)
- Cross-generational UX (elderly guests, 44×44px touch targets)
- Emotional design ("Masya Allah, cantiknya!" curtain reveal moments)
- Cultural compliance (PDPA, Malay wedding traditions)

**🎨 Emotional Design System:**

- 3-layer component architecture: jc-base (UI) → jc-interactive (accessibility) → jc-wedding (emotional UX)
- Curtain reveal animation: Creates "Masya Allah, cantiknya!" defining experience
- Celebration milestones: Confetti at 100% setup, progress celebrations (20% → 40% → 70% → 90% → 100%)
- Warm tone: Kind error messages, supportive copy ("You're doing great!")

**📊 Scalability Path:**

- Current: 100 weddings (validation phase)
- Architecture: Single DB with `wedding_id` scoping supports 1000+ weddings
- Upgrade path: Manual droplet upgrade (DigitalOcean flexibility)
- Future enhancements: Redis caching (if >1000 weddings), CI/CD (if team grows), public API (if third-party integrations)

---

**Architecture Status:** ✅ **READY FOR IMPLEMENTATION**

**Next Phase:**
- Since JomNikah is **already complete**, this architecture serves as documentation and reference
- For new development: Follow architectural decisions and implementation patterns
- For refactoring: Maintain consistency with documented patterns and structure
- For AI agents: Read this document before implementing any changes

**Document Maintenance:**
Update this architecture when major technical decisions are made during future development:
1. Add new architectural decisions to Section "Core Architectural Decisions"
2. Update implementation patterns if new conflict points emerge
3. Expand project structure if new modules/components are added
4. Re-validate coherence after significant changes

---

**🎉 Architecture Workflow Complete!**

Your architecture for JomNikah is comprehensive, validated, and ready to guide all future development work.

**✅ What's been delivered:**

- Complete architecture document with all decisions, patterns, and structure
- Project structure documented (all files and directories)
- Validation confirming everything works together coherently
- Implementation guidance for AI agents and developers

**📍 Where to find it:**
`_bmad-output/planning-artifacts/architecture.md`

**🚀 What's next:**

1. **Review your complete architecture document** - All 8 steps completed
2. **Use as reference** - For new development, refactoring, or AI agent collaboration
3. **Maintain consistency** - Follow implementation patterns and architectural decisions
4. **Update as needed** - Document major technical decisions as they arise

**💡 Optional Enhancement: Project Context File**

Would you like to create a `project-context.md` file? This is a concise, optimized guide for AI agents that captures:

- Critical language and framework rules they might miss
- Specific patterns and conventions for your project
- Testing and code quality requirements
- Anti-patterns and edge cases to avoid

This file helps ensure AI agents implement code consistently with your project's unique requirements and patterns.

**Create project context?** [Y/N]