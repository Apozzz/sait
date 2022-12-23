<template>
    <button @click="toggle">Toggle</button>
    <div v-if="active">
        Menu
    </div>
</template>

<script>
export default {
    data () {
        return {
            active: false
        }
    },
    methods: {
        toggle () {
            this.active = !this.active
        }
    }
}
</script>
