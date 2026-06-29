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
        // Primary Brand — Elegant Violet
        primary: {
          50:  '#FDF8FC',
          100: '#F5E6F2',
          200: '#EABBE0',
          400: '#714B67',
          600: '#5C3D54',
          800: '#432B3C',
          900: '#2A1A26',
        },
        charcoal: {
          50:  '#F8FAFC',
          100: '#F1F5F9',
          400: '#94A3B8',
          700: '#475569',
          800: '#1E293B',
          900: '#0F172A',
        },
        warm: {
          50:     '#FAF9FC',
          100:    '#F4F2F7',
          200:    '#ECE8F2',
          border: '#E2DFE8',
        },
        // Premium Dark Palette
        dark: {
          bg:     '#08090C',
          card:   '#0F111A',
          hover:  '#171A26',
          border: '#1D2132',
          text:   '#E2E8F0',
          muted:  '#64748B',
        },
        // Vibrant Accent Colors
        vibrant: {
          purple: '#A855F7',
          pink:   '#EC4899',
          blue:   '#3B82F6',
          teal:   '#14B8A6',
          cyan:   '#06B6D4',
          indigo: '#6366F1',
          lime:   '#84CC16',
        },
      },
      fontFamily: {
        display: ['Cairo', 'Reem Kufi', 'sans-serif'],
        body:    ['Reem Kufi', 'Cairo', 'sans-serif'],
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
