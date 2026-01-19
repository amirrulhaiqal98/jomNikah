# Enhanced Curtain Animation - Inspired by ekaddigital

## JomNikah Enhanced Entrance Curtain

Based on ekaddigital.com/ikrizainvite/IK11738, I've created an enhanced curtain animation that incorporates Malaysian Islamic cultural elements while maintaining JomNikah's unique "ritual opening" experience.

---

## Enhanced Curtain Design

### Stage 1: Initial Load (Islamic-Inspired Opening)

```
╔═══════════════════════════════════════════════════════════════════════════╗
║  ⚡ JomNikah - Digital Wedding Card                                  📶 100%     ║
╚═══════════════════════════════════════════════════════════════════════════╝

┌──────────────────────────────────────────────────────────────────────────┐
│                                                                          │
│                     🌸 ELEGANT PINK & GOLD GRADIENT 🌸                       │
│                                                                          │
│              ━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━                    │
│                                                                          │
│                                                                          │
│                              بِسْمِ اللهِ الرَّحْمَنِ الرَّحِيمِ                      │
│                         (In the name of Allah, the Most Gracious)          │
│                                                                          │
│                              ─────────────────                           │
│                                                                          │
│                                    💍                                      │
│                                                                          │
│                              Sarah & Ahmad                                │
│                          Raikan Cinta Sejati                             │
│
│                    The Wedding of Sarah & Ahmad                         │
│                      Request the Pleasure of Your Company                │
│                                                                          │
│              ────────────────────────────────────────                   │
│                                                                          │
│                    📅 Saturday, 28 December 2026                           │
│                       2:00 PM - 6:00 PM                                  │
│                    Grand Hyatt Kuala Lumpur                                │
│                                                                          │
│                    ╔═════════════════════════════════╗                        │
│                    ║   TAP ANYWHERE TO OPEN      ║                        │
│                    ║      Their Wedding Card      ║                        │
│                    ╚═════════════════════════════════╝                        │
│                                                                          │
│                            (Optional)                                      │
│                    🌟 Bismillahirahmanirrahim                           │
│                    (With Allah's Blessings)                              │
│                                                                          │
└──────────────────────────────────────────────────────────────────────────┘
```

### Stage 2: Curtain Animation (2-Stage Reveal)

**Part 1: Split Curtain Opening (0-1.5s)**
```
Frame 0.0s:  [███████████████████████████████████████]  Full curtain
Frame 0.3s:  [█████████████▓▓░░░░░░░░░░░░░░░░░░░░░░░░░]  Splitting starts
Frame 0.6s:  [████████▓▓░░░░░░░░░░░░░░░░░░░░░░░░░░░░░]  Parting more
Frame 0.9s:  [████▓▓░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░]  Almost open
Frame 1.2s:  [▓▓░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░]  Thin strips
Frame 1.5s:  [░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░]  Curtain gone
```

**Part 2: Card Fade-In Reveal (1.5s-2.0s)**
```
Frame 1.5s:  [░░░ Card barely visible ░░░░░]  Opacity: 10%
Frame 1.7s:  [▓▓ Card fading in ▓▓▓▓▓▓▓▓▓▓]  Opacity: 50%
Frame 2.0s:  [███████████████████████████]  Opacity: 100% (FULLY VISIBLE)
```

---

## Enhanced Features (Inspired by ekaddigital)

### 1. Islamic Cultural Header

**Before Curtain:**
```
بِسْمِ اللهِ الرَّحْمَنِ الرَّحِيمِ
(In the name of Allah, the Most Gracious)
```

**Styling:**
- Font: Traditional Arabic calligraphy style (if available) or elegant serif
- Color: `text-emerald-800` (dark green, Islamic association)
- Size: `text-lg` (18px)
- Position: Top center, above couple's names
- Animation: Fade-in with subtle glow effect

**Why This Matters:**
- Honors Malaysian Muslim wedding traditions
- Creates sense of ceremony and blessing
- Cultural alignment with target audience
- Shows respect for Islamic values

---

### 2. Enhanced Couple Names Display

**Before Curtain (on curtain):**
```
                    💍

              Sarah & Ahmad
          Raikan Cinta Sejati
       (True Love Revealed)
```

**Styling:**
- Names: `font-serif text-4xl font-bold text-rose-900` (48px, Playfair Display)
- Subtitle: `text-xl text-rose-700 italic` (20px, elegant)
- Ring Icon: `text-5xl` emoji or SVG icon (48px)
- Position: Center of screen
- Animation: Gentle pulse (scale 1.0 → 1.05 → 1.0 every 2s)

---

### 3. Wedding Details Preview (On Curtain)

