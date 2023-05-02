<script setup>
import {
    FileOutlined,
    ShoppingOutlined,
    WalletOutlined,
    SettingOutlined,
    AreaChartOutlined,
} from '@ant-design/icons-vue';
import {Link} from '@inertiajs/inertia-vue3';
</script>

<template>
    <a-menu v-model="openKeys" v-model:selectedKeys="selectedKeys" theme="dark" mode="inline">
        <Link :href="route('postCategory.index')">
            <a-menu-item key="postCategory.index">
                <file-outlined/>
                <span>Материалы</span>
            </a-menu-item>
        </Link>
        <Link :href="route('product.index')">
            <a-menu-item key="product.index">
                <shopping-outlined/>
                <span>Продукты</span>
            </a-menu-item>
        </Link>
        <Link :href="route('order.index')">
            <a-menu-item key="order.index">
                <wallet-outlined/>
                <span>Покупки</span>
            </a-menu-item>
        </Link>
        <a-sub-menu key="settings">
            <template #icon>
                <setting-outlined/>
            </template>
            <template #title>Настройки</template>
            <Link :href="route('analytics.settings')">
                <a-menu-item key="analytics.settings">
                    <area-chart-outlined/>
                    <span>Аналитика</span>
                </a-menu-item>
            </Link>
        </a-sub-menu>
    </a-menu>
</template>

<script>
export default {
    data() {
        return {
            openKeys: [],
            selectedKeys: [],
        };
    },
}
</script>
