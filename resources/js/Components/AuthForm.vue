<template>
    <a-spin :spinning="form.processing">
        <a-form
            :model='form'
            :rules='rules'
            :label-col="{ span: 8 }"
            :wrapper-col="{ span: 16 }"
            @finish='onSubmit'
        >
            <a-form-item v-if="register" label='Имя' name='name' :extra='form.errors.name'>
                <a-input v-model:value='form.name'/>
            </a-form-item>
            <a-form-item label='Номер телефона' name='phone' :extra='form.errors.phone'>
                <a-input v-model:value='form.phone' v-mask="maskPhone"/>
            </a-form-item>
            <a-form-item
                v-if="showCode && form.method == 'sms'"
                label='Код из смс'
                name='code'
                :extra='form.errors.code'
            >
                <a-input v-model:value='form.code' v-mask="maskCode"/>
                <a @click="handleCodeNotReceived">Не пришёл код?</a>
            </a-form-item>
            <a-form-item
                v-if="showCode && form.method == 'call'"
                label='Код из звонка'
                name='code'
                :extra='form.errors.code'
            >
                <a-input v-model:value='form.code' v-mask="maskCode"/>
                <p>Последние 4 цифры звонившего номера</p>
            </a-form-item>
            <a-form-item :wrapper-col="{ offset: 8, span: 16 }">
                <a-button v-if="!showCode" type="primary" html-type="submit">Получить код</a-button>
                <a-button v-else-if="register" type="primary" html-type="submit">Зарегистрироваться</a-button>
                <a-button v-else type="primary" html-type="submit">Войти</a-button>
            </a-form-item>
        </a-form>
    </a-spin>
</template>

<script>
import {useForm} from "@inertiajs/inertia-vue3";

export default {
    props: {
        register: {
            type: Boolean,
            default() {
                return false;
            },
        },
    },
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
            showCode: false,
            maskPhone: '+7 (###) ###-##-##',
            maskCode: '####',
        };
    },
    created() {
        this.form = useForm('authForm', {
            name: '',
            phone: '',
            code: '',
            method: 'sms',
        });
    },
    methods: {
        onSubmit() {
            if (this.showCode) {
                this.signInUp();
            } else {
                this.sendCode();
            }
        },

        sendCode() {
            let url = this.register ? route('auth.signUpSendCode') : route('auth.signInSendCode');
            this.form.post(url, {
                onSuccess: (page) => {
                    if (page.props.flash.message.status) {
                        this.showCode = true;
                    }
                }
            });
        },

        handleCodeNotReceived() {
            this.form.method = 'call';
            this.sendCode();
        },

        signInUp() {
            let url = this.register ? route('auth.signUp') : route('auth.signIn');
            this.form.post(url);
        },
    },
}
</script>
