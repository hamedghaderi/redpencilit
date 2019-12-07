<template>
    <div>
        <dropdown classes="dropdown-left">
            <template v-slot:toggler>
                <button
                        class="border py-3 px-4 focus:outline-none rounded text-sm shadow"
                        v-bind:class="classObj"
                        v-if="!user"
                    >
                    {{ trans.get('__JSON__.account') }}
                </button>

                <div class="inline-flex justify-end items-center text-grey-darker cursor-pointer"
                     v-else>
                    <span class="text-grey-dark ml-2 text-sm" :class="{'text-white': home}">{{ user.name }}</span>
                    <img :src="avatar" class="w-8 h-8 rounded-full ml-1">
                    <i class="la la-angle-down" :class="{rotate: rotate, 'text-white': home}"></i>
                </div>
            </template>

            <div>
                <div v-if="!user">
                    <a :href="loginUrl"
                       class="text-grey-dark block items-center py-2 px-3 mb-1 rounded hover:bg-blue-lightest hover:text-blue-dark">
                        <span class="flex items-center">
                            <svg class="fill-current h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                 width="24"
                                 height="24"><path
                                    class="heroicon-ui"
                                    d="M5 3h14a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5c0-1.1.9-2 2-2zm0 10v6h14v-6h-2.38l-1.45 2.9a2 2 0 0 1-1.79 1.1h-2.76a2 2 0 0 1-1.8-1.1L7.39 13H5zm14-2V5H5v6h2.38a2 2 0 0 1 1.8 1.1l1.44 2.9h2.76l1.45-2.9a2 2 0 0 1 1.79-1.1H19z"/></svg>
                            <span class="mr-3">
                                {{ trans.get('__JSON__.login') }}
                            </span>
                        </span>
                    </a>

                    <a :href="registerUrl"
                       class="text-grey-dark block items-center py-2 px-3 mb-1 rounded hover:bg-green-lightest hover:text-green-dark">
                         <span class="flex items-center">
                             <svg class="fill-current h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                  width="24"
                                  height="24"><path
                                     class="heroicon-ui"
                                     d="M19 10h2a1 1 0 0 1 0 2h-2v2a1 1 0 0 1-2 0v-2h-2a1 1 0 0 1 0-2h2V8a1 1 0 0 1 2 0v2zM9 12A5 5 0 1 1 9 2a5 5 0 0 1 0 10zm0-2a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm8 11a1 1 0 0 1-2 0v-2a3 3 0 0 0-3-3H7a3 3 0 0 0-3 3v2a1 1 0 0 1-2 0v-2a5 5 0 0 1 5-5h5a5 5 0 0 1 5 5v2z"/></svg>
                            <span class="mr-3">
                                {{ trans.get('__JSON__.register') }}
                            </span>
                        </span>
                    </a>
                </div>

                <div v-else>
                    <a class="border-b border-grey-lighter block py-4 mb-4 text-indigo flex items-center"
                       :href="dashboard">
                        <i class="la la-tachometer-alt text-2xl"></i>

                        <span class="text-grey-dark mr-1">
                            {{ trans.get('__JSON__.dashboard') }}
                        </span>
                    </a>

                    <a class="block pb-4 text-red flex items-center" href="#" @click="logout">
                        <i class="la la-sign-out-alt text-2xl"></i>

                        <span class="text-grey-dark mr-2">{{ trans.get('__JSON__.logout') }}</span>

                        <form id="logout-form" :action="logoutUrl" method="POST" style="display:none;">
                        </form>
                    </a>
                </div>
            </div>
        </dropdown>
    </div>
</template>

<script>
    export default {
        props: {
            home: {
                default: false
            },
        },

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
                buttonColor: 'red',
                locale: Redpencilit.locale
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
                return `/${this.locale}/dashboard/${this.user.id}`;
            },

            classObj() {
                return {
                    "bg-red": this.home,
                    "text-white": this.home,
                    "text-red": !this.home,
                    "border-transparent": this.home,
                    "border-red": !this.home,
                    "hover:bg-white": this.home,
                    "hover:bg-red": !this.home,
                    "hover:text-red": this.home,
                    "hover:text-white": !this.home
                }
            },

            loginUrl() {
                return '/' + Redpencilit.locale + '/login';
            },

            registerUrl() {
                return '/' + Redpencilit.locale + '/register';
            },

            logoutUrl() {
                return '/' + Redpencilit.locale + '/logout';
            }
        },

        methods: {
            logout() {
                axios.post(`/${this.locale}/logout`).then(response => {
                    window.location = `/${this.locale}/orders/create`;
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

