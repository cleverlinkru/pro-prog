<script setup>
import DefaultLayout from '@/Layouts/Default.vue';

defineProps(['isYandexConnect', 'yandexConnectLink']);
</script>

<template>
    <DefaultLayout>
        <template #breadcrumb>
            <a-breadcrumb-item>Настройки аналитики</a-breadcrumb-item>
        </template>

        <a-page-header title="Настройки аналитики"/>

        <a-card title="Яндекс">
            <p v-if="isYandexConnect">Подключено</p>
            <p v-else>Не подключено</p>
            <a :href="yandexConnectLink" target="_blank">Подключить</a>
        </a-card>
    </DefaultLayout>
</template>
