<template>
    <div>
        <div class="flex mb-6">
            <h3 class="text-lg text-grey-darker">سوالات متداول</h3>

            <a href="/faq" class="font-bold text-indigo mr-auto">مشاهده همه</a>
        </div>
        <dl class="border border-grey-light text-grey-darker rounded">
            <dt class="border-b border-grey-lighter px-4 py-4 cursor-pointer hover:text-red" @click="show('doctype')">
           <span
                   class="w-6 h-6 ml-4 text-sm border border-grey-light rounded-full inline-flex items-center justify-center">1
           </span>
                چه نوع اسنادی قابل آپلود می‌باشد؟
            </dt>
            <dd v-if="items.doctype" class="p-4 bg-grey-lighter text-sm leading-loose">
                Redpencilit هر نوع اسنادی از قبیل رزومه، مقاله، کتاب غیره را ویرایش می‌کند.
            </dd>

            <dt class="border-b border-grey-lighter px-4 py-4 cursor-pointer hover:text-red" @click="show('review')">
               <span
                       class="w-6 h-6 ml-4 text-sm border border-grey-light rounded-full inline-flex items-center justify-center">2
               </span>
                چه مدت طول می‌کشد تا سندی بررسی شود؟
            </dt>
            <dd v-if="items.review" class="p-4 bg-grey-lighter text-sm leading-loose">
                اگر به صفحه <a class="text-indigo" href="/orders/create">ثبت سفارش</a> بروید ملاحظه خواهید کرد که سیستم
                به صورت
                خودکار
                زمان نهایی شدن فایل‌ها را به شما نشان می‌دهد. البته لازم به ذکر است که این زمان تخمینی بوده و برای
                زمان دقیق باید سفارش را نهایی کنید.
            </dd>

            <dt class="border-b border-grey-lighter px-4 py-4 cursor-pointer hover:text-red" @click="show('hourly')">
               <span
                       class="w-6 h-6 ml-4 text-sm border border-grey-light rounded-full inline-flex items-center justify-center">3
               </span>
                آیا روز‌های تعطیل هم Redpencilit جوابگو می‌باشد؟
            </dt>
            <dd v-if="items.hourly" class="p-4 bg-grey-lighter text-sm leading-loose">
                بله. کل روز‌های هفته به از ساعت ۸ صبح الی ۸ شب Redpenciliit پاسخگوی سوالات شما می‌باشد.
            </dd>

            <dt class="border-b border-grey-lighter px-4 py-4 cursor-pointer hover:text-red" @click="show('payment')">
               <span
                       class="w-6 h-6 ml-4 text-sm border border-grey-light rounded-full inline-flex items-center justify-center">4
               </span>
                از چه روش‌هایی برای پرداخت ‌می‌توان استفاده کرد؟
            </dt>
            <dd v-if="items.payment" class="p-4 bg-grey-lighter text-sm leading-loose">
                در حال حاضر فقط می‌توانید از درگاه زرین پال استفاده کنید، اما در آینده نزدیک درگاه‌های دیگری نیز به
                وبسایت افزوده خواهد شد.
            </dd>
        </dl>
    </div>
</template>

<script>
    export default {
        name: "Faq",

        data() {
            return {
                items: {
                    doctype: false,
                    review: false,
                    hourly: false,
                    payment: false
                },

            }
        },

        methods: {
            show(type) {

                for(let key of Object.keys(this.items)) {
                    if (key === type) { continue; }

                    this.items[key] = false;
                }

                this.items[type] = ! this.items[type];
            }
        }
    }
</script>

<style scoped>

</style>