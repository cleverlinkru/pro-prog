<script setup>
import DefaultLayout from '@/Layouts/Default.vue';
import {Link} from "@inertiajs/inertia-vue3";

defineProps(['post']);
</script>

<template>
    <DefaultLayout>
        <template #breadcrumb>
            <a-breadcrumb-item>
                <Link :href="route('postCategory.index')">Материалы</Link>
            </a-breadcrumb-item>
            <a-breadcrumb-item>{{ post.title }}</a-breadcrumb-item>
        </template>

        <a-page-header :title="post.title" @back="() => $inertia.visit(route('postCategory.index'))"/>

        <div class="text">{{ post.text }}</div>
    </DefaultLayout>
</template>

<style lang="scss" scoped>
.text {
    white-space: pre;
}
</style>
