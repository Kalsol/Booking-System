<script setup lang="ts">
import { Head, Link } from '@inertiajs/vue3';
import { Search, UserPlus, MoreHorizontal, Star, Briefcase,} from 'lucide-vue-next';
import { ref, computed } from 'vue';
import { Button } from '@/components/ui/button';
import { Input } from '@/components/ui/input';
import { index, create,show } from '@/routes/staff'

defineOptions({
    layout: {
        breadcrumbs: [
            {
                title: 'Staff Directory',
                href: index(),
            },
        ],
    },
});

const searchQuery = ref('');

interface StaffMember {
    id: number;
    role_title: string;
    role: string;
    user: {
        id: number;
        name: string;
        email: string;
    },
    projects: number;
    hourly_rate: number;
    status: string;
}

const { staffMembers } = defineProps<{ staffMembers: StaffMember[] }>()

console.log(staffMembers)

const filteredStaff = computed(() => {
    return staffMembers.filter(member => 
        `${member.user.name} ${member.role_title}`.toLowerCase().includes(searchQuery.value.toLowerCase()) ||
        member.role.toLowerCase().includes(searchQuery.value.toLowerCase())
    );
});

</script>

<template>
    <Head title="Staff Directory" />

    <div class="flex h-full flex-1 flex-col gap-4 overflow-x-auto rounded-xl p-4">
        <header class="flex flex-col md:flex-row justify-between items-start md:items-center gap-6 mb-10">
            <div>
                <h1 class="text-3xl font-bold text-white tracking-tight">Production Team</h1>
                <p class="text-slate-400 mt-1">Manage your crew and equipment operators.</p>
            </div>

            <div class="flex items-center gap-3 w-full md:w-auto">
                <div class="relative w-full md:w-72">
                    <Search class="absolute left-3 top-1/2 -translate-y-1/2 text-slate-500" :size="18" />
                    <Input 
                        v-model="searchQuery"
                        placeholder="Search by name or skill..." 
                        class="pl-10 bg-[#1e2028] border-[#2e3039] text-white focus:ring-[#ffd700]"
                    />
                </div>
                <Link :href="create()" class="bg-[#ffd700] hover:bg-[#ffd700]/90 text-black font-bold px-5 h-11 rounded-lg flex items-center transition-colors shadow-lg shadow-[#ffd700]/10">
                    <UserPlus class="mr-2 h-4 w-4" /> Add Staff
                </Link>
            </div>
        </header>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <div 
                v-for="member in filteredStaff" 
                :key="member.id"
                class="bg-[#1e2028] border border-[#2e3039] rounded-xl p-6 relative transition-all duration-300 hover:-translate-y-1 hover:border-[#ffd700]/50 group">
                <div class="absolute top-6 right-6 w-2.5 h-2.5 rounded-full"
                    :class="member.status === 'active' ? 'bg-green-500 shadow-[0_0_8px_rgba(34,197,94,0.6)]' : 'bg-red-500'"></div>

                <div class="flex items-center gap-4 mb-6">
                    <div class="w-14 h-14 rounded-full bg-[#16171d] border-2 border-[#2e3039] flex items-center justify-center text-[#ffd700] text-lg font-bold">
                        {{ member.user.name[0] }}
                    </div>
                    <div>
                        <h3 class="text-white font-bold text-lg leading-tight">{{ member.user.name }}</h3>
                        <p class="text-slate-500 text-sm">{{ member.role }}</p>
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-3 bg-black/20 p-4 rounded-lg mb-6">
                    <div class="flex flex-col">
                        <span class="text-[10px] uppercase tracking-wider text-slate-500 font-bold flex items-center gap-1">
                            <Briefcase :size="10" /> Projects
                        </span>
                        <strong class="text-white text-sm">{{ member.projects }}</strong>
                    </div>
                    <div class="flex flex-col">
                        <span class="text-[10px] uppercase tracking-wider text-slate-500 font-bold flex items-center gap-1">
                            <Star :size="10" /> Rating
                        </span>
                        <strong class="text-white text-sm">{{ member.hourly_rate }}</strong>
                    </div>
                </div>

                <div class="flex gap-2">
                    <Button variant="outline" class="flex-1 border-[#2e3039] text-white hover:bg-[#2e3039] text-xs h-9">
                        <Link :href="show(member.user.id)">
                              View Profile
                        </Link>
                    </Button>
                    <Button variant="outline" class="w-10 border-[#2e3039] text-white hover:bg-[#2e3039] p-0 h-9">
                        <MoreHorizontal :size="16" />
                    </Button>
                </div>
            </div>
        </div>

        <div v-if="filteredStaff.length === 0" class="text-center py-20 bg-[#16171d] rounded-xl border border-dashed border-[#2e3039]">
            <p class="text-slate-500">No staff members found matching your search.</p>
        </div>
    </div>
</template>