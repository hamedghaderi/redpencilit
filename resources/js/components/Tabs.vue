<template>
    <div class="bg-white rounded border">
        <ul class="list-reset flex border-b px-4">
            <li v-for="(tab, index) in tabs">
                <button
                        v-text="tab.title"
                        role="tab"
                        @click="activeTab = tab"
                        class="text-grey-dark px-4 py-2 border-b border-transparent py-4 text-sm"
                        :class="{'border-red': tab === activeTab}"
                        type="button"
                >
                </button>
            </li>
        </ul>

        <div class="px-4 py-8">
            <slot></slot>
        </div>
    </div>
</template>

<script>
    import Tab from './Tab';

    export default {
        components: {Tab},

        data() {
            return {
                tabs: [],
                activeTab: null
            }
        },

        mounted() {
            this.tabs = this.$children;

            this.activeTab = this.tabs[0];
        },

        watch: {
            activeTab(activeTab) {
                this.tabs.map(tab => (tab.show =  tab === activeTab));
            }
        }
    }
</script>

<style>

</style>
