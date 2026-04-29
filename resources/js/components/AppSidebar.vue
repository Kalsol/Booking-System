<script setup lang="ts">
import { Link } from '@inertiajs/vue3';
import { BookOpen, FolderGit2, LayoutGrid } from 'lucide-vue-next';
import AppLogo from '@/components/AppLogo.vue';
import NavFooter from '@/components/NavFooter.vue';
import NavMain from '@/components/NavMain.vue';
import NavUser from '@/components/NavUser.vue';
import {
    Sidebar,
    SidebarContent,
    SidebarFooter,
    SidebarHeader,
    SidebarMenu,
    SidebarMenuButton,
    SidebarMenuItem,
} from '@/components/ui/sidebar';
import { dashboard, appointments, billing } from '@/routes';
import { schedule } from '@/routes/appointments';
import { index as serviceIndex } from '@/routes/services';
import { index as staffIndex } from '@/routes/staff';


import type { NavItem } from '@/types';

const mainNavItems: NavItem[] = [
    {
        title: 'Dashboard',
        href: dashboard(),
        icon: LayoutGrid,
    },
    {
        title: 'Appointments',
        href: appointments(),
        icon: BookOpen,
    },
    {
        title: 'Services',
        href: serviceIndex(),
        icon: FolderGit2,
    },
    {
        title: 'Schedule',
        href: schedule(),
        icon: LayoutGrid,
    },
    {
        title: 'Staff Directory',
        href: staffIndex(),
        icon: FolderGit2,
    },
    {
        title: 'Billing and Invoices',
        href: billing(),
        icon: FolderGit2,
    }
];

const footerNavItems: NavItem[] = [
  
];
</script>

<template>
    <Sidebar collapsible="icon" variant="inset">
        <SidebarHeader>
            <SidebarMenu>
                <SidebarMenuItem>
                    <SidebarMenuButton size="lg" as-child>
                        <Link :href="dashboard()">
                            <AppLogo />
                        </Link>
                    </SidebarMenuButton>
                </SidebarMenuItem>
            </SidebarMenu>
        </SidebarHeader>

        <SidebarContent>
            <NavMain :items="mainNavItems" />
        </SidebarContent>

        <SidebarFooter>
            <NavFooter :items="footerNavItems" />
            <NavUser />
        </SidebarFooter>
    </Sidebar>
        <slot />
</template>
