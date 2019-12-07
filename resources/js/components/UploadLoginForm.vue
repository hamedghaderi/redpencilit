<template>
    <div>
        <div class="form-group">
            <div class="relative flex">
                <input type="email"
                       name="email"
                       :placeholder="trans.get('__JSON__.email')"
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
                <input
                        type="password"
                        name="password"
                        :placeholder="trans.get('__JSON__.password')"
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
            <button class="button button--primary button--block" @click="onSubmit">
                {{ trans.get('__JSON__.confirm') }}
            </button>
        </div>
    </div>
</template>

<script>
    import Errors from '../Errors.js';

    export default {
        data() {
            return {
                email: '',
                password: '',
                errors: new Errors(),
                locale: Redpencilit.locale
            }
        },

        methods: {
            onSubmit() {
                axios.post(`/${this.locale}/login`, this.$data)
                    .then(response => {
                        console.log(response.data);
                        if (response.data.status === 200) {
                            window.events.$emit('userCreated', response.data);

                            this.$emit('userLoggedIn', response.data);
                        }
                    }).catch(error => {
                        this.errors.record(error.response.data.errors);
                    });
            }
        }
    }
</script>