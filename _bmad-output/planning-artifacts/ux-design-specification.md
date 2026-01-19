---
stepsCompleted: [1, 2, 3]
inputDocuments: ['prd.md', 'project-proposal.md', 'implementation-readiness-report-2026-01-19.md']
documentCounts:
  briefs: 0
  research: 1
  projectDocs: 1
  other: 1
workflowType: 'ux-design'
---

# UX Design Specification - JomNikah

**Author:** Amirrul
**Date:** 2026-01-19

---

## Executive Summary

### Project Vision

JomNikah is a Managed Digital Wedding Platform that modernizes Malaysian wedding invitations by replacing expensive physical cards (RM500-RM1000) with affordable digital alternatives (RM20-30). The platform reduces setup time from weeks to under one hour while adding real-time RSVP tracking and gift management features.

**Key Differentiators from UX Perspective:**
1. **Managed Service Model** - Admin-led onboarding ensures quality control and personal touch
2. **Culturally-Aligned Features** - Digital Ang Pow honors Malaysian wedding gift-giving traditions
3. **Mobile-First Experience** - Optimized for 80%+ of guests viewing on smartphones
4. **Template Flexibility** - Couples can switch designs instantly without losing data
5. **Real-Time Connection** - Instant RSVP tracking and guestbook wishes create emotional immediacy

**Technical Foundation:** Single Page Application (Vue 3 + Inertia.js + Laravel 12) with mobile-first responsive design, supporting 100 concurrent weddings with <5 second page load times on mobile 4G connections.

### Target Users

**Primary Users: Malaysian Engaged Couples (Aged 25-35)**
- **Tech Comfort:** Comfortable with technology but need guidance and reassurance
- **Emotional State:** Stressed from wedding planning, seeking convenience and cost savings
- **Goals:** Complete wedding card setup in <1 hour, save RM800+ vs physical cards, feel confident and prepared
- **Context:** Setting up cards after work, late nights, tired - need calming, supportive experience
- **Success Metric:** 80% complete setup on first day

**Secondary Users: Wedding Guests (All Ages, 20-70 years old)**
- **Tech Comfort:** Wide range - from tech-savvy youth to elderly needing simple, guided experiences
- **Emotional State:** Excited to celebrate, want to show they care, pressed for time
- **Goals:** RSVP easily, leave heartfelt wishes, give gifts (registry or digital ang pow), feel included
- **Context:** On-the-go viewing (in car, waiting, breaks), using smartphones on mobile data
- **Success Metric:** Complete RSVP + wish + gift in <5 minutes

**Tertiary Users: Super Admin (Solo Developer/Owner)**
- **Role:** Amirrul as platform owner/operator
- **Goals:** Create accounts quickly (<5 min), monitor wedding success, provide excellent support
- **Context:** Manual onboarding via WhatsApp, managing 100 weddings during validation phase

### Key Design Challenges

**1. Stress-Free Setup Experience (Couple Emotional Journey)**
- **Challenge:** Wedding planning is overwhelming. The card setup experience must feel calming, supportive, and NOT like "another task on the checklist"
- **UX Requirements:**
  - Clear progress indication with milestones ("85% complete - Almost there!")
  - Gentle guidance with celebration moments for each section completion
  - Helpful, kind error messages that prevent frustration
  - Frontend validation that feels like assistance, not restriction
- **Technical Constraints:** <2MB photo upload limit must be communicated helpfully, not punitively

**2. Cross-Generational Usability (Guest Emotional Journey)**
- **Challenge:** Guests range from 20-70 years old with varying tech comfort. Elderly guests like Auntie Fatimah (60) need to feel confident, not frustrated
- **UX Requirements:**
  - Mobile-first design with thumb-friendly touch targets (minimum 44×44 pixels)
  - Readable fonts (minimum 16px base size on mobile)
  - Simple, clear language (English and Bahasa Malaysia)
  - Unambiguous call-to-action buttons
  - Forgiving interface that prevents errors
- **Technical Constraints:** <5 second page load on 4G, progressive enhancement for graceful degradation

