<template>
<div>
    <div class="flex items-center border-b border-grey-lighter pb-3 mb-3">
        <h3>اطلاعات حساب</h3>

        <button
                type="button"
                class="mr-auto button button--smooth--primary button--sm"
                @click="onEdit"
                v-show="!showEdit">
            ویرایش اطلاعات
        </button>

        <button type="button"
                class="mr-auto button button--smooth--danger button--sm"
                @click="onCancelEdit"
                v-show="showEdit">
            منصرف شدم!
        </button>
    </div>

    <div class="flex mb-12">
        <div class="w-1/3" :class="{ 'form-group': showEdit, 'pl-6': showEdit }">
            <label for="name" class="text-grey block mb-4">نام</label>
            <input
                    class="w-full"
                    type="text"
                   :value="name"
                   name="name"
                   :readonly="!showEdit"
                   :class="{ 'dashboard-input': showEdit }">
        </div>

        <div class="w-1/3" :class="{ 'form-group': showEdit, 'pl-6': showEdit }">
            <label for="email" class="text-grey block mb-4">آدرس ایمیل</label>
            <input
                    class="w-full"
                    type="email"
                    name="email"
                    :value="email"
                    :readonly="!showEdit"
                    :class="{ 'dashboard-input': showEdit }">
        </div>

        <div class="w-1/3" :class="{ 'form-group': showEdit, 'pl-6': showEdit }">
            <label for="mobile" class="text-grey block mb-4">شماره تماس (موبایل)</label>
            <input
                    class="w-full"
                    type="text"
                    name="phone"
                    :value="phone"
                    :readonly="!showEdit"
                    :class="{ 'dashboard-input': showEdit }">
        </div>
    </div>
    <div class="flex">
        <div class="w-1/3" :class="{ 'form-group': showEdit, 'pl-6': showEdit }">
            <label for="username" class="text-grey block mb-4">نام کاربری</label>
            <p class="text-sm text-grey-darkest">{{ this.username}} </p>
        </div>

        <div class="w-2/3 text-left flex items-center justify-end">
            <button type="submit" class="button button--primary button--sm" v-show="showEdit">ذخیره تفییرات</button>
        </div>
    </div>
</div>
</template>

<script>
    export default {
        props: ['name', 'email', 'phone', 'username'],

        data() {
            return {
                showEdit: false,
                formGroup: {
                    'form-group': this.showEdit
                }
            }
        },

        methods: {
            onEdit() {
                this.showEdit = true;
            },

            onCancelEdit() {
                this.showEdit = false;
            }
        }
    }
</script>