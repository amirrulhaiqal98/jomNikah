---
stepsCompleted: [1, 2, 3, 4, 5, 6]
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

---

## Desired Emotional Response

### Primary Emotional Goals

**For Couples: "Empowered Relief"**
- **Emotional Definition:** Feeling capable, supported, and successful in completing wedding card setup without the stress and cost of traditional physical cards
- **Key Feelings:** "I can do this!" → "This is easier than I thought" → "I'm almost there!" → "I did it! And saved RM800+!"
- **Differentiation from Physical Cards:** Couples feel empowered (active participant) vs. overwhelmed (passive victim of complex printing process)
- **Word-of-Mouth Driver:** "You won't believe how easy this was! I set up our entire wedding card in 47 minutes!"

**For Guests: "Connected Belonging"**
- **Emotional Definition:** Feeling included in the celebration, part of the couple's special day, and satisfied that they've expressed their care
- **Key Feelings:** Excited → Delighted → Accomplished → Connected
- **Differentiation from Physical Cards:** Guests feel emotionally connected (ritualistic opening, personal photos) vs. transactionally informed (date/time/venue only)
- **Word-of-Mouth Driver:** "The digital card was so beautiful! I loved opening it - felt like a real event!"

**For Admin: "Efficient Satisfaction"**
- **Emotional Definition:** Feeling productive and helpful, enabling happiness efficiently without operational burden
- **Key Feelings:** Capable → Efficient → Proud → Accomplished
- **Success Indicator:** <5 minutes to onboard each couple, smooth operations

### Emotional Journey Mapping

**Couple Emotional Journey (Sarah & Ahmad):**

| Journey Stage | Emotional State | Design Triggers | Avoid These Negative Emotions |
|---------------|-----------------|-----------------|-------------------------------|
| **1. Account Creation** | Hopeful | WhatsApp credential delivery, warm personal message from Admin | Bureaucratic, cold, automated feeling |
| **2. First Login** | Curious → Supported | Clean dashboard, clear progress indicator (0% → 25%) | Overwhelmed, "where do I start?" confusion |
| **3. Subdomain Setup** | Empowered | Real-time availability check, green ✅ "Available!" | Frustration, "sorry, taken!" disappointment |
| **4. Template Selection** | Creative Delight | Instant preview, "Click, boom! New design!" switching | Anxiety about data loss, commitment pressure |
| **5. Details Entry** | Capable | Live preview updates, form validation feedback | Boredom, fatigue from repetitive data entry |
| **6. Photo Upload** | Guided | Kind validation messages (<2MB), helpful tips | Rejected, punitive error feeling |
| **7. Premium Setup** (Optional) | Confident | Locked features with upgrade prompts, clear value props | Confused about what's included |
| **8. Setup Complete** | Elated Relief | Celebration animation (confetti!), "100% done!", copy link button | Anti-climactic, "is that it?" letdown |
| **9. Share Link** | Proud Anticipation | Easy share button, preview of public card | Uncertainty, "did I do everything right?" |
| **10. First RSVP** | Joyous Validation | Real-time notification: "Auntie Fatimah confirmed!" | Delayed gratification, "is anyone seeing this?" |
| **11. Ongoing Monitoring** | Connected & Organized | Dashboard with RSVP/wish counts, guestbook feed | Anxiety about missing messages |

**Guest Emotional Journey (Auntie Fatimah):**

| Journey Stage | Emotional State | Design Triggers | Avoid These Negative Emotions |
|---------------|-----------------|-----------------|-------------------------------|
| **1. Receives Link** | Curious Excitement | Personalized WhatsApp message from couple | Generic, spam-like feeling |
| **2. Opens Card** | Anticipation | Curtain animation: "Tap to Open Their Wedding Card" | Nothing, immediate content dump |
| **3. Card Reveals** | Delighted Beauty | Smooth fade-in, couple's photo, beautiful design | Slow loading, broken images |
| **4. Views Details** | Informed | Clear date/time/venue, countdown timer | Confusion about when/where |
| **5. RSVPs** | Accomplished | One-tap WhatsApp, immediate confirmation | Frustrating form filling, "did it work?" |
| **6. Views Registry** (Optional) | Generous | Wish Present items, clear claiming process | Pressure, guilt about gifts |
| **7. Gives Ang Pow** (Optional) | Private Contribution | QR code/bank details, privacy assured | Exposed amounts, public comparison |
| **8. Writes Wish** | Expressive Love | Simple guestbook form, "Thank you! Pending approval" | Technical barriers, login requirements |
| **9. Completion** | Satisfied Inclusion | "Your response has been sent to Sarah & Ahmad" | Unfinished feeling, uncertainty |

**Admin Emotional Journey (Amirrul):**

| Journey Stage | Emotional State | Design Triggers |
|---------------|-----------------|-----------------|
| **1. Onboards Couple** | Efficient | Streamlined form, <5 min process |
| **2. Sends Credentials** | Helpful | WhatsApp automation, personal message template |
| **3. Monitors Progress** | Informed | Dashboard with setup completion % |
| **4. Sees Success** | Proud | RSVP/wish counts, active weddings |

### Micro-Emotions

**Critical Micro-Emotions for JomNikah:**

