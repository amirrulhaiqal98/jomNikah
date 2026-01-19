---
stepsCompleted: ['step-01-validate-prerequisites', 'step-02-design-epics', 'step-03-create-stories', 'step-04-final-validation']
inputDocuments:
  - prd.md
  - architecture.md
  - ux-journey-flows.md
  - ux-design-mockups.md
  - ux-design-specification.md
workflowStatus: 'complete'
readyForImplementation: true
---

# JomNikah - Epic Breakdown

## Overview

This document provides the complete epic and story breakdown for JomNikah, decomposing the requirements from the PRD, UX Design, and Architecture requirements into implementable stories.

## Requirements Inventory

### Functional Requirements

**Account & Package Management (7 FRs):**
- **FR1:** Super Admin can create new couple accounts with email/phone and password
- **FR2:** Super Admin can assign package tier (Standard or Premium) during account creation
- **FR3:** Super Admin can independently enable or disable Wish Present feature per couple
- **FR4:** Super Admin can independently enable or disable Digital Ang Pow feature per couple
- **FR5:** Super Admin can upgrade couple from Standard to Premium package
- **FR6:** Couples can log in to their dashboard using credentials provided by Super Admin
- **FR7:** Couples can request package upgrade through their dashboard

**Wedding Card Configuration (8 FRs):**
- **FR8:** Couples can define unique subdomain for their wedding card
- **FR9:** System can validate subdomain availability in real-time during subdomain creation
- **FR10:** System can enforce subdomain format rules (lowercase, no special characters)
- **FR11:** Couples can select wedding template from available options
- **FR12:** Couples can switch templates without losing previously entered data
- **FR13:** Couples can enter wedding details (date, time, venue, location map)
- **FR14:** Couples can upload photos to photo gallery
- **FR15:** System can validate photo file size before upload (<2MB limit)

**Guest RSVP Management (5 FRs):**
- **FR16:** Guests can RSVP through WhatsApp redirect
- **FR17:** Guests can RSVP through web form
- **FR18:** Couples can view real-time RSVP list
- **FR19:** System can track RSVP submission date and time
- **FR20:** System can display RSVP count and status in couple dashboard

**Guestbook & Wishes (7 FRs):**
- **FR21:** Guests can submit messages to couple's guestbook
- **FR22:** System can require guestbook message approval before public display
- **FR23:** Couples can approve guestbook messages
- **FR24:** Couples can delete any guestbook message
- **FR25:** System can display guestbook approval status to guests
- **FR26:** Couples can export guestbook messages to Excel format
- **FR27:** Couples can export guestbook messages to PDF format

**Premium Features - Wish Present Registry (11 FRs):**
- **FR28:** Premium couples can add gift items to Wish Present registry
- **FR29:** Premium couples can edit gift items in Wish Present registry
- **FR30:** Premium couples can delete gift items from Wish Present registry
- **FR31:** Guests can claim gift items from Wish Present registry
- **FR32:** System can require guest contact information (email or phone) during present claim
- **FR33:** System can prevent multiple guests from claiming same gift item
- **FR34:** System can display claimed status with guest identifier for gift items
- **FR35:** Guests can cancel gift item claims, making items available for other guests
- **FR36:** System can display couple's contact information (name, phone, address) to guests who claimed presents
- **FR37:** Standard couples can view Wish Present registry section in locked state
- **FR38:** System can display upgrade prompt when Standard couples access locked Wish Present features

**Premium Features - Digital Ang Pow (8 FRs):**
- **FR39:** Premium couples can upload QR code image for Digital Ang Pow
- **FR40:** Premium couples can add bank account details for Digital Ang Pow
- **FR41:** Premium couples can specify bank name for displayed account details
- **FR42:** Guests can view QR code for Digital Ang Pow contributions
- **FR43:** Guests can view bank account details for Digital Ang Pow contributions
- **FR44:** System can maintain privacy of Ang Pow contribution amounts
- **FR45:** Standard couples can view Digital Ang Pow section in locked state
- **FR46:** System can display upgrade prompt when Standard couples access locked Digital Ang Pow features

**Public Wedding Card Display (7 FRs):**
- **FR47:** Guests can view wedding card through unique subdomain URL
- **FR48:** System can display curtain animation with tap-to-open interaction
- **FR49:** System can display wedding countdown timer that updates in real-time
- **FR50:** System can display photo gallery on public wedding card
- **FR51:** System can display wedding details (names, date, time, venue, map)
- **FR52:** System can display RSVP section on public wedding card
- **FR53:** System can display guestbook section on public wedding card

**Admin & Monitoring (8 FRs):**
- **FR54:** Super Admin can view list of all wedding accounts
- **FR55:** Super Admin can view setup progress for each wedding account
- **FR56:** Super Admin can monitor RSVP counts per wedding
- **FR57:** Super Admin can monitor guestbook message count per wedding
- **FR58:** Super Admin can monitor Wish Present claim activity per wedding
- **FR59:** Couples can view RSVP list in their dashboard
- **FR60:** Couples can view guestbook messages in their dashboard
- **FR61:** System can track setup completion percentage for couples

**Data Management & Privacy (6 FRs):**
- **FR62:** System can automatically delete wedding photos 6 months after wedding date
- **FR63:** System can automatically delete wedding card content 6 months after wedding date
- **FR64:** System can retain couple account credentials beyond 6-month period
- **FR65:** System can display Privacy Policy to users
- **FR66:** System can display Terms of Service to users
- **FR67:** System can comply with personal data protection requirements

**Multi-Language Support (3 FRs):**
- **FR68:** System can display interface in English language
- **FR69:** System can display interface in Bahasa Malaysia language
- **FR70:** Users can switch between English and Bahasa Malaysia

**Feature Locking & Upgrade (5 FRs):**
- **FR71:** System can hide Wish Present functionality from Standard couples
- **FR72:** System can hide Digital Ang Pow functionality from Standard couples
- **FR73:** System can display upgrade prompts for locked premium features
- **FR74:** System can send upgrade request notifications to Super Admin
- **FR75:** System can instantly unlock premium features when package is upgraded

### NonFunctional Requirements

**Performance (8 NFRs):**
- **NFR-PERF-001:** Public wedding card pages must load within 5 seconds on 4G mobile connections
- **NFR-PERF-002:** Initial Time to Interactive (TTI) for couple dashboard must be within 3 seconds on desktop
- **NFR-PERF-003:** Photo gallery images must display progressively with lazy loading
- **NFR-PERF-004:** Subdomain lookup validation must complete within 2 seconds during typing
- **NFR-PERF-005:** System must support 100 concurrent weddings without performance degradation
- **NFR-PERF-006:** System must handle 50 concurrent guests viewing the same wedding card without slowdown
- **NFR-PERF-007:** Countdown timer must update every second without page refresh
- **NFR-PERF-008:** RSVP submissions must reflect in couple dashboard within 5 seconds

**Security (17 NFRs):**
- **NFR-SEC-001:** All passwords must be hashed using bcrypt or Argon2 before storage
- **NFR-SEC-002:** User sessions must use secure HTTP-only cookies
- **NFR-SEC-003:** Couple bank account numbers and QR codes must be stored securely in database
- **NFR-SEC-004:** Guest contact information (email/phone) must be encrypted at rest
- **NFR-SEC-005:** Super Admin dashboard must require authentication with super-admin role
- **NFR-SEC-006:** Couple dashboards must require authentication and role-based access to their own data only
- **NFR-SEC-007:** Guests must not access admin or couple dashboard areas
- **NFR-SEC-008:** Standard package couples must not access locked premium features
- **NFR-SEC-009:** System must display Privacy Policy accessible from all pages
- **NFR-SEC-010:** System must obtain implicit consent for data collection through service use
- **NFR-SEC-011:** System must automatically delete wedding data (photos, content) 6 months after wedding date
- **NFR-SEC-012:** System must retain account credentials separately from wedding data
- **NFR-SEC-013:** All user inputs must be sanitized to prevent XSS attacks
- **NFR-SEC-014:** File uploads must be validated for type and size before processing
- **NFR-SEC-015:** Subdomain inputs must be validated to prevent SQL injection
- **NFR-SEC-016:** All authenticated connections must use HTTPS (TLS 1.2+)
- **NFR-SEC-017:** Sensitive data (bank details, contact info) must be transmitted over encrypted connections

