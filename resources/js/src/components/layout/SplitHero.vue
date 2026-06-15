<template>
  <section class="max-w-7xl mx-auto mt-8 mb-16 px-4 sm:px-6 lg:px-8 relative">
    
    <!-- Hero Layout Grid -->
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 lg:gap-16 items-center min-h-[560px] py-10">
      
      <!-- Right Side: Text & Actions -->
      <div class="lg:col-span-7 space-y-7 text-right animate-slide-right">
        
        <!-- Premium Badge -->
        <div class="inline-flex items-center gap-2.5 px-4 py-2 bg-dark-card border border-dark-border rounded-full select-none">
          <span class="flex h-2 w-2 rounded-full bg-vibrant-purple animate-pulse shrink-0"></span>
          <span class="font-mono text-[11px] font-semibold text-slate-300 tracking-widest uppercase">
            REMOTELLY AGENCY • SAAS SOLUTIONS
          </span>
        </div>

        <!-- Headline — الأهم: توضيح الخط -->
        <h1 class="hero-headline text-[2rem] sm:text-[2.5rem] lg:text-[2.75rem] text-white">
          امتلك نظامك
          <span class="relative inline-block">
            <span class="bg-gradient-to-l from-vibrant-cyan via-vibrant-purple to-primary-200 bg-clip-text text-transparent">
              السحابي الذكي
            </span>
          </span>
          <br />
          <span class="text-slate-200">وأدر أعمالك بكفاءة</span>
        </h1>

        <!-- Subheading -->
        <p class="font-body font-normal text-slate-300 text-base sm:text-lg leading-ar-relaxed max-w-xl">
          فريق ريموتلي يصمم ويبني لك أنظمة مخصصة لإدارة المخازن، المطاعم، والكاشير. نساعدك على أتمتة مبيعاتك ومراقبة أرباحك من أي مكان.
        </p>

        <!-- Benefit Checklist -->
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-3.5">
          <div
            v-for="feat in features"
            :key="feat.label"
            class="flex items-center gap-3.5 bg-dark-card/60 border border-dark-border/70 p-4 rounded-2xl hover:border-vibrant-purple/30 transition-all duration-300"
          >
            <span
              :class="`w-9 h-9 rounded-xl ${feat.bg} flex items-center justify-center ${feat.color} text-base shrink-0`"
            >{{ feat.icon }}</span>
            <div>
              <span class="font-display font-bold text-sm text-white block leading-snug">{{ feat.label }}</span>
              <span class="font-body font-normal text-xs text-dark-muted block mt-0.5 leading-snug">{{ feat.sub }}</span>
            </div>
          </div>
        </div>

        <!-- Action Buttons -->
        <div class="flex flex-col sm:flex-row gap-4 pt-2 justify-end">
          <button
            @click="$emit('open-wizard')"
            class="bg-gradient-to-l from-primary-400 to-vibrant-purple text-white font-display font-bold py-3.5 px-8 rounded-2xl transition-all duration-300 shadow-neon-purple hover:-translate-y-0.5 active:translate-y-0 cursor-pointer text-sm text-center hover:shadow-[0_0_35px_rgba(168,85,247,0.45)]"
          >
            ✨ احجز استشارتك المجانية الآن
          </button>
          
          <a
            href="#products"
            class="bg-dark-card hover:bg-dark-hover text-dark-text border border-dark-border font-display font-semibold py-3.5 px-7 rounded-2xl transition-all duration-300 text-center text-sm hover:-translate-y-0.5 active:translate-y-0"
          >
            استعرض أنظمتنا
          </a>
        </div>

      </div>

      <!-- Left Side: CSS Dashboard Mockup -->
      <div class="lg:col-span-5 animate-slide-left relative flex items-center justify-center">
        <!-- Glow Backing -->
        <div class="absolute w-72 h-72 bg-vibrant-purple rounded-full blur-[110px] opacity-15 pointer-events-none"></div>

        <!-- Dashboard Card -->
        <div class="relative bg-[#0e1018]/90 backdrop-blur-lg border border-dark-border p-6 rounded-3xl w-full max-w-[360px] shadow-premium space-y-5 select-none animate-float">
          
          <!-- Window bar -->
          <div class="flex items-center justify-between border-b border-dark-border/50 pb-3">
            <div class="flex items-center gap-1.5">
              <span class="w-3 h-3 rounded-full bg-red-500/80"></span>
              <span class="w-3 h-3 rounded-full bg-yellow-500/80"></span>
              <span class="w-3 h-3 rounded-full bg-green-500/80"></span>
            </div>
            <span class="font-mono text-[10px] text-dark-muted uppercase tracking-widest">remotelly.dashboard</span>
          </div>

          <!-- Stats Row -->
          <div class="grid grid-cols-2 gap-3">
            <div class="bg-dark-bg border border-dark-border p-3.5 rounded-2xl text-right">
              <span class="font-body text-[10px] text-dark-muted block mb-1">مبيعات اليوم</span>
              <span class="font-mono text-base font-bold text-vibrant-cyan block">2,490 ج</span>
            </div>
            <div class="bg-dark-bg border border-dark-border p-3.5 rounded-2xl text-right">
              <span class="font-body text-[10px] text-dark-muted block mb-1">الحركات</span>
              <span class="font-mono text-base font-bold text-vibrant-purple block">+142 حركة</span>
            </div>
          </div>

          <!-- Bar Chart -->
          <div class="bg-dark-bg border border-dark-border p-4 rounded-2xl space-y-2.5">
            <div class="flex items-center justify-between">
              <span class="font-body text-[10px] text-slate-300 font-semibold">نمو الأداء الأسبوعي</span>
              <span class="font-mono text-[10px] text-vibrant-teal font-bold">+24%</span>
            </div>
            <div class="h-16 flex items-end justify-between gap-1.5">
              <div class="bg-dark-hover w-full rounded h-[35%]"></div>
              <div class="bg-dark-hover w-full rounded h-[60%]"></div>
              <div class="bg-gradient-to-t from-primary-400 to-vibrant-purple w-full rounded h-[82%] shadow-neon-purple"></div>
              <div class="bg-dark-hover w-full rounded h-[48%]"></div>
              <div class="bg-gradient-to-t from-vibrant-blue to-vibrant-cyan w-full rounded h-[95%] shadow-neon-cyan"></div>
              <div class="bg-dark-hover w-full rounded h-[55%]"></div>
            </div>
          </div>

          <!-- Activity Log -->
          <div class="space-y-2">
            <span class="font-body text-[10px] text-dark-muted block">آخر حركة للأنظمة:</span>
            <div class="flex items-center justify-between bg-dark-bg/70 border border-dark-border/50 p-2.5 rounded-xl">
              <div class="flex items-center gap-2">
                <span>📦</span>
                <span class="font-body font-semibold text-[11px] text-white">تعديل كمية المخزون</span>
              </div>
              <span class="font-mono text-[10px] text-dark-muted">منذ دقيقة</span>
            </div>
            <div class="flex items-center justify-between bg-dark-bg/70 border border-dark-border/50 p-2.5 rounded-xl">
              <div class="flex items-center gap-2">
                <span>🧾</span>
                <span class="font-body font-semibold text-[11px] text-white">فاتورة مبيعات جديدة</span>
              </div>
              <span class="font-mono text-[10px] text-dark-muted">منذ 3 دقائق</span>
            </div>
          </div>

          <!-- Live Badge -->
          <div class="flex items-center justify-center gap-2 bg-vibrant-purple/5 border border-vibrant-purple/20 rounded-xl p-2">
            <span class="w-1.5 h-1.5 rounded-full bg-vibrant-purple animate-pulse"></span>
            <span class="font-mono text-[10px] text-vibrant-purple font-semibold tracking-wider">LIVE SYSTEM • ONLINE</span>
          </div>

        </div>
      </div>

    </div>
  </section>
</template>

<script setup>
defineEmits(['open-wizard'])

const features = [
  {
    icon: '⚡',
    label: 'تفعيل فوري',
    sub: 'جاهز للعمل خلال 24 ساعة',
    bg: 'bg-vibrant-purple/10',
    color: 'text-vibrant-purple',
  },
  {
    icon: '🛡️',
    label: 'أمان كامل للبيانات',
    sub: 'نسخ احتياطي سحابي تلقائي',
    bg: 'bg-vibrant-cyan/10',
    color: 'text-vibrant-cyan',
  },
  {
    icon: '🤝',
    label: 'جلسة استشارية مجانية',
    sub: 'نناقش فكرتك أونلاين',
    bg: 'bg-vibrant-teal/10',
    color: 'text-vibrant-teal',
  },
  {
    icon: '🛠️',
    label: 'دعم فني متكامل',
    sub: 'تحديثات دورية وصيانة مستمرة',
    bg: 'bg-vibrant-pink/10',
    color: 'text-vibrant-pink',
  },
]
</script>
