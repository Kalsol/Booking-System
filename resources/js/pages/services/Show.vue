<script setup lang="ts">
import { Head, Link } from '@inertiajs/vue3'
import { 
  ChevronLeft, 
  Video, 
  Camera, 
  Package, 
  Clock, 
  DollarSign, 
  CheckCircle2,
  Edit2,
  Trash2
} from 'lucide-vue-next'
import PlaceholderPattern from '@/components/PlaceholderPattern.vue'
import { Button } from '@/components/ui/button'

interface Service {
    id: number;
    category_name: string;
    name: string;
    description: string;
    price: string;
    duration: string;
    status: string;
    created_at: string;
}

defineProps<{
    service: Service
}>()

defineOptions({
    layout: {
        breadcrumbs: [
            { title: 'Services', href: '/services' },
            { title: 'Details', href: '#' },
        ],
    },
})

const formatPrice = (price: string | number) => {
    return Number(price).toLocaleString('en-US', { 
        minimumFractionDigits: 2,
        maximumFractionDigits: 2 
    })
}
</script>

<template>
    <Head :title="`Service: ${service.name}`" />

    <div class="flex flex-col gap-6 p-6 max-w-6xl mx-auto">
        <div class="flex items-center justify-between">
            <Link href="/services" class="flex items-center gap-2 text-sm text-slate-400 hover:text-[#ffd700] transition-colors">
                <ChevronLeft :size="16" /> Back to Catalog
            </Link>
            
            <div class="flex gap-3">
                <Link :href="`/services/${service.id}/edit`">
                    <Button variant="outline" class="border-[#2e3039] text-white hover:bg-white/5 gap-2">
                        <Edit2 :size="14" /> Edit
                    </Button>
                </Link>
                <Button variant="destructive" class="bg-red-500/10 text-red-500 border border-red-500/20 hover:bg-red-500/20 gap-2">
                    <Trash2 :size="14" /> Delete
                </Button>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <div class="lg:col-span-1 space-y-6">
                <div class="relative overflow-hidden rounded-3xl border border-[#2e3039] bg-[#111218] p-8 shadow-xl">
                    <PlaceholderPattern />
                    
                    <div class="relative z-10 flex flex-col items-center text-center">
                        <div class="mb-6 p-5 rounded-2xl bg-[#ffd700]/10 text-[#ffd700]">
                            <Video v-if="service.category_name.toLowerCase().includes('video')" :size="48" />
                            <Camera v-else-if="service.category_name.toLowerCase().includes('photo')" :size="48" />
                            <Package v-else :size="48" />
                        </div>

                        <span class="text-[10px] font-black uppercase tracking-[3px] text-[#ffd700] mb-2">
                            {{ service.category_name }}
                        </span>
                        <h1 class="text-2xl font-bold text-white mb-6 leading-tight">
                            {{ service.name }}
                        </h1>

                        <div :class="[
                            service.status === 'active' ? 'bg-emerald-500/10 text-emerald-500 border-emerald-500/20' : 'bg-slate-500/10 text-slate-400 border-slate-500/20'
                        ]" class="px-4 py-1.5 rounded-full text-[10px] uppercase font-black border tracking-widest mb-8">
                            {{ service.status }}
                        </div>

                        <div class="w-full space-y-4 pt-6 border-t border-[#2e3039]">
                            <div class="flex items-center justify-between">
                                <span class="text-slate-500 text-xs flex items-center gap-2"><DollarSign :size="14" /> Base Price</span>
                                <span class="text-white font-bold">{{ formatPrice(service.price) }} <span class="text-[#ffd700] text-[10px]">Br</span></span>
                            </div>
                            <div class="flex items-center justify-between">
                                <span class="text-slate-500 text-xs flex items-center gap-2"><Clock :size="14" /> Turnaround</span>
                                <span class="text-white font-bold text-sm">{{ service.duration }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="lg:col-span-2 space-y-6">
                <div class="rounded-3xl border border-[#2e3039] bg-[#111218]/50 backdrop-blur-sm p-8 h-full">
                    <h2 class="text-lg font-bold text-white mb-6 flex items-center gap-3">
                        <div class="h-1 w-8 bg-[#ffd700] rounded-full"></div>
                        Service Overview
                    </h2>

                    <div class="space-y-8">
                        <div>
                            <h3 class="text-xs font-bold text-slate-500 uppercase tracking-wider mb-3">Description</h3>
                            <p class="text-slate-300 leading-relaxed text-sm">
                                {{ service.description }}
                            </p>
                        </div>

                        <div>
                            <h3 class="text-xs font-bold text-slate-500 uppercase tracking-wider mb-4">What's Included</h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div v-for="i in 4" :key="i" class="flex items-start gap-3 p-3 rounded-xl bg-white/5 border border-white/5">
                                    <CheckCircle2 class="text-[#ffd700] mt-0.5" :size="16" />
                                    <div class="text-xs text-slate-300">
                                        Professional production standard compliant for {{ service.category_name }}.
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="pt-8 mt-8 border-t border-[#2e3039]">
                            <div class="flex items-center gap-4 text-[10px] text-slate-600 uppercase font-bold tracking-widest">
                                <span>ID: #SER-{{ service.id.toString().padStart(4, '0') }}</span>
                                <span class="h-1 w-1 bg-slate-800 rounded-full"></span>
                                <span>Added: {{ service.created_at || 'Recently' }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>