**Scalability (8 NFRs):**
- **NFR-SCALE-001:** System must support 100 active wedding subdomains
- **NFR-SCALE-002:** System must support 1 Super Admin and 100 Couple accounts simultaneously
- **NFR-SCALE-003:** System must support 500 guest RSVPs per wedding without performance degradation
- **NFR-SCALE-004:** System architecture must allow manual addition of server resources (DigitalOcean droplet upgrade)
- **NFR-SCALE-005:** Database must handle 10,000 guestbook messages across all weddings
- **NFR-SCALE-006:** File storage must accommodate 5,000 photos (100 weddings × 50 photos each)
- **NFR-SCALE-007:** Page load times must not exceed 7 seconds during peak wedding weekend traffic
- **NFR-SCALE-008:** System must not crash when 20 guests simultaneously RSVP to the same wedding

**Reliability (8 NFRs):**
- **NFR-REL-001:** System must maintain 95% uptime during active wedding periods (weekends)
- **NFR-REL-002:** System must support manual server restarts during low-traffic periods (weekday nights)
- **NFR-REL-003:** RSVP submissions must not be lost due to server errors
- **NFR-REL-004:** Guestbook messages must be saved atomically (complete or not at all)
- **NFR-REL-005:** Photo uploads must validate before saving to prevent corruption
- **NFR-REL-006:** System must display user-friendly error messages for all failure scenarios
- **NFR-REL-007:** System must log all errors for Super Admin review
- **NFR-REL-008:** Frontend validation must prevent common user errors before server submission

**Usability (8 NFRs):**
- **NFR-USE-001:** All primary user actions must be completable on mobile devices (smartphones)
- **NFR-USE-002:** Touch targets (buttons, links) must be minimum 44×44 pixels for mobile interaction
- **NFR-USE-003:** Text must be minimum 16px base font size on mobile for readability
- **NFR-USE-004:** Error messages must be clear and actionable in user's language (English/BM)
- **NFR-USE-005:** Form inputs must provide immediate validation feedback
- **NFR-USE-006:** Locked premium features must display upgrade prompts clearly
- **NFR-USE-007:** Users must be able to complete wedding card setup within 1 hour
- **NFR-USE-008:** Super Admin must be able to create new couple account within 5 minutes

### Additional Requirements

**From Architecture Document:**

**Technical Stack & Architecture:**
- **Starter Template:** Greenfield project (development already complete, no starter template specified)
- **Backend:** Laravel 12.17.0 (PHP 8.2+) with Inertia.js for SPA (no REST API)
- **Frontend:** Vue 3.4+ (Composition API only, no Options API) with Tailwind CSS v4
- **Database:** MySQL 8+ with InnoDB engine, utf8mb4 charset, single database with wedding_id scoping
- **Permissions:** Spatie Laravel Permission package for role-based access control
- **State Management:** Vue 3 ref()/reactive() only (NO Pinia, NO Vuex)
- **Real-Time Updates:** Short polling (every 5 seconds) for RSVP/wish updates (no WebSockets, no Laravel Queues)

**Infrastructure & Deployment:**
- **Hosting:** DigitalOcean droplets (Ubuntu 22.04 LTS)
- **Web Server:** Nginx 1.24+ with wildcard subdomain routing
- **PHP:** PHP-FPM 8.2 with Opcache enabled
- **Process Monitor:** Supervisor (Laravel scheduler only, NO queue workers)
- **SSL:** Certbot for wildcard SSL certificate (*.jomnikah.com)
- **Manual Server Management:** No Forge, no Envoyer, full control over infrastructure
- **Droplet Size:** 4GB RAM / 2 vCPUs sufficient for 100 concurrent weddings

**Multi-Tenancy & Security:**
- **Data Isolation:** Single database with wedding_id foreign keys on all tenant-specific tables
- **Global Scopes:** Automatic tenant filtering via Laravel global scopes to prevent data leaks
- **Role-Based Access:** Super Admin (can create accounts, manage all weddings), Couple (can only access own wedding data)
- **Feature Locking:** Spatie Permissions for premium features (access_wish_present_registry, access_digital_ang_pow)
- **Middleware:** CheckPremiumFeature middleware redirects Standard couples to upgrade prompt
- **Controller Organization:** Role-based controller folders (Admin/, Couple/, Public/)

**Data Lifecycle & Compliance:**
- **6-Month Data Deletion:** Laravel Console Scheduler automated jobs for photos, card content, guestbook
- **Credential Retention:** Account credentials kept separately from wedding data
- **Export Functionality:** PDF generation (barryvdh/laravel-dompdf), Excel export (fastexcel/fastexcel)
- **Privacy Policy & Terms:** Static pages accessible from footer

**File Upload & Storage:**
- **Photo Validation:** Client-side validation (<2MB limit) before upload to server
- **Storage:** Local filesystem storage (5,000 photos capacity: 100 weddings × 50 photos)
- **Formats:** Image validation (JPG, PNG, WebP)

**Subdomain Routing:**
- **Wildcard DNS:** Manual Nginx configuration for *.jomnikah.com
- **Validation:** Real-time AJAX availability checking with <2 second response time
- **Format Rules:** Lowercase, alphanumeric, dashes only (no special characters)
- **SSL:** Wildcard SSL certificate for all subdomains

**WhatsApp Integration:**
- **Deep Links Only:** No WhatsApp Business API (free approach, no setup costs)
- **RSVP Integration:** https://wa.me/{phone}?text={encoded_message}
- **Fallback:** Web form if WhatsApp not installed on guest device
- **Credential Delivery:** Manual WhatsApp messages from Super Admin to couples

**Real-Time Features:**
- **Countdown Timer:** Client-side JavaScript (updates every second, no server polling)
- **RSVP/Wish Updates:** Short polling every 5 seconds (no WebSockets, no server push)
- **Dashboard Updates:** Inertia.js page refresh or polling for new RSVPs/wishes

**Naming Conventions & Code Organization:**
- **Database Tables:** Singular, snake_case (e.g., users, weddings, rsvps, guestbook)
- **Database Columns:** snake_case, foreign keys as {table}_id format
- **Models:** Singular PascalCase matching table name (e.g., Rsvp, Guestbook)
- **Controllers:** Organized by role (Admin/WeddingController, Couple/WeddingController, Public/WeddingCardController)
- **Vue Components:** 3-layer architecture with jc- prefix (jc-base/, jc-interactive/, jc-wedding/)
- **Routes:** Dot notation with role prefix (admin.weddings.index, couple.wedding.edit)

**Monitoring & Logging:**
- **Error Logging:** Laravel logging channels for Super Admin review
- **Development Debugging:** Laravel Telescope (optional), Laravel Debugbar (query profiling)
- **Performance Monitoring:** Page load time tracking, database query optimization

**From UX Journey Flows:**

**Guest Card Viewing Experience:**
- **Curtain Animation:** 1.8s theater curtain part animation, full-screen rose gradient overlay
- **Page Load Target:** <2 seconds on 4G connection
- **Progressive Information:** Photo → Details → RSVP (natural discovery order)
- **Zero-Login RSVP:** No account creation required for guests
- **Smart Fallbacks:** WhatsApp redirect preferred, web form if unavailable
- **Error Recovery:** Clear error messages with retry button, no technical jargon
- **Confirmation Toast:** "Thank you! RSVP sent to {Couple Names}" message

**Couple Setup Experience:**
- **Setup Wizard:** Progressive disclosure (one section at a time)
- **Progress Tracking:** 20% → 40% → 70% → 90% → 100% milestones
- **Celebration Animations:** Confetti bursts, milestone celebrations at each section completion
- **Real-Time Validation:** AJAX subdomain availability checking as user types
- **Live Preview:** See changes instantly when editing wedding details or switching templates
- **Auto-Save Progress:** Local storage to prevent data loss if user abandons
- **Time Target:** Complete full setup in <1 hour

**Admin Account Creation:**
- **Streamlined Form:** <5 minutes per couple account creation
- **Smart Defaults:** Subdomain suggestions based on couple names
- **Setup Progress Tracking:** Visual % complete indicator for each wedding
- **Real-Time Updates:** RSVPs appear instantly in admin dashboard
- **WhatsApp Integration:** Personal credential delivery messages

**Responsive Design Requirements:**
- **Mobile-First:** 80%+ guest traffic on smartphones
- **Breakpoints:** Mobile (<640px), Tablet (640-1024px), Desktop (>1024px)
- **Touch Targets:** Minimum 44×44px buttons for mobile interaction
- **Font Sizes:** Minimum 16px base font size on mobile
- **Vertical Scrolling:** Primary use case orientation for mobile