**3. Emotional Connection Through Digital Medium**
- **Challenge:** Digital cards can feel impersonal compared to physical cards. How to create warmth and emotional resonance?
- **UX Requirements:**
  - Ritualistic "curtain animation" that creates anticipation (tap to open card)
  - Personal photo display that highlights couple's happiness
  - Countdown timer that builds excitement
  - Guestbook that captures emotional messages
  - Design that feels celebratory and special, not generic
- **Cultural Considerations:** Digital Ang Pow must balance convenience with cultural privacy norms

**4. Managed Service Personal Touch**
- **Challenge:** Manual onboarding by Admin could feel bureaucratic. How to maintain warmth at scale?
- **UX Requirements:**
  - Warm, personalized WhatsApp messages from Admin
  - Quick, streamlined account creation process (<5 minutes)
  - Responsive, helpful support throughout setup
  - Admin dashboard that shows wedding progress emotionally (not just metrics)

### Design Opportunities

**1. Celebrate Setup Progress (Couple Empowerment)**
- **Opportunity:** Transform setup checklist into journey with emotional payoff. Each completion is a mini-celebration.
- **UX Concept:** Progress bar with milestones, celebratory micro-animations when sections complete, "You're doing great!" messaging
- **Competitive Advantage:** Other platforms feel transactional. JomNikah feels like a supportive partner in wedding journey
- **Implementation:** Visual progress indicators, achievement unlocks, confetti on full setup completion

**2. Ritualistic Card Opening (Guest Anticipation)**
- **Opportunity:** Recreate the ritual of opening physical wedding invitation envelope through digital interaction
- **UX Concept:** "Curtain animation" overlay with "Tap to Open Their Wedding Card" creates moment of anticipation and specialness
- **Competitive Advantage:** Physical cards have ritual (envelope opening). Most digital cards skip this. JomNikah creates digital ritual
- **Implementation:** Animated overlay, dramatic reveal, smooth transition to card content

**3. Real-Time Emotional Connection (Couple-Guest Bond)**
- **Opportunity:** Live RSVP updates and instant guestbook wishes create sense of being surrounded by love
- **UX Concept:** Real-time dashboard where couples see RSVPs and wishes appearing instantly. "Look, Auntie Fatimah just wished us!"
- **Competitive Advantage:** Traditional cards = days/weeks for RSVP responses. JomNikah = instant emotional gratification and connection
- **Implementation:** Polling updates or real-time notifications, emotional dashboard design (not just metrics), share moments feature

**4. Privacy in Gift-Giving (Cultural Sensitivity)**
- **Opportunity:** Digital Ang Pow maintains privacy of gift amounts while enabling convenience
- **UX Concept:** Only couple sees who gave what amount. Guests see their own contribution privately. No public comparison
- **Competitive Advantage:** Physical ang pow is private by nature. Digital ang pow must match that privacy to feel culturally appropriate
- **Implementation:** Private amount display, couple-only visibility, QR code for scanning (no amount visible publicly)

---

## Core User Experience

### Defining Experience

**The Core Loop:** Setup Kad Wedding → Share with Guests → Receive RSVPs & Wishes → Celebrate Together

**Primary User Action (The Critical Path):**
**"Wedding Card Setup"** - The end-to-end process where couples transform from overwhelmed to empowered in under 1 hour.

This core action encompasses:
1. Subdomain definition (sarah-ahmad.jomnikah.com)
2. Template selection (with instant preview)
3. Wedding details entry (date, time, venue, map)
4. Photo gallery upload (<2MB validation)
5. Optional: Wish Present registry + Digital Ang Pow setup (Premium)

**Why This is Core:**
- This is the value-creating moment - couples go from "nothing" to "ready to share"
- Emotional arc: Stressed → Curious → Empowered → Relieved → Grateful
- Success metric: 80% complete setup on first day
- If setup fails or frustrates, everything else doesn't matter
- Once setup is complete, platform becomes passive (RSVPs, wishes come in automatically)

**Secondary Core Actions (Supporting Loops):**
- **Guest Card Viewing:** The emotional peak where guests experience the couple's celebration
- **Admin Dashboard Monitoring:** The operational heartbeat for platform owner

### Platform Strategy

**Responsive Web Application (Mobile + Desktop Parity)**

**Primary Platform:** Web-based Single Page Application (Vue 3 + Inertia.js + Laravel 12)

