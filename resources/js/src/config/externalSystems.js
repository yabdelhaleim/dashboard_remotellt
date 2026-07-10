/**
 * روابط داشبوردات أنظمة SaaS.
 * ضع الرابط الكامل في .env ثم أعد بناء الـ frontend: npm run build
 */
export const externalSystems = [
  {
    label: 'لوحة تحكم الأنظمة',
    icon: '🖥️',
    url: import.meta.env.VITE_SAAS_ADMIN_URL,
  },
].filter((system) => system.url)