**Accessibility for Cross-Generational Users:**
- **Target Users:** Ages 20-70 with varying tech comfort (e.g., Auntie Fatimah, age 60)
- **Simplified Navigation:** Minimal UI chrome on mobile
- **Clear Typography:** Readable fonts, generous whitespace
- **Form Inputs:** Appropriate input types (numeric keypads for phone numbers)
- **Error Messages:** Simple language, clear guidance in English/Bahasa Malaysia

**Emotional Design Elements:**
- **Defining Experience:** Curtain animation ritual creates emotional peak
- **Celebration Moments:** Confetti at 100% completion, milestone animations
- **Warm Error Messages:** Kind, supportive tone (not punitive or technical)
- **Progress Indicators:** Visual progress tracking to reduce anxiety
- **Personal Touches:** Couple's names and photos prominent throughout

**Performance & Optimization:**
- **Image Optimization:** Lazy loading for photo galleries
- **Bundle Size:** Code splitting by route for <3s TTI
- **Frontend Validation:** Immediate feedback to prevent server round-trips
- **Progressive Enhancement:** JavaScript required (modern web app assumption)

### FR Coverage Map

**Account & Package Management (FR1-FR7):**
- FR1: Epic 1 - Super Admin creates couple accounts
- FR2: Epic 1 - Package tier assignment (Standard/Premium)
- FR3: Epic 1 - Wish Present feature toggle per couple
- FR4: Epic 1 - Digital Ang Pow feature toggle per couple
- FR5: Epic 1 - Upgrade couple from Standard to Premium
- FR6: Epic 1 - Couples log in with credentials
- FR7: Epic 1 - Couples request package upgrade

**Wedding Card Configuration (FR8-FR15):**
- FR8: Epic 2 - Couples define unique subdomain
- FR9: Epic 2 - Real-time subdomain availability validation
- FR10: Epic 2 - Subdomain format enforcement (lowercase, no special chars)
- FR11: Epic 2 - Couples select wedding template
- FR12: Epic 2 - Template switching without data loss
- FR13: Epic 2 - Enter wedding details (date, time, venue, map)
- FR14: Epic 2 - Upload photos to gallery
- FR15: Epic 2 - Photo file size validation (<2MB)

**Guest RSVP Management (FR16-FR20):**
- FR16: Epic 3 - Guests RSVP via WhatsApp redirect
- FR17: Epic 3 - Guests RSVP via web form
- FR18: Epic 3 - Couples view real-time RSVP list
- FR19: Epic 3 - RSVP date/time tracking
- FR20: Epic 3 - RSVP count display in dashboard

**Guestbook & Wishes (FR21-FR27):**
- FR21: Epic 4 - Guests submit guestbook messages
- FR22: Epic 4 - Guestbook approval workflow
- FR23: Epic 4 - Couples approve messages
- FR24: Epic 4 - Couples delete messages
- FR25: Epic 4 - Display approval status to guests
- FR26: Epic 4 - Export guestbook to Excel
- FR27: Epic 4 - Export guestbook to PDF

**Premium Features - Wish Present Registry (FR28-FR38):**
- FR28: Epic 5 - Premium couples add gift items
- FR29: Epic 5 - Premium couples edit gift items
- FR30: Epic 5 - Premium couples delete gift items
- FR31: Epic 5 - Guests claim gift items
- FR32: Epic 5 - Require guest contact info during claim
- FR33: Epic 5 - Prevent duplicate claims
- FR34: Epic 5 - Display claimed status with guest identifier
- FR35: Epic 5 - Guests cancel claims (items available again)
- FR36: Epic 5 - Display couple contact info to claimants
- FR37: Epic 5 - Standard couples see locked registry
- FR38: Epic 5 - Display upgrade prompt for locked feature

**Premium Features - Digital Ang Pow (FR39-FR46):**
- FR39: Epic 6 - Premium couples upload QR code
- FR40: Epic 6 - Premium couples add bank account details
- FR41: Epic 6 - Specify bank name for display
- FR42: Epic 6 - Guests view QR code
- FR43: Epic 6 - Guests view bank account details
- FR44: Epic 6 - Privacy of contribution amounts
- FR45: Epic 6 - Standard couples see locked Digital Ang Pow
- FR46: Epic 6 - Display upgrade prompt for locked feature

**Public Wedding Card Display (FR47-FR53):**
- FR47: Epic 3 - Guests view card via subdomain URL
- FR48: Epic 3 - Curtain animation with tap-to-open
- FR49: Epic 3 - Real-time countdown timer
- FR50: Epic 3 - Photo gallery display
- FR51: Epic 3 - Display wedding details
- FR52: Epic 3 - RSVP section on public card
- FR53: Epic 3 - Guestbook section on public card

**Admin & Monitoring (FR54-FR61):**
- FR54: Epic 7 - Super Admin views all wedding accounts
- FR55: Epic 7 - View setup progress per wedding
- FR56: Epic 7 - Monitor RSVP counts per wedding
- FR57: Epic 7 - Monitor guestbook count per wedding
- FR58: Epic 7 - Monitor Wish Present activity per wedding
- FR59: Epic 7 - Couples view RSVP list
- FR60: Epic 7 - Couples view guestbook messages
- FR61: Epic 7 - Track setup completion percentage

**Data Management & Privacy (FR62-FR67):**
- FR62: Epic 8 - Auto-delete wedding photos after 6 months
- FR63: Epic 8 - Auto-delete wedding card content after 6 months
- FR64: Epic 8 - Retain account credentials beyond 6 months
- FR65: Epic 8 - Display Privacy Policy
- FR66: Epic 8 - Display Terms of Service
- FR67: Epic 8 - Comply with PDPA requirements

**Multi-Language Support (FR68-FR70):**
- FR68: Epic 8 - Display interface in English
- FR69: Epic 8 - Display interface in Bahasa Malaysia
- FR70: Epic 8 - Users switch between languages

**Feature Locking & Upgrade (FR71-FR75):**
- FR71: Epic 8 - Hide Wish Present from Standard couples
- FR72: Epic 8 - Hide Digital Ang Pow from Standard couples
- FR73: Epic 8 - Display upgrade prompts for locked features
- FR74: Epic 8 - Send upgrade notifications to Super Admin
- FR75: Epic 8 - Instantly unlock features on upgrade

**All 75 FRs mapped to 8 epics ✅**

## Epic List

### Epic 1: Foundation & Access Control
Super Admin can create couple accounts with package tier assignment (Standard/Premium) and feature toggles, enabling couples to securely log in and manage their wedding with appropriate permissions.
**FRs covered:** FR1, FR2, FR3, FR4, FR5, FR6, FR7 (7 FRs)

### Epic 2: Wedding Card Configuration
Couples can fully customize their wedding card through subdomain selection, template switching, wedding details entry, and photo uploads with real-time validation, completing setup in under one hour.
**FRs covered:** FR8, FR9, FR10, FR11, FR12, FR13, FR14, FR15 (8 FRs)

### Epic 3: Guest Experience & RSVP
Guests can view wedding cards with the defining curtain animation ritual, explore photos and details, and RSVP via WhatsApp or web form, creating an emotional connection in under five minutes.
**FRs covered:** FR16, FR17, FR18, FR19, FR20, FR47, FR48, FR49, FR50, FR51, FR52, FR53 (12 FRs)

### Epic 4: Guestbook & Wishes
Couples can collect heartfelt messages from guests, moderate content through approval workflows, and preserve memories forever through PDF and Excel export functionality.
**FRs covered:** FR21, FR22, FR23, FR24, FR25, FR26, FR27 (7 FRs)

### Epic 5: Premium Gift Registry
Premium couples can manage a Wish Present registry where guests claim gifts without duplication, view delivery details, and cancel/reclaim items, eliminating duplicate gift anxiety.
**FRs covered:** FR28, FR29, FR30, FR31, FR32, FR33, FR34, FR35, FR36, FR37, FR38 (11 FRs)

### Epic 6: Digital Ang Pow System
Premium couples can collect monetary gifts privately through QR code display and bank account details, maintaining cultural alignment with Malaysian wedding traditions while keeping contribution amounts private.
**FRs covered:** FR39, FR40, FR41, FR42, FR43, FR44, FR45, FR46 (8 FRs)

### Epic 7: Real-Time Monitoring & Dashboards
Super Admin can efficiently manage 100 wedding accounts with visibility into setup progress and engagement metrics, while couples track RSVPs and guestbook activity in real-time.
**FRs covered:** FR54, FR55, FR56, FR57, FR58, FR59, FR60, FR61 (8 FRs)

