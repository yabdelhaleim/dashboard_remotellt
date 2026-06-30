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
        // Primary Brand — Sky Blue (from Logo)
        primary: {
          50:  '#F5F7FA',
          100: '#E1E7F0',
          200: '#C2D1E5',
          400: '#1E90FF', // Sky Blue Primary
          600: '#00B6FF',
          800: '#0087C4',
          900: '#005982',
        },
        charcoal: {
          50:  '#F5F7FA',
          100: '#E4E7EB',
          200: '#CBD2D9',
          700: '#627D98',
          800: '#486581',
          900: '#102A43',
        },
        warm: {
          50:     '#F5F7FA',
          100:    '#E4E7EB',
          200:    '#CBD2D9',
          border: '#334E68',
        },
        // Premium Dark Navy Palette
        dark: {
          bg:     '#0A0E1A', // Deep dark navy
          card:   '#11151F', // Secondary dark navy
          hover:  '#1B202E', // Slightly lighter hover navy
          border: '#1E2536', // Thin blue-gray border
          text:   '#F5F7FA', // Off-white
          muted:  '#9AA4B2', // Light gray muted text
        },
        // Logo Accent colors mapped to sky blue / cyan variants
        vibrant: {
          purple: '#1E90FF', // Sky Blue (Primary)
          pink:   '#00C6FF', // Light Cyan (Secondary)
          blue:   '#2563EB', // Blue
          teal:   '#0EA5E9', // Light Sky Blue
          cyan:   '#00C6FF', // Cyan
          indigo: '#1D4ED8', // Deep Blue
          lime:   '#60A5FA', // Soft Blue
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
        'neon-purple': '0 0 25px rgba(30, 144, 255, 0.3)', // Dodger blue glow
        'neon-cyan':   '0 0 25px rgba(0, 198, 255, 0.3)',  // Cyan glow
        'neon-blue':   '0 0 25px rgba(30, 144, 255, 0.3)',  // Dodger blue glow
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
          '0%, 100%': { boxShadow: '0 0 20px rgba(0, 198, 255, 0.2)' },
          '50%':      { boxShadow: '0 0 35px rgba(0, 198, 255, 0.5)' },
        },
      },
    },
  },
  plugins: [],
}
