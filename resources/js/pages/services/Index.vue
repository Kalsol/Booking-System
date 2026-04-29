<script setup lang="ts">
import { Head, Link, Form } from '@inertiajs/vue3'
import { 
  Plus, 
  Video, 
  Camera, 
  Package, 
  Clock,
  Edit2,
  Trash2,
  ExternalLink
} from 'lucide-vue-next';
import { ref } from 'vue'
import PlaceholderPattern from '@/components/PlaceholderPattern.vue';
import { show, edit, destroy, create } from '@/routes/services'
// State for tab switching
const activeTab = ref('services');

defineOptions({
    layout: {
        breadcrumbs: [
            {
                title: 'Services & Gear',
                href: '/services',
            }
        ],
    },
});

interface Service {
    id: number; // Added ID for routing actions
    category_name: string;
    name: string;
    description: string;
    price: string;
    duration: string;
    status: string;
}

defineProps<{
    services: Service[];
}>()

// Helper for price formatting
const formatPrice = (price: string | number) => {
    return Number(price).toLocaleString('en-US', { 
        minimumFractionDigits: 2,
        maximumFractionDigits: 2 
    });
};
</script>

<template>
    <Head title="Services & Gear" />

    <div class="flex flex-col md:flex-row md:items-center justify-between px-6 py-6 gap-4">
        <div>
            <h1 class="text-2xl font-bold text-white">Services & Catalog</h1>
            <p class="text-sm text-slate-400">Manage your production packages and equipment inventory.</p>
        </div>
        <Link :href="create()" class="bg-[#ffd700] hover:bg-[#ffd700]/90 text-black font-bold px-5 h-11 rounded-lg flex items-center transition-colors shadow-lg shadow-[#ffd700]/10">
            <Plus class="mr-2 h-4 w-4" /> Add Service
        </Link>
    </div>

    <div class="flex h-full flex-1 flex-col gap-4 p-4">
        
        <div class="flex gap-8 border-b border-[#2e3039] px-2 mb-2">
            <button 
                @click="activeTab = 'services'"
                :class="[activeTab === 'services' ? 'text-[#ffd700] border-b-2 border-[#ffd700]' : 'text-slate-400 border-b-2 border-transparent']"
                class="pb-3 text-sm font-semibold transition-all">
                Production Services
            </button>
            
            <button 
                @click="activeTab = 'gear'"
                :class="[activeTab === 'gear' ? 'text-[#ffd700] border-b-2 border-[#ffd700]' : 'text-slate-400 border-b-2 border-transparent']"
                class="pb-3 text-sm font-semibold transition-all">
                Equipment & Gear
            </button>
        </div>

        <div class="flex overflow-hidden relative min-h-[70vh] flex-1 rounded-xl border border-sidebar-border/70 bg-[#0d0e12] dark:border-sidebar-border">
            <PlaceholderPattern />
            <div v-if="activeTab === 'services'" class="relative z-10 w-full grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6 p-6 content-start">
                <div 
                    v-for="(item, index) in services" 
                    :key="index"
                    class="group flex flex-col justify-between rounded-2xl border border-[#2e3039] bg-[#111218]/80 backdrop-blur-sm p-6 transition-all hover:border-[#ffd700]/40 shadow-lg">
                    <div>
                        <div class="flex items-center justify-between mb-4">
                            <span class="text-[10px] font-black uppercase tracking-[2px] text-[#ffd700]">
                                {{ item.category_name }}
                            </span>
                            <div class="p-2 rounded-lg bg-white/5 text-slate-400 group-hover:text-[#ffd700] transition-colors">
                                <Video v-if="item.category_name.toLowerCase().includes('video')" :size="16" />
                                <Camera v-else-if="item.category_name.toLowerCase().includes('photo')" :size="16" />
                                <Package v-else :size="16" />
                            </div>
                        </div>

                        <h3 class="text-lg font-bold text-white mb-2 line-clamp-1">{{ item.name }}</h3>
                        <p class="text-xs text-slate-400 leading-relaxed mb-6 line-clamp-3">
                            {{ item.description }}
                        </p>
                    </div>

                    <div class="space-y-4">
                        <div class="pt-4 border-t border-[#2e3039] flex items-center justify-between">
                            <div class="flex flex-col">
                                <span class="text-white text-lg font-bold">
                                    {{ formatPrice(item.price) }} <span class="text-[10px] text-[#ffd700]">Br</span>
                                </span>
                                <span class="flex items-center gap-1 text-[10px] text-slate-500">
                                    <Clock :size="10" /> {{ item.duration }} Hours
                                </span>
                            </div>

                            <div :class="[
                                item.status === 'active' ? 'bg-emerald-500/10 text-emerald-500 border-emerald-500/20' : 'bg-slate-500/10 text-slate-400 border-slate-500/20'
                            ]" class="px-2 py-1 rounded text-[9px] uppercase font-bold border">
                                {{ item.status }}
                            </div>
                        </div>

                        <div class="flex items-center gap-2">
                            <Link :href="show(item.id)" class="flex-1 flex items-center justify-center gap-2 py-2 rounded-lg bg-white/5 text-white text-xs font-semibold hover:bg-white/10 transition-colors border border-white/5">
                                <ExternalLink :size="14" /> Details
                            </Link>
                            
                            <Link :href="edit(item.id)" class="p-2 rounded-lg border border-[#2e3039] text-slate-400 hover:text-[#ffd700] hover:border-[#ffd700]/50 transition-all">
                                <Edit2 :size="14" />
                            </Link>
                            <Form 
                                :action="destroy(item.id)" 
                                method="DELETE"
                                confirm="Are you sure you want to delete this service?"
                                v-slot="{ processing }">
                                <button 
                                    type="submit" 
                                    :disabled="processing"
                                    class="p-2 rounded-lg border border-[#2e3039] text-slate-400 hover:text-red-500 hover:border-red-500/50 transition-all flex items-center justify-center">
                                    <Trash2 v-if="!processing" :size="14" />
                                    <span v-else class="animate-spin text-[10px]">...</span>
                                </button>
                            </Form>
                        </div>
                    </div>
                </div>
            </div>

            <div v-else class="relative z-10 w-full flex items-center justify-center text-slate-500">
                <p>Equipment & Gear inventory coming soon...</p>
            </div>
        </div>
    </div>
</template>

<style scoped>
.line-clamp-1 { display: -webkit-box; -webkit-line-clamp: 1; -webkit-box-orient: vertical; overflow: hidden; }
.line-clamp-3 { display: -webkit-box; -webkit-line-clamp: 3; -webkit-box-orient: vertical; overflow: hidden; }

.custom-scroll::-webkit-scrollbar { width: 4px; }
.custom-scroll::-webkit-scrollbar-track { background: transparent; }
.custom-scroll::-webkit-scrollbar-thumb { background: #2e3039; border-radius: 10px; }
</style>