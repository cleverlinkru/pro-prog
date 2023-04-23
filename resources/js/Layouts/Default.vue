<script setup>
import AuthUser from '@/Components/Auth/AuthUser.vue';
import MainMenu from '@/Components/MainMenu.vue';
</script>

<template>
    <a-layout>
        <a-layout-sider>
            <p class="title">Школа программирования ProProg</p>
            <main-menu/>
        </a-layout-sider>
        <a-layout>
            <a-layout-header class="header">
                <auth-user/>
            </a-layout-header>
            <a-layout-content class="content">
                <a-breadcrumb class="breadcrumb">
                    <slot name="breadcrumb"/>
                </a-breadcrumb>
                <div class="content__inner">
                    <slot/>
                </div>
            </a-layout-content>
            <a-layout-footer class="footer">
                ProProg ©{{ new Date().getFullYear() }}
            </a-layout-footer>
        </a-layout>
    </a-layout>
</template>

<style lang="scss" scoped>
.title {
    color: rgba(255, 255, 255, 0.65);
    text-align: center;
}

.header {
    background: #fff;
    padding: 0 16px;
    text-align: right;
}

.content {
    margin: 0 16px;

    &__inner {
        padding: 24px;
        background: #fff;
        min-height: 360px;
    }
}

.breadcrumb {
    margin: 16px 0;
}

.footer {
    text-align: center;
}
</style>
