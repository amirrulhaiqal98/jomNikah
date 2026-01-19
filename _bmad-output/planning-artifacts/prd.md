---
stepsCompleted: ['step-01-init', 'step-02-discovery', 'step-03-success', 'step-04-journeys', 'step-05-domain', 'step-06-innovation', 'step-07-project-type', 'step-08-scoping', 'step-09-functional', 'step-10-nonfunctional']
inputDocuments: ['project-proposal.md']
workflowType: 'prd'
documentCounts:
  briefs: 0
  research: 0
  brainstorming: 0
  projectDocs: 0
  other: 1
classification:
  projectType: Web Application (SPA)
  domain: General (Events/Weddings)
  complexity: Low
  projectContext: Greenfield
---

# Product Requirements Document - JomNikah

**Author:** Amirrul
**Date:** 2026-01-15

## Success Criteria

### User Success

**Primary Success Moment:**
Couples complete their full wedding card setup in **under 1 hour** (compared to weeks for physical cards involving design, printing, proofing, and postage).

**Key User Outcomes:**
- **80% of couples** complete setup within their first day
- **Time savings:** From weeks (physical card process) to <1 hour (digital configuration)
- **Real-time RSVP tracking** - Instant updates instead of waiting for manual responses
- **Guestbook wishes** - Digital memories captured, with **print to PDF** feature for physical keepsakes
- **Wish Present Registry** - Real-time claim system prevents duplicates, guests can cancel claims making items available again
- **Digital Ang Pow** - Culturally relevant for Malaysian weddings, private monetary gift collection (supports bank accounts, Touch 'n Go, DuitNow QR codes)
- **Mobile-first experience** - Optimized for guests viewing on smartphones

### Business Success

**Revenue Model:**
- **RM20 one-time fee** per couple
- Card valid for **6 months** per payment

**Targets:**
- **Initial capacity:** 100 weddings
- **Timeline:** 6-month market validation period
- **Status:** Development already complete

**Key Business Metric:**
- **80% setup completion rate** on first day (indicates product usability)
- Successful launch with first 100 wedding customers

### Technical Success

**Performance:**
- **Page load time:** <5 seconds (mobile-optimized)
- **Subdomain generation:** <5 minutes (allows manual DNS configuration)
- **Server:** Manual DigitalOcean setup (full control, no Laravel Queues)

**Capacity & Reliability:**
- **Target:** Support 100 concurrent weddings
- **No queue workers** - synchronous processing for simplicity
- **Manual server management** by owner

### Measurable Outcomes

- **80% of couples** complete full setup in <1 hour on their first day
- **Page load times** consistently under 5 seconds for mobile guests
- **100 weddings** successfully hosted on initial infrastructure
- **RM20 revenue** per couple with 6-month card validity
- **6-month runway** for market validation and iteration

## Product Scope

### MVP - Minimum Viable Product (Current - v1.0)
✅ **All features currently built:**
- Admin-led couple account creation
- Dynamic subdomain generation (e.g., sarah-ahmad.jomnikah.com)
- Template switching engine (change designs without losing data)
- RSVP tracking with real-time updates
- Guestbook with wishes
- Wish Present registry (claim system, prevent duplicates, cancel functionality)
- Digital Ang Pow (QR codes, bank details, private amounts)
- Print to PDF (guestbook and wishes)
- Mobile-first responsive design
- Super Admin dashboard
- Couple dashboard
- Public wedding card display

### Growth Features (Post-MVP - v2.0)
*To be determined after launch feedback from first 100 weddings*

### Vision (Future)
*Dream version to be defined based on market learning*

## User Journeys

### Journey 1: Couple Success Path - Sarah & Ahmad

**Opening Scene (The Pain):**
Sarah and Ahmad are 6 months from their wedding. They just received quotes for physical wedding cards - RM500-RM1000 for design, printing, and postage. They're feeling overwhelmed. They need to visit a print shop, choose from limited templates, proof and reprint if there are errors, collect guest addresses (some they don't even have!), mail everything, and track RSVPs manually through WhatsApp chaos. Wedding planning is stressful enough - this is adding more stress.

**Rising Action (The Discovery):**
They discover JomNikah through a friend's recommendation. They contact Amirrul and pay the RM20 fee. Amirrul creates their account manually. Sarah receives a WhatsApp message with her login credentials and the link to dashboard.jomnikah.com.

**The Setup Experience:**
Sarah logs in for the first time. She's greeted by a clean, simple interface. She starts customizing:
1. **Subdomain:** She types "sarah-ahmad" - system instantly checks availability ✅ (all lowercase, no special characters)
2. **Template Selection:** She browses beautiful wedding templates, picks "Rustic Elegance" (she can change this anytime!)
3. **Wedding Details:** Fills in date, time, venue, map link - all in one form
4. **Photo Upload:** She uploads 5 favorite couple photos
5. **Wish Present Registry:** She adds 5 items they'd love (blender, air fryer, dinner set, honeymoon fund, bedding)
6. **Digital Ang Pow:** She adds her bank account number and DuitNow QR code (optional feature)
7. **Preview:** She sees her card in real-time - it looks beautiful!

