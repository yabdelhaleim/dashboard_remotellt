<template>
  <div class="space-y-6 text-right font-body text-dark-text">
    
    <!-- Title Section -->
    <div class="border-b border-dark-border pb-5 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
      <div>
        <h2 class="font-display font-black text-2xl text-white">إدارة الباقات والأسعار</h2>
        <p class="text-dark-muted text-xs mt-1">تخصيص أسعار ومميزات باقات الاشتراك الشهرية لكل نظام برمجي</p>
      </div>

      <!-- Select System Dropdown -->
      <div class="flex items-center gap-3">
        <span class="text-xs font-bold text-dark-muted">اختر النظام البرمجي:</span>
        <select 
          v-model="selectedProductId" 
          class="px-4 py-2.5 rounded-xl border border-dark-border bg-dark-card text-dark-text text-sm font-medium focus:outline-none focus:ring-2 focus:ring-primary-400 transition-all cursor-pointer"
        >
          <option v-for="p in products" :key="p.id" :value="p.id">
            {{ p.name }}
          </option>
        </select>
      </div>
    </div>

    <!-- No Product Selection Fallback -->
    <div v-if="!selectedProduct" class="bg-dark-card rounded-2xl border border-dark-border p-8 text-center text-dark-muted">
      يرجى اختيار نظام برمجي من القائمة بالأعلى لإدارة باقاته.
    </div>

    <div v-else class="space-y-6">
      
      <!-- Redirection URL Alert -->
      <div 
        v-if="selectedProduct.externalUrl" 
        class="bg-vibrant-blue/10 border border-vibrant-blue/20 p-4 rounded-xl text-xs flex items-start gap-3 text-vibrant-blue leading-relaxed"
      >
        <span class="text-lg">ℹ️</span>
        <div>
          <b class="block mb-0.5 text-white">ملاحظة: هذا النظام مهيأ لإعادة التوجيه (رابط خارجي)</b>
          هذا النظام يحتوي على رابط إعادة توجيه مخصص وهو: <code class="font-mono text-white select-all bg-dark-bg px-1.5 py-0.5 rounded border border-dark-border">{{ selectedProduct.externalUrl }}</code>. 
          عند نقر العميل على هذا النظام في الموقع العام، لن يتم إظهار الباقات المحلية أدناه، بل سيتم فتح هذا الرابط المباشر تلقائياً (مثال: رابط باقات مخزني التفصيلي).
        </div>
      </div>

      <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 items-start">
        
        <!-- Packages List -->
        <div class="lg:col-span-2 space-y-4">
          <h3 class="text-base font-bold text-white mb-2">الباقات المحددة حالياً</h3>

          <div v-if="selectedProduct.packages && selectedProduct.packages.length > 0" class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div 
              v-for="pkg in selectedProduct.packages" 
              :key="pkg.id"
              :class="[
                'bg-dark-card border rounded-2xl p-5 shadow-sm transition-all relative flex flex-col justify-between hover:shadow-md',
                pkg.highlighted ? 'border-primary-400 border-2 shadow-neon-purple/20' : 'border-dark-border'
              ]"
            >
              <!-- Highlighted Star Badge -->
              <div 
                v-if="pkg.highlighted"
                class="absolute top-3 left-3 bg-primary-400/20 text-vibrant-purple border border-primary-400/35 text-[9px] font-bold px-2.5 py-0.5 rounded-lg shadow-sm"
              >
                ★ مميزة وشائعة
              </div>

              <div>
                <div class="flex justify-between items-start mb-2 pt-2">
                  <h4 class="font-bold text-white text-base">{{ pkg.name }}</h4>
                  <span class="font-mono text-vibrant-cyan font-bold text-xs bg-dark-bg/80 border border-dark-border px-2.5 py-1 rounded-lg">
                    {{ pkg.price }} ج /شهر
                  </span>
                </div>
                
                <!-- Features preview -->
                <div class="mt-4 border-t border-dark-border/40 pt-4">
                  <span class="text-[10px] text-dark-muted font-bold block mb-2">مميزات الباقة ({{ pkg.features?.length || 0 }}):</span>
                  <ul v-if="pkg.features && pkg.features.length > 0" class="space-y-1.5 text-xs text-dark-text/95">
                    <li v-for="feat in pkg.features" :key="feat" class="flex items-center gap-1.5">
                      <span class="text-vibrant-cyan">✓</span>
                      <span>{{ feat }}</span>
                    </li>
                  </ul>
                  <p v-else class="text-xs text-dark-muted italic">لا توجد ميزات مضافة لهذه الباقة بعد.</p>
                </div>
              </div>

              <!-- Actions -->
              <div class="flex justify-end gap-2 mt-6 border-t border-dark-border/45 pt-4">
                <button 
                  @click="startEdit(pkg)" 
                  class="bg-dark-bg hover:bg-dark-hover text-dark-text text-[10px] font-bold py-1.5 px-3 rounded-lg border border-dark-border transition-all cursor-pointer"
                >
                  ✏️ تعديل
                </button>
                <button 
                  @click="removePackage(pkg.id)" 
                  class="bg-red-950/20 hover:bg-red-900/20 text-red-400 text-[10px] font-bold py-1.5 px-3 rounded-lg border border-red-900/30 transition-all cursor-pointer"
                >
                  🗑 حذف
                </button>
              </div>

            </div>
          </div>

          <div v-else class="bg-dark-card rounded-2xl border border-dark-border p-8 text-center text-dark-muted shadow-sm">
            لا توجد أي باقات مضافة لهذا النظام حالياً. سيطلب العميل سعراً مخصصاً افتراضياً في الموقع.
          </div>
        </div>

        <!-- Add / Edit Form Column -->
        <div class="bg-dark-card rounded-2xl border border-dark-border shadow-sm p-6 space-y-4">
          <h3 class="text-xs font-bold text-white border-b border-dark-border pb-3">
            {{ isEditing ? '✏️ تعديل الباقة المحددة' : '✨ إضافة باقة جديدة' }}
          </h3>

          <form @submit.prevent="savePackage" class="space-y-4">
            
            <div>
              <label class="block text-xs font-bold text-dark-muted mb-1.5">اسم الباقة *</label>
              <input 
                type="text" 
                v-model="form.name" 
                placeholder="مثال: الباقة الفضية، المتقدمة"
                class="w-full px-4 py-2.5 rounded-xl border border-dark-border bg-dark-bg text-dark-text text-sm focus:outline-none focus:ring-2 focus:ring-primary-400"
                required 
              />
            </div>

            <div>
              <label class="block text-xs font-bold text-dark-muted mb-1.5">السعر شهرياً (بالجنيه المصري) *</label>
              <input 
                type="number" 
                v-model.number="form.price" 
                placeholder="مثال: 499"
                class="w-full px-4 py-2.5 rounded-xl border border-dark-border bg-dark-bg text-dark-text text-sm font-mono focus:outline-none focus:ring-2 focus:ring-primary-400 text-left"
                dir="ltr"
                required 
              />
            </div>

            <div class="flex items-center gap-2.5 py-1">
              <input 
                type="checkbox" 
                id="highlighted" 
                v-model="form.highlighted"
                class="w-4 h-4 text-vibrant-purple border-dark-border rounded focus:ring-primary-400 bg-dark-bg"
              />
              <label for="highlighted" class="text-xs font-bold text-dark-text cursor-pointer select-none">
                تمييز الباقة كخيار أفضل طلبًا ★
              </label>
            </div>

            <!-- Features Manager -->
            <div class="border-t border-dark-border/50 pt-4">
              <label class="block text-xs font-bold text-dark-muted mb-1.5">ميزات الباقة</label>
              
              <div class="flex gap-2 mb-3">
                <input 
                  type="text" 
                  v-model="newFeatureText" 
                  @keypress.enter.prevent="addFeature"
                  placeholder="مثال: دعم فني 24 ساعة"
                  class="flex-grow px-3 py-2 rounded-xl border border-dark-border bg-dark-bg text-dark-text text-xs focus:outline-none focus:ring-2 focus:ring-primary-400"
                />
                <button 
                  type="button" 
                  @click="addFeature"
                  class="bg-dark-bg hover:bg-dark-hover border border-dark-border text-vibrant-cyan text-xs px-3.5 py-2 rounded-xl font-bold transition-all cursor-pointer shrink-0"
                >
                  أضف ميزة
                </button>
              </div>

              <!-- Features Badges list -->
              <div class="space-y-1.5 max-h-40 overflow-y-auto border border-dark-border rounded-xl p-2 bg-dark-bg/50">
                <div 
                  v-for="(f, idx) in form.features" 
                  :key="idx"
                  class="flex items-center justify-between bg-dark-card px-2.5 py-1.5 rounded-lg border border-dark-border text-xs text-dark-text"
                >
                  <span class="line-clamp-1 flex-grow pr-1">{{ f }}</span>
                  <button 
                    type="button" 
                    @click="removeFeature(idx)" 
                    class="text-red-400 hover:text-red-500 font-bold px-1"
                    title="حذف الميزة"
                  >
                    ✕
                  </button>
                </div>
                <p v-if="form.features.length === 0" class="text-[10px] text-dark-muted text-center py-4 italic">
                  لم يتم إضافة أي ميزات لهذه الباقة بعد.
                </p>
              </div>
            </div>

            <!-- Buttons -->
            <div class="flex gap-2 pt-4 border-t border-dark-border mt-4">
              <button 
                type="submit"
                class="flex-grow bg-gradient-to-r from-primary-400 to-vibrant-purple text-white font-bold py-2.5 px-4 rounded-xl text-xs transition-all shadow-neon-purple/20 cursor-pointer"
              >
                {{ isEditing ? 'حفظ تعديلات الباقة' : 'إضافة الباقة' }}
              </button>
              <button 
                v-if="isEditing"
                type="button" 
                @click="cancelEdit"
                class="bg-dark-hover hover:bg-dark-border text-dark-text font-bold py-2.5 px-4 rounded-xl text-xs border border-dark-border transition-all cursor-pointer"
              >
                إلغاء
              </button>
            </div>

          </form>
        </div>

      </div>
    </div>

  </div>
