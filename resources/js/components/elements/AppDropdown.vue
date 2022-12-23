<template>
    <div>
        <slot name="toggler">
            <button>Toggle</button>
        </slot>
        <slot/>
    </div>
</template>

<script>
export default {
    name: 'AppDropdown'
}
</script>
