<template>
    <a-spin :spinning="form.processing">
        <a-form
            :model='form'
            :rules='rules'
            :label-col="{ span: 24 }"
            :wrapper-col="{ span: 24 }"
            @finish='onSubmit'
        >
            <a-form-item label='Заголовок' name='title' :extra='form.errors.title'>
                <a-input v-model:value='form.title'/>
            </a-form-item>
            <a-form-item label='Цена' name='price' :extra='form.errors.price'>
                <a-input-number v-model:value='form.price' :min="0" class="input-number"/>
            </a-form-item>
            <a-form-item>
                <a-space>
                    <a-button type="primary" html-type="submit">Сохранить</a-button>
                    <a-button :href="route('product.index')">Отмена</a-button>
                </a-space>
            </a-form-item>
        </a-form>
    </a-spin>
</template>

<script>
import {useForm} from "@inertiajs/inertia-vue3";

export default {
    props: {
        product: {
            type: Object,
            default() {
                return null;
            },
        },
    },
    data() {
        return {
            form: {},
            rules: {
                title: {
                    required: true,
                    message: 'Обязательно',
                },
                price: {
                    required: true,
                    message: 'Обязательно',
                },
            },
        };
    },
    created() {
        this.form = useForm('productForm', this.product ?? {
            title: '',
            price: '',
        });
    },
    methods: {
        onSubmit() {
            if (this.product) {
                this.form.put(route('product.update', this.product.id));
            } else {
                this.form.post(route('product.store'));
            }
        },
    },
}
</script>

<style lang="scss" scoped>
.input-number {
    width: 100%;
}
</style>
