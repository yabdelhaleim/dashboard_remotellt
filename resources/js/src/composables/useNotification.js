import axios from 'axios'
import emailjs from '@emailjs/browser'

export function useNotification() {
  async function sendEmail(leadData) {
    if (!import.meta.env.VITE_EMAILJS_SERVICE_ID) return
    return emailjs.send(
      import.meta.env.VITE_EMAILJS_SERVICE_ID,
      import.meta.env.VITE_EMAILJS_TEMPLATE_ID,
      {
        client_name: leadData.name,
        client_phone: leadData.phone,
        client_whatsapp: leadData.whatsapp || leadData.phone,
        client_address: leadData.address,
        business_type: leadData.business,
        product: leadData.product,
        package: leadData.package,
        notes: leadData.notes,
        submitted_at: new Date().toLocaleString('ar-EG'),
      },
      import.meta.env.VITE_EMAILJS_PUBLIC_KEY
    )
  }

  function buildMessage(leadData) {
    return `🔔 طلب جديد\n\nالاسم: ${leadData.name}\nالهاتف: ${leadData.phone}\nالواتساب: ${leadData.whatsapp || leadData.phone}\nالنشاط: ${leadData.business}\nالبرنامج: ${leadData.product}\nالباقة: ${leadData.package || 'لم يحدد'}\nملاحظات: ${leadData.notes || 'لا يوجد'}\nالوقت: ${new Date().toLocaleString('ar-EG')}`
  }

  async function sendTelegram(leadData) {
    const token = import.meta.env.VITE_TELEGRAM_BOT_TOKEN
    const chatId = import.meta.env.VITE_TELEGRAM_CHAT_ID
    if (!token || !chatId) return
    const text = buildMessage(leadData)
    return axios.post(`https://api.telegram.org/bot${token}/sendMessage`, { chat_id: chatId, text })
  }

  async function sendWhatsapp(leadData) {
    const msg = encodeURIComponent(buildMessage(leadData))
    window.open(`https://wa.me/${import.meta.env.VITE_WHATSAPP_NUMBER}?text=${msg}`, '_blank')
  }

  async function notifyAll(leadData) {
    await Promise.allSettled([
      sendEmail(leadData),
      sendTelegram(leadData),
      // sendWhatsapp(leadData),
    ])
  }

  return { notifyAll, sendEmail, sendTelegram, sendWhatsapp }
}
