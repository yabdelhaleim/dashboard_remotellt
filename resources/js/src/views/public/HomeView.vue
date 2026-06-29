<template>
  <div class="min-h-screen bg-dark-bg text-dark-text flex flex-col justify-between overflow-x-hidden relative">
    
    <!-- Floating background glow spots for the "cheerful/vibrant" dark vibe -->
    <div class="absolute top-[10%] left-[-10%] w-[500px] h-[500px] bg-primary-400 rounded-full blur-[180px] opacity-10 pointer-events-none"></div>
    <div class="absolute top-[40%] right-[-10%] w-[600px] h-[600px] bg-vibrant-purple rounded-full blur-[200px] opacity-15 pointer-events-none"></div>
    <div class="absolute bottom-[10%] left-[10%] w-[500px] h-[500px] bg-vibrant-cyan rounded-full blur-[180px] opacity-10 pointer-events-none"></div>

    <!-- Navbar -->
    <TheNavbar @open-wizard="isWizardOpen = true" />

    <!-- Main Content -->
    <main class="flex-grow relative z-10">
      <!-- Split Hero Section -->
      <SplitHero @open-wizard="isWizardOpen = true" />

      <!-- Products Listing Section -->
      <ProductsSection />

      <!-- Onboarding Steps / How It Works -->
      <HowItWorks @open-wizard="isWizardOpen = true" />

      <!-- Call to Action Section -->
      <CTASection @open-wizard="isWizardOpen = true" />
    </main>

    <!-- Footer -->
    <TheFooter />

    <!-- Intake Wizard Modal (Floating Calendar Scheduling) -->
    <IntakeWizardModal :isOpen="isWizardOpen" @close="isWizardOpen = false" />
  </div>
</template>

<script setup>
import { ref } from 'vue'
import { locale } from '../../utils/locale'
import TheNavbar from '../../components/layout/TheNavbar.vue'
import SplitHero from '../../components/layout/SplitHero.vue'
import ProductsSection from '../../components/home/ProductsSection.vue'
import HowItWorks from '../../components/home/HowItWorks.vue'
import CTASection from '../../components/home/CTASection.vue'
import TheFooter from '../../components/layout/TheFooter.vue'
import IntakeWizardModal from '../../components/home/IntakeWizardModal.vue'

const isWizardOpen = ref(false)
</script>

<style>
/* Smooth fade animations */
.fade-enter-active, .fade-leave-active {
  transition: opacity 0.3s ease;
}
.fade-enter-from, .fade-leave-to {
  opacity: 0;
}
</style>
