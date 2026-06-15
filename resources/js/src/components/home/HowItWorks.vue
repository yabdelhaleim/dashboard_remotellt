<template>
  <section id="how-it-works" class="bg-[#0b0c10] border-y border-dark-border py-24 text-right scroll-mt-24">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      
      <!-- Section Title -->
      <div class="mb-14 text-center md:text-right">
        <span class="font-mono text-[11px] font-semibold text-vibrant-cyan uppercase tracking-widest bg-dark-card px-4 py-2 rounded-full border border-dark-border">
          كيف نعمل • الخطوات
        </span>
        <h2 class="section-headline text-2xl sm:text-3xl text-white mt-4">
          ثلاث خطوات لبدء نظامك السحابي مع ريموتلي
        </h2>
      </div>

      <!-- Steps Grid -->
      <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
        
        <div
          v-for="(step, i) in steps"
          :key="i"
          class="relative bg-dark-card rounded-3xl p-7 sm:p-8 border border-dark-border shadow-card flex flex-col gap-4 hover:border-vibrant-purple/40 hover:shadow-neon-purple transition-all duration-300 group overflow-hidden"
        >
          <!-- Step Number Watermark -->
          <div class="absolute left-5 top-5 font-mono text-7xl font-black text-primary-400/5 select-none group-hover:text-vibrant-purple/8 transition-colors leading-none">
            0{{ i + 1 }}
          </div>

          <div class="relative z-10">
            <div class="font-mono text-xs font-bold text-vibrant-purple mb-3 tracking-widest">
              STEP 0{{ i + 1 }}
            </div>
            <h3 class="font-display font-bold text-lg text-white mb-2 group-hover:text-vibrant-purple transition-colors leading-ar-normal">
              {{ step.title }}
            </h3>
            <p class="font-body font-normal text-slate-300 text-sm leading-ar-relaxed">
              {{ step.description }}
            </p>
          </div>

        </div>

      </div>

      <!-- CTA Under Steps -->
      <div class="mt-12 text-center">
        <button
          @click="$emit('open-wizard')"
          class="font-display font-bold text-sm bg-gradient-to-l from-primary-400 to-vibrant-purple text-white py-3.5 px-8 rounded-2xl shadow-neon-purple hover:-translate-y-0.5 transition-all duration-300 cursor-pointer"
        >
          ابدأ الآن — احجز مقابلتك المجانية
        </button>
      </div>

    </div>
  </section>
</template>

<script setup>
defineEmits(['open-wizard'])

const steps = [
  {
    title: 'تصفح الأنظمة أو أضف فكرتك',
    description: 'تصفح البرمجيات السحابية المعروضة كالمخازن والمطاعم ونقاط البيع، أو حدد رغبتك في بناء نظام مخصص لنشاطك التجاري.',
  },
  {
    title: 'احجز موعد المقابلة الاستشارية',
    description: 'استخدم معالج الحجز الذكي لتعبئة تفاصيل نشاطك، واختيار التوقيت المفضل لعقد الجلسة الافتراضية مع مهندسينا.',
  },
  {
    title: 'تأكيد الحجز وتفعيل النظام',
    description: 'سنتواصل معك عبر الواتساب لتأكيد الموعد وإرسال رابط البث لمناقشة التفاصيل الفنية وتدريب فريقك وتفعيل النظام.',
  },
]
</script>
