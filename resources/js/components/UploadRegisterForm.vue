<template>
    <div>
        <div class="form-group">
            <div class="relative flex">
                <input type="text" name="name" :placeholder="trans.get('__JSON__.full name')"
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
                <input type="email" name="email" :placeholder="trans.get('__JSON__.email')"
                       class="input input--rounded input--right"
                       :class="{'input--danger': errors.has('name') }"
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
                <input type="text" name="phone" :placeholder="trans.get('__JSON__.phone number')"
                       class="input input--rounded input--right"
                       i:class="{'input--danger': errors.has('name') }"
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
                <input type="password" name="password" :placeholder="trans.get('__JSON__.password')"
                       class="input input--rounded input--right"
                       :class="{'input--danger': errors.has('name') }"
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
                       :placeholder="trans.get('__JSON__.password confirmation')"
                       class="input input--rounded input--right"
                       :class="{'input--danger': errors.has('name') }"
                       v-model="password_confirmation">

                <span class="input-icon input-icon--no-border input-icon--right">
                      <i class="fas fa-key"></i>
                 </span>
            </div>
        </div>

        <div class="form-group">
            <button class="button button--primary button--block" @click="submitForm" v-html="buttonText" :disabled="disabled">
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
                password: '',
                password_confirmation: '',
                phone: '',
                errors: new Errors(),
                buttonText: this.trans.get('__JSON__.confirm'),
                disabled: false,
                locale: Redpencilit.locale
            }
        },

        methods: {
            submitForm() {
                this.buttonText = '<img src="/images/three-dots.svg" class="loader">';
                this.disabled = true;

                axios.post(`/${this.locale}/register`, this.$data)
                    .then(response => {
                        this.disabled = false;
                        flash(this.trans.get('__JSON__.account created'));

                        if (response.data.status === 200) {
                            this.buttonText = '<i class="fas fa-check">';
                            window.events.$emit('userCreated', response.data);

                            this.$emit('userRegistered', response.data);
                        }
                    })
                    .catch(error => {
                        this.disabled = false;
                        this.buttonText = this.trans.get('__JSON__.confirm');
                        this.errors.record(error.response.data.errors);
                    });
            },
        }
    }
</script>