<script setup lang="ts">
import { Form, Head } from '@inertiajs/vue3';
import { ref } from 'vue';
import InputError from '@/components/InputError.vue';
import { Button } from '@/components/ui/button';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import { 
    Select, 
    SelectContent, 
    SelectItem, 
    SelectTrigger, 
    SelectValue 
} from '@/components/ui/select';
import { Spinner } from '@/components/ui/spinner';
import { index, store } from '@/routes/staff'

defineOptions({
    layout: {
        breadcrumbs: [
            { title: 'Staff', href: index() },
            { title: 'Create', href: '#' },
        ],
    },
});

interface Roles {
    id: number;
    name: string;
}

const role_title = ref<Roles[]>([
    {
        id: 1,
        name: 'Videographer'
    },
    {
        id: 2,
        name: 'Photographer'
    },
    {
        id: 3,
        name: 'Editor'
    }
]);

</script>
<template>
    <Head title="Create Staff" />

    <div class="flex flex-col">
        <p class="text-2xl font-semibold w-full text-left px-5 py-5">
            Add New Staff
        </p>
        <p class="text-sm px-5 mb-6 text-muted-foreground">
            Configure a new staff member for the catalog.
        </p>
    </div>

    <div class="flex h-full flex-1 flex-col gap-4 p-4 max-w-5xl">
        <div class="relative overflow-hidden rounded-2xl border border-sidebar-border/70 bg-card/50 p-8 shadow-sm backdrop-blur-md dark:border-sidebar-border/40">
            <div class="absolute -right-4 -top-4 h-24 w-24 rounded-full bg-cyan-500/10 blur-2xl"></div>
            <Form v-bind="store.form()"
                v-slot="{ errors, processing }"
                class="space-y-8">
                <div class="grid gap-2 md:grid-cols-3">
                    <div class="grid gap-2">
                        <Label for="name">Name</Label>
                        <Input
                            id="name"
                            name="name"
                            placeholder="Kaleab Solomon"
                            required
                        />
                        <InputError :message="errors.name" />
                    </div>

                    <div class="grid gap-2">
                        <Label for="category_id">Role Title</Label>
                        <Select name="role_title" id="category_id">
                            <SelectTrigger>
                                <SelectValue placeholder="Select Role Title" />
                            </SelectTrigger>
                            <SelectContent>
                                <SelectItem 
                                    v-for="role in role_title" 
                                    :key="role.id" 
                                    :value="role.name" >
                                    {{ role.name }}
                                </SelectItem>
                            </SelectContent>
                        </Select>
                        <InputError :message="errors.role_title" />
                    </div>
                    
                    <div class="grid gap-2">
                        <Label for="email">Email</Label>
                        <Input
                            id="email"
                            type="email"
                            name="email"
                            placeholder="e.g. kaleab@example.com"
                        />
                        <InputError :message="errors.email" />
                    </div>
                </div>

                <div class="grid gap-6 md:grid-cols-3">
                    <div class="grid gap-2">
                        <Label for="salary">Salary</Label>
                        <Input
                            id="salary"
                            type="number"
                            name="salary"
                            placeholder="e.g. 50,000"
                        />
                        <InputError :message="errors.salary" />
                    </div>

                    <div class="grid gap-2">
                        <Label for="status">Status</Label>
                        <Select name="status" id="status">
                            <SelectTrigger>
                                <SelectValue placeholder="Select Status" />
                            </SelectTrigger>
                            <SelectContent>
                                <SelectItem value="active">Active</SelectItem>
                                <SelectItem value="inactive">Inactive</SelectItem>
                            </SelectContent>
                        </Select>
                        <InputError :message="errors.status" />
                    </div>
                </div>

                <div class="grid gap-2">
                    <Label for="bio">Bio</Label>
                    <textarea
                        id="bio"
                        name="bio"
                        placeholder="Provide details about the staff..."
                        class="w-full rounded-lg border border-sidebar-border bg-background/50 px-4 py-2 focus:ring-2 focus:ring-primary/50 outline-none resize-none"
                    />
                    <InputError :message="errors.bio" />
                </div>

                <div class="flex items-center justify-end gap-4 border-t border-sidebar-border/50 pt-6">
                    <Button
                        type="button"
                        variant="outline"
                        :disabled="processing"
                        @click="$window.history.back()">
                        Cancel
                    </Button>
                    <Button
                        type="submit"
                        class="bg-cyan-600 hover:bg-cyan-700 text-white min-w-[140px]"
                        :disabled="processing">
                        <Spinner v-if="processing" class="mr-2" />
                        Save Service
                    </Button>
                </div>
            </Form>
        </div>
    </div>
</template>