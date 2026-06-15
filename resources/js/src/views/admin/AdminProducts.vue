<template>
  <div class="space-y-6 text-right font-body text-dark-text">
    
    <!-- Header Section -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between border-b border-dark-border pb-5 gap-4">
      <div>
        <h2 class="font-display font-black text-2xl text-white">إدارة البرامج والأنظمة</h2>
        <p class="text-dark-muted text-xs mt-1">عرض، تعديل، وإضافة الأنظمة والبرامج المعروضة في منصة ريموتلي</p>
      </div>

      <!-- Add Product Action Button -->
      <button 
        @click="openAddModal" 
        class="bg-gradient-to-r from-primary-400 to-vibrant-purple hover:opacity-95 text-white font-bold py-2.5 px-5 rounded-xl text-xs transition-all shadow-neon-purple flex items-center justify-center gap-1.5 cursor-pointer self-start sm:self-auto"
      >
        <span>➕</span>
        <span>إضافة برنامج جديد</span>
      </button>
    </div>

    <!-- Add/Edit Modal (or inline card if preferred, let's do a beautiful card overlay when active) -->
    <div 
      v-if="showForm" 
      class="bg-dark-card border border-vibrant-purple/40 shadow-neon-purple rounded-2xl p-6 space-y-4 max-w-2xl mx-auto"
    >
      <h3 class="text-base font-bold text-white border-b border-dark-border pb-3 flex items-center gap-2">
        <span>{{ isEditingMode ? '✏️ تعديل بيانات النظام' : '✨ إضافة نظام جديد بالكامل' }}</span>
      </h3>

      <form @submit.prevent="submitForm" class="space-y-4">
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
          <div>
            <label class="block text-xs font-bold text-dark-muted mb-1.5">اسم النظام *</label>
            <input 
              type="text" 
              v-model="form.name" 
              placeholder="مثال: نظام إدارة المخازن (مخزني)"
              class="w-full px-4 py-2.5 rounded-xl border border-dark-border bg-dark-bg text-dark-text text-sm focus:outline-none focus:ring-2 focus:ring-primary-400"
              required
            />
          </div>

          <div>
            <label class="block text-xs font-bold text-dark-muted mb-1.5">الرمز التعريفي (Slug) *</label>
            <input 
              type="text" 
              v-model="form.slug" 
              placeholder="مثال: warehouse"
              class="w-full px-4 py-2.5 rounded-xl border border-dark-border bg-dark-bg text-dark-text text-sm focus:outline-none focus:ring-2 focus:ring-primary-400 font-mono text-left"
              dir="ltr"
              :disabled="isEditingMode"
              required
            />
          </div>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
          <div>
            <label class="block text-xs font-bold text-dark-muted mb-1.5">الأيقونة (رمز تعبيري Emoji) *</label>
            <input 
              type="text" 
              v-model="form.icon" 
              placeholder="مثال: 📦 أو 🍔"
              class="w-full px-4 py-2.5 rounded-xl border border-dark-border bg-dark-bg text-dark-text text-sm focus:outline-none focus:ring-2 focus:ring-primary-400 text-center"
              required
            />
          </div>

          <div>
            <label class="block text-xs font-bold text-dark-muted mb-1.5">رابط الباقات المخصص (رابط إعادة توجيه) - اختياري</label>
            <input 
              type="text" 
              v-model="form.externalUrl" 
              placeholder="مثال: /product/warehouse أو رابط خارجي"
              class="w-full px-4 py-2.5 rounded-xl border border-dark-border bg-dark-bg text-dark-text text-xs focus:outline-none focus:ring-2 focus:ring-primary-400 text-left font-mono"
              dir="ltr"
            />
          </div>
        </div>

        <div>
          <label class="block text-xs font-bold text-dark-muted mb-1.5">وصف تفصيلي للنظام *</label>
          <textarea 
            v-model="form.description" 
            rows="3" 
            placeholder="اشرح مميزات ووظائف هذا البرنامج للعميل..."
            class="w-full px-4 py-3 rounded-xl border border-dark-border bg-dark-bg text-dark-text text-sm focus:outline-none focus:ring-2 focus:ring-primary-400 leading-relaxed"
            required
          ></textarea>
        </div>

        <div class="flex items-center gap-3 pt-2">
          <button 
            type="submit" 
            class="bg-gradient-to-r from-primary-400 to-vibrant-purple text-white font-bold py-2.5 px-6 rounded-xl text-xs transition-all shadow-neon-purple/20 cursor-pointer"
          >
            {{ isEditingMode ? 'حفظ التغييرات' : 'إنشاء النظام' }}
          </button>
          <button 
            type="button" 
            @click="closeForm" 
            class="bg-dark-hover hover:bg-dark-border text-dark-text font-bold py-2.5 px-6 rounded-xl text-xs border border-dark-border transition-all cursor-pointer"
          >
            إلغاء
          </button>
        </div>
      </form>
    </div>

    <!-- Products Grid (Odoo Layout with Glow Cards) -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
      <div 
        v-for="p in products" 
        :key="p.id" 
        class="bg-dark-card rounded-2xl border border-dark-border shadow-sm p-6 sm:p-8 transition-all duration-300 hover:border-vibrant-purple/40 hover:shadow-neon-purple flex flex-col justify-between"
      >
        <div>
          <div class="flex items-start justify-between border-b border-dark-border pb-4 mb-4">
            <div class="flex items-center gap-3">
              <span class="text-3xl bg-dark-bg p-2 rounded-xl border border-dark-border select-none">
                {{ p.icon || '⚙️' }}
              </span>
              <div>
                <h3 class="font-display font-bold text-lg text-white">{{ p.name }}</h3>
                <span class="text-[10px] font-mono text-vibrant-cyan block mt-0.5">Slug: {{ p.slug }}</span>
              </div>
            </div>

            <!-- Actions buttons -->
            <div class="flex items-center gap-1.5">
              <button 
                @click="openEditForm(p)" 
                class="bg-dark-hover hover:bg-dark-border text-dark-text p-2 rounded-lg border border-dark-border transition-all cursor-pointer"
                title="تعديل النظام"
              >
                ✏️
              </button>
              <button 
                @click="deleteProduct(p.id)" 
                class="bg-red-950/20 hover:bg-red-900/20 text-red-400 p-2 rounded-lg border border-red-900/30 transition-all cursor-pointer"
                title="حذف النظام"
                :disabled="p.id === 'warehouse'"
              >
                🗑
              </button>
            </div>
          </div>

          <!-- Description and link -->
          <div class="space-y-4">
            <div>
              <span class="text-[10px] text-dark-muted font-bold block mb-1">وصف النظام:</span>
              <p class="text-dark-text/90 text-xs leading-relaxed">
                {{ p.description }}
              </p>
            </div>

            <!-- Link status badge -->
            <div>
              <span class="text-[10px] text-dark-muted font-bold block mb-1">التوجيه البرمجي للباقات:</span>
              <span 
                v-if="p.externalUrl" 
                class="inline-flex items-center gap-1 px-2.5 py-1 bg-vibrant-blue/10 border border-vibrant-blue/20 text-vibrant-blue rounded-lg text-[10px] font-mono"
              >
                🔗 رابط إعادة توجيه: {{ p.externalUrl }}
              </span>
              <span 
                v-else 
                class="inline-flex items-center gap-1 px-2.5 py-1 bg-vibrant-teal/10 border border-vibrant-teal/20 text-vibrant-teal rounded-lg text-[10px] font-mono"
              >
                💻 صفحة داخلية (يعرض الباقات المحددة محلياً)
              </span>
            </div>
          </div>
        </div>

        <!-- Packages detail preview -->
        <div class="mt-6 pt-4 border-t border-dark-border flex items-center justify-between">
          <div>
            <span class="text-[10px] text-dark-muted block">الباقات المضافة:</span>
            <span class="font-mono text-vibrant-purple font-bold text-xs">
              {{ p.packages?.length || 0 }} باقات مفعلة
            </span>
          </div>

          <router-link 
            to="/admin/packages" 
            class="inline-flex items-center gap-1.5 px-3.5 py-1.5 bg-dark-bg hover:bg-dark-hover border border-dark-border text-xs text-white rounded-xl font-bold transition-all"
          >
            ⚙️ إدارة الباقات
          </router-link>
        </div>

      </div>
    </div>

  </div>
</template>

<script setup>
import { ref, reactive, computed } from 'vue'
import { useProductsStore } from '../../stores/useProductsStore'

const productsStore = useProductsStore()
const products = computed(() => productsStore.products)

const showForm = ref(false)
const isEditingMode = ref(false)
const editingId = ref(null)

const form = reactive({
  name: '',
  slug: '',
  icon: '⚙️',
  externalUrl: '',
  description: ''
})

function resetForm() {
  form.name = ''
  form.slug = ''
  form.icon = '⚙️'
  form.externalUrl = ''
  form.description = ''
  editingId.value = null
  isEditingMode.value = false
}

function openAddModal() {
  resetForm()
  showForm.value = true
}

function closeForm() {
  showForm.value = false
  resetForm()
}

function openEditForm(p) {
  isEditingMode.value = true
  editingId.value = p.id
  form.name = p.name
  form.slug = p.slug
  form.icon = p.icon
  form.externalUrl = p.externalUrl || ''
  form.description = p.description
  showForm.value = true
}

async function submitForm() {
  if (!form.name.trim() || !form.slug.trim() || !form.description.trim()) return

  try {
    if (isEditingMode.value) {
      await productsStore.updateProduct(editingId.value, {
        name: form.name.trim(),
        icon: form.icon,
        externalUrl: form.externalUrl.trim(),
        description: form.description.trim()
      })
    } else {
      // Check if slug is unique
      if (products.value.some(p => p.slug === form.slug.trim().toLowerCase())) {
        alert('الرمز التعريفي (Slug) مستخدم بالفعل لنظام آخر. يرجى اختيار رمز فريد.')
        return
      }
      await productsStore.addProduct({
        name: form.name.trim(),
        slug: form.slug.trim().toLowerCase(),
        icon: form.icon,
        externalUrl: form.externalUrl.trim(),
        description: form.description.trim(),
        packages: []
      })
    }

    showForm.value = false
    resetForm()
  } catch (err) {
    alert(err.message || 'حدث خطأ أثناء حفظ النظام.')
  }
}

function deleteProduct(id) {
  if (id === 'warehouse') {
    alert('لا يمكن حذف هذا النظام الأساسي.')
    return
  }
  if (confirm('هل أنت متأكد من رغبتك في حذف هذا النظام نهائياً؟ سيتم حذف جميع باقاته المرتبطة به أيضاً.')) {
    productsStore.deleteProduct(id)
  }
}
</script>
