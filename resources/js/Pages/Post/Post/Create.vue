<script setup>
import DefaultLayout from '@/Layouts/Default.vue';
import {Link} from "@inertiajs/inertia-vue3";
import PostCreateEditForm from "@/Components/Post/PostCreateEditForm.vue";

defineProps(['postCategory', 'postCategories']);
</script>

<template>
    <DefaultLayout>
        <template #breadcrumb>
            <a-breadcrumb-item>
                <Link :href="route('postCategory.index')">Материалы</Link>
            </a-breadcrumb-item>
            <a-breadcrumb-item>Создать материал</a-breadcrumb-item>
        </template>

        <a-page-header title="Создать материал" @back="() => $inertia.visit(route('postCategory.index'))"/>

        <post-create-edit-form :postCategory="postCategory" :postCategories="postCategories"/>
    </DefaultLayout>
</template>
