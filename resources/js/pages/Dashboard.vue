<script setup lang="ts">
import { Head, Link } from '@inertiajs/vue3';
import { Wallet, Film, Users, Plus } from 'lucide-vue-next'
import PlaceholderPattern from '@/components/PlaceholderPattern.vue';
import { Button } from '@/components/ui/button'
import {
  Table,
  TableBody,
  TableCaption,
  TableCell,
  TableFooter,
  TableHead,
  TableHeader,
  TableRow,
} from '@/components/ui/table'
import { dashboard } from '@/routes';
import { create } from '@/routes/appointments';


defineOptions({
    layout: {
        breadcrumbs: [
            {
                title: 'Dashboard',
                href: dashboard(),
            },
        ],
    },
});
</script>

<template>
    <Head title="Dashboard" />
    <div class="flex flex-col ">
        <p class="text-2xl font-semibold w-full text-left px-5 py-5">
            Production Overview
        </p>
        <p class="text-sm px-5">
            Welcome Back <span class="font-semibold text-xl italic text-cyan-500">Tinsu</span>.
        </p>
        <div class="p-6 flex justify-end">
            <Link :href="create()" class="flex items-center gap-2 bg-accent text-foreground hover:bg-accent/90 cursor-pointer">
                <Plus size="20" strokeWidth={1.5} />
                Add Booking
            </Link>
        </div>
    </div>
    <div class="flex h-full flex-1 flex-col gap-4 overflow-x-auto rounded-xl p-4">
        <div class="grid auto-rows-min gap-4 md:grid-cols-3">
            <!-- Monthly Revenue Card -->
            <div class="relative aspect-video overflow-hidden rounded-2xl border border-sidebar-border/70 bg-card/50 shadow-sm backdrop-blur-md transition-all hover:shadow-md dark:border-sidebar-border/40">
                <div class="absolute -right-4 -top-4 h-24 w-24 rounded-full bg-primary/10 blur-2xl"></div>
                
                <div class="flex h-full items-center justify-center gap-6 p-6">
                    <div class="flex h-20 w-20 items-center justify-center rounded-2xl bg-primary/10 text-primary">
                        <Wallet size="40" strokeWidth={1.5} />
                    </div>
            
                    <div class="flex flex-col justify-center">
                        <h3 class="text-sm font-medium uppercase tracking-wider text-muted-foreground">
                            Monthly Revenue
                        </h3>
                        <p class="text-3xl font-bold tracking-tight text-foreground">
                            $12,000,000
                        </p>
                        <div class="mt-1 flex items-center text-xs font-medium text-emerald-500">
                            <span>+12.5% from last month</span>
                        </div>
                    </div>
                </div>
            </div>
            
            <!--Upcomming Shoots  -->
            <div class="relative aspect-video overflow-hidden rounded-2xl border border-sidebar-border/70 bg-card/50 shadow-sm backdrop-blur-md transition-all hover:shadow-md dark:border-sidebar-border/40">
                <div class="absolute -right-4 -top-4 h-24 w-24 rounded-full bg-primary/10 blur-2xl"></div>
                
                <div class="flex h-full items-center justify-center gap-6 p-6">
                    <div class="flex h-20 w-20 items-center justify-center rounded-2xl bg-primary/10 text-primary">
                        <Film size="40" strokeWidth={1.5} />
                    </div>
            
                    <div class="flex flex-col justify-center">
                        <h3 class="text-sm font-medium uppercase tracking-wider text-muted-foreground">
                            Active Shoots
                        </h3>
                        <p class="text-3xl font-bold tracking-tight text-foreground">
                            5
                        </p>
                        <div class="mt-1 flex items-center text-xs font-medium text-emerald-500">
                            <span></span>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- No Of Staffs -->
            <div class="relative aspect-video overflow-hidden rounded-2xl border border-sidebar-border/70 bg-card/50 shadow-sm backdrop-blur-md transition-all hover:shadow-md dark:border-sidebar-border/40">
                <div class="absolute -right-4 -top-4 h-24 w-24 rounded-full bg-primary/10 blur-2xl"></div>
                
                <div class="flex h-full items-center justify-center gap-6 p-6">
                    <div class="flex h-20 w-20 items-center justify-center rounded-2xl bg-primary/10 text-primary">
                        <Users size="40" strokeWidth={1.5} />
                    </div>
            
                    <div class="flex flex-col justify-center">
                        <h3 class="text-sm font-medium uppercase tracking-wider text-muted-foreground">
                            No of Staffs
                        </h3>
                        <p class="text-3xl font-bold tracking-tight text-foreground">
                            5
                        </p>
                        <div class="mt-1 flex items-center text-xs font-medium text-emerald-500">
                            <span>+12.5% from last month</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Recent Appointments Table -->
        <div class="relative min-h-[100vh] flex-1 rounded-xl border border-sidebar-border/70 md:min-h-min dark:border-sidebar-border">
            <PlaceholderPattern />
            <div class="p-6">
                <Table>
                    <TableCaption>Recent Appointments</TableCaption>
                    <TableHeader>
                        <TableRow>
                            <TableHead>
                                Customer
                            </TableHead>
                            <TableHead>
                                Production Service
                            </TableHead>
                            <TableHead>
                                Assigned Staff
                            </TableHead>
                            <TableHead>
                                Billing
                            </TableHead>
                            <TableHead>
                                Status
                            </TableHead>
                            <TableHead>
                                Actions
                            </TableHead>
                        </TableRow>
                    </TableHeader>
                    <TableBody>
                        <TableRow>
                            <TableCell>Kaleab Solomon</TableCell>
                            <TableCell>4K Cinematic Music Video </TableCell>
                            <TableCell>Yafet Solomon</TableCell>
                            <TableCell>30,000 Br</TableCell>
                            <TableCell>Pending</TableCell>
                            
                            <TableCell>
                                <Button class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded cursor-pointer">
                                    <a href=''>
                                        View Details
                                    </a>
                                </Button>
                            </TableCell>
                        </TableRow>
                    </TableBody>
                </Table>
            </div>
        </div>
    </div>
</template>