**Before Curtain (below names):**
```
              ─────────────────────

               📅 28 December 2026 (Saturday)
               ⏰ 2:00 PM - 6:00 PM
               📍 Grand Hyatt Kuala Lumpur

              ─────────────────────
```

**Styling:**
- Container: White semi-transparent background (`bg-white/90`)
- Border: Gold border (`border-2 border-gold-500`)
- Rounded: `rounded-xl` (12px corners)
- Padding: `p-6` (24px spacing)
- Shadow: `shadow-xl` (elevated above curtain)

**Why Show Details on Curtain:**
- Sets expectations before curtain opens
- Reduces cognitive load (guests know what to expect)
- Creates anticipation
- ekaddigital-style: Information available upfront

---

### 4. Enhanced CTA Button

**Curtain Tap Button:**
```
          ╔═════════════════════════════════════╗
          ║                                       ║
          ║      ✨ BUKA KAD UNDANGAN ✨       ║
          ║      (Open Wedding Invitation)        ║
          ║                                       ║
          ╚═════════════════════════════════════╝

                    [ TAP ANYWHERE ]
```

**Styling:**
- Background: Gold gradient (`bg-gradient-to-r from-gold-400 to-gold-600`)
- Text: `text-white font-bold text-lg` (18px)
- Border: 2px gold border (`border-2 border-gold-300`)
- Shadow: `shadow-lg shadow-gold-500/50` (golden glow)
- Rounded: `rounded-full` (pill shape)
- Padding: `py-4 px-8` (generous touch target)
- Animation: Pulse effect (scale 1.0 → 1.05 → 1.0)

**Malay Language Option:**
```
          ╔═════════════════════════════════════╗
          ║                                       ║
          ║     👆 TEBUS KAD UNDANGAN 👆       ║
          ║     (Open Wedding Invitation)        ║
          ║                                       ║
          ╚═════════════════════════════════════╝
```

**Why Pulse Animation:**
- Draws attention (ekaddigital does this)
- Encourages interaction
- Makes it obvious what to do
- Creates sense of invitation

---

### 5. Enhanced Reveal (After Curtain Opens)

**After Curtain Parts (2 seconds total):**

**Frame 1: Hero Photo Fade-In (0.5s)**
```
┌──────────────────────────────────────────────────────────────────────────┐
│  [Beautiful Wedding Photo - Sarah & Ahmad]                              │
│  ━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━  │
│                        Sarah & Ahmad                                      │
│                    Raikan Cinta Sejati                                     │
│  ━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━  │
│                                                                          │
│  💕 Together with our families, we invite you to share our joy           │
│     and solemnize our union in the presence of Almighty Allah           │
│                                                                          │
│  ━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━  │
```

**Key Enhancements:**
1. **Islamic Opening:** "Together with our families... Almighty Allah"
2. **Fade-In Stagger:** Photo appears first (0.5s), then text (1.0s)
3. **Subtitle Retention:** "Raikan Cinta Sejati" (True Love Revealed)
4. **Smooth Transitions:** All elements fade in with `ease-out` timing

---

### 6. Enhanced Bottom Section (Islamic-Inspired)

**Below Wedding Details:**
```
━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━
│                                                                          │
│  🤲 Your presence is our greatest gift                                  │
│     (Kehadiran anda adalah hadiah terbesar bagi kami)                    │
│                                                                          │
│  ━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━  │
│                                                                          │
│  Doa Selamat (Prayer for Blessing):                                     │
│  "Mudah-mudahan Allah melimpahkan keberkahan..."                       │
│  (May Allah bless this union with ease and grace...)                    │
│                                                                          │
│  ━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━  │
│                                                                          │
│  [📩 RSVP via WhatsApp]    [💬 Leave Guestbook Wish]                   │
│                                                                          │
└──────────────────────────────────────────────────────────────────────────┘
```

---

## Complete User Journey (Enhanced)

### Step-by-Step Experience:

**1. Link Opens (0s):**
- Page loads with elegant pink/gold gradient
- Bismillah fades in at top (0.5s)
- Couple names appear below (1.0s)
- Wedding details show in semi-transparent card (1.5s)
- CTA button pulses gently (continuous)

**2. Guest Taps (2s total):**
- Curtain starts parting left/right (theater style, 1.5s)
- Golden glow effect during opening
- Curtain fades away smoothly
- Wedding card fades in from bottom (0.5s)

**3. Card Revealed (3.5s total):**
- Hero photo appears with Sarah & Ahmad
- "Raikan Cinta Sejati" subtitle
- Islamic opening text about families + Allah
- Wedding details section with date/time/venue
- Prayer for blessing (Doa Selamat)
- RSVP and Guestbook buttons