**Climax (The Launch):**
Total time: **47 minutes**. She copies the link https://sarah-ahmad.jomnikah.com and shares it on her WhatsApp status, family group, and Instagram story. She sends RM20 payment receipt to Amirrul. Done!

**Resolution (The Stress Relief):**
- Guests start RSVPing immediately - she sees real-time updates
- Wishes pour in: "Mazbahar!" "So happy for you both!"
- Guestbook fills with heartfelt messages
- Auntie Fatimah claims the blender (no duplicates!)
- Digital Ang Pow contributions come in privately
- Sarah can **print to PDF** all wishes and guestbook entries for keepsake
- **She saved RM800+ and weeks of stress** - one less thing to worry about

**Emotional Arc:** Stressed → Curious → Empowered → Relieved → Grateful

---

### Journey 2: Super Admin Account Creation - Amirrul

**Opening Scene (The Opportunity):**
Amirrul receives a WhatsApp message from an engaged couple: "Hi! We saw your JomNikah service, we're interested!" They've discussed pricing and agreed on RM20. Amirrul is ready to onboard another couple.

**Rising Action (The Setup):**
- Amirrul logs into admin.jomnikah.com
- Navigates to "Wedding Manager" dashboard
- Clicks "Create New Wedding Account"
- Fills in the form:
  - Couple's names: "Siti & Rahim"
  - Contact: "siti@gmail.com" (or phone number)
  - Creates secure password for them: "wedding123!"
- Clicks "Create Account"
- System validates and confirms account created
- **Amirrul does NOT choose subdomain or template** - that's for the couple to personalize

**Climax (The Personal Handoff):**
- Amirrul copies the login link
- Sends a personal WhatsApp message:
  "Hi Siti! Your account is ready 🎉
  Login: dashboard.jomnikah.com
  Email: siti@gmail.com
  Password: wedding123!

  Log in, choose your subdomain, pick a template you love, and customize your card! Let me know if you need help 😊"

**Resolution (The Monitoring):**
- Back in his dashboard, Amirrul sees "Siti & Rahim" in his wedding list
- He can monitor: setup progress, RSVP counts, wishes received, presents claimed
- System shows: "Setup completed: 85% (just needs subdomain confirmation)"
- He tracks his progress toward 100-wedding target
- Everything is performing smoothly - pages loading in <3 seconds

**Emotional Arc:** Helpful → Efficient → Proud → Accomplished

---

### Journey 3: Guest Experience - Auntie Fatimah

**Opening Scene (The Invitation):**
Auntie Fatimah (60 years old) receives a WhatsApp from her niece Sarah. She's excited to attend another family wedding! The message says: "We're getting married! View our wedding digital card at: https://sarah-ahmad.jomnikah.com"

**Rising Action (The Experience):**
- She taps the link on her smartphone (mobile-first design!)
- A beautiful "Curtain Animation" appears: "Tap to Open Their Wedding Card" ✨
- She taps - the curtain opens dramatically
- She sees:
  - Sarah & Ahmad's photo - they look so happy!
  - Wedding date: 15 December 2025
  - Countdown: "42 days to go!"
  - Venue map with directions
  - Photo gallery preview

**The RSVP:**
- She scrolls down and sees "RSVP Section"
- Two options:
  1. WhatsApp them directly
  2. Fill RSVP form
- She prefers WhatsApp - taps the button, opens chat: "I'll be there! Mazbahar!"
- System logs her RSVP immediately

**The Wish Present Claim:**
- She continues scrolling - sees "Wish Present Registry"
- Browses items: Air fryer (claimed), Blender (available!), Dinner set (available)
- She wants to give the blender - clicks "Claim"
- **System prompts:** "Enter your email or phone number"
- She types: "012-3456789"
- **Present updates:** "Blender - Claimed by 012-3456789" ✅
- **Delivery details appear:**
  - Couple's Name: Sarah & Ahmad
  - Couple's Phone: 013-9876543
  - Couple's Address: 123 Jalan Wedding, Taman Damai, 56000 Kuala Lumpur
- **She chooses:** "Order online" - She'll buy from Shopee and ship to their address
- She makes a note to buy it next week

**The Digital Ang Pow:**
- She sees "DuitNow QR" section
- She scans the QR code with her TnGo app
- Or she can see: "Maybank Account: 123456789023 (Amirul Bin Ahmad)"
- She sends RM100 as a wedding gift

**The Guestbook:**
- She types her message: "Alhamdulillah, I'm so happy for both of you. May your marriage be blessed with love and happiness. Mazbahar! ❤️ - Auntie Fatimah"
- Clicks "Submit Wish"
- Message appears (after couple approval)

