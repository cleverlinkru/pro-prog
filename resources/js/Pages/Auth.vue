<script setup>
import AuthLayout from '@/Layouts/Auth.vue';
import AuthForm from '@/Components/Auth/AuthForm.vue';
</script>

<template>
    <AuthLayout>
        <a-card>
            <h1>Школа программирования ProProg</h1>
            <a-tabs>
                <a-tab-pane key='sign-in' tab='Авторизация'>
                    <auth-form/>
                </a-tab-pane>
                <a-tab-pane key='sign-up' tab='Регистрация'>
                    <auth-form :register="true"/>
                </a-tab-pane>
            </a-tabs>
        </a-card>
    </AuthLayout>
</template>
