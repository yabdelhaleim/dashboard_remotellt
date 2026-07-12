// Generate transparent-bg logo PNG and hero-bg PNG for the navbar + hero
import sharp from 'sharp'
import { writeFileSync } from 'node:fs'

const OUT = 'public'

// ============================================================
// 1) TRANSPARENT-BG LOGO — horizontal compact: [R icon] Remotely
//    Drawn at 600×135 SVG (transparent background), rendered @3x → 1800×405
// ============================================================
const logoSvg = `<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 600 135" width="600" height="135">
  <defs>
    <linearGradient id="logoBlue" x1="0%" y1="0%" x2="100%" y2="100%">
      <stop offset="0%" stop-color="#00C6FF" />
      <stop offset="100%" stop-color="#1E90FF" />
    </linearGradient>
    <linearGradient id="logoTextGrad" x1="0%" y1="0%" x2="100%" y2="0%">
      <stop offset="0%" stop-color="#FFFFFF" />
      <stop offset="100%" stop-color="#E2F4FF" />
    </linearGradient>
  </defs>

  <!-- R icon group, placed at (0,0) sized 135×135 -->
  <g transform="translate(0,0)">
    <!-- Outer rounded square -->
    <rect x="10" y="10" width="115" height="115" rx="20" fill="none" stroke="url(#logoBlue)" stroke-width="9" stroke-linejoin="round" />
    <!-- Diagonal R leg -->
    <path d="M 64 70 L 80 70 L 130 122 L 112 122 Z" fill="url(#logoBlue)" />
    <!-- Terminal prompt -->
    <text x="22" y="68" font-family="'IBM Plex Mono','JetBrains Mono',monospace" font-size="50" font-weight="900" fill="url(#logoBlue)">&gt;_</text>
  </g>

  <!-- "Remotely" wordmark, starts at x=160, centered vertically -->
  <text x="160" y="85"
        font-family="'Outfit','IBM Plex Sans',sans-serif"
        font-size="78"
        font-weight="800"
        letter-spacing="-1"
        fill="url(#logoTextGrad)">Remotely</text>

  <!-- "— Team Online —" tagline under Remotely -->
  <g transform="translate(160, 115)">
    <line x1="0" y1="-4" x2="35" y2="-4" stroke="#00C6FF" stroke-width="1.6" stroke-linecap="round" />
    <text x="42" y="0"
          font-family="'Outfit','IBM Plex Sans',sans-serif"
          font-size="14"
          font-weight="600"
          letter-spacing="3.5"
          fill="#00C6FF">TEAM ONLINE</text>
    <line x1="178" y1="-4" x2="213" y2="-4" stroke="#00C6FF" stroke-width="1.6" stroke-linecap="round" />
  </g>
</svg>`

// Render @2x for crisp display on retina, transparent background
await sharp(Buffer.from(logoSvg))
  .resize({ width: 1200 })   // 2× of 600px source
  .png({ compressionLevel: 9 })
  .toFile(`${OUT}/logo-navbar.png`)
console.log('✓ logo-navbar.png created (transparent, 1200px wide)')

// ============================================================
// 2) HERO BACKGROUND — dark atmospheric image (1920×1080)
//    Layers:
//      • Deep navy base (#040814)
//      • Big radial cyan glows (top-left + bottom-right)
//      • Subtle dot grid pattern
//      • Vignette darkening at the corners
// ============================================================
const heroBgSvg = `<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1920 1080" width="1920" height="1080">
  <defs>
    <radialGradient id="glowTL" cx="20%" cy="30%" r="55%">
      <stop offset="0%"   stop-color="#00C6FF" stop-opacity="0.32" />
      <stop offset="60%"  stop-color="#1E90FF" stop-opacity="0.10" />
      <stop offset="100%" stop-color="#040814" stop-opacity="0" />
    </radialGradient>
    <radialGradient id="glowBR" cx="80%" cy="70%" r="60%">
      <stop offset="0%"   stop-color="#2563EB" stop-opacity="0.30" />
      <stop offset="50%"  stop-color="#1E90FF" stop-opacity="0.08" />
      <stop offset="100%" stop-color="#040814" stop-opacity="0" />
    </radialGradient>
    <radialGradient id="vignette" cx="50%" cy="50%" r="65%">
      <stop offset="55%"  stop-color="#040814" stop-opacity="0" />
      <stop offset="100%" stop-color="#02050D" stop-opacity="0.85" />
    </radialGradient>
    <pattern id="dotGrid" x="0" y="0" width="48" height="48" patternUnits="userSpaceOnUse">
      <circle cx="24" cy="24" r="1.3" fill="#00C6FF" fill-opacity="0.10" />
    </pattern>
  </defs>

  <!-- Deep navy base -->
  <rect width="1920" height="1080" fill="#040814" />

  <!-- Subtle dot grid -->
  <rect width="1920" height="1080" fill="url(#dotGrid)" />

  <!-- Glow (top-left) -->
  <rect width="1920" height="1080" fill="url(#glowTL)" />

  <!-- Glow (bottom-right) -->
  <rect width="1920" height="1080" fill="url(#glowBR)" />

  <!-- Subtle diagonal accent lines (very faint) -->
  <g stroke="#00C6FF" stroke-width="0.5" stroke-opacity="0.07">
    <line x1="-200" y1="200"  x2="2120" y2="880" />
    <line x1="-200" y1="500"  x2="2120" y2="1180" />
    <line x1="-200" y1="800"  x2="2120" y2="1480" />
  </g>

  <!-- Vignette to darken corners -->
  <rect width="1920" height="1080" fill="url(#vignette)" />
</svg>`

// Convert SVG → PNG. Use a moderate quality for size.
await sharp(Buffer.from(heroBgSvg))
  .jpeg({ quality: 88, progressive: true, mozjpeg: false })
  .toFile(`${OUT}/hero-bg.jpg`)   // jpg is smaller for photographic bg, but the user said png — let's also do png
console.log('✓ hero-bg.jpg created')

// Same svg → png for the user's spec
await sharp(Buffer.from(heroBgSvg))
  .png({ compressionLevel: 9, palette: true })
  .toFile(`${OUT}/hero-bg.png`)
console.log('✓ hero-bg.png created')

console.log('\nAll assets generated.')
