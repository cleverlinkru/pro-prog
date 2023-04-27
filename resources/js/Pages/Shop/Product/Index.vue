<script setup>
import DefaultLayout from '@/Layouts/Default.vue';
import {Link} from '@inertiajs/inertia-vue3';

defineProps(['products']);
</script>

<template>
    <DefaultLayout>
        <template #breadcrumb>
            <a-breadcrumb-item>
                <Link :href="route('product.index')">Продукты</Link>
            </a-breadcrumb-item>
        </template>

        <a-page-header title="Продукты"/>

        <div class="mb">
            <a-button
                type="primary"
                :href="route('product.create')"
            >
                Создать продукт
            </a-button>
        </div>

        <a-table :data-source="products" :columns="columns">
            <template #bodyCell="{ column, record }">
                <template v-if="column.key === 'actions'">
                    <a-space>
                        <a-button :href="route('product.edit', record.id)">Изменить</a-button>
                        <a-popconfirm
                            title="Уверены?"
                            ok-text="Да"
                            cancel-text="Нет"
                            @confirm="handleDelete(record)"
                        >
                            <a-button>Удалить</a-button>
                        </a-popconfirm>
                        <a :href="route('quickBuy.show', record.id)" target="_blank">Быстрая покупка</a>
                    </a-space>
                </template>
            </template>
        </a-table>
    </DefaultLayout>
</template>

<script>
const columns = [
    {
        title: 'ID',
        dataIndex: 'id',
        key: 'id',
    },
    {
        title: 'Заголовок',
        dataIndex: 'title',
        key: 'title',
    },
    {
        title: 'Цена',
        dataIndex: 'price',
        key: 'price',
    },
    {
        title: 'Действия',
        key: 'actions',
    },
];

export default {
    data() {
        return {
            columns,
        };
    },
    methods: {
        handleDelete(product) {
            this.$inertia.visit(route('product.destroy', product.id), {method: 'delete'});
        },
    },
}
</script>

<style lang="scss" scoped>
.mb {
    margin-bottom: 20px;
}
</style>
