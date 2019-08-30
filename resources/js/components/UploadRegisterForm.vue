<template>
    <div>
        <div class="form-group">
            <div class="relative flex">
                <input type="text" name="name" placeholder="نام و نام خانوادگی"
                       class="input input--rounded input--right"
                       :class="{'input--danger': errors.has('name') }"
                       v-model="name">

                <span class="input-icon input-icon--no-border input-icon--right">
                     <i class="far fa-user"></i>
                 </span>
            </div>

            <div class="feedback feedback--invalid my-2" v-show="errors.has('name')">
                <p>{{ errors.get('name') }}</p>
            </div>

        </div>

        <div class="form-group">
            <div class="relative flex">
                <input type="text" name="username" placeholder="نام کاربری"
                       class="input input--rounded input--right"
                       v-model="username">

                <span class="input-icon input-icon--no-border input-icon--right">
                     <i class="far fa-id-card"></i>
                 </span>
            </div>

            <div class="feedback feedback--invalid my-2" v-show="errors.has('username')">
                <p>{{ errors.get('username') }}</p>
            </div>
        </div>

        <div class="form-group">
            <div class="relative flex">
                <input type="email" name="email" placeholder="آدرس ایمیل"
                       class="input input--rounded input--right"
                       v-model="email">

                <span class="input-icon input-icon--no-border input-icon--right">
                      <i class="far fa-envelope"></i>
                </span>
            </div>

            <div class="feedback feedback--invalid my-2" v-show="errors.has('email')">
                <p>{{ errors.get('email') }}</p>
            </div>
        </div>

        <div class="form-group">
            <div class="relative flex">
                <input type="text" name="phone" placeholder="شماره تماس"
                       class="input input--rounded input--right"
                       v-model="phone">

                <span class="input-icon input-icon--no-border input-icon--right">
                      <i class="fas fa-mobile-alt"></i>
                 </span>
            </div>

            <div class="feedback feedback--invalid my-2" v-show="errors.has('phone')">
                <p>{{ errors.get('phone') }}</p>
            </div>
        </div>

        <div class="form-group">
            <div class="relative flex">
                <input type="password" name="password" placeholder="رمز عبور"
                       class="input input--rounded input--right"
                       v-model="password">

                <span class="input-icon input-icon--no-border input-icon--right">
                      <i class="fas fa-key"></i>
                </span>
            </div>

            <div class="feedback feedback--invalid my-2" v-show="errors.has('password')">
                <p>{{ errors.get('password') }}</p>
            </div>
        </div>

        <div class="form-group">
            <div class="relative flex">
                <input type="password" name="password_confirmation"
                       placeholder="تایید رمز عبور"
                       class="input input--rounded input--right"
                       v-model="password_confirmation">

                <span class="input-icon input-icon--no-border input-icon--right">
                      <i class="fas fa-key"></i>
                 </span>
            </div>
        </div>

        <div class="form-group">
            <button class="button button--primary button--block" @click="submitForm" v-html="buttonText">
            </button>
        </div>
    </div>
</template>

<script>
    import Errors from '../Errors.js';

    export default {
        data() {
            return {
                name: '',
                email: '',
                username: '',
                password: '',
                password_confirmation: '',
                phone: '',
                errors: new Errors(),
                buttonText: 'تائید'
            }
        },

        methods: {
            submitForm() {
                this.buttonText = '<img src="/images/three-dots.svg" class="loader">';

                axios.post('/register', this.$data)
                    .then(response => {
                        flash('حساب شما با موفقیت ایجاد شد. لطفا قبل از بارگذاری فایل‌ها، وارد ایمیلتان شوید و حساب خودتان را فعال کنید.');

                        if (response.data.status === 200) {
                            this.buttonText = '<i class="fas fa-check">';
                            window.events.$emit('userCreated', response.data);

                            this.$emit('userRegistered', response.data);
                        }
                    })
                    .catch(error => {
                        this.buttonText = 'تائید';
                        this.errors.record(error.response.data.errors);
                    });
            }
        }
    }
</script>