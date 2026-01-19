---
stepsCompleted: ['step-01-init', 'step-02-discovery', 'step-03-success', 'step-04-journeys', 'step-05-domain', 'step-06-innovation', 'step-07-project-type', 'step-08-scoping']
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

