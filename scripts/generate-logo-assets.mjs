// Copy the user-provided full logo + create icon-only version from it.
// The user gave us: C:/Users/PC/Downloads/remotly_logo_full_transparent (1).png (1254x698, RGBA, transparent)
import sharp from 'sharp'
import { copyFileSync } from 'node:fs'

const USER_FILE = 'C:/Users/PC/Downloads/remotly_logo_full_transparent (1).png'

// 1) Copy the full logo with the requested name (no spaces, no "(1)").
copyFileSync(USER_FILE, 'public/remotly_logo_full_transparent.png')
console.log('✓ public/remotly_logo_full_transparent.png copied from user file')

// 2) Create icon-only by cropping the top portion of the full logo.
//    The R icon is positioned at the top of the 1254×698 image with padding.
//    We crop a tight square around just the R symbol.
const meta = await sharp(USER_FILE).metadata()
console.log(`  source: ${meta.width}×${meta.height}`)

// The R icon takes the top portion of the image. After inspection, it's roughly
// positioned from y=80 to y=290, centered horizontally.
// To get a clean square icon, crop centered: 380×380 starting from (centerX-190, 50).
const cropSide = 380
const cropX = Math.floor((meta.width - cropSide) / 2)
const cropY = 50
const cropW = cropSide
const cropH = cropSide

const extracted = await sharp(USER_FILE)
  .extract({ left: cropX, top: cropY, width: cropW, height: cropH })
  .png({ compressionLevel: 9 })
  .toBuffer()

// Resize to a clean icon size, keeping it crisp
await sharp(extracted)
  .resize({ width: 256, fit: 'contain', background: { r: 0, g: 0, b: 0, alpha: 0 } })
  .png({ compressionLevel: 9 })
  .toFile('public/remotly_icon_transparent.png')
console.log('✓ public/remotly_icon_transparent.png created')

// Verify
const iconMeta = await sharp('public/remotly_icon_transparent.png').metadata()
console.log(`  icon: ${iconMeta.width}×${iconMeta.height} ${iconMeta.hasAlpha ? 'TRANSPARENT' : 'OPAQUE'}`)
