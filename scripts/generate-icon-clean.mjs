// Generate a clean icon-only PNG from an SVG we draw ourselves.
// This avoids any artifact from cropping the user's full PNG.
import sharp from 'sharp'
import { writeFileSync } from 'node:fs'

// =====================================================
// ICON SVG — just the R (no text below, no underline dashes)
// Clean: 240×240 viewBox, transparent background, white stroke + cyan inner
// =====================================================
const iconSvg = `<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 240 240" width="240" height="240">
  <defs>
    <linearGradient id="iconBlue" x1="0%" y1="0%" x2="100%" y2="100%">
      <stop offset="0%" stop-color="#00C6FF" />
      <stop offset="100%" stop-color="#1E90FF" />
    </linearGradient>
  </defs>

  <!-- Outer rounded square (white stroke) -->
  <rect x="20" y="20" width="200" height="200" rx="36"
        fill="none" stroke="#FFFFFF" stroke-width="16"
        stroke-linejoin="round" />

  <!-- Diagonal R leg (cyan) -->
  <path d="M 110 130 L 142 130 L 220 220 L 184 220 Z"
        fill="url(#iconBlue)" />

  <!-- Terminal prompt (cyan) -->
  <text x="46" y="130"
        font-family="'IBM Plex Mono','JetBrains Mono',monospace"
        font-size="90" font-weight="900"
        fill="url(#iconBlue)">&gt;_</text>
</svg>`

// Render @2x (480x480) for crisp display, transparent background
// IMPORTANT: sharp requires a Buffer input, not a raw string
const buffer = Buffer.from(iconSvg, 'utf-8')

// Save the SVG too for debugging
writeFileSync('public/_icon-source.svg', iconSvg)

await sharp(buffer, { density: 96 })
  .resize({ width: 480, fit: 'contain', background: { r: 0, g: 0, b: 0, alpha: 0 } })
  .png({ compressionLevel: 9, force: true })
  .toFile('public/remotly_icon_transparent.png')

const meta = await sharp('public/remotly_icon_transparent.png').metadata()
console.log(`✓ public/remotly_icon_transparent.png: ${meta.width}×${meta.height} ${meta.hasAlpha ? 'TRANSPARENT' : 'OPAQUE'}`)

// Verify it's not empty by sampling a pixel where the R should be (the rectangle's stroke)
const { data, info } = await sharp('public/remotly_icon_transparent.png').raw().toBuffer({ resolveWithObject: true })
const sample = (x, y) => {
  const i = (y * info.width + x) * info.channels
  return [data[i], data[i+1], data[i+2], data[i+3]]
}
console.log('  pixel at top-left corner (transparent?):', sample(5, 5))
console.log('  pixel at R stroke (top of R, should be white):', sample(240, 80))
console.log('  pixel at center (should be transparent BG):', sample(240, 240))
