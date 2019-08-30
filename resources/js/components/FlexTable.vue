<template>
    <div>
        <div name="header" class="flex text-grey">
            <slot name="header"></slot>
        </div>

        <div class="flex bg-white shadow p-6">
            <slot></slot>
        </div>
    </div>

</template>