</template>

<script setup>
import { ref, reactive, computed, watch, onMounted } from 'vue'
import { useProductsStore } from '../../stores/useProductsStore'

const productsStore = useProductsStore()
const products = computed(() => productsStore.products)

const selectedProductId = ref('')
const selectedProduct = computed(() => {
  return products.value.find(p => p.id === selectedProductId.value) || null
})

// Set initial selection when products load
watch(products, (newProducts) => {
  if (newProducts.length > 0 && !selectedProductId.value) {
    selectedProductId.value = newProducts[0].id
  }
}, { immediate: true })

onMounted(() => {
  if (products.value.length > 0 && !selectedProductId.value) {
    selectedProductId.value = products.value[0].id
  }
})

const isEditing = ref(false)
const editingPackageId = ref(null)

const form = reactive({
  name: '',
  price: 0,
  features: [],
  highlighted: false
})

const newFeatureText = ref('')

function resetForm() {
  isEditing.value = false
  editingPackageId.value = null
  form.name = ''
  form.price = 0
  form.features = []
  form.highlighted = false
  newFeatureText.value = ''
}

watch(selectedProductId, () => {
  resetForm()
})

function addFeature() {
  if (!newFeatureText.value.trim()) return
  form.features.push(newFeatureText.value.trim())
  newFeatureText.value = ''
}

