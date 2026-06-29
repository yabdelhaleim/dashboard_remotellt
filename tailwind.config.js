/** @type {import('tailwindcss').Config} */
export default {
  content: [
    './resources/views/**/*.blade.php',
    './resources/js/**/*.js',
    './resources/js/**/*.vue',
    './resources/css/**/*.css',
  ],
  theme: {
    extend: {
      colors: {
        // Primary Brand — Warm Rust (from Logo)
        primary: {
          50:  '#FAF8F5',
          100: '#FBEFEA',
          200: '#F5D7C9',
          400: '#C06C47', // Rust Orange
          600: '#A15431',
          800: '#773D22',
          900: '#4B2412',
        },
        charcoal: {
          50:  '#FAF9F6',
          100: '#F4F2EE',
          200: '#E4DFD9',
          700: '#7E766D',
          800: '#4D4741',
          900: '#2A2622',
        },
        warm: {
          50:     '#FDFBF7',
          100:    '#FAF6F0',
          200:    '#F1EAE0',
          border: '#E3D8C8',
        },
        // Sophisticated Dark Sienna Palette (for warm dark mode)
        dark: {
          bg:     '#0C0B0A', // Deep obsidian black-brown
          card:   '#141311', // Warm dark clay sienna
          hover:  '#1C1B18', // Warm hover clay
          border: '#262420', // Earthy border
          text:   '#FAF8F5', // Warm cream white
          muted:  '#908980', // Earthy muted gray
        },
        // Logo Accent colors mapped to existing classes to preserve layout styles
        vibrant: {
          purple: '#C06C47', // Rust Orange
          pink:   '#D49B4B', // Ochre Gold
          blue:   '#4E6B53', // Olive Forest Green
          teal:   '#5C7D61', // Sage Green
          cyan:   '#E2865E', // Light Terracotta
          indigo: '#A6532C', // Deep Ochre
          lime:   '#A2B591', // Soft Moss
        },
      },
      fontFamily: {
        display: ['Cairo', 'sans-serif'],
        body:    ['Cairo', 'sans-serif'],
        mono:    ['IBM Plex Mono', 'monospace'],
      },
      fontSize: {
        // Arabic needs slightly larger base
        'xs':   ['0.8125rem',  { lineHeight: '1.6',  letterSpacing: '0' }],
        'sm':   ['0.9375rem',  { lineHeight: '1.7',  letterSpacing: '0' }],
        'base': ['1.0625rem',  { lineHeight: '1.75', letterSpacing: '0' }],
        'lg':   ['1.1875rem',  { lineHeight: '1.7',  letterSpacing: '0' }],
        'xl':   ['1.3125rem',  { lineHeight: '1.65', letterSpacing: '0' }],
        '2xl':  ['1.5625rem',  { lineHeight: '1.6',  letterSpacing: '0' }],
        '3xl':  ['1.875rem',   { lineHeight: '1.6',  letterSpacing: '0' }],
        '4xl':  ['2.25rem',    { lineHeight: '1.55', letterSpacing: '0' }],
        '5xl':  ['2.75rem',    { lineHeight: '1.5',  letterSpacing: '0' }],
      },
      lineHeight: {
        'ar-tight':  '1.5',
        'ar-normal': '1.7',
        'ar-relaxed': '1.85',
        'ar-loose':  '2.0',
      },
      letterSpacing: {
        // Arabic: always 0 or very minimal
        'ar': '0',
      },
      boxShadow: {
        'neon-purple': '0 0 25px rgba(168, 85, 247, 0.3)',
        'neon-cyan':   '0 0 25px rgba(6, 182, 212, 0.3)',
        'neon-blue':   '0 0 25px rgba(59, 130, 246, 0.3)',
        'premium':     '0 8px 40px rgba(0, 0, 0, 0.5)',
        'card':        '0 4px 24px rgba(0, 0, 0, 0.3)',
      },
      animation: {
        'slide-up':    'slideUp 0.5s cubic-bezier(0.16, 1, 0.3, 1) forwards',
        'slide-right': 'slideRight 0.6s cubic-bezier(0.16, 1, 0.3, 1) forwards',
        'slide-left':  'slideLeft 0.6s cubic-bezier(0.16, 1, 0.3, 1) forwards',
        'fade-in':     'fadeIn 0.4s ease forwards',
        'float':       'float 3s ease-in-out infinite',
        'pulse-glow':  'pulseGlow 2s ease-in-out infinite',
      },
      keyframes: {
        slideUp: {
          'from': { opacity: '0', transform: 'translateY(24px)' },
          'to':   { opacity: '1', transform: 'translateY(0)' },
        },
        slideRight: {
          'from': { opacity: '0', transform: 'translateX(32px)' },
          'to':   { opacity: '1', transform: 'translateX(0)' },
        },
        slideLeft: {
          'from': { opacity: '0', transform: 'translateX(-32px)' },
          'to':   { opacity: '1', transform: 'translateX(0)' },
        },
        fadeIn: {
          'from': { opacity: '0' },
          'to':   { opacity: '1' },
        },
        float: {
          '0%, 100%': { transform: 'translateY(0)' },
          '50%':      { transform: 'translateY(-8px)' },
        },
        pulseGlow: {
          '0%, 100%': { boxShadow: '0 0 20px rgba(168, 85, 247, 0.2)' },
          '50%':      { boxShadow: '0 0 35px rgba(168, 85, 247, 0.5)' },
        },
      },
    },
  },
  plugins: [],
}
