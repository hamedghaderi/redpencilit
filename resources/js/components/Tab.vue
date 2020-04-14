<template>
   <div role="tabpanel" v-show="show">
       <slot></slot>
   </div>
</template>

<script>
    export default {
        props: ['title'],
        name: "Tab",
        data() {
           return {
               show: false
           }
        },
    }
</script>

<style scoped>

</style>
