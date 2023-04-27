<script setup>
import DefaultLayout from '@/Layouts/Default.vue';
import {Link} from '@inertiajs/inertia-vue3';
import ProductCreateEditForm from "@/Components/Shop/ProductCreateEditForm.vue";

defineProps(['product']);
</script>

<template>
    <DefaultLayout>
        <template #breadcrumb>
            <a-breadcrumb-item>
                <Link :href="route('product.index')">Продукты</Link>
            </a-breadcrumb-item>
            <a-breadcrumb-item>Изменить продукт</a-breadcrumb-item>
        </template>

        <a-page-header title="Изменить продукт" @back="() => $inertia.visit(route('product.index'))"/>

        <product-create-edit-form :product="product"/>
    </DefaultLayout>
</template>