**Climax (The Completion):**
- Auntie Fatimah has done everything in 5 minutes
- She didn't need to:
  - Buy a physical card
  - Go to the bank
  - Call anyone
  - Mail anything

**Resolution (The Connection):**
- She feels connected and included
- Everything was easy - even on her phone
- Sarah & Ahmad will see her RSVP, wish, gift claim, and Ang Pow
- She feels good about contributing to their special day

**Emotional Arc:** Excited → Delighted → Generous → Connected → Satisfied

---

### Journey 4: Couple Error Recovery - Sarah's Experience with Frontend Validation

**Opening Scene (The Prevention):**
It's 11:30 PM. Sarah is uploading her favorite couple photo. She selects a large 5MB photo from her phone.

**Rising Action (The Smart Validation):**
- She clicks "Upload"
- **Frontend validates instantly** - before the file even reaches the server
- **Clear message appears:** "This photo is 5.2MB. Please choose a photo under 2MB for best performance."
- The file input field highlights in red
- A helpful tooltip appears: "Tip: Use your phone's photo settings to reduce file size, or take a new photo with 'High Quality' instead of 'Max Quality' setting"

**The Solution (Self-Service):**
- Sarah understands immediately - she doesn't need to contact anyone
- She picks a different photo - 1.8MB ✅
- Or she uses her phone's built-in photo compression
- Uploads again - **success!** Green checkmark appears

**Smooth Completion:**
- She continues with other photos - each validates in real-time
- No errors, no frustration, no waiting
- Finishes setup in 47 minutes total
- Everything works smoothly

**Resolution (The Empowered User):**
- Sarah feels capable - the system guided her
- No need to WhatsApp Amirrul for simple questions
- Clear validation messages prevent issues before they happen
- She completes her setup independently and successfully

**Emotional Arc:** Confident → Guided → Empowered → Successful

---

### Journey Requirements Summary

These journeys reveal the following capability requirements:

**For Couple Success Path:**
- **Onboarding:** Manual account creation by admin with credential delivery
- **Subdomain Management:** Real-time availability checking, validation rules (lowercase, no special chars)
- **Template System:** Multiple wedding templates, instant switching without data loss
- **Content Management:** Wedding details form, photo gallery upload (<2MB limit), live preview
- **Wish Present Registry:** CRUD operations for gift items, claim tracking with guest contact info, delivery details display
- **Digital Ang Pow:** QR code upload, bank account details, private amount tracking
- **RSVP Tracking:** Real-time RSVP list with guest information
- **Guestbook Moderation:** Message approval workflow before public display
- **Export:** Print to PDF functionality for wishes and guestbook

**For Super Admin:**
- **Account Management:** Create couple accounts (email/phone + password)
- **Wedding Dashboard:** View all weddings, track setup progress, monitor RSVPs/wishes/presents
- **System Monitoring:** Performance tracking, page load times, uptime
- **Support:** Password resets, troubleshooting assistance

**For Guest Experience:**
- **Public Card Display:** Mobile-first responsive design, curtain animation, fast loading (<5 seconds)
- **RSVP Interface:** WhatsApp redirect or form-based RSVP
- **Present Claiming:** Email/phone number entry, claim status updates, delivery details, cancel/reclaim functionality
- **Digital Ang Pow:** QR code display, bank details for monetary gifts
- **Guestbook:** Public message submission with moderation indicator

**For Error Recovery:**
- **Frontend Validation:** Real-time file size checking (<2MB), format validation, clear error messages, helpful guidance
- **Self-Service UX:** Prevent issues proactively so users can solve problems independently
- **Data Persistence:** Save progress to prevent data loss during errors
- **Validation Feedback:** Real-time validation for subdomains, form inputs

## Domain-Specific Requirements

### Compliance & Regulatory

**Privacy Policy (PDPA Compliance):**
- Platform must display and maintain a comprehensive Privacy Policy
- Collect personal data (names, phone numbers, emails, addresses) with consent
- Clearly state data retention period and deletion policies
- Provide contact information for data-related inquiries

**Terms of Service:**
- Define platform responsibilities and limitations
- Clarify that gift transactions (Digital Ang Pow, present delivery) are between guests and couples
- Platform acts as facilitator, not payment processor or shipping intermediary

### Technical Constraints

**Data Retention & Deletion:**
- **Card validity period: 6 months**
- **Photo storage:** Automatically delete all wedding photos 6 months after wedding date
- **Content cleanup:** Remove wedding card, guestbook, and present registry after 6 months
- **Couple data:** Retain account credentials for longer period (for statistics/re-use)

**Data Export:**
- **Guestbook Export:** Couples can download all guestbook messages in Excel format
- Export includes: guest name, message, date/time submitted
- Available anytime during the 6-month active period
- **Print to PDF:** Additional option for physical keepsakes

### Security & Privacy

**Personal Information Protection:**
- Couple's address and phone number only visible to guests who claim presents
- Bank account numbers and QR codes for Digital Ang Pow displayed publicly (monetary gifts)
- Guest contact information (email/phone) stored only when claiming presents

