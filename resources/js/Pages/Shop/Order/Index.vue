<script setup>
import DefaultLayout from '@/Layouts/Default.vue';

defineProps(['orders']);
</script>

<template>
    <DefaultLayout>
        <template #breadcrumb>
            <a-breadcrumb-item><a :href="route('order.index')">Покупки</a></a-breadcrumb-item>
        </template>

        <a-page-header title="Покупки"/>

        <a-table :data-source="orders" :columns="columns">
            <template #bodyCell="{ column, record }">
                <template v-if="column.key === 'user'">
                    ({{ record.user.id }}) {{ record.user.phone }}
                </template>
                <template v-if="column.key === 'product'">
                    ({{ record.product.id }}) {{ record.product.title }}
                </template>
                <template v-if="column.key === 'status'">
                    {{ record.paid ? 'Оплачен' : '' }}
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
        title: 'Пользователь',
        key: 'user',
    },
    {
        title: 'Продукт',
        key: 'product',
    },
    {
        title: 'Цена',
        dataIndex: 'price',
        key: 'price',
    },
    {
        title: 'Дата',
        dataIndex: 'created_at',
        key: 'created_at',
    },
    {
        title: 'Статус',
        key: 'status',
    },
];

export default {
    data() {
        return {
            columns,
        };
    },
}
</script>
