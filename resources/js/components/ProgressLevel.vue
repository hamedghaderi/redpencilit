<template>
    <div class="w-full lg:w-3/4 mx-auto md:flex items-center">
        <h3 class="mb-8 w-48 md:mb-0">آپلود مستندات</h3>

        <div class="flex justify-between w-full relative z-20 mb-16">
            <div class="w-48 md:w-24">
                <div v-if="step==1"
                     class="bg-white w-full text-center py-3 flex flex-col items-center rounded border border-gray z-30 mb-5 shadow step-1 relative">
                    <div class="text-grey text-xs mb-1">مرحله ۱</div>
                    <div class="text-sm">ثبت‌نام</div>
                </div>
            </div>


            <div class="w-48 md:w-24">
                <div v-if="step==2"
                     class="bg-white w-full text-center py-3 flex flex-col items-center rounded border border-gray z-30 mb-5 shadow step-2 relative">
                    <div class="text-grey text-xs mb-1">مرحله ۲</div>
                    <div class="text-sm">آپلود مستندات</div>
                </div>
            </div>


            <div class="w-48 md:w-24">
                <div v-if="step==3"
                     class="bg-white w-24 text-center py-3 flex flex-col items-center rounded border border-gray z-30 mb-5 shadow step-3 relative">
                    <div class="text-grey text-xs mb-1">مرحله ۳</div>
                    <div class="text-sm">ثبت نهایی</div>
                </div>
            </div>

            <ul class="flex list-reset justify-between absolute pin-b w-full z-10 level-circle-list">
                <li
                        class="w-5 h-5 bg-grey-lightest bg-white shadow rounded-full flex items-center justify-center"
                        :class="{'border-transparent': step > 1}">
                        <span class="w-2 h-2 bg-red inline-block rounded-full"
                              :class="{'w-full h-full': step > 1}"></span>
                </li>

                <li
                        class="w-5 h-5 bg-grey-lightest border border-lighter rounded-full flex items-center justify-center"
                        :class="{'bg-white shadow border-transparent': step >= 2}">
                        <span v-if="step>=2" class="w-2 h-2 bg-red inline-block rounded-full"
                              :class="{'w-full h-full': step > 2}"></span>
                </li>

                <li
                        class="w-5 h-5 bg-grey-lightest border border-lighter rounded-full flex items-center justify-center"
                        :class="{'bg-white shadow border-transparent': step == 3 }">
                    <span v-if="step==3" class="w-2 h-2 bg-red inline-block rounded-full"></span>
                </li>
            </ul>

            <div class="bg-grey-light border-none w-full absolute level-line pin-b z-0">
                <div class="bg-red border-none absolute pin-b z-0 level-progress" :class="levelProgress"></div>
            </div>
        </div>
    </div><!-- upload-levels -->
</template>

<script>
    export default {
        name: "ProgressLevel",

        props: ['step'],

        computed: {
            levelProgress() {
                return this.step === 1 ? 'w-0' :
                    this.step === 2 ? 'w-1/2' :
                        'w-full';
            }
        }
    }
</script>

<style scoped>
    .level-line {
        height: 1px;
    }

    .level-circle-list {
        bottom: -.5rem;
    }

    .level-progress {
        height: 1px;
    }

    .step-1::before,
    .step-2::before,
    .step-3::before {
        content: '';
        position: absolute;
        top: 100%;
        width: 13px;
        height: 8px;
        clip-path: polygon(0% 0%, 100% 0%, 50% 100%);
        background-color: #dae1e7;
    }

    .step-1::after,
    .step-2::after,
    .step-3::after {
        content: '';
        position: absolute;
        top: 100%;
        width: 10px;
        height: 5px;
        clip-path: polygon(0% 0%, 100% 0%, 50% 100%);
        background-color: white;
    }

    .step-1::after,
    .step-1::before {
        right: 10%;
    }

    .step-2::after,
    .step-2::before {
        left: 50%;
        transform: translate(-50%, 0);
    }

    .step-3::after,
    .step-3::before {
        left: 10%;
    }
</style>