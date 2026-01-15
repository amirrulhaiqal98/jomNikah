# Project Proposal: Digital Wedding Card SaaS Platform (Revised)

## 1. Executive Summary
We are building a Managed Digital Wedding Platform. Unlike a pure SaaS where users self-register, this model involves the Super Admin (Owner) creating accounts for couples. The couple logs in to configure their card, choose templates, and manage guests. The system generates unique subdomains and handles RSVPs/Wishes in real-time.

## 2. Technology Stack
We are using the latest, stable ecosystem for high performance.

- **Backend:** Laravel 12 (PHP). Handles logic, database, and routing.
- **Frontend:** Vue 3 + Tailwind CSS. Interactive, responsive UI.
- **Interface:** Inertia.js. Seamless integration between Vue and Laravel.
- **Roles:** Spatie Permission. To manage Super Admin vs. Couple access.
- **Database:** MySQL 8+.
- **Local Env:** Laravel Herd. Fast local development.
- **Server Env:** DigitalOcean Droplets. Manually configured Nginx, PHP-FPM, and Supervisor.

## 3. User Roles & Permissions
We use Spatie Permission to strictly define access levels.

### Super Admin (The Platform Owner):
- Can: Create new Couple accounts, Manage Templates, View all Wishes, Manage Server Settings.

### Couple (The Client):
- Can: Edit their wedding details, Upload photos, Switch templates, View RSVPs, View & Approve Wishes.

## 4. Business Logic & Features

### A. Admin-Led Onboarding (New Flow)
**Logic:** Bypass public registration. Only the Super Admin can create a "Wedding Account".

**Process:** The Super Admin receives a contract/payment -> Logs into Dashboard -> Clicks "Create New Wedding" -> Inputs Email/Password/Role.

### B. Dynamic Subdomain Generation
**Feature:** The Super Admin (or Couple) defines a unique slug.

**Example:** sarah-ahmad.

**Validation:** The system checks the database to ensure sarah-ahmad is unique before saving.

**Result:** The card is accessible at https://sarah-ahmad.yourdomain.com.

### C. Template Switching Engine
**Feature:** Couples can change the "Vibe" of their card instantly without losing their data (Names, Dates, Photos).

**Logic:** The database stores a template_id (e.g., rustic, minimalist). The Vue frontend dynamically loads the correct component based on this ID.

### D. Guestbook & Wishes
**Feature:** Guests can type a message on the public card.

**Management:**
- Wishes are saved to the database.
- Couple Dashboard: Has a "Wishes" tab to view all messages.
- Moderation: Optional toggle to "Approve" wishes before they appear publicly (to prevent spam).

## 5. User Flows

### Flow A: The Super Admin (Setup)
1. **Login:** Super Admin logs into admin.yourdomain.com.
2. **Create Account:** Fills form:
   - Bride/Groom Name.
   - Email & Password (for the couple).
   - Desired Subdomain: (e.g., sarah-ahmad).
   - Assign Default Template.
3. **Notification:** System sends email to Couple with login credentials.

### Flow B: The Couple (Configuration)
1. **Login:** Couple logs into yourdomain.com/dashboard.
2. **Customize:** Edits wedding details, uploads photos.
3. **Design:** Opens "Theme Manager" -> Selects different template (Visuals update instantly).
4. **Management:** Views RSVP list and Guest Wishes.

### Flow C: The Guest (Experience)
1. **Visit:** Goes to sarah-ahmad.yourdomain.com.
2. **Open:** Sees Curtain Animation, clicks to open.
3. **Interact:**
   - Views photos.
   - Clicks RSVP (Redirects to WhatsApp or Form).
   - Writes a Wish in the Guestbook.
4. **Submit:** Wish is saved to database.

## 6. Screens Needed (UI Overview)

### 1. Super Admin Dashboard
- **Wedding Manager:** Table of all couples.
- **Create Wedding:** Form to register new user + assign subdomain.
- **Template Manager:** Upload/Disable themes.
- **System Health:** DigitalOcean Server metrics.

### 2. Couple Dashboard
- **Home:** Overview of RSVPs (Confirmed/Pending).
- **Editor:** Form to edit details + Live Preview.
- **Theme Selector:** Grid of thumbnail images (Rustic, Luxury, etc.) -> One click to switch.
- **Wishes Feed:** List of guest messages + Button to "Delete" or "Approve".
- **Gallery:** Drag-and-drop photo uploader.

### 3. Public Card (Mobile)
- **The Curtain:** "Tap to Open" overlay.
- **Sections:** Hero, Countdown, Map, Gallery.
- **Guestbook:** Input field Name: | Message: | Submit.

## 7. Technical Implementation Details

### A. Database Schema Updates
- **users table:** Added role (Spatie Role).
- **weddings table:**
  - subdomain (Unique string).
  - template_id (String: e.g., 'rustic').
- **wishes table (New):**
  - wedding_id (Foreign Key).
  - name (Guest Name).
  - message (Text).
  - status (Approved/Pending).

### B. DigitalOcean Manual Setup
Since we are not using Forge, the Server Engineer must manually configure:

- **Web Server:** Install Nginx.
- **PHP:** Install PHP 8.2/8.3 + Extensions (MySQL, GD, Redis, etc.).
- **Process Manager:** Configure Supervisor to keep Laravel Queues running (for sending emails/processing uploads).
- **SSL:** Install Certbot for Wildcard SSL (*.yourdomain.com).
- **Subdomain Logic:** Nginx Server Block configuration to route *.yourdomain.com to /var/www/html/project/public.

### C. Spatie Implementation
```php
// In RolesSeeder
$superAdmin = Role::create(['name' => 'super-admin']);
$couple = Role::create(['name' => 'couple']);

// Assign to user
$user->assignRole('super-admin');
```

## 8. Conclusion
This refined approach creates a Managed Service model. By using Spatie Permissions, we ensure security. The Manual DigitalOcean setup provides full control without the SaaS cost of Forge. The Admin-Driven Registration ensures quality control, while the Guest Wishes and Template Switching features provide high value to the couples.