**Content Moderation:**
- Couples have full control: can delete any guestbook message
- Optional approval workflow before messages appear publicly
- No automated profanity filter (manual moderation by couple)

### Cultural Considerations

**Malaysian Wedding Context:**
- Templates support multicultural wedding styles (Malay, Chinese, Indian, modern)
- Language options: English and Bahasa Malaysia
- Digital Ang Pow aligns with Malaysian gift-giving culture
- Mobile-first design suits Malaysian smartphone usage patterns

### Risk Mitigations

**Data Privacy Risks:**
- Auto-deletion after 6 months limits long-term data exposure
- Privacy policy establishes legal compliance framework
- Export functionality allows couples to keep memories before deletion

**Content Moderation Risks:**
- Couple-controlled deletion prevents inappropriate content
- Optional approval workflow prevents spam/offensive messages

**Financial Transaction Risks:**
- Terms of Service clarify platform is not payment processor
- Gift delivery arrangements are between guests and couples
- No payment disputes handled by platform


## Web Application Specific Requirements

### Project-Type Overview

JomNikah is a **Single Page Application (SPA)** built with **Vue 3 + Inertia.js + Laravel 12**, providing a smooth, app-like experience without full page reloads. The platform serves two distinct user experiences:
- **Authenticated dashboards** (Super Admin, Couple) - Protected, interactive admin interfaces
- **Public wedding cards** - Guest-facing, mobile-optimized landing pages per wedding

### Technical Architecture Considerations

**Browser Matrix**

**Primary Support (Fully Tested):**
- **Mobile Browsers:**
  - Chrome Mobile (Android, last 2 versions)
  - Safari iOS (iOS 14+)
- **Desktop Browsers:**
  - Chrome (Windows/Mac, last 2 versions)
  - Safari (macOS, last 2 versions)
  - Edge (Windows, last 2 versions)

**Out of Scope:**
- Internet Explorer (any version)
- Older Android browsers (< Chrome 90)
- Legacy mobile browsers

**Rationale:** Malaysian smartphone users predominantly use modern Android or iOS devices with current browsers. This focus ensures optimal performance for 95%+ of guests while maintaining reasonable development overhead.

**Responsive Design**

**Mobile-First Strategy:**
- **Primary target:** Mobile devices (smartphones) - 80%+ of guest traffic
- **Secondary target:** Tablets - Adaptive layout for 768px-1024px screens
- **Tertiary target:** Desktop - Full-featured layout for 1024px+ screens

**Breakpoint Strategy:**
- **Mobile:** < 640px (core experience, simplified layout)
- **Tablet:** 640px - 1024px (adjusted spacing, grid layouts)
- **Desktop:** > 1024px (multi-column layouts, enhanced features)

**Mobile-Optimization Priorities:**
- Touch-friendly buttons (min 44px tap targets)
- Simplified navigation (minimal UI chrome)
- Optimized forms (appropriate input types, numeric keypads for phone numbers)
- Fast loading on mobile networks (4G/5G, degraded gracefully on 3G)
- Vertical scrolling orientation (primary use case)

**Performance Targets**

**Page Load Performance:**
- **Target:** <5 seconds initial page load on mobile (4G connection)
- **Measurement:** Largest Contentful Paint (LCP) < 5 seconds
- **Images:** <2MB per photo with lazy loading for galleries
- **JavaScript:** Bundle size optimization, code splitting by route
- **CSS:** Tailwind CSS with purging of unused styles

**Interactive Performance:**
- **Time to Interactive (TTI):** <3 seconds after initial load
- **First Input Delay (FID):** <100 milliseconds
- **Cumulative Layout Shift (CLS):** <0.1 (minimal layout jank)

**Subdomain Performance:**
- Each wedding subdomain loads within same performance targets
- No performance degradation with 100 concurrent weddings
- Static asset caching via CDN (optional optimization)

**Real-Time Features:**
- **Live Countdown Timer:** JavaScript-based, updates every second without page refresh
- No WebSockets or server push required (countdown is client-side calculation)
- Optional: Poll-based updates for RSVP/Guestbook if couples want "live" dashboard

**SEO Strategy**

**Public Wedding Cards:**
- **No SEO optimization required** - Cards are shared via direct links (WhatsApp, social media)
- Subdomain URLs (sarah-ahmad.jomnikah.com) serve as direct access points, not search discovery
- Meta tags present for social sharing (Open Graph, Twitter Cards) but not search ranking

**Rationale:**
- Wedding cards are private events, not public content
- Traffic comes from direct sharing, not organic search
- Guest privacy prioritized over search discoverability
- Saves development effort on SEO (no sitemaps, structured data, schema markup)

**Authentication Pages:**
- **Admin/Couple dashboards:** Noindex, nofollow (password-protected, not for public indexing)
- Login pages accessible via direct links only

**Optional Future Enhancement:**
- SEO-optimized marketing landing page (jomnikah.com) for business discovery (separate from wedding subdomains)