**Device Strategy:** Hybrid Flexibility for Busy Couples
- **Desktop Experience:** Full-featured layout for focused setup sessions at home
  - Multi-column layouts with live preview side-by-side
  - Larger form fields, easier data entry
  - File upload drag-and-drop interface
  - Keyboard shortcuts for power users

- **Mobile Experience:** Touch-optimized layout for on-the-go setup
  - Single-column, vertical scrolling layout
  - Thumb-friendly touch targets (44×44px minimum)
  - Mobile-optimized form inputs (numeric keypads for phone numbers)
  - Camera integration for photo uploads
  - Swipe gestures for gallery management

**Responsive Breakpoints:**
- **Mobile:** < 640px (core experience, simplified layout)
- **Tablet:** 640px - 1024px (adjusted spacing, grid layouts)
- **Desktop:** > 1024px (multi-column, enhanced features)

**Touch vs. Mouse/Keyboard:**
- **Primary Interaction:** Touch-based (80%+ guest traffic on smartphones)
- **Secondary Interaction:** Mouse/keyboard (couple setup may be on desktop)
- **Design Implication:** All critical actions must work via touch FIRST

**Platform Constraints:**
- **No offline functionality** (MVP - requires internet connection)
- **No native mobile apps** (web-only to keep development simple for solo developer)
- **Browser support:** Modern browsers only (Chrome, Safari, Edge - last 2 versions)

### Effortless Interactions

**1. Template Switching (Zero-Friction Creativity)**
- **What It Feels Like:** "Click, boom! New design!" - No anxiety, no data loss
- **How It Works:** Instant visual preview with all data preserved
- **Emotional Payoff:** Exploration feels safe and fun, not risky
- **Technical:** Vue component swaps data without re-fetching from server

**2. Subdomain Availability (Real-Time Validation)**
- **What It Feels Like:** Typing "sarah-ahmad" and seeing green ✅ "Available!" instantly
- **How It Works:** AJAX validation as user types (debounced to prevent server overload)
- **Emotional Payoff:** Progress feels smooth, no "Sorry, taken!" disappointment after form submission
- **Technical:** 2-second response time requirement (NFR-PERF-004)

**3. Photo Upload with Kind Validation**
- **What It Feels Like:** Selecting 5MB photo → Friendly message: "This photo is 5.2MB. Please choose under 2MB for best performance. Tip: Use your phone's photo settings to reduce size" - Not "ERROR: File too big!"
- **How It Works:** Frontend validation checks file size before upload attempt
- **Emotional Payoff:** User feels guided, not rejected. "The system is helping me succeed"
- **Technical:** Client-side validation, helpful tooltips, clear guidance

**4. RSVP via WhatsApp (One-Tap Connection)**
- **What It Feels Like:** Guest taps "RSVP via WhatsApp" → Chat opens → Type "I'll be there!" → Done
- **How It Works:** Deep link to WhatsApp API with pre-filled message
- **Emotional Payoff:** Guest feels "I've done my part quickly" - No forms, no friction
- **Technical:** WhatsApp URL scheme, fallback to web form if WhatsApp not installed

**5. Guestbook Submission (No-Login Expression)**
- **What It Feels Like:** Guest types heartfelt message → Clicks "Send Wish" → "Thank you! Your wish will appear after couple approval"
- **How It Works:** Simple form (name + message), no authentication required
- **Emotional Payoff:** Easy to express love, no barriers
- **Technical:** Optional approval workflow to prevent spam

