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
            <a-form-item
                label='Родительская категория'
                name='category_id'
                :extra='form.errors.category_id'
            >
                <a-select v-model:value="form.category_id">
                    <a-select-option :value="null">Не выбрано</a-select-option>
                    <a-select-option v-for="postCategory in postCategories" :value="postCategory.id">
                        ({{ postCategory.id }}) {{ postCategory.title }}
                    </a-select-option>
                </a-select>
            </a-form-item>
            <a-form-item>
                <a-space>
                    <a-button type="primary" html-type="submit">Сохранить</a-button>
                    <a-button :href="route('postCategory.index')">Отмена</a-button>
                </a-space>
            </a-form-item>
        </a-form>
    </a-spin>
</template>

<script>
import {useForm} from "@inertiajs/inertia-vue3";

export default {
    props: {
        postCategory: {
            type: Object,
            default() {
                return null;
            },
        },
        parentPostCategory: {
            type: Object,
            default() {
                return null;
            },
        },
        postCategories: {
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
            },
        };
    },
    created() {
        this.form = useForm('postCategoryForm', this.postCategory ?? {
            title: '',
            category_id: this.parentPostCategory ? this.parentPostCategory.id : null,
        });
    },
    methods: {
        onSubmit() {
            if (this.postCategory) {
                this.form.put(route('postCategory.update', this.postCategory.id));
            } else {
                this.form.post(route('postCategory.store'));
            }
        },
    },
}
</script>
