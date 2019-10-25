<template>
    <div>
        <dropdown classes="dropdown-left">
            <template v-slot:toggler>
                <button
                        class="border border-red text-red py-3 px-4 focus:outline-none hover:bg-red hover:text-white rounded text-sm"
                        v-if="!user">
                    حساب کاربری
                </button>

                <div class="inline-flex justify-end items-center text-grey-darker cursor-pointer" v-else>
                    <img :src="avatar" class="w-8 h-8 rounded-full ml-1">
                    <i class="fas fa-chevron-down text-xs" :class="{rotate: rotate}"></i>
                </div>
            </template>

            <div>
                <div v-if="!user">
                    <a href="/login"
                       class="text-grey-dark block items-center py-2 px-3 mb-1 rounded hover:bg-blue-lightest hover:text-blue-dark">
                        <span class="flex items-center">
                            <svg class="fill-current h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                 width="24"
                                 height="24"><path
                                    class="heroicon-ui"
                                    d="M5 3h14a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5c0-1.1.9-2 2-2zm0 10v6h14v-6h-2.38l-1.45 2.9a2 2 0 0 1-1.79 1.1h-2.76a2 2 0 0 1-1.8-1.1L7.39 13H5zm14-2V5H5v6h2.38a2 2 0 0 1 1.8 1.1l1.44 2.9h2.76l1.45-2.9a2 2 0 0 1 1.79-1.1H19z"/></svg>
                            <span class="mr-3">ورود به حساب </span>
                        </span>
                    </a>

                    <a href="/register"
                       class="text-grey-dark block items-center py-2 px-3 mb-1 rounded hover:bg-green-lightest hover:text-green-dark">
                         <span class="flex items-center">
                             <svg class="fill-current h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                  width="24"
                                  height="24"><path
                                     class="heroicon-ui"
                                     d="M19 10h2a1 1 0 0 1 0 2h-2v2a1 1 0 0 1-2 0v-2h-2a1 1 0 0 1 0-2h2V8a1 1 0 0 1 2 0v2zM9 12A5 5 0 1 1 9 2a5 5 0 0 1 0 10zm0-2a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm8 11a1 1 0 0 1-2 0v-2a3 3 0 0 0-3-3H7a3 3 0 0 0-3 3v2a1 1 0 0 1-2 0v-2a5 5 0 0 1 5-5h5a5 5 0 0 1 5 5v2z"/></svg>
                            <span class="mr-3">ثبت‌نام</span>
                        </span>
                    </a>
                </div>

                <div v-else>
                    <div class="text-grey pb-4">{{ user.name }}</div>

                    <a class="border-b border-grey-lighter block py-4 mb-4 text-grey-dark" :href="dashboard">
                        <i class="fas fa-tachometer-alt text-indigo"></i>
                        داشبورد
                    </a>

                    <a class="block pb-4 text-grey-dark" href="#" @click="logout">
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

