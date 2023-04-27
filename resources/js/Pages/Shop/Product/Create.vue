<script setup>
import DefaultLayout from '@/Layouts/Default.vue';
import {Link} from '@inertiajs/inertia-vue3';
import ProductCreateEditForm from "@/Components/Shop/ProductCreateEditForm.vue";
</script>

<template>
    <DefaultLayout>
        <template #breadcrumb>
            <a-breadcrumb-item>
                <Link :href="route('product.index')">Продукты</Link>
            </a-breadcrumb-item>
            <a-breadcrumb-item>Создать продукт</a-breadcrumb-item>
        </template>

        <a-page-header title="Создать продукт" @back="() => $inertia.visit(route('product.index'))"/>

        <product-create-edit-form/>
    </DefaultLayout>
</template>
