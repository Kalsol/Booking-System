<script setup lang="ts">
import { Head } from '@inertiajs/vue3';
import { Search, Video, Clock, MapPin, CalendarCheck2, CalendarSync, CalendarClock } from 'lucide-vue-next'
import PlaceholderPattern from '@/components/PlaceholderPattern.vue';
import {
  Table,
  TableBody,
  TableCell,
  TableHead,
  TableHeader,
  TableRow,
} from '@/components/ui/table'
import { appointments } from '@/routes';

defineOptions({
    layout: {
        breadcrumbs: [
            {
                title: 'Appointments',
                href: appointments(),
            }
        ],
    },
});
</script>

<template>
    <Head title="Appointments" />
    <div class="flex flex-col">
        <p class="text-2xl font-semibold w-full text-left px-5 py-5">
            Appointment Manager
        </p>
    </div>
    
    <div class="flex h-full flex-1 flex-col gap-4 overflow-x-auto rounded-xl p-4">
        <div class="grid auto-rows-min gap-4 md:grid-cols-3">
            <div class="relative aspect-video overflow-hidden rounded-2xl border border-sidebar-border/70 bg-card/50 shadow-sm backdrop-blur-md transition-all hover:shadow-md dark:border-sidebar-border/40">
                <div class="flex h-full items-center justify-center gap-6 p-6">
                    <div class="flex h-20 w-20 items-center justify-center rounded-2xl bg-primary/10 text-primary">
                        <CalendarCheck2 :size="40" :stroke-width="1.5" />
                    </div>
                    <div class="flex flex-col justify-center">
                        <h3 class="text-sm font-medium uppercase tracking-wider text-muted-foreground">Completed Appointment</h3>
                        <p class="text-3xl font-bold tracking-tight text-foreground">45</p>
                        <div class="mt-1 flex items-center text-xs font-medium text-emerald-500">
                            <span>+12.5% from last month</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="relative aspect-video overflow-hidden rounded-2xl border border-sidebar-border/70 bg-card/50 shadow-sm backdrop-blur-md transition-all hover:shadow-md dark:border-sidebar-border/40">
                <div class="flex h-full items-center justify-center gap-6 p-6">
                    <div class="flex h-20 w-20 items-center justify-center rounded-2xl bg-primary/10 text-primary">
                        <CalendarClock :size="40" :stroke-width="1.5" />
                    </div>
                    <div class="flex flex-col justify-center">
                        <h3 class="text-sm font-medium uppercase tracking-wider text-muted-foreground">Upcoming Appointments</h3>
                        <p class="text-3xl font-bold tracking-tight text-foreground">5</p>
                    </div>
                </div>
            </div>

            <div class="relative aspect-video overflow-hidden rounded-2xl border border-sidebar-border/70 bg-card/50 shadow-sm backdrop-blur-md transition-all hover:shadow-md dark:border-sidebar-border/40">
                <div class="flex h-full items-center justify-center gap-6 p-6">
                    <div class="flex h-20 w-20 items-center justify-center rounded-2xl bg-primary/10 text-primary">
                        <CalendarSync :size="40" :stroke-width="1.5" />
                    </div>
                    <div class="flex flex-col justify-center">
                        <h3 class="text-sm font-medium uppercase tracking-wider text-muted-foreground">Pending Appointments</h3>
                        <p class="text-3xl font-bold tracking-tight text-foreground">5</p>
                        <div class="mt-1 flex items-center text-xs font-medium text-emerald-500">
                            <span>+12.5% from last month</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="flex overflow-hidden relative min-h-[100vh] flex-1 rounded-xl border border-sidebar-border/70 md:min-h-min dark:border-sidebar-border bg-[#0d0e12]">
            <PlaceholderPattern />
            
            <div class="relative z-10 grid w-full grid-cols-1 gap-6 p-6 lg:grid-cols-2">
                <div class="flex flex-col rounded-xl border border-[#2e3039] bg-[#111218]/80 backdrop-blur-sm p-5 h-fit">
                    <div class="mb-4 flex items-center justify-between">
                        <h3 class="font-semibold text-slate-200 text-lg">Recent Appointments</h3>
                        <div class="relative">
                            <Search class="absolute left-2.5 top-2.5 h-4 w-4 text-slate-500" />
                            <input type="text" placeholder="Search..." class="h-9 w-48 rounded-md border border-[#2e3039] bg-[#1f2129] pl-9 text-xs focus:outline-none focus:ring-1 focus:ring-[#ffd700]" />
                        </div>
                    </div>

                    <Table>
                        <TableHeader class="hover:bg-transparent">
                            <TableRow class="border-[#2e3039] hover:bg-transparent">
                                <TableHead class="text-slate-400">Customer</TableHead>
                                <TableHead class="text-slate-400">Service</TableHead>
                                <TableHead class="text-slate-400">Date</TableHead>
                                <TableHead class="text-slate-400 text-right">Status</TableHead>
                            </TableRow>
                        </TableHeader>
                        <TableBody>
                            <TableRow v-for="i in 5" :key="i" class="border-[#2e3039] hover:bg-[#1f2129]/50 transition-colors">
                                <TableCell class="font-medium text-sm text-white">Kaleab Solomon</TableCell>
                                <TableCell class="text-slate-400 text-xs">4K Music Video</TableCell>
                                <TableCell class="text-slate-400 text-xs">2024-25-2</TableCell>
                                <TableCell class="text-right">
                                    <span class="rounded-full bg-orange-500/10 px-2 py-0.5 text-[10px] font-bold uppercase text-orange-500 border border-orange-500/20">Pending</span>
                                </TableCell>
                            </TableRow>
                        </TableBody>
                    </Table>
                </div>

                <div class="flex flex-col space-y-4">
                    <h3 class="text-lg font-semibold text-slate-200">Upcoming Sessions</h3>
                    <div class="space-y-3 overflow-y-auto pr-2 custom-scroll max-h-[500px]">
                        <div class="group flex items-center justify-between rounded-xl border border-[#2e3039] bg-[#16171d]/90 p-5 transition-all hover:border-[#ffd700]/40">
                            <div class="space-y-1">
                                <h4 class="font-bold text-white text-sm">Abebe Kebede</h4>
                                <div class="flex items-center gap-3 text-[11px] text-slate-400">
                                    <span class="flex items-center gap-1"><Video :size="12"/> Wedding Cinematography</span>
                                    <span class="flex items-center gap-1 font-semibold text-[#ffd700]"><Clock :size="12"/> Oct 12, 10:00 AM</span>
                                </div>
                                <p class="text-[10px] text-slate-500">Staff: Dawit (Lead Camera)</p>
                            </div>
                            <span class="rounded-full bg-emerald-500/10 px-3 py-1 text-[10px] font-bold uppercase text-emerald-500 border border-emerald-500/20">Confirmed</span>
                        </div>

                        <div class="group flex items-center justify-between rounded-xl border border-[#2e3039] bg-[#16171d]/90 p-5 transition-all hover:border-[#ffd700]/40">
                            <div class="space-y-1">
                                <h4 class="font-bold text-white text-sm">Bethany M.</h4>
                                <div class="flex items-center gap-3 text-[11px] text-slate-400">
                                    <span class="flex items-center gap-1"><Video :size="12"/> Studio Portrait Session</span>
                                    <span class="flex items-center gap-1 font-semibold text-[#ffd700]"><Clock :size="12"/> Oct 14, 02:30 PM</span>
                                </div>
                                <p class="text-[10px] text-slate-500">Staff: Hanna (Photographer)</p>
                            </div>
                            <span class="rounded-full bg-orange-500/10 px-3 py-1 text-[10px] font-bold uppercase text-orange-500 border border-orange-500/20">Pending Payment</span>
                        </div>

                        <div class="group flex items-center justify-between rounded-xl border border-[#2e3039] bg-[#16171d]/90 p-5 transition-all hover:border-[#ffd700]/40">
                            <div class="space-y-1">
                                <h4 class="font-bold text-white text-sm">TechCorp Office</h4>
                                <div class="flex items-center gap-3 text-[11px] text-slate-400">
                                    <span class="flex items-center gap-1"><MapPin :size="12"/> Corporate Interview Video</span>
                                    <span class="flex items-center gap-1 font-semibold text-[#ffd700]"><Clock :size="12"/> Oct 15, 09:00 AM</span>
                                </div>
                                <p class="text-[10px] text-slate-500">Staff: Elias (Audio/Lighting)</p>
                            </div>
                            <span class="rounded-full bg-emerald-500/10 px-3 py-1 text-[10px] font-bold uppercase text-emerald-500 border border-emerald-500/20">Confirmed</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<style scoped>
.custom-scroll::-webkit-scrollbar {
  width: 4px;
}
.custom-scroll::-webkit-scrollbar-track {
  background: transparent;
}
.custom-scroll::-webkit-scrollbar-thumb {
  background: #2e3039;
  border-radius: 10px;
}
</style>