---
stepsCompleted: ['step-01-init', 'step-02-discovery', 'step-03-success', 'step-04-journeys']
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
- Card valid for **3 months** per payment

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
- **RM20 revenue** per couple with 3-month card validity
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

