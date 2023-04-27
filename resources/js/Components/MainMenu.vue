<script setup>
import {
    FileOutlined,
    ShoppingOutlined,
    WalletOutlined,
} from '@ant-design/icons-vue';
import {Link} from '@inertiajs/inertia-vue3';
</script>

<template>
    <a-menu v-model:selectedKeys="selectedKeys" theme="dark" mode="inline">
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
    </a-menu>
</template>

<script>
export default {
    data() {
        return {
            selectedKeys: [],
        };
    },
}
</script>
