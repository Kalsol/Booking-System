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
import { services } from '@/routes'
import { store } from '@/routes/services'; // Replace with your actual service route helper

defineOptions({
    layout: {
        breadcrumbs: [
            { title: 'Services', href: services() },
            { title: 'Create', href: '#' },
        ],
    },
});

interface Category {
    id: number;
    name: string;
}

const categories = ref<Category[]>([
    {
        id: 1,
        name: 'Videography'
    },
    {
        id: 2,
        name: 'Photography'
    },
    {
        id: 3,
        name: 'Weeding'
    }
]);

</script>
<template>
    <Head title="Create Service" />

    <div class="flex flex-col">
        <p class="text-2xl font-semibold w-full text-left px-5 py-5">
            Add New Service
        </p>
        <p class="text-sm px-5 mb-6 text-muted-foreground">
            Configure a new production package for the catalog.
        </p>
    </div>

    <div class="flex h-full flex-1 flex-col gap-4 p-4 max-w-5xl">
        <div class="relative overflow-hidden rounded-2xl border border-sidebar-border/70 bg-card/50 p-8 shadow-sm backdrop-blur-md dark:border-sidebar-border/40">
            <div class="absolute -right-4 -top-4 h-24 w-24 rounded-full bg-cyan-500/10 blur-2xl"></div>

            <Form v-bind="store.form()"
                v-slot="{ errors, processing }"
                class="space-y-8">
                <div class="grid gap-6 md:grid-cols-2">
                    <div class="grid gap-2">
                        <Label for="name">Service Name</Label>
                        <Input
                            id="name"
                            name="name"
                            placeholder="e.g. 4K Cinematic Music Video"
                            required
                        />
                        <InputError :message="errors.name" />
                    </div>

                    <div class="grid gap-2">
                        <Label for="category_id">Category</Label>
                        <Select name="category_name" id="category_id">
                            <SelectTrigger>
                                <SelectValue placeholder="Select Category" />
                            </SelectTrigger>
                            <SelectContent>
                                <SelectItem 
                                    v-for="category in categories" 
                                    :key="category.id" 
                                    :value="category.name" >
                                    {{ category.name }}
                                </SelectItem>
                            </SelectContent>
                        </Select>
                        <InputError :message="errors.category_name" />
                    </div>
                </div>

                <div class="grid gap-6 md:grid-cols-3">
                    <div class="grid gap-2">
                        <Label for="price">Price (Br)</Label>
                        <Input
                            id="price"
                            type="number"
                            name="price"
                            placeholder="0.00"
                        />
                        <InputError :message="errors.price" />
                    </div>

                    <div class="grid gap-2">
                        <Label for="duration">Duration</Label>
                        <Input
                            id="duration"
                            name="duration"
                            placeholder="e.g. 2 Days"
                        />
                        <InputError :message="errors.duration" />
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
                    <Label for="description">Description</Label>
                    <textarea
                        id="description"
                        name="description"
                        placeholder="Provide details about the service inclusions..."
                        class="w-full rounded-lg border border-sidebar-border bg-background/50 px-4 py-2 focus:ring-2 focus:ring-primary/50 outline-none resize-none"
                    />
                    <InputError :message="errors.description" />
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