**Accessibility Level**

**Target Audience Accessibility:**
- **Standard:** "Good enough for typical users" - No strict WCAG compliance required
- **Focus:** Usability for non-technical users (elderly guests like Auntie Fatimah)
- **Language:** Bahasa Malaysia and English support

**Accessibility Features:**
- **Readable fonts:** Minimum 16px base font size on mobile
- **Color contrast:** WCAG AA ratio for text readability (4.5:1 normal text, 3:1 large text)
- **Touch targets:** Minimum 44x44px buttons (iOS/Android guidelines)
- **Form labels:** Clear input labels and placeholders
- **Error messages:** Helpful validation messages in simple language
- **Keyboard navigation:** Basic keyboard support for desktop users

**Out of Scope:**
- Screen reader optimization (not required for target audience)
- Full keyboard navigation for complex workflows
- WCAG 2.1 Level AAA compliance
- Multi-language screen reader support

**Rationale:** Target users are tech-comfortable enough for standard web interactions but appreciate clear, simple interfaces. Accessibility focuses on usability rather than strict compliance.

### Implementation Considerations

**Frontend Validation:**
- **Photo upload:** <2MB file size validation on client-side before upload
- **Subdomain availability:** Real-time AJAX checking as user types
- **Form validation:** Immediate feedback on required fields, email formats, phone numbers
- **Error messaging:** Clear, actionable error messages in user's language (BM/English)

**Live Countdown Timer:**
- **JavaScript-based:** Calculates remaining time from wedding date
- **Updates every second:** No page refresh needed
- **Timezone awareness:** Displays countdown in user's local timezone
- **Zero-state:** Shows "Wedding completed!" message after event passes

**Progressive Enhancement:**
- **JavaScript required:** Platform assumes JS enabled (modern web app)
- **Graceful degradation:** Photos still load if JS fails (basic HTML fallback)
- **Offline support:** Not required (no PWA features in MVP)

**Caching Strategy:**
- **Static assets:** Long-term caching for CSS/JS bundles
- **Images:** Browser caching with CDN optimization (optional)
- **Dynamic content:** No caching for authenticated dashboards
- **Public cards:** Short-term caching (5-15 minutes) to balance freshness vs performance


## Project Scoping & Phased Development

### MVP Strategy & Philosophy

**MVP Approach:** Experience-Plus MVP - Solve the core pain (expensive physical cards) while delighting users with smooth UX and flexible pricing tiers

**Current Status:** Development complete, launching with packaged pricing model

**Resource Requirements:**
- Solo developer (Amirrul as owner/operator)
- DigitalOcean droplet hosting
- Manual server management and customer support
- Target: 100 weddings for initial validation

**Business Model:**
- **Tiered pricing:** RM20 Standard vs RM30 Premium
- **One-time fee:** No recurring revenue (6-month card validity)
- **Manual onboarding:** Super Admin creates all accounts
- **Upgrade path:** RM10 difference to unlock premium features

### MVP Feature Set (Phase 1) - CURRENT VERSION

**Core User Journeys Supported:**
- ✅ Couple Success Path (Sarah & Ahmad) - Full setup in <1 hour
- ✅ Super Admin Account Creation (Amirrul) - Manual account provisioning with package selection
- ✅ Guest Experience (Auntie Fatimah) - Mobile-first card viewing, RSVP, guestbook
- ✅ Couple Error Recovery - Frontend validation, self-service UX

**Must-Have Capabilities (All Packages):**

**Authentication & Access Control:**
- Spatie Permission-based roles (super-admin, couple)
- Manual account creation by Super Admin
- Package assignment at account creation (Standard/Premium)
- Secure password management

**Core Card Features (Standard & Premium):**
- Dynamic subdomain generation (e.g., sarah-ahmad.jomnikah.com)
- Real-time subdomain availability checking
- Template switching engine (change designs without losing data)
- Wedding details management (date, time, venue, map)
- Photo gallery upload (<2MB limit, frontend validation)
- Live countdown timer (JavaScript-based, updates every second)
- Mobile-first responsive design
- Curtain animation (tap to open)

**Guest Interaction Features (Standard & Premium):**
- RSVP tracking (WhatsApp redirect + form-based)
- Real-time RSVP list for couples
- Guestbook with message submission
- Guestbook moderation (approve/delete messages)
- Print to PDF (guestbook and wishes)
- Export to Excel (guestbook messages)

**Admin & Management (Standard & Premium):**
- Super Admin dashboard (wedding manager, create accounts)
- Couple dashboard (edit details, view RSVPs, manage guestbook)
- Package-based feature locking
- Setup progress tracking
- System monitoring (RSVPs, wishes, performance)

**Premium Features (RM30 Package Only):**
- ✅ **Wish Present Registry** - CRUD operations, claim tracking with guest contact info, delivery details, prevent duplicates, cancel/reclaim functionality
- ✅ **Digital Ang Pow** - QR code upload, bank account details, private monetary gift collection
- ✅ **Feature locking/unlocking** by Super Admin

