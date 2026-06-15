<template>
  <div class="min-h-screen flex bg-dark-bg text-dark-text font-body" dir="rtl">
    <!-- Sidebar -->
    <AdminSidebar />

    <!-- Main Content Area -->
    <div class="flex-grow flex flex-col min-h-screen overflow-x-hidden">
      <!-- Top Header -->
      <header class="bg-dark-card border-b border-dark-border h-16 flex items-center justify-between px-6 z-10">
        <div class="flex items-center gap-3">
          <span class="text-xs font-mono bg-dark-hover px-2.5 py-1.5 rounded-lg border border-dark-border text-vibrant-purple">
            v2.1.0 • SaaS Console
          </span>
        </div>

        <div class="flex items-center gap-4">
          <!-- Live Time Indicator -->
          <div class="hidden sm:flex items-center gap-2 text-xs text-dark-muted font-mono bg-dark-bg/50 px-3 py-1.5 rounded-lg border border-dark-border">
            <span class="w-2 h-2 rounded-full bg-green-500 animate-pulse"></span>
            <span>لوحة تحكم ريموتلي متصلة بالإنترنت</span>
          </div>

          <!-- Quick Access User Profile -->
          <div class="flex items-center gap-2.5 border-r border-dark-border pr-4">
            <div class="w-8 h-8 rounded-full bg-gradient-to-tr from-primary-400 to-vibrant-purple flex items-center justify-center text-xs font-bold text-white shadow-neon-purple">
              RM
            </div>
            <div class="hidden md:block text-right">
              <span class="text-xs font-bold block">فريق ريموتلي</span>
              <span class="text-[9px] text-vibrant-cyan font-mono block">مدير النظام</span>
            </div>
          </div>
        </div>
      </header>

      <!-- Page Content -->
      <main class="flex-1 p-6 overflow-y-auto bg-dark-bg relative">
        <!-- Floating decorative neon blur in background -->
        <div class="absolute -left-32 top-32 w-72 h-72 bg-primary-400 rounded-full blur-3xl opacity-5 pointer-events-none"></div>
        <div class="absolute right-1/4 bottom-10 w-96 h-96 bg-vibrant-purple rounded-full blur-3xl opacity-5 pointer-events-none"></div>

        <div class="relative z-10 max-w-7xl mx-auto space-y-6">
          <router-view />
        </div>
      </main>
    </div>
  </div>
</template>

<script setup>
import AdminSidebar from '../../components/admin/AdminSidebar.vue'
</script>