**4. Emotional Flow:**
- Anticipation (curtain, details preview)
- Delight (reveal, beautiful couple)
- Connection (Islamic values, blessing)
- Warmth (Cultural alignment, respect)
- Action (RSVP, Guestbook)

---

## Color Scheme (Enhanced)

**Background Gradient:**
```
Top:    #FEE2E2 (Rose 100) - Light pink
Middle: #FDF2F8 (Pink 50)   - Soft pink
Bottom: #FEF3C7 (Amber 50)  - Light gold/cream
```

**Text Colors:**
```
Bismillah:     #065F46 (Emerald 800) - Dark green
Couple Names:  #881337 (Rose 900)   - Dark rose
Subtitle:      #BE123C (Rose 700)   - Medium rose
Details:       #374151 (Slate 700)  - Dark gray
```

**Gold Accents:**
```
Border:        #D97706 (Gold 600)   - Medium gold
Background:     #FDE68A (Gold 400)   - Light gold
Glow:          #F59E0B (Gold 500)   - Bright gold
```

---

## Typography (Enhanced)

**Bismillah:**
- Font: Traditional Arabic (if available) or Serif italic
- Size: `text-lg` (18px)
- Weight: `font-medium`
- Color: `text-emerald-800`

**Couple Names:**
- Font: Playfair Display (Serif)
- Size: `text-4xl` (36px mobile, 48px desktop)
- Weight: `font-bold`
- Color: `text-rose-900`

**Subtitle (Raikan Cinta Sejati):**
- Font: Playfair Display
- Size: `text-xl` (20px)
- Weight: `font-medium italic`
- Color: `text-rose-700`

**Body Text:**
- Font: Inter (Sans-serif)
- Size: `text-base` (16px)
- Weight: `font-normal`
- Color: `text-neutral-700`

---

## Animation Timing (Precise)

**Stage 1: Content Load (0-2s)**
```
0.0s:  Bismillah fades in (opacity: 0 → 1, duration: 0.5s)
0.5s:  Ring icon fades in (opacity: 0 → 1, scale: 0.8 → 1.0)
0.8s:  Couple names appear (opacity: 0 → 1, translateY: 10px → 0)
1.2s:  Wedding details card slides up (translateY: 20px → 0, opacity: 0 → 1)
1.5s:  CTA button appears with pulse (opacity: 0 → 1, scale: 1.0 → 1.05)
2.0s:  All animation complete, ready for user interaction
```

**Stage 2: Curtain Opening (2s total)**
```
0.0s:  User taps anywhere
0.1s:  Ripple effect from tap point (visual feedback)
0.2s:  Curtain starts splitting (transform: translateX 0)
1.3s:  Curtain fully parted (transform: translateX ±100%)
1.5s:  Curtain opacity fades to 0 (opacity: 1 → 0)
```

**Stage 3: Card Reveal (0.5s)**
```
1.5s:  Card starts fading in (opacity: 0)
1.7s:  Card at 50% opacity
2.0s:  Card fully visible (opacity: 1)
```

**Total Animation Time: 4 seconds** (from load to full card visibility)

---

## Responsive Design

### Mobile (375px width):
- Bismillah: `text-base` (16px)
- Couple names: `text-3xl` (30px)
- Details card: 90% width
- Single column layout

### Desktop (1024px+ width):
- Bismillah: `text-xl` (20px)
- Couple names: `text-5xl` (48px)
- Details card: 60% width, centered
- Photo can be larger (hero section)

---

## Accessibility Enhancements

**Screen Reader Announcements:**
```
On load: "Wedding card loading for Sarah & Ahmad. Tap to open."
On tap: "Opening wedding card..."
On reveal: "Wedding card revealed. Scroll to RSVP or leave guestbook wish."
```

**Keyboard Navigation:**
- `Tab` focuses on curtain overlay
- `Enter` or `Space` triggers curtain open
- `Escape` (after reveal) goes back to top

**Focus Indicators:**
- 2px rose outline on focus
- High contrast (4.5:1 minimum)

---

## Implementation Code (Vue 3)