**Technical & Non-Functional (All Packages):**
- Page load <5 seconds (mobile-optimized)
- Subdomain generation <5 minutes
- Support for 100 concurrent weddings
- 6-month data retention with auto-deletion
- Privacy Policy and Terms of Service
- Frontend validation (file size, subdomain availability)
- Bahasa Malaysia & English language support

**Explicitly Out of Scope for MVP:**
- No self-service registration (admin-led onboarding only)
- No automated emails (manual WhatsApp/Telegram communication)
- No payment processing integration (manual payment via bank transfer)
- No API for third-party integrations
- No mobile apps (web-only)
- No PWA/offline functionality
- No advanced analytics (basic metrics only)

### Post-MVP Features

**Phase 2 (Post-Launch - After First 100 Weddings):**

*To be determined based on user feedback and market validation*

**Potential Growth Features:**
- Automated email notifications (RSVP confirmations, reminders)
- Payment gateway integration (FPX, credit card)
- Self-service registration (optional, alongside manual onboarding)
- Analytics dashboard (engagement metrics, popular templates)
- Template marketplace (more design options)
- Video messages from guests
- Photo album expansion (more photos, better gallery)
- Couple collaboration features (both partners can edit)

**Phase 3 (Expansion - Future):**

*Dream version to be defined based on market learning*

**Potential Platform Features:**
- Wedding vendor directory integration
- Multi-language support (Chinese, Tamil)
- White-label solution for wedding planners
- API for third-party integrations
- Mobile apps (iOS/Android)
- Advanced analytics and insights
- Community features (forums, tips)

### Package & Pricing Strategy

**Standard Package - RM20 (One-Time):**

**Target:** Budget-conscious couples who want digital convenience without gift management

**Included Features:**
- Full wedding card customization
- RSVP tracking and management
- Guestbook with wishes
- Photo gallery
- Template switching
- Print to PDF + Excel export
- Mobile-first experience
- 6-month card validity

**Excluded Features:**
- ❌ Wish Present registry
- ❌ Digital Ang Pow

**Upgrade Path:** Can add Premium features later for RM10 additional

---

**Premium Package - RM30 (One-Time):**

**Target:** Couples who want complete digital wedding experience with gift management

**Included Features:**
- **ALL Standard features**
- **PLUS:**
  - Wish Present registry (claim system, guest contact info, delivery details)
  - Digital Ang Pow (QR codes, bank details, private monetary gifts)
  - Premium feature access for 6 months

**Value Proposition:** Extra RM10 for comprehensive gift and monetary management features

---

**Feature Locking Implementation:**

**Super Admin Controls:**
- **Package Selection:** Dropdown during account creation (Standard/Premium)
- **Feature Unlocking:** Checkbox to enable/disable Wish Present and Digital Ang Pow independently
- **Upgrade Handling:** Change package from Standard → Premium, system unlocks features

**Couple Dashboard Experience:**
- **Standard Couples:** See Wish Present and Digital Ang Pow sections in dashboard
  - Sections appear **locked/grayed out**
  - Message displayed: "Upgrade to Premium Package (RM30) to unlock this feature"
  - Call-to-action button: "Upgrade Now - Add RM10"
  - Clicking upgrade sends notification to Super Admin
- **Premium Couples:** Full access to all features with no restrictions

**Upgrade Workflow:**
1. Couple clicks "Upgrade Now" in dashboard
2. System sends notification to Super Admin (WhatsApp/email)
3. Super Admin processes RM10 payment
4. Super Admin changes couple package to Premium in admin dashboard
5. System instantly unlocks Wish Present and Digital Ang Pow features
6. Couple receives confirmation and can immediately use premium features

### Risk Mitigation Strategy

**Technical Risks:**

**Risk:** Subdomain routing issues with 100+ weddings
**Mitigation:** Manual Nginx configuration testing, wildcard SSL certificate, gradual rollout

**Risk:** Page load performance degrades with photo-heavy cards
**Mitigation:** Frontend validation (<2MB limit), lazy loading for galleries, CDN optimization (if needed)

**Risk:** Data deletion after 6 months removes valuable memories
**Mitigation:** Export functionality (PDF + Excel), reminder notifications before expiry, optional renewal

**Market Risks:**

**Risk:** Couples unwilling to pay for digital wedding cards
**Mitigation:** Strong value proposition (save RM800+ vs physical cards), low entry price (RM20), social proof through first 100 weddings

**Risk:** Competitors copy the model and undercut pricing
**Mitigation:** Focus on user experience (easy setup, mobile-first), personalized service (manual onboarding), Malaysian cultural features (Digital Ang Pow)

**Risk:** Low upgrade rate from Standard to Premium
**Mitigation:** Visible locked features create desire, targeted messaging about gift management benefits, upgrade path is frictionless (RM10 difference)

