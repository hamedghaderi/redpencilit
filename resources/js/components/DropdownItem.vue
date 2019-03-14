<template>
    <li>
        <a :href="href">
            <slot></slot>
        </a>
    </li>
</template>

<script>
    export default {
        props: ['href']
    }
</script>