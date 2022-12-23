<template>
    <form @submit.prevent="register">
        <div>
            <label for="name">Name</label>
            <input
                id="name"
                type="text"
                class="mt-1 block w-full"
                v-model="user.name"
                required
                autofocus
                autocomplete="name" />
        </div>
        <div class="mt-4">
            <label for="email">Email</label>
            <input
                id="email"
                type="email"
                class="mt-1 block w-full"
                v-model="user.email"
                required
                autocomplete="email" />
        </div>
        <div class="mt-4">
            <label for="password">Password</label>
            <input
                id="password"
                type="password"
                class="mt-1 block w-full"
                v-model="user.password"
                required
                autocomplete="password" />
        </div>
        <div class="flex items-center justify-end mt-4">
            <div class="col-12 mb-2">
                <button type="submit" class="btn btn-primary">Register</button>
            </div>
        </div>
    </form>
</template>
<script>
export default {
    name: "register-user",
    data () {
        return {
            user: {
                name: "",
                email: "",
                password: "",
            }
        }
    },
    methods: {
        async register() {
            await this.axios.post('/api/register', this.user).then(response => {
                this.$router.push({name: "home"})
            }).catch(error => {
                console.log(error)
            })
        }
    }
}
</script>