**Resource Risks:**

**Risk:** Solo developer overwhelmed by support requests
**Mitigation:** Frontend validation prevents common errors, clear documentation, limit to 100 weddings initially, automated FAQ

**Risk:** DigitalOcean server management complexity
**Mitigation:** Manual setup gives full control, no queue workers simplifies architecture, synchronous processing easier to debug

**Risk:** Time constraints for manual account creation
**Mitigation:** Streamlined admin dashboard, quick account creation process (<5 minutes per couple), scale support resources with revenue


## Functional Requirements

### Account & Package Management

- **FR1:** Super Admin can create new couple accounts with email/phone and password
- **FR2:** Super Admin can assign package tier (Standard or Premium) during account creation
- **FR3:** Super Admin can independently enable or disable Wish Present feature per couple
- **FR4:** Super Admin can independently enable or disable Digital Ang Pow feature per couple
- **FR5:** Super Admin can upgrade couple from Standard to Premium package
- **FR6:** Couples can log in to their dashboard using credentials provided by Super Admin
- **FR7:** Couples can request package upgrade through their dashboard

### Wedding Card Configuration

- **FR8:** Couples can define unique subdomain for their wedding card
- **FR9:** System can validate subdomain availability in real-time during subdomain creation
- **FR10:** System can enforce subdomain format rules (lowercase, no special characters)
- **FR11:** Couples can select wedding template from available options
- **FR12:** Couples can switch templates without losing previously entered data
- **FR13:** Couples can enter wedding details (date, time, venue, location map)
- **FR14:** Couples can upload photos to photo gallery
- **FR15:** System can validate photo file size before upload (<2MB limit)

### Guest RSVP Management

- **FR16:** Guests can RSVP through WhatsApp redirect
- **FR17:** Guests can RSVP through web form
- **FR18:** Couples can view real-time RSVP list
- **FR19:** System can track RSVP submission date and time
- **FR20:** System can display RSVP count and status in couple dashboard

### Guestbook & Wishes

- **FR21:** Guests can submit messages to couple's guestbook
- **FR22:** System can require guestbook message approval before public display
- **FR23:** Couples can approve guestbook messages
- **FR24:** Couples can delete any guestbook message
- **FR25:** System can display guestbook approval status to guests
- **FR26:** Couples can export guestbook messages to Excel format
- **FR27:** Couples can export guestbook messages to PDF format

### Premium Features - Wish Present Registry

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

### Premium Features - Digital Ang Pow

- **FR39:** Premium couples can upload QR code image for Digital Ang Pow
- **FR40:** Premium couples can add bank account details for Digital Ang Pow
- **FR41:** Premium couples can specify bank name for displayed account details
- **FR42:** Guests can view QR code for Digital Ang Pow contributions
- **FR43:** Guests can view bank account details for Digital Ang Pow contributions
- **FR44:** System can maintain privacy of Ang Pow contribution amounts
- **FR45:** Standard couples can view Digital Ang Pow section in locked state
- **FR46:** System can display upgrade prompt when Standard couples access locked Digital Ang Pow features

### Public Wedding Card Display

- **FR47:** Guests can view wedding card through unique subdomain URL
- **FR48:** System can display curtain animation with tap-to-open interaction
- **FR49:** System can display wedding countdown timer that updates in real-time
- **FR50:** System can display photo gallery on public wedding card
- **FR51:** System can display wedding details (names, date, time, venue, map)
- **FR52:** System can display RSVP section on public wedding card
- **FR53:** System can display guestbook section on public wedding card

### Admin & Monitoring

- **FR54:** Super Admin can view list of all wedding accounts
- **FR55:** Super Admin can view setup progress for each wedding account
- **FR56:** Super Admin can monitor RSVP counts per wedding
- **FR57:** Super Admin can monitor guestbook message count per wedding
- **FR58:** Super Admin can monitor Wish Present claim activity per wedding
- **FR59:** Couples can view RSVP list in their dashboard
- **FR60:** Couples can view guestbook messages in their dashboard
- **FR61:** System can track setup completion percentage for couples

### Data Management & Privacy

- **FR62:** System can automatically delete wedding photos 6 months after wedding date
- **FR63:** System can automatically delete wedding card content 6 months after wedding date
- **FR64:** System can retain couple account credentials beyond 6-month period
- **FR65:** System can display Privacy Policy to users
- **FR66:** System can display Terms of Service to users
- **FR67:** System can comply with personal data protection requirements

### Multi-Language Support

- **FR68:** System can display interface in English language
- **FR69:** System can display interface in Bahasa Malaysia language
- **FR70:** Users can switch between English and Bahasa Malaysia

### Feature Locking & Upgrade

- **FR71:** System can hide Wish Present functionality from Standard couples
- **FR72:** System can hide Digital Ang Pow functionality from Standard couples
- **FR73:** System can display upgrade prompts for locked premium features
- **FR74:** System can send upgrade request notifications to Super Admin
- **FR75:** System can instantly unlock premium features when package is upgraded