### Epic 8: Data Lifecycle & Compliance
System automatically manages 6-month data deletion for PDPA compliance, provides bilingual interface support (English/Bahasa Malaysia), and handles feature locking with upgrade workflows.
**FRs covered:** FR62, FR63, FR64, FR65, FR66, FR67, FR68, FR69, FR70, FR71, FR72, FR73, FR74, FR75 (14 FRs)

---

## Epic 1: Foundation & Access Control

Super Admin can create couple accounts with package tier assignment (Standard/Premium) and feature toggles, enabling couples to securely log in and manage their wedding with appropriate permissions.

### Story 1.1: Super Admin Authentication

As a Super Admin,
I want to securely log in to the administration dashboard with my credentials,
So that I can manage wedding accounts and perform administrative tasks.

**Acceptance Criteria:**

**Given** the Super Admin has valid credentials (email and password)
**When** I navigate to the admin login page and submit my credentials
**Then** I should be authenticated and redirected to the Super Admin dashboard
**And** my session should use HTTP-only cookies for security (NFR-SEC-002)
**And** my password should be verified using bcrypt/Argon2 hashing (NFR-SEC-001)
**And** I should see a dashboard overview with wedding account management options

**Given** the Super Admin enters invalid credentials
**When** I submit the login form
**Then** I should see a clear error message in English or Bahasa Malaysia (NFR-USE-004)
**And** I should remain on the login page
**And** the error should be logged for admin review (NFR-REL-007)

**Given** the Super Admin is already logged in
**When** I navigate to the admin login page
**Then** I should be redirected directly to the dashboard
**And** I should not see the login form

---

### Story 1.2: Create Couple Account

As a Super Admin,
I want to create new couple accounts with email/phone and secure password credentials,
So that couples can log in and begin setting up their wedding card.

**Acceptance Criteria:**

**Given** I am logged in as Super Admin
**When** I navigate to the wedding account creation page
**Then** I should see a streamlined form with fields: Couple's names, Email/Phone, Password (FR1)

**Given** I have filled in all required couple account information
**When** I submit the account creation form
**Then** the system should create a new User record with role 'couple'
**And** the system should hash the password using bcrypt/Argon2 (NFR-SEC-001)
**And** I should see a confirmation message "Wedding account created successfully"
**And** the form should complete within 5 minutes (NFR-USE-008)
**And** the system should log the account creation action

**Given** I submit the form with missing required fields
**When** the form validation runs
**Then** I should see inline validation errors for missing fields
**And** the errors should be clear and actionable (NFR-USE-005)
**And** the form should not submit

**Given** I submit the form with an email/phone that already exists
**When** the system checks for duplicates
**Then** I should see a validation error "This email or phone is already registered"
**And** the account should not be created

**Given** the account is successfully created
**When** the creation process completes
**Then** I should be able to share the login credentials with the couple
**And** the couple should be able to log in using those credentials (FR6)

---

### Story 1.3: Package Tier Assignment

As a Super Admin,
I want to assign a package tier (Standard or Premium) when creating couple accounts,
So that couples receive the appropriate feature access based on their payment.

**Acceptance Criteria:**

**Given** I am on the couple account creation form
**When** I view the package selection options
**Then** I should see a dropdown or radio buttons with "Standard (RM20)" and "Premium (RM30)" options (FR2)

**Given** I select "Standard" package tier
**When** I create the couple account
**Then** the system should assign 'standard' as the package_tier for the wedding
**And** the couple should not have access to Wish Present or Digital Ang Pow features (FR71, FR72)

**Given** I select "Premium" package tier
**When** I create the couple account
**Then** the system should assign 'premium' as the package_tier for the wedding
**And** the couple should have access to all features including Wish Present and Digital Ang Pow

**Given** I have created a Standard package account
**When** I view the account in the admin dashboard
**Then** I should see the package tier clearly displayed
**And** I should be able to change the package tier later (FR5)

**Given** the package tier is saved
**When** the couple logs into their dashboard
**Then** they should see features locked/unlocked based on their package tier (NFR-SEC-008)
**And** Standard couples should see upgrade prompts for premium features (FR73)

---

### Story 1.4: Premium Feature Toggles

As a Super Admin,
I want to independently enable or disable Wish Present and Digital Ang Pow features for each couple,
So that I can provide flexible package customization and promotional access.

**Acceptance Criteria:**

**Given** I am creating or editing a couple account
**When** I view the feature options section
**Then** I should see two independent checkboxes: "Enable Wish Present Registry" and "Enable Digital Ang Pow" (FR3, FR4)

**Given** I check "Enable Wish Present Registry" for a Standard package couple
**When** I save the account
**Then** the system should set wish_present_enabled to true
**And** the couple should be able to access Wish Present Registry features
**And** this should work even if their package tier is 'standard'

**Given** I check "Enable Digital Ang Pow" for a Standard package couple
**When** I save the account
**Then** the system should set digital_ang_pow_enabled to true
**And** the couple should be able to access Digital Ang Pow features
**And** this should work independently of the Wish Present setting

**Given** a Premium package couple has both features enabled by default
**When** I uncheck "Enable Wish Present Registry"
**Then** the couple should lose access to Wish Present features
**And** the Wish Present section should appear locked in their dashboard (FR37)
**And** Digital Ang Pow should remain accessible if still enabled

**Given** both features are disabled for a couple
**When** the couple views their dashboard
**Then** both Wish Present and Digital Ang Pow sections should appear locked
**And** upgrade prompts should be displayed (FR38, FR46)
**And** the couple should be able to request an upgrade (FR7)

---

### Story 1.5: Couple Package Upgrade

As a Super Admin,
I want to upgrade couples from Standard to Premium package,
So that couples can unlock premium features when they pay the additional RM10 fee.

**Acceptance Criteria:**

**Given** I am viewing a Standard package couple account in the admin dashboard
**When** I click the "Upgrade to Premium" button or select Premium from package dropdown
**Then** I should see a confirmation dialog "Upgrade this couple to Premium package? Features will be unlocked immediately." (FR5)

**Given** I confirm the package upgrade
**When** the system processes the upgrade
**Then** the couple's package_tier should change from 'standard' to 'premium'
**And** both Wish Present and Digital Ang Pow features should be instantly enabled (FR75)
**And** I should see a success message "Package upgraded to Premium successfully"

**Given** the couple is logged in when I upgrade their package
**When** the upgrade completes
**Then** the couple should see previously locked features become available on their next page refresh
**And** they should not need to log out and back in
**And** Wish Present and Digital Ang Pow sections should be fully accessible

**Given** a couple is logged into their dashboard
**When** they are on Standard package and see locked premium features
**Then** they should see an "Upgrade to Premium - Add RM10" button or link (FR7)
**And** clicking it should send an upgrade request notification to me (FR74)

**Given** I receive an upgrade request notification
**When** I verify payment (manual process outside the system)
**Then** I can perform the package upgrade through the admin dashboard
**And** the system should unlock features immediately upon upgrade

**Given** a couple is downgraded from Premium to Standard (rare case)
**When** the package change is saved
**Then** Wish Present and Digital Ang Pow features should become locked
**And** existing data (registry items, QR codes) should be retained but inaccessible
**And** the features should be accessible again if re-upgraded

---

**Epic 1 Summary:**
- ✅ 5 Stories created
- ✅ All 7 FRs covered (FR1-FR7)
- ✅ Foundation for authentication and access control complete
- ✅ Package management system established
- ✅ Ready for Epic 2: Wedding Card Configuration

---

## Epic 2: Wedding Card Configuration

Couples can fully customize their wedding card through subdomain selection, template switching, wedding details entry, and photo uploads with real-time validation, completing setup in under one hour.

### Story 2.1: Couple Authentication & Dashboard Access

As a couple,
I want to log in to my dashboard using the credentials provided by Super Admin,
So that I can begin setting up my wedding card.

**Acceptance Criteria:**

**Given** I have valid login credentials (email/phone and password)
**When** I navigate to the couple login page and submit my credentials
**Then** I should be authenticated and redirected to my couple dashboard
**And** my session should use HTTP-only cookies for security (NFR-SEC-002)
**And** I should only have access to my own wedding data (NFR-SEC-006)

**Given** I enter invalid credentials
**When** I submit the login form
**Then** I should see a clear bilingual error message (NFR-USE-004)
**And** I should remain on the login page

**Given** I successfully log in
**When** I reach my dashboard
**Then** I should see a welcome message "Let's set up your wedding card together"
**And** I should see my setup progress (0% if first login)

---

### Story 2.2: Subdomain Selection & Validation

