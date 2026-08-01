// =====================================================================
// analytics.js — Unified tracking for GA4 + Meta Pixel
// =====================================================================
// All tracking IDs come from `window.REMOTELY_TRACKING` which is injected
// by the Blade template from the .env values. This way nothing leaks to
// the public bundle accidentally.
//
// USAGE (from any Vue component):
//
//   import { trackEvent, trackPageView } from '@/utils/analytics'
//   trackEvent('cta_click', { button: 'book_consultation' })
//   trackPageView('/packages')  // automatic on router change
//
// =====================================================================

const hasGA4 = () => typeof window.gtag === 'function'
const hasPixel = () => typeof window.fbq === 'function'

/* ------------------------------------------------------------------ */
/* Page views                                                          */
/* ------------------------------------------------------------------ */
export function trackPageView(path) {
  // GA4 page_view
  if (hasGA4()) {
    window.gtag('event', 'page_view', {
      page_path: path,
      page_title: document.title,
      page_location: window.location.href,
    })
  }

  // Meta Pixel PageView
  if (hasPixel()) {
    window.fbq('track', 'PageView')
  }
}

/* ------------------------------------------------------------------ */
/* Generic event tracking                                              */
/* ------------------------------------------------------------------ */
export function trackEvent(eventName, params = {}) {
  // GA4 custom event
  if (hasGA4()) {
    window.gtag('event', eventName, params)
  }

  // Meta Pixel — fallback to CustomEvent if no standard event matches
  if (hasPixel()) {
    window.fbq('trackCustom', eventName, params)
  }
}

/* ------------------------------------------------------------------ */
/* Meta Pixel standard events (richer matching for ads optimization)  */
/* ------------------------------------------------------------------ */
export const pixel = {
  viewContent: (params = {}) => hasPixel() && window.fbq('track', 'ViewContent', params),
  lead:        (params = {}) => hasPixel() && window.fbq('track', 'Lead', params),
  contact:     (params = {}) => hasPixel() && window.fbq('track', 'Contact', params),
  submitForm:  (params = {}) => hasPixel() && window.fbq('track', 'SubmitApplication', params),
  schedule:    (params = {}) => hasPixel() && window.fbq('track', 'Schedule', params),
  initiateCheckout: (params = {}) => hasPixel() && window.fbq('track', 'InitiateCheckout', params),
  purchase:    (params = {}, value = 0, currency = 'EGP') => {
    if (hasPixel()) window.fbq('track', 'Purchase', { ...params, value, currency })
  },
}

/* ------------------------------------------------------------------ */
/* Convenience helpers for common Remotely events                      */
/* ------------------------------------------------------------------ */
export function trackCTAClick(label, extra = {}) {
  trackEvent('cta_click', { button_label: label, ...extra })
  pixel.lead({ content_name: label, ...extra })
}

export function trackWizardStep(step, total, extra = {}) {
  trackEvent('wizard_step', { step, total_steps: total, ...extra })
}

export function trackWizardComplete(extra = {}) {
  trackEvent('wizard_complete', extra)
  pixel.schedule({ content_category: 'consultation_booking', ...extra })
}

export function trackLanguageSwitch(from, to) {
  trackEvent('language_switch', { from, to })
}

export function trackProductView(slug, name, price) {
  trackEvent('view_item', { item_id: slug, item_name: name, price })
  pixel.viewContent({ content_ids: [slug], content_name: name, content_type: 'product' })
}

export function trackSupportTicketSubmit(subject) {
  trackEvent('support_ticket_submit', { subject })
  pixel.contact({ content_name: 'support_ticket', subject })
}

export function trackContactClick(method, target) {
  trackEvent('contact_click', { method, target })
  pixel.contact({ content_category: 'contact', contact_method: method })
}

export default {
  trackPageView,
  trackEvent,
  trackCTAClick,
  trackWizardStep,
  trackWizardComplete,
  trackLanguageSwitch,
  trackProductView,
  trackSupportTicketSubmit,
  trackContactClick,
  pixel,
}