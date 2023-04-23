<script setup>
import {
    FileOutlined,
} from '@ant-design/icons-vue';
import {Link} from '@inertiajs/inertia-vue3';
</script>

<template>
    <a-menu v-model:selectedKeys="selectedKeys" theme="dark" mode="inline">
        <Link :href="route('postCategory.index')">
            <a-menu-item key="test" path="/">
                <file-outlined/>
                <span>Материалы</span>
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