```vue
<template>
  <div class="curtain-container">
    <!-- Bismillah Header -->
    <transition name="fade-in" appear>
      <div v-if="showBismillah" class="bismillah-header">
        بِسْمِ اللهِ الرَّحْمَنِ الرَّحِيمِ
      </div>
    </transition>

    <!-- Couple Names -->
    <transition name="slide-up" appear>
      <div v-if="showNames" class="couple-names">
        <div class="ring-icon">💍</div>
        <h1 class="names">Sarah & Ahmad</h1>
        <p class="subtitle">Raikan Cinta Sejati</p>
      </div>
    </transition>

    <!-- Wedding Details Preview -->
    <transition name="slide-up" appear>
      <div v-if="showDetails" class="details-preview">
        <p>📅 Saturday, 28 December 2026</p>
        <p>⏰ 2:00 PM - 6:00 PM</p>
        <p>📍 Grand Hyatt Kuala Lumpur</p>
      </div>
    </transition>

    <!-- CTA Button -->
    <transition name="fade-in" appear>
      <button
        v-if="showCTA"
        @click="openCard"
        class="cta-button pulse-animation"
      >
        ✨ BUKA KAD UNDANGAN ✨
        <span class="tap-hint">(Tap Anywhere)</span>
      </button>
    </transition>

    <!-- Curtain Overlay -->
    <transition name="curtain-open">
      <div v-if="showCurtain" class="curtain-overlay" @click="openCard">
        <div class="curtain-left"></div>
        <div class="curtain-right"></div>
      </div>
    </transition>

    <!-- Wedding Card (Revealed) -->
    <transition name="card-reveal">
      <div v-if="!showCurtain" class="wedding-card">
        <WeddingCardContent />
      </div>
    </transition>
  </div>
</template>

<script setup>
import { ref, onMounted } from 'vue'

const showBismillah = ref(false)
const showNames = ref(false)
const showDetails = ref(false)
const showCTA = ref(false)
const showCurtain = ref(true)

// Staged content loading
onMounted(() => {
  setTimeout(() => showBismillah.value = true, 0)    // 0s
  setTimeout(() => showNames.value = true, 500)        // 0.5s
  setTimeout(() => showDetails.value = true, 800)      // 0.8s
  setTimeout(() => showCTA.value = true, 1200)          // 1.2s
})

const openCard = () => {
  showCurtain.value = false
}

// Auto-reveal after 5 seconds (accessibility)
setTimeout(() => {
  if (showCurtain.value) {
    openCard()
  }
}, 5000)
</script>

<style scoped>
.bismillah-header {
  @apply text-center py-6 text-emerald-800 text-lg font-medium;
  animation: fade-in 0.5s ease-out;
}

.couple-names {
  @apply text-center py-8;
}

.names {
  @apply font-serif text-4xl font-bold text-rose-900;
}

.subtitle {
  @apply text-xl text-rose-700 italic mt-2;
}

.details-preview {
  @apply bg-white/90 border-2 border-gold-500 rounded-xl p-6 mx-auto max-w-md shadow-xl;
  @apply text-center space-y-2 text-neutral-700;
}

.cta-button {
  @apply block mx-auto mt-8 py-4 px-8 font-bold text-lg text-white rounded-full;
  background: linear-gradient(to right, #FBBF24, #F59E0B);
  @apply border-2 border-gold-300 shadow-lg;
  transition: all 0.3s ease;
}

.cta-button:hover {
  @apply scale-105 shadow-xl shadow-gold-500/50;
}

.pulse-animation {
  animation: pulse 2s infinite;
}

@keyframes pulse {
  0%, 100% { transform: scale(1); }
  50% { transform: scale(1.05); }
}

.curtain-left {
  position: absolute;
  inset: 0;
  background: linear-gradient(to right, #FEE2E2, #FDF2F8);
  transition: transform 1.3s ease-in-out;
}

.curtain-right {
  position: absolute;
  inset: 0;
  background: linear-gradient(to left, #FEE2E2, #FDF2F8);
  transition: transform 1.3s ease-in-out;
}

.curtain-open-enter-active .curtain-left {
  transform: translateX(-100%);
}

.curtain-open-enter-active .curtain-right {
  transform: translateX(100%);
}

.curtain-open-enter-to .curtain-overlay,
.curtain-open-leave-to .curtain-overlay {
  opacity: 0;
}

.card-reveal-enter-active {
  transition: all 0.5s ease-out 1.5s;
  animation: fade-in 0.5s ease-out 1.5s both;
}

@keyframes fade-in {
  from { opacity: 0; transform: translateY(20px); }
  to { opacity: 1; transform: translateY(0); }
}
</style>
```

---

## Summary of Enhancements

**What We Borrowed from ekaddigital:**
✅ Islamic cultural header (Bismillah)
✅ Wedding details preview on curtain
✅ Elegant two-stage reveal
✅ Traditional/religious reverence tone
✅ Information upfront before curtain opens

**What Makes JomNikah Unique:**
🎭 **Curtain Animation:** Theater-style parting (not just fade)
🎨 **Rose/Gold Colors:** Warm, celebratory (vs. ekaddigital's neutral)
🎉 **Confetti Celebration:** After 100% setup (not in ekaddigital)
💝 **Guestbook + RSVP:** Real-time features (not in ekaddigital)
📊 **Dashboard Analytics:** Progress tracking, not just static card

**Result:** Enhanced cultural alignment while maintaining JomNikah's unique brand identity!