function removeFeature(idx) {
  form.features.splice(idx, 1)
}

function startEdit(pkg) {
  isEditing.value = true
  editingPackageId.value = pkg.id
  form.name = pkg.name
  form.price = pkg.price
  form.features = [...(pkg.features || [])]
  form.highlighted = !!pkg.highlighted
}

function cancelEdit() {
  resetForm()
}

function removePackage(pkgId) {
  if (confirm('هل أنت متأكد من رغبتك في حذف هذه الباقة نهائياً؟')) {
    productsStore.removePackage(selectedProductId.value, pkgId)
    if (editingPackageId.value === pkgId) {
      resetForm()
    }
  }
}

async function savePackage() {
  if (!form.name.trim() || form.price < 0) return

  const p = selectedProduct.value
  if (!p) return

  try {
    if (isEditing.value) {
      await productsStore.updatePackage(selectedProductId.value, editingPackageId.value, {
        name: form.name.trim(),
        price: Number(form.price),
        features: [...form.features],
        highlighted: form.highlighted
      })
    } else {
      await productsStore.addPackage(selectedProductId.value, {
        name: form.name.trim(),
        price: Number(form.price),
        features: [...form.features],
        highlighted: form.highlighted
      })
    }
    resetForm()
  } catch (err) {
    alert(err.message || 'حدث خطأ أثناء حفظ الباقة')
  }
}
</script>