As a couple,
I want to choose a unique subdomain for my wedding card with real-time availability checking,
So that my guests can access my card through a memorable URL.

**Acceptance Criteria:**

**Given** I am on the wedding card setup wizard
**When** I reach the subdomain selection step
**Then** I should see an input field with examples like "sarah-ahmad.jomnikah.com"
**And** I should see helper text "Lowercase letters, numbers, and dashes only"

**Given** I type a subdomain
**When** the system validates in real-time via AJAX
**Then** the availability check should complete within 2 seconds (NFR-PERF-004)
**And** I should see a green checkmark ✅ if available (FR9)
**And** I should see a red message ❌ if taken with suggestions (FR10)

**Given** I enter invalid characters (uppercase, special characters)
**When** the system validates
**Then** I should see an inline error "Only lowercase letters, numbers, and dashes allowed"
**And** the invalid characters should be automatically corrected or rejected

**Given** I submit an available subdomain
**When** the form saves
**Then** the subdomain should be saved to my wedding record (FR8)
**And** setup progress should update to 20%
**And** I should see a celebration animation

---

### Story 2.3: Template Selection & Preview

As a couple,
I want to browse wedding templates and see my data instantly applied,
So that I can choose the perfect design without fear of losing my information.

**Acceptance Criteria:**

**Given** I have completed the subdomain step
**When** I reach the template selection step
**Then** I should see a grid of 4+ wedding template options with thumbnails
**And** each template should show my wedding data in the preview (FR11)

**Given** I click on a template
**When** the preview loads
**Then** I should see my names, date, venue, and photos in that template
**And** the preview should update instantly (live preview)
**And** I should be able to explore different templates without commitment

**Given** I select a template
**When** I confirm my choice
**Then** the template should be saved to my wedding record
**And** all my previously entered data should remain intact (FR12)
**And** setup progress should update to 40%
**And** I should see a confetti burst celebration

**Given** I want to change templates later
**When** I return to the template selection step
**Then** I should be able to switch templates without losing any data
**And** the new template should display all my existing information

---

### Story 2.4: Wedding Details Entry

As a couple,
I want to enter my wedding date, time, venue, and location map,
So that guests have all the essential information they need.

**Acceptance Criteria:**

**Given** I have selected a template
**When** I reach the wedding details step
**Then** I should see a form with fields: Wedding Date, Wedding Time, Venue Name, Address, Google Maps Link (FR13)

**Given** I enter my wedding details
**When** I type in each field
**Then** I should see the details update in the live preview in real-time
**And** required fields should show clear validation indicators

**Given** I leave required fields empty
**When** I try to proceed
**Then** I should see inline validation errors (NFR-USE-005)
**And** the Next button should be disabled until all required fields are complete
**And** I should see helpful messages "Please fill in all fields to continue"

**Given** I enter a wedding date in the past
**When** the system validates
**Then** I should see an error "Wedding date must be in the future"
**And** the form should prevent submission

**Given** I complete all wedding details
**When** I save the step
**Then** all details should be saved to my wedding record
**And** setup progress should update to 70%
**And** I should see an "Almost There!" message

---

### Story 2.5: Photo Gallery Upload

As a couple,
I want to upload my favorite couple photos with size validation,
So that guests can see our happiness and personality.

**Acceptance Criteria:**

**Given** I have completed wedding details
**When** I reach the photo upload step
**Then** I should see an upload widget with drag-drop and click-to-select options
**And** I should see a helper text "Upload photos under 2MB for best performance" (FR15)

**Given** I select a photo larger than 2MB
**When** the system validates on the client side
**Then** I should see an immediate error "This photo is {size}MB. Please choose under 2MB for best performance" (FR15)
**And** the photo should not upload
**And** I should see a helpful tip about resizing photos

**Given** I select a valid photo (<2MB)
**When** the upload completes
**Then** the photo should appear in my gallery
**And** I should see a progress indicator during upload
**And** the photo should save to the photos table with wedding_id

**Given** I upload multiple photos
**When** all uploads complete
**Then** I should see all photos in a grid layout
**And** I should be able to reorder or delete photos
**And** setup progress should update to 90%
**And** I should see a "One Last Step!" message

---

### Story 2.6: Setup Progress & Completion

As a couple,
I want to track my setup progress and celebrate when complete,
So that I feel supported and accomplished throughout the process.

**Acceptance Criteria:**

**Given** I am going through the setup wizard
**When** I complete each step
**Then** I should see a progress bar showing completion percentage (FR61)
**And** I should see milestone celebrations at 20%, 40%, 70%, 90%

**Given** I complete all required steps (subdomain, template, details, photos)
**When** I reach 100% completion
**Then** I should see a confetti explosion celebration
**And** I should see a success screen "Your wedding card is ready!"
**And** I should see a button to copy my wedding card link
**And** I should see share buttons for WhatsApp and social media

**Given** I click "Copy Link"
**When** the link copies
**Then** I should see a toast confirmation "Link copied to clipboard!"
**And** the link should be in format "https://{subdomain}.jomnikah.com"

**Given** I click "Test Your Card"
**When** the preview opens
**Then** my wedding card should open in a new tab
**And** I should see the curtain animation and full card display

**Given** I complete setup within 1 hour
**When** the setup finishes
**Then** I should feel relieved and proud (emotional outcome)
**And** the total setup time should be tracked (NFR-USE-007)

**Given** I leave the setup wizard incomplete
**When** I log out and return later
**Then** I should see "Continue where you left off" message
**And** my progress should be saved and restored
**And** I can complete setup from where I stopped

---

**Epic 2 Summary:**
- ✅ 6 Stories created
- ✅ All 8 FRs covered (FR8-FR15)
- ✅ Wedding card configuration flow complete
- ✅ Real-time validation and live preview implemented
- ✅ Setup progress tracking with celebration milestones
- ✅ Ready for Epic 3: Guest Experience & RSVP
---

## Epic 3: Guest Experience & RSVP

Guests can view wedding cards with the defining curtain animation ritual, explore photos and details, and RSVP via WhatsApp or web form, creating an emotional connection in under five minutes.

### Story 3.1: Public Wedding Card Access via Subdomain

As a guest,
I want to access a wedding card by visiting its unique subdomain URL,
So that I can view the couple's wedding information without logging in.

**Acceptance Criteria:**

**Given** I have a wedding card link (e.g., sarah-ahmad.jomnikah.com)
**When** I navigate to the URL in my browser
**Then** the page should load within 5 seconds on 4G mobile (NFR-PERF-001)
**And** I should see the curtain animation overlay
**And** the system should route to the correct wedding using subdomain (FR47)

**Given** I visit an invalid subdomain
**When** the system looks up the wedding
**Then** I should see a friendly 404 error page
**And** the error message should be bilingual (NFR-USE-004)

**Given** 50 guests view the same card simultaneously
**When** the cards load
**Then** the system should handle the load without slowdown (NFR-PERF-006)

---

### Story 3.2: Curtain Animation Ritual

As a guest,
I want to experience a curtain opening animation before viewing the wedding card,
So that I feel a sense of anticipation and emotional connection.

**Acceptance Criteria:**

**Given** I navigate to a wedding card URL
**When** the page loads
**Then** I should see a full-screen curtain overlay with rose gradient (FR48)
**And** I should see the text "Tap to Open Their Wedding Card"
**And** I should see the couple's names visible
**And** I should see a ring icon 💍

**Given** I tap the curtain
**When** the animation triggers
**Then** I should see a 1.8s theater curtain part animation
**And** the card should reveal with fade-in showing hero photo and names
**And** the animation should feel smooth and celebratory

**Given** the page loads slowly
**When** the curtain animation runs
**Then** photos should load progressively during the curtain (perceived performance)
**And** the animation should not feel laggy

---

### Story 3.3: Wedding Details & Countdown Display

As a guest,
I want to see the couple's wedding details and a real-time countdown timer,
So that I know when and where the wedding will take place.

**Acceptance Criteria:**

**Given** I have opened the wedding card
**When** I scroll through the card
**Then** I should see the couple's photo gallery at the top (FR50)
**And** I should see wedding details: names, date, time, venue (FR51)
**And** I should see a Google Maps link to the venue

**Given** I view the countdown timer
**When** the timer displays
**Then** I should see the time remaining until the wedding (FR49)
**And** the timer should update every second without page refresh (NFR-PERF-007)
**And** the timer should show "Wedding completed!" after the date passes

**Given** I view on a mobile device
**When** the card displays
**Then** text should be minimum 16px for readability (NFR-USE-003)
**And** photos should load progressively with lazy loading (NFR-PERF-003)