**1. Confidence (Couple Setup Experience)**
- **Why Critical:** Wedding planning creates uncertainty. Couples must feel capable to complete setup independently
- **UX Approach:** Clear progress indication, gentle guidance, forgiving interface
- **Anti-Pattern:** Confusing navigation, technical jargon, punitive errors

**2. Trust (Guest Gift-Giving)**
- **Why Critical:** Guests need privacy assurance for Digital Ang Pow and registry contact info
- **UX Approach:** Private amounts, clear privacy statements, secure HTTPS indicators
- **Anti-Pattern:** Public contribution amounts, unclear data usage

**3. Excitement (Guest Anticipation)**
- **Why Critical:** Wedding guests are excited. Platform should amplify, not dampen, this emotion
- **UX Approach:** Curtain animation ritual, countdown timer, beautiful design reveal
- **Anti-Pattern:** Generic, boring, purely functional interface

**4. Accomplishment (Progress Tracking)**
- **Why Critical:** Setup is multi-step process. Users need milestone reinforcement to persist
- **UX Approach:** Progress bar (60% → 75% → 85% → 100%), celebration animations
- **Anti-Pattern:** No progress indication, endless-feeling forms

**5. Delight (Exceeding Expectations)**
- **Why Critical:** Delight creates word-of-mouth. Satisfied users don't recommend; delighted users do
- **UX Approach:** Micro-animations, instant template switching, "Wow!" moments
- **Anti-Pattern:** Merely functional, zero personality

**6. Belonging (Guest Connection)**
- **Why Critical:** Guests want to feel part of celebration, not just informed of logistics
- **UX Approach:** Guestbook with others' messages, personal photos, couple's story
- **Anti-Pattern:** Impersonal, information-only interface

### Design Implications

**Emotion-First UX Decisions:**

**To Create "Empowered Relief" (Couples):**

| Emotional Goal | UX Design Implementation | Examples |
|----------------|------------------------|----------|
| **Feeling Supported** | Clear guidance with warm language | "Let's set up your wedding card together" (not "Enter data") |
| **Feeling Capable** | Progressive disclosure with progress tracking | Setup sections shown one at a time, completion % visible |
| **Feeling Successful** | Instant feedback + celebration moments | Real-time validation, confetti at 100%, "First RSVP" notification |
| **Feeling Relieved** | Prevent errors + kind error handling | Frontend validation, helpful tips: "Try compressing your photo" |
| **Avoiding Overwhelm** | Simplify complexity | Guided setup flow, don't show all sections at once |

**To Create "Connected Belonging" (Guests):**

| Emotional Goal | UX Design Implementation | Examples |
|----------------|------------------------|----------|
| **Feeling Anticipation** | Ritualistic opening interaction | Curtain animation with "Tap to Open Their Wedding Card" |
| **Feeling Delighted** | Beautiful, celebratory design | Couple's photo prominent, warm color palette, smooth animations |
| **Feeling Accomplished** | Easy, quick interactions | One-tap RSVP, simple guestbook form, immediate confirmation |
| **Feeling Connected** | Community elements | Visible guestbook messages (approved), see who's attending |
| **Feeling Included** | Personal touch | Couple's names prominent, their story, countdown to special day |
| **Avoiding Transaction** | Emotional resonance vs. pure utility | Not just date/time/venue - feelings, photos, wishes matter |

**To Avoid Negative Emotions:**

| Negative Emotion | Prevention Strategy |
|------------------|-------------------|
| **Confusion** | Clear labels, simple language (BM/English), unambiguous buttons |
| **Frustration** | Prevent errors before they happen, clear guidance, forgiving interface |
| **Anxiety** | Progress tracking, auto-save reassurance, "You're doing great!" messaging |
| **Disappointment** | Meet expectations set by marketing, deliver on promises |
| **Impersonal Feeling** | Warm design language, celebratory micro-interactions, personal photos |
| **Skepticism** | Privacy assurance, secure indicators, clear data policies |

### Emotional Design Principles

**1. Safety Before Efficiency (The "Stressed Couple" Principle)**
- Users are emotionally vulnerable (wedding planning stress). Prioritize feeling safe over speed
- **Translation:** Kind error messages, helpful validation, clear progress, "You can do this!" reinforcement
- **Applies to:** Setup flow, error handling, photo uploads, form validation

**2. Ritual Over Function (The "Celebration" Principle)**
- Weddings are emotional events, not transactions. Create rituals that match physical card traditions
- **Translation:** Curtain opening ritual, countdown anticipation, celebration moments, personal prominence
- **Applies to:** Public card experience, notification design, completion moments

**3. Delight Creates Advocacy (The "Word-of-Mouth" Principle)**
- Satisfied users don't recommend products. Delighted users do. Design for "Wow!" moments
- **Translation:** Micro-animations, instant template switching, beautiful reveals, unexpected polish
- **Applies to:** Template selection, card opening, RSVP confirmation, wish submission

**4. Connection Through Transparency (The "Belonging" Principle)**
- Guests feel included when they see others participating. Couple feels supported when they see real-time activity
- **Translation:** Guestbook messages visible, RSVP counts shown, live dashboard updates
- **Applies to:** Dashboard design, guestbook display, RSVP tracking

