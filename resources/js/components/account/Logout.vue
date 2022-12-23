<template>
    <form @submit.prevent="logout">
        <div class="flex items-center justify-end mt-4">
            <div class="col-12 mb-2">
                <button type="submit" class="btn btn-primary">Logout</button>
            </div>
        </div>
    </form>
</template>
<script>
export default {
    name: "logout-user",
    methods: {
        async logout() {
            await this.axios.post('/api/logout').then(response => {
                this.$router.push({name: "home"})
            }).catch(error => {
                console.log(error)
            })
        }
    }
}
</script>