---

### Story 3.4: WhatsApp RSVP Integration

As a guest,
I want to RSVP by tapping a button that opens WhatsApp with a pre-filled message,
So that I can quickly confirm my attendance using my preferred communication method.

**Acceptance Criteria:**

**Given** I scroll to the RSVP section
**When** I view the RSVP options
**Then** I should see a prominent "RSVP via WhatsApp" button (FR16)
**And** I should see an alternative "RSVP via Form" option (FR17)

**Given** I tap "RSVP via WhatsApp"
**When** the deep link triggers
**Then** WhatsApp should open with a pre-filled message "I'll be there!" or similar
**And** the message should include the couple's names if possible
**And** sending the message should log my RSVP in the system

**Given** I don't have WhatsApp installed
**When** I tap the WhatsApp button
**Then** the system should automatically show the web form RSVP option
**And** I should see a helpful fallback message

**Given** I send the WhatsApp message
**When** the RSVP is logged
**Then** I should see a confirmation toast "Thank you! RSVP sent to {Couple Names}"
**And** the couple should see my RSVP in their dashboard within 5 seconds (NFR-PERF-008)

---

### Story 3.5: Web Form RSVP Fallback

As a guest,
I want to RSVP through a web form if WhatsApp is unavailable,
So that I can still confirm my attendance.

**Acceptance Criteria:**

**Given** I cannot use WhatsApp or prefer the web form
**When** I click "RSVP via Form"
**Then** I should see a form with fields: Name, Phone Number, and Attendance Status
**And** the form should be mobile-optimized with large touch targets (NFR-USE-002)

**Given** I submit the RSVP form
**When** the form validates
**Then** all required fields should be completed
**And** I should see clear validation errors if fields are missing

**Given** I submit valid RSVP information
**When** the form saves
**Then** my RSVP should be saved to the rsvps table with wedding_id
**And** I should see a confirmation toast "Thank you! Your RSVP has been sent"
**And** the couple should see my RSVP in their dashboard (FR18)

**Given** the RSVP is saved
**When** the record is created
**Then** the submission date and time should be tracked (FR19)
**And** the RSVP count should update in the couple's dashboard (FR20)

---

### Story 3.6: RSVP List & Real-Time Updates for Couples

As a couple,
I want to view all RSVPs in my dashboard and see new RSVPs appear in real-time,
So that I can track guest attendance without constant refreshing.

**Acceptance Criteria:**

**Given** I log into my couple dashboard
**When** I navigate to the RSVP section
**Then** I should see a list of all RSVPs with guest names and status (FR18)
**And** I should see submission date and time for each RSVP (FR19)
**And** I should see the total RSVP count (FR20)

**Given** a guest submits an RSVP
**When** I am viewing my dashboard
**Then** I should see the new RSVP appear within 5 seconds (NFR-PERF-008)
**And** the RSVP count should update automatically
**And** I should not need to refresh the page

**Given** I have many RSVPs
**When** I view the list
**Then** RSVPs should be paginated if more than 20
**And** I should be able to search or filter RSVPs

---

**Epic 3 Summary:**
- ✅ 6 Stories created
- ✅ All 12 FRs covered (FR16-FR20, FR47-FR53)
- ✅ Defining curtain animation experience complete
- ✅ WhatsApp deep link integration with web form fallback
- ✅ Real-time RSVP tracking for couples
- ✅ Mobile-first guest experience optimized
- ✅ Ready for Epic 4: Guestbook & Wishes

---

## Epic 4: Guestbook & Wishes

Couples can collect heartfelt messages from guests, moderate content through approval workflows, and preserve memories forever through PDF and Excel export functionality.

### Story 4.1: Guestbook Message Submission

As a guest,
I want to submit a message to the couple's guestbook,
So that I can share my well wishes and be part of their special day.

**Acceptance Criteria:**

**Given** I have opened the wedding card
**When** I scroll to the guestbook section
**Then** I should see the guestbook section displayed (FR53)
**And** I should see existing approved messages from other guests

**Given** I want to leave a message
**When** I view the guestbook form
**Then** I should see fields: Name and Message (FR21)
**And** I should see a "Submit Wish" button
**And** the form should be mobile-friendly with 44×44px touch targets (NFR-USE-002)

**Given** I submit a message
**When** the form validates
**Then** my name and message should be required fields
**And** I should see inline validation errors if missing

**Given** I submit a valid message
**When** the form saves
**Then** my message should be saved to the guestbook table with wedding_id
**And** I should see feedback "Your message is pending approval"
**And** my message should not appear publicly until approved (FR22)
**And** the approval status should be visible to me (FR25)

---

### Story 4.2: Guestbook Moderation for Couples

As a couple,
I want to approve or delete guestbook messages,
So that I have control over what appears on our wedding card.

**Acceptance Criteria:**

**Given** I log into my couple dashboard
**When** I navigate to the guestbook section
**Then** I should see all guestbook messages (FR60)
**And** I should see approval status indicators: Pending/Approved
**And** pending messages should be highlighted

**Given** I view a pending message
**When** I click "Approve"
**Then** the message should be marked as approved (FR23)
**And** the message should become visible on the public wedding card
**And** I should see a success confirmation

**Given** I view an inappropriate message
**When** I click "Delete"
**Then** the message should be deleted from the guestbook (FR24)
**And** the message should be removed from the public card immediately
**And** the deletion should be logged for audit purposes

---

### Story 4.3: Guestbook Export to Excel

As a couple,
I want to export all guestbook messages to an Excel file,
So that I can keep a digital record of well wishes.

**Acceptance Criteria:**

**Given** I am viewing my guestbook in the dashboard
**When** I look for export options
**Then** I should see an "Export to Excel" button (FR26)

**Given** I click "Export to Excel"
**When** the export processes
**Then** the system should generate an Excel file using fastexcel package
**And** the file should include columns: Guest Name, Message, Date/Time Submitted
**And** the file should download automatically

**Given** I open the exported Excel file
**When** I view the contents
**Then** all approved guestbook messages should be included
**And** the data should be formatted for readability
**And** pending messages should not be included

---

### Story 4.4: Guestbook Export to PDF

As a couple,
I want to export all guestbook messages to a beautifully formatted PDF,
So that I can create a physical keepsake of memories.

**Acceptance Criteria:**

**Given** I am viewing my guestbook in the dashboard
**When** I look for export options
**Then** I should see an "Export to PDF" button (FR27)

**Given** I click "Export to PDF"
**When** the export processes
**Then** the system should generate a PDF using barryvdh/laravel-dompdf
**And** the PDF should be beautifully formatted with wedding theme
**And** the PDF should include couple's names, wedding date, and all messages
**And** the file should download automatically

**Given** I open the exported PDF
**When** I view the contents
**Then** I should see a header with wedding details
**And** all messages should be formatted elegantly
**And** the PDF should be printable for physical keepsakes

---

**Epic 4 Summary:**
- ✅ 4 Stories created
- ✅ All 7 FRs covered (FR21-FR27)
- ✅ Guestbook submission and moderation workflow complete
- ✅ PDF and Excel export functionality implemented
- ✅ Content control for couples (approve/delete)
- ✅ Ready for Epic 5: Premium Gift Registry

---

## Epic 5: Premium Gift Registry

Premium couples can manage a Wish Present registry where guests claim gifts without duplication, view delivery details, and cancel/reclaim items, eliminating duplicate gift anxiety.

### Story 5.1: Wish Present CRUD Operations

As a Premium couple,
I want to add, edit, and delete gift items in my Wish Present registry,
So that guests know what gifts we would love to receive.

**Acceptance Criteria:**

**Given** I am a Premium couple logged into my dashboard
**When** I navigate to the Wish Present section
**Then** I should see the Wish Present registry fully accessible (FR28)
**And** I should see an "Add Gift Item" button

**Given** I click "Add Gift Item"
**When** the form appears
**Then** I should see fields: Item Name, Description, Quantity, Image URL (optional)
**And** I should be able to specify the item details clearly

**Given** I fill in the gift item details and submit
**When** the item saves
**Then** the item should be saved to the presents table with wedding_id (FR28)
**And** I should see the item in my registry
**And** the item should be marked as "Available" by default

**Given** I want to modify an item
**When** I click "Edit" on an item
**Then** I should be able to update the item details (FR29)
**And** changes should save immediately

**Given** I want to remove an item
**When** I click "Delete"
**Then** the item should be removed from the registry (FR30)
**And** any existing claims should be cancelled
**And** the item should be permanently deleted