**5. Privacy Enables Generosity (The "Trust" Principle)**
- Guests give more when they feel private and respected. Cultural norms around gift-giving must be honored
- **Translation:** Private Digital Ang Pow amounts, secure contact info, clear privacy policies
- **Applies to:** Premium features, gift registry, data handling

---

## UX Pattern Analysis & Inspiration

### Inspiring Products Analysis

**Based on your input about social media apps, interactivity, psychology-driven design, and minimalist aesthetics, here's the inspiration analysis for JomNikah:**

#### 1. Instagram (Visual Storytelling & Emotional Connection)

**What We Can Learn:**
- **Photo-First Philosophy:** Instagram puts visuals front and center. For JomNikah, the couple's photos should be prominent and celebrated
- **Minimalist UI:** Clean interface that lets content shine. No clutter, no competing elements
- **Emotional Engagement:** Heart reactions, comments create sense of community. Translate to guestbook wishes and RSVP celebrations
- **Story Format:** Ephemeral, full-screen content that feels intimate and personal

**Application to JomNikah:**
- Photo gallery should be the "hero" of the wedding card
- Clean, white/minimalist background that puts couple's photos in spotlight
- Guestbook wishes can have "heart" reaction from couple (creating two-way emotional connection)
- Consider "Story-style" countdown or special moments

#### 2. TikTok (Instant Gratification & Flow State)

**What We Can Learn:**
- **Immediate Reward:** Videos start instantly, no friction. Users are immediately engaged
- **Flow State Design:** Infinite scroll, seamless transitions between content - users lose track of time
- **Micro-Interactions:** Hearts, comments, shares are one-tap actions with instant visual feedback
- **Algorithmic Personalization:** Content adapts to user preferences (advanced, but applicable to template suggestions)