**6. Setup Progress Tracking (You're Almost There!)**
- **What It Feels Like:** "Setup completion: 60% → 75% → 85% → Almost there! → 100% done!"
- **How It Works:** Visual progress bar updates as sections completed
- **Emotional Payoff:** Clear finish line, celebration when complete
- **Technical:** Local storage to preserve progress if user exits and returns

### Critical Success Moments

**For Couples (Make-or-Break Moments):**

**1. "Setup Complete" Moment (The Ultimate Success)**
- **What Happens:** Couple fills last field → Progress bar hits 100% → Celebration animation (confetti!) → "Your wedding card is ready! Share this link: [COPY BUTTON]"
- **Emotional Impact:** Relief, pride, excitement - "I did it! It's beautiful!"
- **Success Criteria:** Happens within 1 hour of first login (80% of couples)
- **Failure Mode:** Setup takes >2 hours, feels overwhelming, couple abandons

**2. "First RSVP Received" Moment (Emotional Payoff)**
- **What Happens:** Couple shares link → 10 minutes later → Dashboard notification: "Auntie Fatimah confirmed attendance!"
- **Emotional Impact:** Joy, validation - "It's working! People are coming!"
- **Success Criteria:** Real-time notification within 5 seconds of RSVP
- **Failure Mode:** No notification, couple doesn't see RSVPs immediately

**3. "Template Switch" Success (No-Regret Exploration)**
- **What Happens:** Couple browsing templates → Clicks "Rustic Elegance" → Preview updates instantly → All photos, details still there → "Wow, I like this better!"
- **Emotional Impact:** Delight, confidence to explore - "I can change my mind without penalty"
- **Success Criteria:** Instant switch (<1 second), zero data loss
- **Failure Mode:** Data loss, slow loading, couple afraid to switch

**For Guests (Moment of Delight):**

**4. "Curtain Opens" Moment (Ritualistic Reveal)**
- **What Happens:** Guest taps card → Curtain animation plays dramatically → Card fades in → Couple's photo, names, date revealed → "Masya Allah, cantiknya!"
- **Emotional Impact:** Anticipation, delight, connection - "I'm part of their special day"
- **Success Criteria:** Animation completes in <2 seconds, smooth on 4G mobile
- **Failure Mode:** Animation stutters, takes >5 seconds, guest closes

**5. "RSVP Submitted" Moment (Guest Achievement)**
- **What Happens:** Guest taps RSVP → WhatsApp opens or form submits → Clear confirmation: "Thank you! Your RSVP has been sent to Sarah & Ahmad"
- **Emotional Impact:** Satisfaction - "I've done my part as a good guest/friend"
- **Success Criteria:** Clear success message, one-tap action
- **Failure Mode:** Confusing interface, no confirmation, "Did it work?"

**For Admin (Operational Success):**

**6. "Account Created" Moment (Efficient Onboarding)**
- **What Happens:** Admin fills form → Clicks "Create Account" → "Wedding account created for Sarah & Ahmad! Credentials sent via WhatsApp"
- **Emotional Impact:** Efficiency, satisfaction - "Another happy couple onboarded"
- **Success Criteria:** Process completes in <5 minutes
- **Failure Mode:** Takes >10 minutes, feels bureaucratic

### Experience Principles

**1. Emotional Safety First (The "Wedding Planning Context" Principle)**
- Couples are stressed and overwhelmed. Every interaction must feel safe, supportive, and forgiving
- **Translation:** No punitive error messages. Helpful guidance that prevents mistakes. Clear progress indication. "You're doing great!" reinforcement
- **Applies to:** Setup flow, error handling, validation messages, progress tracking

**2. Mobile-First, Touch-Primary (The "Guest Reality" Principle)**
- 80%+ of guests view cards on smartphones. Design for touch first, mouse/keyboard second
- **Translation:** 44×44px minimum touch targets. Readable 16px+ fonts. Simplified mobile layouts. Thumb-friendly navigation. Large, unambiguous buttons
- **Applies to:** All guest-facing interfaces, couple dashboard mobile view

**3. Instant Gratification (The "Digital Speed" Principle)**
- The advantage over physical cards is speed. Feedback must be immediate to feel "better"
- **Translation:** Real-time validation. Instant template switching. Live preview updates. Immediate confirmation messages. <5 second page loads
- **Applies to:** Form validation, template selection, photo uploads, RSVP submissions

**4. Ritualistic Warmth (The "Personal Connection" Principle)**
- Digital cards risk feeling impersonal. Create rituals and warmth to match physical cards' emotional resonance
- **Translation:** Curtain animation (tap to open ritual). Countdown timer (anticipation building). Personal photos prominent. Guestbook messages highlighted. Celebratory micro-interactions
- **Applies to:** Public card design, emotional moments, notification design

**5. Cross-Device Flexibility (The "Modern Couple" Principle)**
- Busy couples need to setup anywhere, anytime. Support both desktop (focus) and mobile (convenience)
- **Translation:** Responsive design that works beautifully on both. Desktop: multi-column with live preview. Mobile: single-column with camera integration. Data syncs across devices
- **Applies to:** Couple dashboard, setup flow, admin interface