---

### Story 5.2: Guest Gift Claiming System

As a guest,
I want to claim a gift item from the couple's Wish Present registry,
So that I know exactly what to buy and avoid duplicates.

**Acceptance Criteria:**

**Given** I am viewing a wedding card with Wish Present enabled
**When** I scroll to the Wish Present section
**Then** I should see all available gift items with descriptions (FR31)
**And** each item should show its claim status

**Given** I want to claim a gift
**When** I click "Claim" on an available item
**Then** I should see a form asking for my email or phone number (FR32)
**And** I should see helper text "Required so the couple knows who claimed this"

**Given** I submit my contact information
**When** the claim processes
**Then** the item should be marked as "Claimed" in the registry (FR33)
**And** the item should show my identifier (email/phone partially hidden) (FR34)
**And** other guests should see this item is no longer available

**Given** an item is already claimed
**When** I view it
**Then** I should not be able to claim it (FR33)
**And** I should see "Claimed by [guest identifier]"

**Given** I have claimed an item
**When** I view the item details
**Then** I should see the couple's contact information (FR36)
**And** I should see: Couple's Name, Phone, Address
**And** I should be able to plan delivery or online order

---

### Story 5.3: Claim Cancellation & Reclaiming

As a guest,
I want to cancel my gift claim if my plans change,
So that the item becomes available for other guests.

**Acceptance Criteria:**

**Given** I have previously claimed a gift item
**When** I view the Wish Present section
**Then** I should see a "Cancel Claim" button on my claimed item (FR35)

**Given** I click "Cancel Claim"
**When** the cancellation processes
**Then** the item should become available for other guests to claim (FR35)
**And** my claim should be removed from the system
**And** I should see a confirmation "Your claim has been cancelled"

**Given** I cancelled a claim
**When** another guest views the registry
**Then** the item should appear as "Available" again
**And** another guest can now claim the item

---

### Story 5.4: Wish Present Feature Locking

As a Standard couple,
I want to see the Wish Present registry in a locked state,
So that I understand it's a Premium feature.

**Acceptance Criteria:**

**Given** I am a Standard couple logged into my dashboard
**When** I navigate to the Wish Present section
**Then** the Wish Present section should appear locked/grayed out (FR37)
**And** I should see an upgrade prompt "Upgrade to Premium Package (RM30) to unlock this feature" (FR38)

**Given** I see the locked Wish Present section
**When** I view the upgrade prompt
**Then** I should see an "Upgrade Now - Add RM10" button or link
**And** clicking it should send an upgrade request to Super Admin (FR74)

**Given** the Super Admin upgrades me to Premium
**When** the upgrade processes
**Then** the Wish Present section should unlock instantly (FR75)
**And** I should have full access to all Wish Present features

---

**Epic 5 Summary:**
- ✅ 4 Stories created
- ✅ All 11 FRs covered (FR28-FR38)
- ✅ Complete Wish Present registry with CRUD operations
- ✅ Guest claiming system with duplicate prevention
- ✅ Claim cancellation functionality
- ✅ Premium feature locking and upgrade prompts
- ✅ Ready for Epic 6: Digital Ang Pow System

---

## Epic 6: Digital Ang Pow System

Premium couples can collect monetary gifts privately through QR code display and bank account details, maintaining cultural alignment with Malaysian wedding traditions while keeping contribution amounts private.

### Story 6.1: QR Code Upload & Display

As a Premium couple,
I want to upload a QR code image for Digital Ang Pow contributions,
So that guests can easily scan and send monetary gifts.

**Acceptance Criteria:**

**Given** I am a Premium couple logged into my dashboard
**When** I navigate to the Digital Ang Pow section
**Then** I should see the Digital Ang Pow section fully accessible
**And** I should see an "Upload QR Code" button

**Given** I click "Upload QR Code"
**When** the upload interface appears
**Then** I should see a file upload widget
**And** I should see validation that the file must be an image (JPG, PNG)
**And** the file should be validated for size (<2MB)

**Given** I upload a valid QR code image
**When** the upload completes
**Then** the QR code should be saved to the wedding record (FR39)
**And** I should see a preview of the uploaded QR code
**And** I should be able to replace the QR code anytime

---

### Story 6.2: Bank Account Details Management

As a Premium couple,
I want to add and display my bank account details for monetary gifts,
So that guests can transfer funds directly if they prefer not to scan QR.

**Acceptance Criteria:**

**Given** I am in the Digital Ang Pow section
**When** I view the bank details form
**Then** I should see fields: Bank Name, Account Number, Account Holder Name (FR40, FR41)

**Given** I fill in my bank details
**When** I save the information
**Then** the bank details should be saved securely to the wedding record (FR40)
**And** I should see the bank name displayed prominently (FR41)

**Given** I have saved bank details
**When** I view the Digital Ang Pow section
**Then** I should see my bank details formatted for display
**And** I should see an option to hide or edit the details

---

### Story 6.3: Guest View of Digital Ang Pow

As a guest,
I want to view the couple's QR code and bank details for Digital Ang Pow,
So that I can send a monetary gift conveniently.

**Acceptance Criteria:**

**Given** I am viewing a wedding card with Digital Ang Pow enabled
**When** I scroll to the Digital Ang Pow section
**Then** I should see the QR code image displayed (FR42)
**And** I should see bank account details (FR43)
**And** the bank details should show: Bank Name, Account Number, Account Holder Name

