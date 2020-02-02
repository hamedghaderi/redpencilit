<template>
    <div class="w-full px-8 md:px-24 contact md:h-screen md:min-h-screen relative">
        <div class="flex flex-wrap items-center">
            <div class="w-full md:w-2/3 lg:w-1/2">
                <h3 class="title text-center">{{ trans.get('__JSON__.contact us')}}</h3>

                <p class="text-grey-dark text-sm leading-loose mb-3">
                    {{ trans.get(`__JSON__.Returns a string with the first character of str capitalized, if that character is alphabetic. Note that 'alphabetic' is determined by the current locale.`) }}
                </p>

                <div class="mb-4">
                    <input name="name" type="text" v-model="name" :placeholder="trans.get('__JSON__.full name')"
                           class="text-sm bg-white rounded w-full px-4 py-3 border focus:outline-none focus:border-indigo">

                    <div class="feedback feedback--invalid" v-if="errors.has('name')">
                        {{ errors.get('name') }}
                    </div>
                </div>

                <div class="mb-4">
                    <input name="email" v-model="email" type="email" :placeholder="trans.get('__JSON__.email')"
                           class="text-sm bg-white rounded w-full px-4 py-3 border focus:outline-none focus:border-indigo">

                    <div class="feedback feedback--invalid" v-if="errors.has('email')">
                        {{ errors.get('email') }}
                    </div>
                </div>

                <div class="mb-4">
                        <textarea name="message" v-model="message" id="message"
                                  class="text-sm h-32 bg-white rounded w-full px-4 py-3 border focus:outline-none
                                  focus:border-indigo"
                                  :placeholder="trans.get('__JSON__.message')"> </textarea>

                    <div class="feedback feedback--invalid" v-if="errors.has('message')">
                        {{ errors.get('message') }}
                    </div>
                </div>

                <div class="mb-4 flex">
                    <ul class="list-reset flex">
                        <li class="text-grey mr-1 text-sm hover:cursor-pointer" v-for="item in
                        items"
                            v-bind:item="item"
                            @mouseover="hovered(item)"
                            @mouseleave="leaved(item)"
                            @click="clicked(item)"
                            :class="{'text-yellow-dark': item['hover'] === true || item['value'] === true}"
                        >
                            <i class="la la-star text-lg"></i>
                        </li>
                    </ul>

                    <span class="text-grey-dark text-sm mr-2">
                          {{ trans.get('__JSON__.your score')}} {{this.rate}}
                        <em v-if="rate">{{ trans.get('__JSON__.from')}} 5</em></span>
                        <input type="hidden" name="rate" v-model="rate">
                </div>

                <div class="form-group">
                    <button type="submit" class="button button--primary" :disabled="disabled" @click="submitComment">
                        {{ trans.get('__JSON__.send message') }}
                    </button>
                </div>
            </div>

            <div class="w-full md:w-1/3 lg:w-1/2">
                <img class="w-full" src="/images/8.svg" alt="a support girl" style="transform: rotateY(-180deg);">
            </div>
        </div>
    </div>
</template>

<script>
    import Errors from "../Errors";

    export default {
        name: "Contact",

        data() {
            return {
                name: '',
                email: '',
                message: '',
                rate: '',
                disabled: false,
                errors: new Errors(),
                locale: Redpencilit.locale,
                items: [
                    {key: 1, value: false, hover: false},
                    {key: 2, value: false, hover: false},
                    {key: 3, value: false, hover: false},
                    {key: 4, value: false, hover: false},
                    {key: 5, value: false, hover:false}
                ]
            }
        },

        methods: {
            submitComment() {
                let data =  {
                    name: this.name,
                    email: this.email,
                    message: this.message,
                };

                if (parseInt(this.rate))  {
                    data.rate = this.rate;
                }

                let url = `/${this.locale}/comments`;

                this.disabled = true;

                axios.post(url, data).then(res => {
                    this.disabled = false;
                    flash(res.data);
                    this.clear();
                }).catch(error => {
                    this.disabled = false;
                    this.errors.record(error.response.data.errors);
                });
            },

            clicked(item) {
                for (let star in this.items) {
                    this.items[star]['value'] = false;

                    if (this.items[star]['key'] <= item['key']) {
                        this.items[star]['value'] = true;
                    }
                }

                this.rate = item['key'];
            },

            hovered(item) {
                for (let star in this.items) {
                    if (this.items[star]['key'] <= item['key']) {
                        this.items[star]['hover'] = true;
                    }
                }
            },

            leaved(item) {
                for (let star in this.items) {
                    this.items[star]['hover']  = false;
                }
            },

            clear() {
                this.name = '';
                this.email = '';
                this.message = '';
                this.rate = '';

               for(let item in this.items)  {
                   this.items[item]['value'] = false;
               }
            }
        }
    }
</script>

<style scoped>

</style>