## Non-Functional Requirements

### Performance

**Page Load Performance:**
- **NFR-PERF-001:** Public wedding card pages must load within 5 seconds on 4G mobile connections
- **NFR-PERF-002:** Initial Time to Interactive (TTI) for couple dashboard must be within 3 seconds on desktop
- **NFR-PERF-003:** Photo gallery images must display progressively with lazy loading
- **NFR-PERF-004:** Subdomain lookup validation must complete within 2 seconds during typing

**Concurrent User Performance:**
- **NFR-PERF-005:** System must support 100 concurrent weddings without performance degradation
- **NFR-PERF-006:** System must handle 50 concurrent guests viewing the same wedding card without slowdown

**Real-Time Features:**
- **NFR-PERF-007:** Countdown timer must update every second without page refresh
- **NFR-PERF-008:** RSVP submissions must reflect in couple dashboard within 5 seconds

### Security

**Data Protection:**
- **NFR-SEC-001:** All passwords must be hashed using bcrypt or Argon2 before storage
- **NFR-SEC-002:** User sessions must use secure HTTP-only cookies
- **NFR-SEC-003:** Couple bank account numbers and QR codes must be stored securely in database
- **NFR-SEC-004:** Guest contact information (email/phone) must be encrypted at rest

**Access Control:**
- **NFR-SEC-005:** Super Admin dashboard must require authentication with super-admin role
- **NFR-SEC-006:** Couple dashboards must require authentication and role-based access to their own data only
- **NFR-SEC-007:** Guests must not access admin or couple dashboard areas
- **NFR-SEC-008:** Standard package couples must not access locked premium features

**Data Privacy (PDPA Compliance):**
- **NFR-SEC-009:** System must display Privacy Policy accessible from all pages
- **NFR-SEC-010:** System must obtain implicit consent for data collection through service use
- **NFR-SEC-011:** System must automatically delete wedding data (photos, content) 6 months after wedding date
- **NFR-SEC-012:** System must retain account credentials separately from wedding data

**Input Validation:**
- **NFR-SEC-013:** All user inputs must be sanitized to prevent XSS attacks
- **NFR-SEC-014:** File uploads must be validated for type and size before processing
- **NFR-SEC-015:** Subdomain inputs must be validated to prevent SQL injection

**Transmission Security:**
- **NFR-SEC-016:** All authenticated connections must use HTTPS (TLS 1.2+)
- **NFR-SEC-017:** Sensitive data (bank details, contact info) must be transmitted over encrypted connections

### Scalability

**Current Capacity:**
- **NFR-SCALE-001:** System must support 100 active wedding subdomains
- **NFR-SCALE-002:** System must support 1 Super Admin and 100 Couple accounts simultaneously
- **NFR-SCALE-003:** System must support 500 guest RSVPs per wedding without performance degradation

**Growth Planning:**
- **NFR-SCALE-004:** System architecture must allow manual addition of server resources (DigitalOcean droplet upgrade)
- **NFR-SCALE-005:** Database must handle 10,000 guestbook messages across all weddings
- **NFR-SCALE-006:** File storage must accommodate 5,000 photos (100 weddings × 50 photos each)

**Performance Under Load:**
- **NFR-SCALE-007:** Page load times must not exceed 7 seconds during peak wedding weekend traffic
- **NFR-SCALE-008:** System must not crash when 20 guests simultaneously RSVP to the same wedding

### Reliability

**System Availability:**
- **NFR-REL-001:** System must maintain 95% uptime during active wedding periods (weekends)
- **NFR-REL-002:** System must support manual server restarts during low-traffic periods (weekday nights)

**Data Integrity:**
- **NFR-REL-003:** RSVP submissions must not be lost due to server errors
- **NFR-REL-004:** Guestbook messages must be saved atomically (complete or not at all)
- **NFR-REL-005:** Photo uploads must validate before saving to prevent corruption

**Error Handling:**
- **NFR-REL-006:** System must display user-friendly error messages for all failure scenarios
- **NFR-REL-007:** System must log all errors for Super Admin review
- **NFR-REL-008:** Frontend validation must prevent common user errors before server submission

### Usability

**Mobile Usability:**
- **NFR-USE-001:** All primary user actions must be completable on mobile devices (smartphones)
- **NFR-USE-002:** Touch targets (buttons, links) must be minimum 44×44 pixels for mobile interaction
- **NFR-USE-003:** Text must be minimum 16px base font size on mobile for readability

**User Interface Clarity:**
- **NFR-USE-004:** Error messages must be clear and actionable in user's language (English/BM)
- **NFR-USE-005:** Form inputs must provide immediate validation feedback
- **NFR-USE-006:** Locked premium features must display upgrade prompts clearly

**Navigation:**
- **NFR-USE-007:** Users must be able to complete wedding card setup within 1 hour
- **NFR-USE-008:** Super Admin must be able to create new couple account within 5 minutes

