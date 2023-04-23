<script setup>
import DefaultLayout from '@/Layouts/Default.vue';
import {Link} from '@inertiajs/inertia-vue3';
import PostCategoryCreateEditForm from "@/Components/Post/PostCategoryCreateEditForm.vue";

defineProps(['postCategory', 'postCategories']);
</script>

<template>
    <DefaultLayout>
        <template #breadcrumb>
            <a-breadcrumb-item>
                <Link :href="route('postCategory.index')">Материалы</Link>
            </a-breadcrumb-item>
            <a-breadcrumb-item>Изменить категорию материала</a-breadcrumb-item>
        </template>

        <a-page-header title="Изменить категорию материала" @back="() => $inertia.visit(route('postCategory.index'))"/>

        <post-category-create-edit-form :postCategory="postCategory" :postCategories="postCategories"/>
    </DefaultLayout>
</template>