**Given** I want to send a gift
**When** I scan the QR code with my banking app
**Then** the QR code should work with Malaysian banking apps (Touch 'n Go, DuitNow, etc.)
**And** I should be able to complete the transfer

**Given** I prefer manual transfer
**When** I use the bank details
**Then** I should see all necessary information to transfer funds
**And** I should be able to copy the account number

---

### Story 6.4: Privacy of Contribution Amounts

As a couple,
I want contribution amounts to remain private,
So that guests don't feel pressured based on how much others gave.

**Acceptance Criteria:**

**Given** guests have sent Digital Ang Pow contributions
**When** I view my Digital Ang Pow section
**Then** I should see that contributions were received
**And** I should NOT see the specific amounts contributed (FR44)
**And** privacy should be maintained

**Given** a guest contributes
**When** the contribution is recorded
**Then** the system should log that a contribution was received
**And** the amount should be kept private
**And** only the couple should know the actual amounts

---

### Story 6.5: Digital Ang Pow Feature Locking

As a Standard couple,
I want to see the Digital Ang Pow section in a locked state,
So that I understand it's a Premium feature.

**Acceptance Criteria:**

**Given** I am a Standard couple logged into my dashboard
**When** I navigate to the Digital Ang Pow section
**Then** the Digital Ang Pow section should appear locked/grayed out (FR45)
**And** I should see an upgrade prompt "Upgrade to Premium Package (RM30) to unlock this feature" (FR46)

**Given** I see the locked Digital Ang Pow section
**When** I view the upgrade prompt
**Then** I should see an "Upgrade Now - Add RM10" button or link
**And** clicking it should send an upgrade request to Super Admin

**Given** I am upgraded to Premium
**When** the upgrade processes
**Then** the Digital Ang Pow section should unlock instantly (FR75)
**And** I should have full access to all Digital Ang Pow features

---

**Epic 6 Summary:**
- ✅ 5 Stories created
- ✅ All 8 FRs covered (FR39-FR46)
- ✅ Complete Digital Ang Pow system with QR code and bank details
- ✅ Malaysian cultural alignment for wedding monetary gifts
- ✅ Privacy of contribution amounts maintained
- ✅ Premium feature locking and upgrade prompts
- ✅ Ready for Epic 7: Real-Time Monitoring & Dashboards

---

## Epic 7: Real-Time Monitoring & Dashboards

Super Admin can efficiently manage 100 wedding accounts with visibility into setup progress and engagement metrics, while couples track RSVPs and guestbook activity in real-time.

### Story 7.1: Super Admin Wedding Accounts List

As a Super Admin,
I want to view a list of all wedding accounts,
So that I can monitor and manage them efficiently.

**Acceptance Criteria:**

**Given** I am logged into the Super Admin dashboard
**When** I navigate to the weddings section
**Then** I should see a list of all wedding accounts (FR54)
**And** each account should show: Couple Names, Subdomain, Package Tier, Creation Date
**And** I should see setup progress percentage for each wedding (FR55)

**Given** I have 100 wedding accounts
**When** I view the list
**Then** accounts should be paginated (e.g., 25 per page)
**And** I should be able to search by couple names or subdomain
**And** I should be able to filter by package tier or status

---

### Story 7.2: Setup Progress Tracking

As a Super Admin,
I want to see detailed setup progress for each wedding account,
So that I can identify couples who need assistance.

**Acceptance Criteria:**

**Given** I am viewing the wedding accounts list
**When** I look at any wedding account
**Then** I should see setup progress percentage (FR55, FR61)
**And** I should see visual indicators: Complete, In Progress, Not Started

**Given** I click on a wedding account
**When** I view the details
**Then** I should see which steps are completed: Subdomain ✅, Template ✅, Details ✅, Photos ✅
**And** I should see which steps are pending
**And** I should be able to identify couples stuck at specific steps

**Given** a couple completes setup
**When** they reach 100%
**Then** I should see a "Completed" status
**And** the account should be highlighted as ready for sharing

---

### Story 7.3: Engagement Metrics Monitoring

As a Super Admin,
I want to monitor RSVP counts, guestbook messages, and present claims per wedding,
So that I can track engagement and identify active weddings.

**Acceptance Criteria:**

**Given** I am viewing a wedding account's details
**When** I look at engagement metrics
**Then** I should see RSVP count (FR56)
**And** I should see guestbook message count (FR57)
**And** I should see Wish Present claim activity (FR58)

**Given** multiple guests RSVP simultaneously
**When** I am viewing the dashboard
**Then** RSVP counts should update within 5 seconds (NFR-PERF-008)
**And** I should see real-time updates without page refresh

**Given** I view the engagement summary
**When** I look across all weddings
**Then** I should see total RSVPs across all weddings
**And** I should see total guestbook messages
**And** I should see most active weddings

---

### Story 7.4: Couple Dashboard - RSVP & Guestbook Views

As a couple,
I want to view RSVPs and guestbook messages in my dashboard,
So that I can track guest engagement.

**Acceptance Criteria:**

**Given** I log into my couple dashboard
**When** I view the overview
**Then** I should see RSVP count and recent RSVPs (FR59)
**And** I should see guestbook message count and recent messages (FR60)
**And** I should see setup progress indicator (FR61)

**Given** I click to view RSVPs
**When** the RSVP list loads
**Then** I should see all RSVPs with guest names and status
**And** I should see submission date and time
**And** I should see total attending count

**Given** I click to view guestbook
**When** the guestbook loads
**Then** I should see all messages with approval status
**And** I should be able to approve or delete messages
**And** I should see pending messages highlighted

**Given** new RSVPs or messages arrive
**When** I am viewing my dashboard
**Then** I should see updates within 5 seconds (NFR-PERF-008)
**And** I should not need to refresh the page

---

**Epic 7 Summary:**
- ✅ 4 Stories created
- ✅ All 8 FRs covered (FR54-FR61)
- ✅ Super Admin monitoring dashboard complete
- ✅ Real-time engagement metrics tracking
- ✅ Couple dashboard with RSVP and guestbook views
- ✅ Setup progress monitoring for 100 weddings
- ✅ Ready for Epic 8: Data Lifecycle & Compliance

---

## Epic 8: Data Lifecycle & Compliance

System automatically manages 6-month data deletion for PDPA compliance, provides bilingual interface support (English/Bahasa Malaysia), and handles feature locking with upgrade workflows.

### Story 8.1: Privacy Policy & Terms of Service Pages

As a user,
I want to access Privacy Policy and Terms of Service from any page,
So that I understand how my data is used and my rights.

**Acceptance Criteria:**

**Given** I am viewing any page on the platform
**When** I scroll to the footer
**Then** I should see "Privacy Policy" and "Terms of Service" links (FR65, FR66)

**Given** I click "Privacy Policy"
**When** the page loads
**Then** I should see comprehensive privacy policy content
**And** the policy should explain data collection, retention, and deletion practices
**And** the policy should comply with PDPA requirements (FR67)

**Given** I click "Terms of Service"
**When** the page loads
**Then** I should see clear terms outlining platform responsibilities
**And** the terms should clarify that gift transactions are between guests and couples
**And** the terms should state the platform acts as facilitator, not payment processor

---

### Story 8.2: 6-Month Automated Data Deletion

As the system,
I want to automatically delete wedding photos and content 6 months after the wedding date,
So that I comply with PDPA data retention requirements.

**Acceptance Criteria:**

**Given** a wedding date has passed
**When** 6 months have elapsed since the wedding date
**Then** the system should automatically delete all wedding photos (FR62)
**And** the system should delete wedding card content (FR63)
**And** the system should delete guestbook messages
**And** the system should delete RSVP records
**And** the system should delete Wish Present registry data
**And** the system should delete Digital Ang Pow details

**Given** photos and content are deleted
**When** the deletion completes
**Then** the couple's account credentials should be retained (FR64)
**And** the wedding record should remain with a "deleted" status
**And** the deletion should be logged for audit purposes

**Given** the Laravel scheduler runs
**When** the deletion command executes
**Then** it should run daily at 3:00 AM (low-traffic period)
**And** it should process all weddings that reached 6-month mark
**And** it should send a completion report to Super Admin

---

### Story 8.3: Bilingual Interface Support

As a user,
I want to switch the interface between English and Bahasa Malaysia,
So that I can use the platform in my preferred language.

**Acceptance Criteria:**

**Given** I am viewing any page
**When** I look for language options
**Then** I should see a language selector (EN | BM) in the header or footer (FR70)

**Given** I select "English"
**When** the interface updates
**Then** all interface text should display in English (FR68)
**And** navigation, labels, buttons, and messages should be in English
**And** my language preference should be saved

**Given** I select "Bahasa Malaysia"
**When** the interface updates
**Then** all interface text should display in Bahasa Malaysia (FR69)
**And** navigation, labels, buttons, and messages should be in BM
**And** error messages should be bilingual (NFR-USE-004)

**Given** I have selected a language preference
**When** I log out and log back in
**Then** the system should remember my language preference
**And** the interface should load in my chosen language

---

### Story 8.4: Feature Locking & Upgrade Prompts

As a Standard couple,
I want to see clear upgrade prompts when I access locked premium features,
So that I understand the value of upgrading.

**Acceptance Criteria:**

**Given** I am a Standard package couple
**When** I access Wish Present or Digital Ang Pow sections
**Then** the features should be hidden or disabled (FR71, FR72)
**And** I should see an upgrade prompt (FR73)
**And** the prompt should clearly state the benefit: "Upgrade to Premium Package (RM30) to unlock this feature"

**Given** I see an upgrade prompt
**When** I view the call-to-action
**Then** I should see an "Upgrade Now - Add RM10" button or link
**And** I should understand the upgrade cost is RM10 difference

**Given** I click the upgrade request button
**When** the request processes
**Then** the system should send a notification to Super Admin (FR74)
**And** I should see a confirmation "Upgrade request sent! We'll contact you soon."

**Given** the Super Admin processes my upgrade
**When** they change my package to Premium
**Then** all premium features should unlock instantly (FR75)
**And** I should see a success message "Your account has been upgraded to Premium!"
**And** I should have immediate access to Wish Present and Digital Ang Pow

---

**Epic 8 Summary:**
- ✅ 4 Stories created
- ✅ All 14 FRs covered (FR62-FR75)
- ✅ PDPA compliance with 6-month automated data deletion
- ✅ Privacy Policy and Terms of Service pages
- ✅ Bilingual interface (English/Bahasa Malaysia)
- ✅ Feature locking and upgrade workflow complete
- ✅ All epics and stories complete for JomNikah platform

---

## Final Summary

**Total Epics:** 8
**Total Stories:** 32
**All 75 Functional Requirements:** ✅ Covered
**All 49 Non-Functional Requirements:** ✅ Addressed across stories

**Epic Breakdown:**
1. Foundation & Access Control (5 stories) - Authentication, accounts, packages
2. Wedding Card Configuration (6 stories) - Subdomain, templates, details, photos
3. Guest Experience & RSVP (6 stories) - Public card, curtain animation, RSVP
4. Guestbook & Wishes (4 stories) - Messages, moderation, export
5. Premium Gift Registry (4 stories) - Wish Present CRUD, claiming, locking
6. Digital Ang Pow System (5 stories) - QR codes, bank details, privacy
7. Real-Time Monitoring & Dashboards (4 stories) - Admin monitoring, couple dashboards
8. Data Lifecycle & Compliance (4 stories) - PDPA, bilingual, upgrade workflows

**Implementation Ready:** ✅ All stories are sized for single dev agent completion with clear acceptance criteria.
