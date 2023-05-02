<script setup>
import AuthLayout from '@/Layouts/Auth.vue';

defineProps(['product']);
</script>

<template>
    <AuthLayout>
        <a-card>
            <template #title>
                <div class="card-title">Школа программирования ProProg</div>
            </template>
            <a-spin :spinning="form.processing">
                <a-card>
                    <template #title>
                        <div class="card-title">Купить: {{ product.title }}</div>
                    </template>
                    Цена: {{ product.price }} руб.
                </a-card>
                <a-form
                    :model='form'
                    :rules='rules'
                    :label-col="{ span: 24 }"
                    :wrapper-col="{ span: 24 }"
                    class="form"
                    @finish='onSubmit'
                >
                    <a-form-item label='Номер телефона' name='phone' :extra='form.errors.phone'>
                        <a-input v-model:value='form.phone' v-mask="maskPhone"/>
                    </a-form-item>
                    <a-form-item>
                        <a-button type="primary" html-type="submit">Оплатить</a-button>
                    </a-form-item>
                </a-form>
            </a-spin>
        </a-card>
    </AuthLayout>
</template>

<script>
import {useForm} from "@inertiajs/inertia-vue3";

export default {
    data() {
        return {
            form: {},
            rules: {
                phone: {
                    required: true,
                    message: 'Обязательно',
                },
                code: {
                    required: true,
                    message: 'Обязательно',
                },
            },
            maskPhone: '+7 (###) ###-##-##',
        };
    },
    created() {
        this.form = useForm('quickBuyForm', {
            phone: '',
        });
    },
    methods: {
        onSubmit() {
            this.form.post(route('shop.quickBuy.buy', this.product.id));
        },
    },
}
</script>

<style lang="scss" scoped>
.card-title {
    white-space: break-spaces;
}

.form {
    margin-top: 20px;
}
</style>
