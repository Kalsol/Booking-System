<script setup lang="ts">
import { ref } from 'vue';
import { Head } from '@inertiajs/vue3';
import { 
    Wallet, 
    Clock, 
    CheckCircle2, 
    Plus, 
    Search, 
    Download, 
    Send, 
    MoreVertical, 
    FileText 
} from 'lucide-vue-next';
import { Button } from '@/components/ui/button';
import { Input } from '@/components/ui/input';

defineOptions({
    layout: {
        breadcrumbs: [
            {
                title: 'Billing & Invoices',
                href: '/billing',
            }
        ],
    },
});

const invoices = [
    { id: '#INV-001', client: 'Abebe Kebede', service: 'Wedding Highlight Film', amount: '25,000 ETB', status: 'paid' },
    { id: '#INV-002', client: 'Sara Tekle', service: 'Commercial Photo Session', amount: '8,500 ETB', status: 'unpaid' },
    { id: '#INV-003', client: 'TechCorp Ltd.', service: 'Corporate Event Coverage', amount: '45,000 ETB', status: 'paid' },
];
</script>

<template>
    <Head title="Billing & Invoices" />

    <div class="flex h-full flex-1 flex-col gap-4 overflow-x-auto rounded-xl p-4">
        <header class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
            <div>
                <h1 class="text-3xl font-bold text-white tracking-tight">Billing & Financials</h1>
                <p class="text-slate-400 mt-1">Track production payments and client invoices.</p>
            </div>
            <Button class="bg-[#ffd700] hover:bg-[#e6c200] text-black font-bold gap-2 shadow-lg shadow-[#ffd700]/10">
                <Plus :size="18" />
                Create Invoice
            </Button>
        </header>

        <section class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="group bg-[#1e2028] border border-[#2e3039] p-6 rounded-2xl relative overflow-hidden transition-all hover:border-[#ffd700]/40">
                <div class="absolute -right-4 -top-4 w-24 h-24 bg-[#ffd700]/5 rounded-full blur-2xl group-hover:bg-[#ffd700]/10 transition-all"></div>
                <div class="flex items-center gap-4">
                    <div class="p-3 bg-[#ffd700]/10 rounded-xl text-[#ffd700]">
                        <Wallet :size="24" />
                    </div>
                    <div>
                        <p class="text-xs font-bold text-slate-500 uppercase tracking-widest">Total Revenue</p>
                        <h2 class="text-2xl font-bold text-white mt-1">450,200 <span class="text-xs text-slate-400">ETB</span></h2>
                    </div>
                </div>
            </div>

            <div class="group bg-[#1e2028] border border-[#2e3039] p-6 rounded-2xl relative overflow-hidden transition-all hover:border-red-500/40">
                <div class="absolute -right-4 -top-4 w-24 h-24 bg-red-500/5 rounded-full blur-2xl group-hover:bg-red-500/10 transition-all"></div>
                <div class="flex items-center gap-4">
                    <div class="p-3 bg-red-500/10 rounded-xl text-red-500">
                        <Clock :size="24" />
                    </div>
                    <div>
                        <p class="text-xs font-bold text-slate-500 uppercase tracking-widest">Outstanding</p>
                        <h2 class="text-2xl font-bold text-white mt-1">12,400 <span class="text-xs text-slate-400">ETB</span></h2>
                    </div>
                </div>
            </div>

            <div class="group bg-[#1e2028] border border-[#2e3039] p-6 rounded-2xl relative overflow-hidden transition-all hover:border-green-500/40">
                <div class="absolute -right-4 -top-4 w-24 h-24 bg-green-500/5 rounded-full blur-2xl group-hover:bg-green-500/10 transition-all"></div>
                <div class="flex items-center gap-4">
                    <div class="p-3 bg-green-500/10 rounded-xl text-green-500">
                        <CheckCircle2 :size="24" />
                    </div>
                    <div>
                        <p class="text-xs font-bold text-slate-500 uppercase tracking-widest">Paid Invoices</p>
                        <h2 class="text-2xl font-bold text-white mt-1">142 <span class="text-xs text-slate-400">Units</span></h2>
                    </div>
                </div>
            </div>
        </section>

        <div class="bg-[#1e2028] border border-[#2e3039] rounded-2xl overflow-hidden shadow-2xl">
            <div class="p-6 border-b border-[#2e3039] flex flex-col sm:flex-row justify-between items-center gap-4 bg-white/[0.01]">
                <h3 class="text-lg font-bold text-white flex items-center gap-2">
                    <FileText :size="18" class="text-[#ffd700]" /> Recent Invoices
                </h3>
                <div class="relative w-full sm:w-64">
                    <Search class="absolute left-3 top-1/2 -translate-y-1/2 text-slate-500" :size="16" />
                    <Input 
                        placeholder="Search invoices..." 
                        class="pl-10 bg-[#0d0e12] border-[#2e3039] text-white focus:ring-[#ffd700] h-9 text-xs"
                    />
                </div>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full border-collapse">
                    <thead>
                        <tr class="bg-white/[0.02]">
                            <th class="text-left py-4 px-6 text-[10px] font-bold text-slate-500 uppercase tracking-widest border-b border-[#2e3039]">Invoice #</th>
                            <th class="text-left py-4 px-6 text-[10px] font-bold text-slate-500 uppercase tracking-widest border-b border-[#2e3039]">Client</th>
                            <th class="text-left py-4 px-6 text-[10px] font-bold text-slate-500 uppercase tracking-widest border-b border-[#2e3039]">Service</th>
                            <th class="text-left py-4 px-6 text-[10px] font-bold text-slate-500 uppercase tracking-widest border-b border-[#2e3039]">Amount</th>
                            <th class="text-left py-4 px-6 text-[10px] font-bold text-slate-500 uppercase tracking-widest border-b border-[#2e3039]">Status</th>
                            <th class="text-right py-4 px-6 text-[10px] font-bold text-slate-500 uppercase tracking-widest border-b border-[#2e3039]">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-[#2e3039]">
                        <tr v-for="invoice in invoices" :key="invoice.id" class="hover:bg-white/[0.02] transition-colors group">
                            <td class="py-4 px-6 text-sm font-bold text-[#ffd700]">{{ invoice.id }}</td>
                            <td class="py-4 px-6 text-sm text-white font-medium">{{ invoice.client }}</td>
                            <td class="py-4 px-6 text-xs text-slate-400">{{ invoice.service }}</td>
                            <td class="py-4 px-6 text-sm font-bold text-white">{{ invoice.amount }}</td>
                            <td class="py-4 px-6">
                                <span 
                                    class="px-3 py-1 rounded-full text-[10px] font-bold uppercase tracking-wider"
                                    :class="invoice.status === 'paid' ? 'bg-green-500/10 text-green-500' : 'bg-red-500/10 text-red-500'"
                                >
                                    {{ invoice.status }}
                                </span>
                            </td>
                            <td class="py-4 px-6 text-right">
                                <div class="flex justify-end gap-2">
                                    <Button v-if="invoice.status === 'paid'" variant="ghost" class="h-8 w-8 p-0 text-slate-400 hover:text-white">
                                        <Download :size="16" />
                                    </Button>
                                    <Button v-else variant="ghost" class="h-8 w-8 p-0 text-slate-400 hover:text-white">
                                        <Send :size="16" />
                                    </Button>
                                    <Button variant="ghost" class="h-8 w-8 p-0 text-slate-400 hover:text-white">
                                        <MoreVertical :size="16" />
                                    </Button>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</template>