**Application to JomNikah:**
- Template switching should be instant (no loading screens) - "Click, boom! New design!"
- Setup progress should flow smoothly from section to section (no disjointed multi-page forms)
- Celebrate small wins with micro-animations (like TikTok's heart explosions)
- Guest RSVP should be one-tap action with immediate confirmation

#### 3. WhatsApp (Intimacy & Reliability)

**What We Can Learn:**
- **Utter Simplicity:** One screen, clear purpose. No features competing for attention
- **Intimacy in Design:** Chat bubbles, checkmarks, profile photos create personal connection
- **Reliability First:** Messages always go through. Clear status indicators (sent, delivered, read)
- **Cross-Platform Parity:** Works identically on mobile and desktop

**Application to JomNikah:**
- RSVP via WhatsApp deep link - leverages users' existing comfort with WhatsApp
- Simple, single-purpose screens (Setup, Dashboard, Public Card - each with clear focus)
- Reliable status indicators: "RSVP received," "Wish submitted and pending approval"
- Mobile and desktop experiences feel equally capable

#### 4. Spotify (Personalization & Delight)

**What We Can Learn:**
- **Onboarding Delight:** "Pick your artists" creates instant personalization. Users feel "this is made for me"
- **Micro-Interactions:** Hover effects, smooth transitions, satisfying animations
- **Dark Mode as Default:** Sleek, modern aesthetic that reduces eye strain
- **Playlist = Curation:** Easy to organize, reorder, customize content

**Application to JomNikah:**
- Template selection should feel like "pick your vibe" - instant visual personalization
- Smooth transitions between setup sections
- Consider dark mode option for evening guests viewing cards
- Photo gallery should be easy to reorder and customize (drag-and-drop)

#### 5. Canva (Template-Based Creativity)

**What We Can Learn:**
- **Template Grid:** Visual browsing with instant preview. Users see exactly what they'll get
- **Zero Learning Curve:** Templates are pre-designed. Users just customize content
- **No "Commitment Anxiety":** Can switch templates anytime without losing work
- **"Done For You" Feeling:** Users feel creative without actually designing from scratch

**Application to JomNikah:**
- Template selector with visual thumbnails and instant preview
- Couple fills details once, can switch templates endlessly
- No "design skills required" - everything looks beautiful automatically
- "You're almost done!" messaging reinforces ease of use

#### 6. ekaddigital.com (Competitor Analysis)

**Analysis of https://ekaddigital.com/ikrizainvite/IK11738:**

**Strengths to Learn From:**
- **Single-Page Scroll:** All information accessible by scrolling - no navigation complexity
- **Visual Hierarchy:** Couple's names and photo are prominent. Date/time/venue are clear
- **Music Integration:** Background music creates atmosphere (optional feature to consider)
- **WhatsApp RSVP Button:** Clear, prominent CTA button
- **Countdown Timer:** Builds anticipation and excitement
- **Islamic Elements:** "Bismillah" at top, prayer timings - culturally aligned

**Gaps to Improve Upon (JomNikah Opportunities):**
- **Static Design:** No template switching capability. JomNikah can offer flexibility
- **No Guestbook:** Missing community/wishes feature. JomNikah adds emotional connection
- **No Gift Registry:** No Wish Present or Digital Ang Pow features. JomNikah provides complete solution
- **Minimal Interaction:** Mostly informational. JomNikah can create more engaging, interactive experience
- **No Couple Dashboard:** Appears to be static card only. JomNikah adds ongoing management and real-time RSVP tracking

**Key Takeaway:** ekaddigital proves market exists and validates single-page scroll format. JomNikah's competitive advantage is interactivity, premium features (registry, ang pow), and couple dashboard.

### Transferable UX Patterns

#### Navigation Patterns

**1. Progressive Disclosure (Show One Section at a Time)**
- **Source:** Setup wizards, form design best practices
- **Application:** Setup flow shows sections sequentially (Subdomain → Template → Details → Photos → Premium)
- **Benefit:** Reduces cognitive load, creates sense of progress, prevents overwhelm
- **Emotional Impact:** "I can do this" confidence building

**2. Bottom Navigation (Mobile Pattern)**
- **Source:** Instagram, TikTok mobile apps
- **Application:** Couple dashboard mobile view uses bottom tab bar (Home, Editor, Gallery, RSVP, Settings)
- **Benefit:** Thumb-friendly, clear navigation hierarchy, always visible
- **Emotional Impact:** "I know where I am" confidence

**3. Gesture-Based Navigation (Desktop Enhancement)**
- **Source:** macOS trackpad gestures, innovative web interfaces
- **Application:** Swipe between photos in gallery, pull-to-refresh RSVP list (desktop)
- **Benefit:** Fast, fluid interactions feel modern and delightful
- **Emotional Impact:** "This feels premium and polished" delight

#### Interaction Patterns

**1. Instant Preview (Zero-Latency Feedback)**
- **Source:** Canva template switching, Instagram filters
- **Application:** Template selector shows live preview of couple's data in new design instantly
- **Benefit:** No anxiety about "what will this look like?" Exploration feels safe
- **Emotional Impact:** "Wow, that's beautiful!" delight in exploration

**2. Micro-Interactions (Emotional Delight)**
- **Source:** Twitter heart animation, TikTok reactions
- **Application:** Confetti at setup completion, subtle bounce on button hover, smooth fade-ins
- **Benefit:** Creates delight, makes interface feel alive and responsive
- **Emotional Impact:** "This is fun!" positive association with platform

**3. Real-Time Validation (Prevent Errors Before They Happen)**
- **Source:** Modern form design, signup flows
- **Application:** Subdomain availability checks as user types (green ✅ "Available!")
- **Benefit:** Smooth progress, no "submit → error → fix → resubmit" frustration
- **Emotional Impact:** "Everything is working perfectly" flow state

**4. One-Tap Actions (Reduce Friction)**
- **Source:** RSVP via WhatsApp, mobile payment flows
- **Application:** Single-tap RSVP, one-tap template switch, one-tap photo upload
- **Benefit:** Minimal effort, fast completion
- **Emotional Impact:** "That was easy!" satisfaction

#### Visual Patterns

**1. Card-Based Layout (Content Organization)**
- **Source:** Material Design, modern web design
- **Application:** Dashboard shows RSVPs, wishes, and stats as cards
- **Benefit:** Clear content hierarchy, scannable, responsive
- **Emotional Impact:** "I can see everything at a glance" clarity

**2. Minimalist Aesthetic (Content Over Chrome)**
- **Source:** Apple design, Instagram, TikTok
- **Application:** Clean white/minimal backgrounds, generous whitespace, focus on photos and content
- **Benefit:** Fast load times, reduces distraction, feels premium
- **Emotional Impact:** "This looks professional and beautiful" pride

**3. Dark Mode (Optional Enhancement)**
- **Source:** Spotify, Twitter, modern apps
- **Application:** Optional dark theme for evening viewing, reduces eye strain
- **Benefit:** Accessibility, modern feel, personalization
- **Emotional Impact:** "This platform thinks of everything" delight

**4. Progress Indicators (Clear Finish Line)**
- **Source:** Setup wizards, gaming progress bars
- **Application:** Setup completion % (60% → 75% → 85% → 100% done!)
- **Benefit:** Motivation, clear goals, sense of accomplishment
- **Emotional Impact:** "I'm making progress" encouragement

### Anti-Patterns to Avoid

**1. Cluttered Interfaces (Cognitive Overload)**
- **Anti-Pattern:** Squeezing too many features, buttons, options into single screen
- **Why Avoid:** Overwhelms stressed couples, confuses elderly guests
- **JomNikah Solution:** Progressive disclosure, one primary action per screen, clear hierarchy

**2. Pagination on Mobile (Friction)**
- **Anti-Pattern:** "View 10 more RSVPs" pagination on guest list
- **Why Avoid:** Breaks flow, adds unnecessary clicks
- **JomNikah Solution:** Infinite scroll or load more on scroll (smooth, continuous)

**3. Pop-Up Overlays (Disruptive)**
- **Anti-Pattern:** Modal pop-ups for "Upgrade now!" or "Rate this app"
- **Why Avoid:** Interrupts flow, feels aggressive, damages trust
- **JomNikah Solution:** Non-intrusive inline prompts, gentle upgrade suggestions in context

**4. Multi-Page Forms (Fatigue)**
- **Anti-Pattern:** Wedding details spread across 5 separate form pages with "Next" buttons
- **Why Avoid:** Creates anxiety about length, users abandon mid-process
- **JomNikah Solution:** Single-page setup with accordion sections or smooth scrolling, clear progress indicator

**5. Hidden Features (Discoverability Failure)**
- **Anti-Pattern:** Premium features buried in settings, users don't know they exist
- **Why Avoid:** Couples won't upgrade if they don't see value
- **JomNikah Solution:** Visible (locked) premium sections with clear "Upgrade to access" prompts

**6. Generic Error Messages (Frustration)**
- **Anti-Pattern:** "Error 500: Internal Server Error" or "An error occurred"
- **Why Avoid:** Users feel confused, don't know what to do
- **JomNikah Solution:** Kind, actionable messages: "Photo upload failed. Please try a smaller file under 2MB"

**7. Feature Bloat (Loss of Focus)**
- **Anti-Pattern:** Adding too many features "because we can"
- **Why Avoid:** Confuses primary value proposition, harder to maintain
- **JomNikah Solution:** Ruthless MVP focus - do fewer things perfectly, not many things poorly

### Design Inspiration Strategy

#### What to Adopt (Direct Inspiration)

**1. Single-Page Scroll Format (from ekaddigital)**
- All wedding information accessible by scrolling
- Simple, familiar interaction model
- Works beautifully on mobile

**2. Visual Template Browser (from Canva)**
- Grid of template thumbnails with instant preview
- Clear visual differentiation between options
- One-click activation

**3. Real-Time Validation (from modern signup flows)**
- AJAX subdomain availability checking
- Instant photo size validation before upload
- Green checkmarks for valid inputs

**4. One-Tap RSVP via WhatsApp (from ekaddigital + WhatsApp integration)**
- Leverage existing user behavior
- Minimal friction for guests
- Reliable delivery

**5. Progress Bar with Milestones (from setup wizards)**
- Clear visual progress (0% → 25% → 50% → 75% → 100%)
- Celebratory moments at each milestone
- "You're almost there!" motivation

#### What to Adapt (Customize for Wedding Domain)

**1. "Stories" Format (from Instagram/WhatsApp)**
- **Adaptation:** Create "Wedding Journey" section showing couple's story, photos, countdown
- **Wedding Context:** Not ephemeral like stories, but permanent emotional narrative
- **Emotional Impact:** Guests feel connected to couple's journey

**2. Music Integration (from ekaddigital + Spotify)**
- **Adaptation:** Optional background music for public card ( culturally aligned with Malaysian weddings)
- **Wedding Context:** Couple chooses their special song
- **Technical Consideration:** Auto-play restrictions (browser policy), mute by default

**3. Dark Mode (from Spotify/Twitter)**
- **Adaptation:** Optional theme for evening wedding card viewing
- **Wedding Context:** Elegant, romantic aesthetic for night receptions
- **Implementation:** User choice, not forced (accessibility)

#### What to Avoid (Anti-Patterns for This Domain)

**1. Social Feed Features (from Facebook/Instagram)**
- **Why Avoid:** Wedding cards are private events, not social networks
- **Exception:** Guestbook shows messages, but this is curated by couple, not open feed

**2. Algorithmic Content Discovery (from TikTok/YouTube)**
- **Why Avoid:** Wedding cards have specific, curated content. No "recommendations" needed
- **Exception:** Template suggestions based on selected template ("You liked Rustic, try also Vintage")

**3. Gamification Overload (from language learning apps)**
- **Why Avoid:** Weddings are emotional, not game-like. Too many badges/points feels trivializing
- **Exception:** Gentle celebration moments (confetti at 100% setup), but not "streaks" or "leaderboards"

**4. Infinite Scroll Everything (from Twitter/Instagram)**
- **Why Avoid:** Setup has clear finish line. Infinite scroll would feel endless
- **Exception:** Guest RSVP list and guestbook can use infinite scroll (these grow continuously)

### Psychology-Driven Design Principles

**Based on your emphasis on psychology/counseling knowledge about human wants:**

#### 1. Social Proof (People Follow Others)

**Psychological Principle:** People look to others' behavior to guide their own actions

**Application to JomNikah:**
- **Guestbook Visibility:** Show approved wishes publicly (with "Auntie Fatimah wished you: 'Congrats!'")
- **RSVP Count Display:** "23 guests confirmed attendance" creates momentum
- **Testimonials (Future):** After validation phase, show "500 couples chose JomNikah"

**Emotional Impact:** "Others are doing this, I should too" - reduces guest hesitation

#### 2. Reciprocity (Give to Receive)

**Psychological Principle:** People feel obligated to return favors and kindness

**Application to JomNikah:**
- **Couple Gives Beautiful Card:** Guests feel compelled to RSVP and give wishes in return
- **Platform Gives Easy Setup:** Couples feel motivated to recommend to friends (word-of-mouth)
- **Free Template Preview:** Give value upfront, couples feel compelled to complete setup

**Emotional Impact:** "They've done something nice for me, I should respond" - increases engagement

#### 3. Authority (Trust Experts)

**Psychological Principle:** People trust credible, knowledgeable sources

**Application to JomNikah:**
- **Professional Design:** High-quality templates signal "this platform knows weddings"
- **Clear Communication:** Professional, warm copy builds trust
- **Privacy Assurance:** Explicit PDPA compliance statements (authority of law)

**Emotional Impact:** "These people know what they're doing" - reduces skepticism

#### 4. Emotional Contagion (Feelings Spread)

**Psychological Principle:** People emotionally mimic those around them

**Application to JomNikah:**
- **Couple's Photos:** Happy, smiling photos evoke guests' happiness
- **Celebratory Design:** Warm colors, countdown create excitement
- **Positive Language:** "You're doing great!" "Almost there!" transfers positivity to couple

**Emotional Impact:** Guests feel couple's joy - creates emotional connection

#### 5. Loss Aversion (People Fear Losing More Than They Value Gaining)

**Psychological Principle:** People are more motivated by avoiding loss than acquiring gain

**Application to JomNikah:**
- **Setup Progress:** "Don't lose your progress! Auto-save enabled" - motivates completion
- **Premium Upsell:** "Upgrade now to unlock Digital Ang Pow" - FOMO (fear of missing out)
- **Limited Time (Future):** "Early adopter pricing RM20 (normally RM30)" - scarcity principle

**Emotional Impact:** "I don't want to miss out" - drives action

#### 6. Cognitive Ease (People Prefer Easy)

**Psychological Principle:** People gravitate toward familiar, easy, low-effort options

**Application to JomNikah:**
- **WhatsApp RSVP:** Leverage familiar platform vs. learning new form
- **Template-Based:** No design skills required - cognitive ease
- **Progressive Disclosure:** One section at a time vs. overwhelming all-at-once

**Emotional Impact:** "This is easy, I'll do it now" - reduces procrastination

#### 7. Commitment Consistency (People Stick to Choices)

**Psychological Principle:** Once people commit publicly, they align actions with that commitment

**Application to JomNikah:**
- **Setup Progress Tracking:** Each section completed is micro-commitment to finish
- **Share Link Early:** After setup complete, prompt "Share your card now" - public commitment
- **RSVP Confirmation:** "Your RSVP has been sent to Sarah & Ahmad" - guest is now committed

**Emotional Impact:** "I started this, I should finish it" - increases completion rates

---

## Design System Foundation

### Design System Choice

**Hybrid Approach: Tailwind CSS + Headless UI + Custom Emotional Components**

For JomNikah, we're using a **hybrid design system approach** that combines the speed and reliability of established tools with custom emotional components that create distinctive brand experiences.

**Three-Layer Foundation:**

1. **Tailwind CSS** (Utility-First Styling)
   - Already selected as part of tech stack (Vue 3 + Tailwind CSS + Inertia.js + Laravel 12)
   - Provides utility classes for rapid development
   - Mobile-first responsive design out of the box
   - Performance optimized with JIT compiler

2. **Headless UI for Vue** (Accessible Component Logic)
   - Official component library by Tailwind Labs
   - Unstyled, fully accessible components (modals, dropdowns, tabs, etc.)
   - Perfect for complex interactive UI elements
   - Full styling control via Tailwind utilities

3. **Custom Emotional Components** (Brand Differentiation)
   - Purpose-built components that create JomNikah's unique emotional experience
   - Ritualistic interactions (curtain animation, celebrations)
   - Wedding-specific features (photo gallery, guestbook, countdown)
   - Micro-interactions and delightful details

### Rationale for Selection

**Why This Hybrid Approach for JomNikah?**

**1. Speed Without Sacrificing Uniqueness**
- **Challenge:** Need MVP quickly (100 weddings validation phase) but must differentiate from competitors like ekaddigital
- **Solution:** Headless UI accelerates complex component development, while custom emotional components create unique brand identity
- **Result:** Fast time-to-market without becoming "just another wedding card platform"

**2. Solo Developer Sustainability**
- **Challenge:** Amirrul is solo developer - needs maintainable, well-documented approach
- **Solution:** Established libraries (Tailwind + Headless UI) have strong communities, reducing support burden. Custom components are few and focused
- **Result:** Long-term maintainability without fighting framework constraints or debugging complex custom implementations

**3. Mobile-First Performance Requirements**
- **Challenge:** 80%+ guests on smartphones, <5 second page load requirement on 4G (NFR-PERF-001)
- **Solution:** Tailwind JIT compiler purges unused CSS, minimal bundle size. Headless UI components are optimized for performance
- **Result:** Fast, responsive experience on mobile devices without manual CSS optimization

**4. Accessibility for Cross-Generational Users**
- **Challenge:** Guests aged 20-70 with varying tech comfort, including elderly users like Auntie Fatimah (60)
- **Solution:** Headless UI components have accessibility built-in (ARIA labels, keyboard navigation, screen reader support)
- **Result:** Inclusive design without requiring deep a11y expertise from solo developer

**5. Emotional Context as Top Priority**
- **Challenge:** User emphasized "Emotional Context" as TOP PRIORITY - need warmth, celebration, connection
- **Solution:** Custom emotional components (curtain animation, confetti, progress milestones) create distinctive brand personality
- **Result:** Platform feels special, celebratory, and emotionally resonant - not generic

**6. Vue 3 + Inertia.js Alignment**
- **Challenge:** Tech stack is Vue 3 + Inertia.js + Laravel 12 SPA architecture
- **Solution:** Headless UI has official Vue 3 support. Tailwind works seamlessly with Inertia.js
- **Result:** No framework wrestling, smooth integration, predictable behavior

### Implementation Approach

**Phase 1: Foundation Setup (Week 1)**

**1.1 Configure Tailwind with JomNikah Design Tokens**

```javascript
// tailwind.config.js
module.exports = {
  theme: {
    extend: {
      colors: {
        primary: {
          rose: '#F43F5E',      // Romance, love, celebration
          gold: '#F59E0B',       // Warmth, joy, achievement
          emerald: '#10B981',    // Success, completion, progress
        },
        neutral: {
          50: '#FAFAFA',        // Light background (Instagram-like)
          100: '#F5F5F5',
          900: '#171717',       // Dark text, minimalist aesthetic
        }
      },
      fontFamily: {
        sans: ['Inter', 'system-ui', 'sans-serif'],      // Clean, modern, readable
        display: ['Playfair Display', 'serif'],          // Elegant, wedding-like
      },
      spacing: {
        '18': '4.5rem',   // Generous spacing for minimalist aesthetic
        '22': '5.5rem',
      },
      animation: {
        'fade-in': 'fadeIn 0.5s ease-in-out',
        'slide-up': 'slideUp 0.3s ease-out',
        'bounce-subtle': 'bounceSubtle 0.6s ease-in-out',
      },
      keyframes: {
        fadeIn: {
          '0%': { opacity: '0' },
          '100%': { opacity: '1' },
        },
        slideUp: {
          '0%': { transform: 'translateY(10px)', opacity: '0' },
          '100%': { transform: 'translateY(0)', opacity: '1' },
        },
        bounceSubtle: {
          '0%, 100%': { transform: 'translateY(0)' },
          '50%': { transform: 'translateY(-5px)' },
        },
      },
    },
  },
  plugins: [
    require('@tailwindcss/forms'),       // Better form styling
    require('@tailwindcss/typography'),  // Prose for guestbook messages
  ],
}
```

**1.2 Install and Configure Headless UI**

```bash
npm install @headlessui/vue
```

```javascript
// Import components as needed
import { Dialog, Menu, Tab, Disclosure } from '@headlessui/vue'
```

**1.3 Create Base Component Structure**

```
resources/js/components/
├── jc-base/              # Base components (design tokens applied)
│   ├── JcButton.vue     # Primary, secondary, tertiary buttons
│   ├── JcInput.vue      # Text, email, phone inputs with validation
│   ├── JcCard.vue       # Card container (dashboard widgets)
│   └── JcBadge.vue      # Status badges (confirmed, pending)
├── jc-feedback/          # Feedback components
│   ├── JcProgressBar.vue      # Setup progress tracking
│   ├── JcConfetti.vue         # Celebration animation
│   └── JcToast.vue            # Success/error messages
├── jc-interactive/       # Headless UI wrappers
│   ├── JcModal.vue           # Modal dialogs (upgrade prompts)
│   ├── JcTabs.vue            # Tab navigation (dashboard)
│   └── JcAccordion.vue       # Accordion sections (setup form)
└── jc-wedding/           # Wedding-specific emotional components
    ├── JCurtainAnimation.vue # Tap-to-open card ritual
    ├── JcPhotoGallery.vue     # Photo display with lazy loading
    ├── JcCountdown.vue        # Wedding countdown timer
    ├── JcGuestbook.vue        # Guestbook message display
    └── JcRSVPCounter.vue      # RSVP statistics
```

**Phase 2: Core Component Development (Week 2-3)**

**2.1 Build Custom Emotional Components**

**JCurtainAnimation.vue** (Ritualistic Opening)
- Full-screen overlay with animated curtain
- "Tap to Open Their Wedding Card" call-to-action
- Smooth fade-out transition to reveal card
- Mobile-optimized (touch targets, <2s animation)

**JcProgressBar.vue** (Setup Tracking)
- Visual progress bar (60% → 75% → 85% → 100%)
- Milestone celebrations at each section completion
- "You're almost there!" motivational messaging
- Persists progress in local storage

**JcConfetti.vue** (Celebration Moments)
- Canvas-based particle animation
- Triggers at 100% setup completion
- Lightweight (<50KB) for performance
- Can be reused for other celebrations

**JcPhotoGallery.vue** (Emotional Visual Display)
- Lazy loading images (<2MB validation)
- Swipe gestures for mobile navigation
- Progressive image loading (blur-up technique)
- Lightbox view for full-screen photos

**2.2 Implement Headless UI Components**

**JcModal.vue** (Premium Upgrade Prompts)
- Wraps Headless UI Dialog component
- Tailwind styling for warm, non-intrusive appearance
- "Upgrade to unlock Digital Ang Pow" messaging
- Accessible (ESC to close, focus trap)

**JcTabs.vue** (Dashboard Navigation)
- Wraps Headless UI Tab component
- Mobile: Bottom navigation bar (thumb-friendly)
- Desktop: Side navigation or top tabs
- Active state indicators

**JcAccordion.vue** (Setup Form Sections)
- Wraps Headless UI Disclosure component
- Progressive disclosure (show one section at a time)
- "Subdomain" → "Template" → "Details" → "Photos" → "Premium"
- Smooth expand/collapse animations

**Phase 3: Templates & Polish (Week 4)**

**3.1 Create Wedding Card Templates**

```
resources/js/components/templates/
├── RusticElegance.vue    # Earth tones, botanical accents
├── MinimalistModern.vue  # Clean lines, sans-serif fonts
├── LuxuryGold.vue        # Gold accents, serif fonts
└── FloralRomance.vue     # Soft colors, flower motifs
```

Each template:
- Uses design tokens (can swap color palettes easily)
- Implements same emotional components (curtain, countdown, gallery)
- Fully responsive (mobile-first approach)
- Accessible (semantic HTML, ARIA labels)

**3.2 Refine Animations and Micro-Interactions**

- Button hover states: Subtle scale transform (1.02), shadow increase
- Input focus states: Warm primary color ring, smooth transition
- Page transitions: Fade-in + slide-up (0.3s ease-out)
- Loading states: Skeleton screens, not spinners (better perceived performance)

**3.3 Performance Optimization**

- Tailwind JIT purges unused CSS (minimal bundle size)
- Image optimization: WebP format, responsive images, lazy loading
- Code splitting: Load template components on-demand
- Measure: Lighthouse scores >90 for mobile performance

### Customization Strategy

**Component Naming Convention**

All custom components use `Jc` prefix (JomNikah Component) to prevent conflicts:
- `JcButton`, `JcModal`, `JcPhotoGallery`, etc.

This convention:
- Prevents naming collisions with third-party libraries
- Makes component origin clear in codebase
- Supports IDE autocomplete (type `Jc` to see all components)

**Design Token Management**

**Colors (Emotional Context):**
- **Primary Rose (#F43F5E):** Romance, love, celebration
- **Primary Gold (#F59E0B):** Achievement, warmth, premium feel
- **Primary Emerald (#10B981):** Success, completion, progress
- **Neutral Grays:** Minimalist backdrop (Instagram-inspired cleanness)

**Typography (Cross-Generational Readability):**
- **Sans (Inter):** Body text, UI elements - 16px minimum on mobile (NFR-USE-003)
- **Display (Playfair Display):** Headlines, couple names - elegant, wedding-like

**Spacing (Mobile-First):**
- Generous padding (minimalist aesthetic, touch-friendly)
- 8px base unit (Tailwind default)
- Larger touch targets (44×44px minimum for mobile, NFR-USE-002)

**Animation (Delight Without Distraction):**
- Short durations (200-500ms)
- Smooth easing curves (ease-out, ease-in-out)
- Purposeful (supports emotional goals, not decorative)

**Component Composition Strategy**

**Base Components** (jc-base/):
- Pure presentational components
- Receive props, emit events
- No business logic
- Reusable across application

**Compound Components** (jc-interactive/):
- Combine base components
- Wrap Headless UI for accessibility
- Handle user interactions
- Manage internal state

**Feature Components** (jc-wedding/):
- Domain-specific business logic
- Wedding-themed styling
- Emotional design patterns
- Directly map to PRD features

**Styling Approach**

**Utility-First (Tailwind):**
- 90% of styling done with Tailwind utility classes
- Fast development, consistent results
- Easy responsive design (sm:, md:, lg: prefixes)

**Component Variants:**
```vue
<template>
  <button
    class="jc-btn"
    :class="[
      variant === 'primary' ? 'bg-primary-rose text-white' : 'bg-gray-100 text-gray-900',
      size === 'lg' ? 'px-6 py-3' : 'px-4 py-2'
    ]"
  >
    <slot />
  </button>
</template>
```

**CSS-in-JS (When Needed):**
- Complex animations (keyframes defined in Tailwind config)
- Component-specific overrides (scoped `<style>` blocks)
- Minimal usage - prefer Tailwind utilities

**Accessibility Strategy**

**Headless UI Foundation:**
- All interactive components use Headless UI (Dialog, Menu, Tab, Disclosure)
- Built-in ARIA labels, keyboard navigation, focus management
- Screen reader support out-of-the-box

**Custom Component Accessibility:**
- Semantic HTML (button, not div with onClick)
- Focus indicators (visible, high contrast)
- Alt text for images (couple photos)
- Color contrast WCAG AA compliant (4.5:1 minimum)

**Testing:**
- Keyboard navigation only (no mouse)
- Screen reader testing (VoiceOver on Mac, NVDA on Windows)
- Color contrast validator tools

**Responsive Design Strategy**

**Mobile-First (Primary Platform):**
- Default styling = mobile (<640px)
- Touch targets 44×44px minimum
- Single-column layouts
- Bottom navigation for dashboard

**Desktop Enhancement:**
- `md:` (640px+) and `lg:` (1024px+) breakpoints
- Multi-column layouts
- Side navigation or top tabs
- Larger images, more content visible

**Testing:**
- Chrome DevTools device emulation
- Real device testing (Android, iOS)
- 4G network throttling (Chrome Network Throttling)

**Performance Strategy**

**CSS Optimization:**
- Tailwind JIT compiler (on-demand CSS generation)
- Purge unused styles in production
- Critical CSS inline (above-the-fold content)
- Minimal custom CSS

**Component Optimization:**
- Lazy load heavy components (photo gallery, templates)
- Code splitting (route-based chunks)
- Tree-shaking (unused code eliminated)

**Measurement:**
- Lighthouse performance score >90
- Page load <5s on 4G (NFR-PERF-001)
- First Contentful Paint <2s
- Time to Interactive <3s (NFR-PERF-002)

---