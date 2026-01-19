---
stepsCompleted: [1, 2]
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
