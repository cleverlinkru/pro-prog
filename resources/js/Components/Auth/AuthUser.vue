<script setup>
import {UserOutlined} from '@ant-design/icons-vue';
</script>

<template>
    <span v-if="$page.props.auth.user">
        <user-outlined/>
        {{ $page.props.auth.user.name }}
        <a-button @click="handleExit">Выйти</a-button>
    </span>
</template>

<script>
export default {
    methods: {
        handleExit() {
            this.$inertia.visit(route('auth.logout'));
        },
    },
}
</script>
