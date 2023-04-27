<script setup>
import DefaultLayout from '@/Layouts/Default.vue';
import {Link} from '@inertiajs/inertia-vue3';

defineProps(['postCategories', 'postCategory', 'posts']);
</script>

<template>
    <DefaultLayout>
        <template #breadcrumb>
            <a-breadcrumb-item>
                <Link :href="route('postCategory.index')">Материалы</Link>
            </a-breadcrumb-item>
            <a-breadcrumb-item v-if="postCategory">{{ postCategory.title }}</a-breadcrumb-item>
        </template>

        <a-page-header :title="postCategory ? postCategory.title : 'Материалы'"/>

        <div class="mb">
            <a-space>
                <a-button
                    type="primary"
                    :href="`${route('postCategory.create')}?parent-post-category=${postCategory ? postCategory.id : ''}`"
                >
                    Создать категорию
                </a-button>
                <a-button
                    type="primary"
                    :href="`${route('post.create')}?post-category=${postCategory ? postCategory.id : ''}`"
                >
                    Создать материал
                </a-button>
            </a-space>
        </div>

        <div v-if="postCategories.length" class="mb">
            <h2>Разделы</h2>
            <a-card v-for="postCategory in postCategories">
                <div class="row">
                    <div class="row__col">
                        <Link :href="route('postCategory.show', postCategory.id)">{{ postCategory.title }}</Link>
                    </div>
                    <div class="row__col">
                        <a-space>
                            <a-button :href="route('postCategory.edit', postCategory.id)">Изменить</a-button>
                            <a-popconfirm
                                title="Уверены?"
                                ok-text="Да"
                                cancel-text="Нет"
                                @confirm="handleDeletePostCategory(postCategory)"
                            >
                                <a-button>Удалить</a-button>
                            </a-popconfirm>
                        </a-space>
                    </div>
                </div>
            </a-card>
        </div>

        <div v-if="posts.length">
            <h2>Материалы</h2>
            <a-card v-for="post in posts">
                <div class="row">
                    <div class="row__col">
                        <Link :href="route('post.show', post.id)">{{ post.title }}</Link>
                    </div>
                    <div class="row__col">
                        <a-button :href="route('post.edit', post.id)">Изменить</a-button>
                        <a-popconfirm
                            title="Уверены?"
                            ok-text="Да"
                            cancel-text="Нет"
                            @confirm="handleDeletePost(post)"
                        >
                            <a-button>Удалить</a-button>
                        </a-popconfirm>
                    </div>
                </div>
            </a-card>
        </div>
    </DefaultLayout>
</template>

<script>
export default {
    methods: {
        handleDeletePostCategory(postCategory) {
            this.$inertia.visit(route('postCategory.destroy', postCategory.id), {method: 'delete'});
        },

        handleDeletePost(post) {
            this.$inertia.visit(route('post.destroy', post.id), {method: 'delete'});
        },
    },
}
</script>

<style lang="scss" scoped>
.row {
    display: grid;
    grid-template-columns: 1fr auto;
    gap: 10px;
}

.mb {
    margin-bottom: 20px;
}
</style>
