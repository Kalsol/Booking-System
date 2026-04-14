<script setup lang="ts">
import { Head } from '@inertiajs/vue3';
import { ChevronLeft, ChevronRight, Calendar, User, Video, Camera, Clock } from 'lucide-vue-next';
import { Button } from '@/components/ui/button';
import PlaceholderPattern from '@/components/PlaceholderPattern.vue';

defineOptions({
    layout: {
        breadcrumbs: [
            {
                title: 'Schedule',
                href: '/schedule',
            }
        ],
    },
});

const timeSlots = [
    '09:00 AM', '10:00 AM', '11:00 AM', '12:00 PM', 
    '01:00 PM', '02:00 PM', '03:00 PM', '04:00 PM', 
    '05:00 PM', '06:00 PM'
];

const staffSchedules = [
    {
        name: 'Dawit S.',
        role: 'Cinematographer',
        bookings: [
            { title: 'Music Video Shoot', client: 'Sara Tekle', type: 'video', start: 1, duration: 3 }
        ]
    },
    {
        name: 'Hanna T.',
        role: 'Lead Photographer',
        bookings: [
            { title: 'Studio Portraits', client: 'Abebe K.', type: 'photo', start: 0, duration: 2 },
            { title: 'Product Shoot', client: 'TechCorp', type: 'photo', start: 5, duration: 2 }
        ]
    },
    {
        name: 'Elias M.',
        role: 'Editor / VFX',
        bookings: [
            { title: 'Post-Production', client: 'Wedding Film Edit', type: 'default', start: 2, duration: 6 }
        ]
    }
];

// Helper to calculate position (120px is the var(--time-slot-width))
const getBlockStyle = (start: number, duration: number) => {
    return {
        left: `${start * 120}px`,
        width: `${duration * 120}px`
    };
};
</script>

<template>
    <Head title="Production Schedule" />

    <div class="flex flex-col h-full overflow-hidden">
        <header class="flex items-center justify-between border-b border-[#2e3039] px-8 py-6 bg-[#0d0e12]/50 backdrop-blur-md">
            <div>
                <h2 class="text-2xl font-bold text-white tracking-tight">April 6, 2026</h2>
                <p class="text-xs text-slate-500 font-medium uppercase tracking-wider">Daily Production Timeline</p>
            </div>
            
            <div class="flex items-center gap-2">
                <Button variant="outline" class="border-[#2e3039] text-white hover:bg-[#1f2129]">Today</Button>
                <div class="flex items-center border border-[#2e3039] rounded-md overflow-hidden">
                    <button class="p-2 hover:bg-[#1f2129] border-r border-[#2e3039] text-slate-400">
                        <ChevronLeft :size="18" />
                    </button>
                    <button class="p-2 hover:bg-[#1f2129] text-slate-400">
                        <ChevronRight :size="18" />
                    </button>
                </div>
            </div>
        </header>

        <div class="flex-1 overflow-auto relative bg-[#0d0e12] custom-scroll">
            <PlaceholderPattern />

            <div class="relative z-10 min-w-[1400px]">
                <div class="flex sticky top-0 z-20 bg-[#16171d] border-b border-[#2e3039]">
                    <div class="w-[240px] p-4 font-bold text-sm text-slate-300 border-r border-[#2e3039] flex items-center gap-2">
                        <User :size="16" class="text-[#ffd700]" /> Production Staff
                    </div>
                    <div v-for="time in timeSlots" :key="time" class="w-[120px] p-4 text-center text-[10px] font-bold text-slate-500 border-r border-white/5 uppercase tracking-widest">
                        {{ time }}
                    </div>
                </div>

                <div v-for="staff in staffSchedules" :key="staff.name" class="flex border-b border-[#2e3039] h-[110px] group transition-colors hover:bg-white/[0.02]">
                    <div class="w-[240px] p-5 bg-[#16171d] border-r border-[#2e3039] flex flex-col justify-center">
                        <span class="text-sm font-bold text-white">{{ staff.name }}</span>
                        <span class="text-[10px] text-slate-500 font-medium">{{ staff.role }}</span>
                    </div>

                    <div class="flex-1 relative">
                        <div class="absolute inset-0 flex pointer-events-none">
                            <div v-for="i in timeSlots.length" :key="i" class="w-[120px] border-r border-white/[0.03] h-full"></div>
                        </div>

                        <div 
                            v-for="(booking, idx) in staff.bookings" 
                            :key="idx"
                            class="absolute top-[20px] h-[70px] rounded-lg p-3 text-xs shadow-xl transition-all hover:scale-[1.02] cursor-pointer border-l-4"
                            :class="{
                                'bg-blue-500/10 border-blue-500 text-blue-100': booking.type === 'video',
                                'bg-pink-500/10 border-pink-500 text-pink-100': booking.type === 'photo',
                                'bg-[#ffd700]/10 border-[#ffd700] text-[#ffd700]': booking.type === 'default',
                            }"
                            :style="getBlockStyle(booking.start, booking.duration)"
                        >
                            <div class="flex items-center gap-1.5 font-bold mb-0.5">
                                <Video v-if="booking.type === 'video'" :size="12" />
                                <Camera v-else-if="booking.type === 'photo'" :size="12" />
                                <Clock v-else :size="12" />
                                {{ booking.title }}
                            </div>
                            <div class="opacity-70 text-[10px]">Client: {{ booking.client }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<style scoped>
.custom-scroll::-webkit-scrollbar {
    height: 8px;
    width: 6px;
}
.custom-scroll::-webkit-scrollbar-track {
    background: transparent;
}
.custom-scroll::-webkit-scrollbar-thumb {
    background: #2e3039;
    border-radius: 10px;
}
</style>