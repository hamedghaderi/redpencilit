<template>
    <div>
        <dropdown classes="text-left w-64">
            <template v-slot:toggler>
                <button class="button button--outline button--outline--danger" v-if="!user">
                    حساب کاربری
                </button>

                <div class="inline-flex justify-end items-center text-grey-darker cursor-pointer" v-else>
                    <img :src="avatar" class="w-8 h-8 rounded-full ml-1">
                    <i class="fas fa-chevron-down text-xs" :class="{rotate: rotate}"></i>
                </div>
            </template>

            <div class="dropdown__content dropdown__content--left">
                <div v-if="!user">
                    <span class="dropdown__title leading-loose">مدیریت حساب</span>
                    <a href="/login">
                        <i class="fas fa-sign-out-alt text-grey"></i>
                        ورود به حساب کاربری
                    </a>

                    <a href="/register">
                        <i class="fas fa-user-plus text-teal"></i>
                        ثبت‌نام
                    </a>
                </div>

                <div v-else>
                    <span class="dropdown__title">{{ user.name }}</span>

                    <a :href="dashboard">
                        <i class="fas fa-tachometer-alt text-indigo"></i>
                        داشبورد
                    </a>

                    <a href="#" @click="logout">
                        <i class="fas fa-sign-out-alt text-red"></i>
                        خروج از حساب کاربری

                        <form id="logout-form" action="/logout" method="POST" style="display:none;">
                        </form>
                    </a>
                </div>
            </div>
        </dropdown>
    </div>
</template>

<script>
    export default {
        created() {
            window.events.$on('userCreated', data => {
                this.user = data.user;

                return;
            });

            window.events.$on('dropdownToggled', isOpen => {
                this.rotate = isOpen;
            });

            this.user = Redpencilit.user;
        },

        data() {
            return {
                user: null,
                rotate: false,
            }
        },

        computed: {
            avatar() {
                if (this.user && this.user.avatar != null && this.user.avatar.length) {
                    return '/' + this.user.avatar;
                }

                return '/images/avatar.svg';
            },

            dashboard() {
                return '/dashboard/' + this.user.id;
            }
        },

        methods: {
            logout() {
                axios.post('/logout').then(response => {
                    window.location = "/orders/create";
                });
            }
        },
    }
</script>

<style>
    .fas.fa-chevron-down {
        transform: rotateX(0deg);
        transition: all .4s;
    }

    .fas.fa-chevron-down.rotate {
        transform: rotateX(180deg);
    }
</style>

