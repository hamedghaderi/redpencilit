<template>
    <div>
        <dropdown :classes="[locale === 'fa' ? 'dropdown-left' : 'dropdown-right']">
            <template v-slot:toggler>
                <button
                        class="border py-3 px-4 focus:outline-none rounded text-sm shadow hover:bg-red hover:text-white"
                        v-bind:class="classObj"
                        v-if="!user"
                    >
                    {{ trans.get('__JSON__.account') }}
                </button>

                <div class="inline-flex justify-end items-center text-grey-darker cursor-pointer"
                     v-else>
                    <span class="text-grey-darkest ml-2 text-sm">{{ user.name
                        }}</span>
                    <img :src="avatar" class="w-8 h-8 rounded-full ml-1">
                    <i class="la la-angle-down" :class="{rotate: rotate, 'text-grey-darkest': home}"></i>
                </div>
            </template>

            <div>
                <div v-if="!user">
                    <a :href="loginUrl"
                       class="text-grey-dark block items-center py-2 px-3 mb-1 rounded hover:bg-blue-lightest hover:text-blue-dark">
                        <span class="flex items-center">
                            <i class="las la-sign-in-alt text-2xl"></i>
                            <span :class="[locale === 'fa' ? 'mr-3' : 'ml-3']">
                                {{ trans.get('__JSON__.login') }}
                            </span>
                        </span>
                    </a>

                    <a :href="registerUrl"
                       class="text-grey-dark block items-center py-2 px-3 mb-1 rounded hover:bg-green-lightest hover:text-green-dark">
                         <span class="flex items-center">
                             <i class="las la-user-plus text-2xl"></i>

                            <span :class="[locale === 'fa' ? 'mr-3' : 'ml-3']">
                                {{ trans.get('__JSON__.register') }}
                            </span>
                        </span>
                    </a>
                </div>

                <div v-else>
                    <a class="border-b border-grey-lighter block py-4 mb-4 text-indigo flex items-center"
                       :href="dashboard">
                        <i class="la la-tachometer-alt text-2xl"></i>

                        <span class="text-grey-dark" :class="[locale === 'fa' ? 'mr-1' : 'ml-1']">
                            {{ trans.get('__JSON__.dashboard') }}
                        </span>
                    </a>

                    <a class="block pb-4 text-red flex items-center" href="#" @click="logout">
                        <i class="la la-sign-out-alt text-2xl"></i>

                        <span class="text-grey-dark" :class="[locale === 'fa' ? 'mr-2' : 'ml-2']">
                            {{ trans.get('__JSON__.logout') }}
                        </span>

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
            window.events.listen('userCreated', data => {
                this.user = data.user;

                return;
            });

            window.events.listen('dropdownToggled', isOpen => {
                this.rotate = isOpen;
            });

            this.user = Redpencilit.user;
        },

        data() {
            return {
                user: null,
                rotate: false,
                buttonColor: 'white',
                locale: Redpencilit.locale
            }
        },

        computed: {
            avatar() {
                if (this.user && this.user.avatar != null && this.user.avatar.length) {
                    return '/storage/' + this.user.avatar;
                }

                return '/images/avatar.svg';
            },

            dashboard() {
                return `/${this.locale}/dashboard/${this.user.id}`;
            },

            classObj() {
                return {
                    "bg-white": this.home,
                    "text-red": this.home || !this.home,
                    "border-transparent": this.home,
                    "border-red": !this.home,
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

