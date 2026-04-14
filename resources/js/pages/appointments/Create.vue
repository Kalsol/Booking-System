<script setup lang="ts">
import { ref, watch } from 'vue';
import { Head } from '@inertiajs/vue3';
import { Calendar as CalendarIcon, Clock, Film, Camera, Music, CheckCircle2 } from 'lucide-vue-next';
import { Button } from '@/components/ui/button';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';

defineOptions({
    layout: {
        breadcrumbs: [
            { title: 'Appointments', href: '/appointments' },
            { title: 'New Booking', href: '/appointments/create' }
        ],
    },
});

// Service data with prices
const services = [
    { id: 1, name: 'Music Video Production', price: 45000, icon: Music },
    { id: 2, name: 'Commercial Photography', price: 12000, icon: Camera },
    { id: 3, name: 'Wedding Highlight Film', price: 35000, icon: Film },
    { id: 4, name: 'Studio Session (Hourly)', price: 2500, icon: Clock },
];

const form = ref({
    service_id: '',
    date: '',
    start_time: '',
    end_time: '',
    price: 0
});

// Update price automatically when service changes
watch(() => form.value.service_id, (newId) => {
    const selected = services.find(s => s.id === Number(newId));
    form.value.price = selected ? selected.price : 0;
});

const submitBooking = () => {
    console.log('Booking Data:', form.value);
    // Handle Inertia submission here
};
</script>

<template>
    <Head title="Book Appointment" />

    <div class="p-8 max-w-2xl mx-auto">
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-white tracking-tight">New Booking</h1>
            <p class="text-slate-400 mt-1">Schedule a new production session or equipment rental.</p>
        </div>

        <div class="bg-[#1e2028] border border-[#2e3039] rounded-2xl overflow-hidden shadow-2xl">
            <form @submit.prevent="submitBooking" class="p-8 space-y-6">
                
                <div class="space-y-2">
                    <Label class="text-slate-400 text-xs font-bold uppercase tracking-widest">Select Service</Label>
                    <div class="grid grid-cols-1 gap-3">
                        <select 
                            v-model="form.service_id"
                            class="w-full bg-[#0d0e12] border-[#2e3039] text-white rounded-lg p-3 focus:ring-2 focus:ring-[#ffd700] outline-none appearance-none"
                        >
                            <option value="" disabled>Choose a production service...</option>
                            <option v-for="service in services" :key="service.id" :value="service.id">
                                {{ service.name }}
                            </option>
                        </select>
                    </div>
                </div>

                <div class="space-y-2">
                    <Label class="text-slate-400 text-xs font-bold uppercase tracking-widest">Appointment Date</Label>
                    <div class="relative">
                        <CalendarIcon class="absolute left-3 top-1/2 -translate-y-1/2 text-slate-500" :size="18" />
                        <Input 
                            v-model="form.date"
                            type="date" 
                            class="pl-10 bg-[#0d0e12] border-[#2e3039] text-white focus:ring-[#ffd700] h-12"
                        />
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div class="space-y-2">
                        <Label class="text-slate-400 text-xs font-bold uppercase tracking-widest">Start Time</Label>
                        <div class="relative">
                            <Clock class="absolute left-3 top-1/2 -translate-y-1/2 text-slate-500" :size="18" />
                            <Input 
                                v-model="form.start_time"
                                type="time" 
                                class="pl-10 bg-[#0d0e12] border-[#2e3039] text-white focus:ring-[#ffd700] h-12"
                            />
                        </div>
                    </div>
                    <div class="space-y-2">
                        <Label class="text-slate-400 text-xs font-bold uppercase tracking-widest">End Time</Label>
                        <div class="relative">
                            <Clock class="absolute left-3 top-1/2 -translate-y-1/2 text-slate-500" :size="18" />
                            <Input 
                                v-model="form.end_time"
                                type="time" 
                                class="pl-10 bg-[#0d0e12] border-[#2e3039] text-white focus:ring-[#ffd700] h-12"
                            />
                        </div>
                    </div>
                </div>

                <div class="pt-4 border-t border-[#2e3039]">
                    <div class="bg-white/[0.03] border border-[#2e3039] p-4 rounded-xl flex justify-between items-center">
                        <div>
                            <p class="text-[10px] font-bold text-slate-500 uppercase tracking-widest">Estimated Price</p>
                            <p class="text-2xl font-bold text-[#ffd700]">
                                {{ form.price.toLocaleString() }} <span class="text-xs text-slate-400">ETB</span>
                            </p>
                        </div>
                        <div class="p-2 bg-[#ffd700]/10 rounded-lg">
                            <CheckCircle2 class="text-[#ffd700]" :size="20" />
                        </div>
                    </div>
                    <input type="hidden" :value="form.price" />
                </div>

                <div class="flex gap-3 pt-2">
                    <Button 
                        type="button" 
                        variant="ghost" 
                        class="flex-1 text-slate-400 hover:text-white border border-[#2e3039]"
                    >
                        Cancel
                    </Button>
                    <Button 
                        type="submit" 
                        class="flex-1 bg-[#ffd700] hover:bg-[#e6c200] text-black font-bold h-12 shadow-lg shadow-[#ffd700]/5"
                        :disabled="!form.service_id || !form.date"
                    >
                        Confirm Booking
                    </Button>
                </div>
            </form>
        </div>

        <div class="mt-6 flex items-start gap-3 p-4 bg-blue-500/5 border border-blue-500/20 rounded-xl">
            <div class="p-1.5 bg-blue-500/10 rounded text-blue-400 mt-0.5">
                <Clock :size="14" />
            </div>
            <p class="text-xs text-slate-400 leading-relaxed">
                <strong class="text-blue-400">Booking Policy:</strong> Prices are estimates based on standard production rates. Final billing may vary depending on equipment usage and overtime.
            </p>
        </div>
    </div>
</template>

<style scoped>
/* Custom styling to hide the default browser icon for date/time to use Lucide icons instead */
input[type="date"]::-webkit-calendar-picker-indicator,
input[type="time"]::-webkit-calendar-picker-indicator {
    background: transparent;
    bottom: 0;
    color: transparent;
    cursor: pointer;
    height: auto;
    left: 0;
    position: absolute;
    right: 0;
    top: 0;
    width: auto;
}
</style>