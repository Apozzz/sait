<template>
    <form @submit.prevent="login">
        <div>
            <label for="email">Email</label>
            <input
                id="email"
                type="email"
                class="mt-1 block w-full"
                v-model="user.email"
                required
                autofocus
                autocomplete="username" />
        </div>
        <div class="mt-4">
            <label for="password">Password</label>
            <input
                id="password"
                type="password"
                class="mt-1 block w-full"
                v-model="user.password"
                required
                autocomplete="current-password" />
        </div>
        <div class="flex items-center justify-end mt-4">
            <div class="col-12 mb-2">
                <button type="submit" class="btn btn-primary">Login</button>
            </div>
        </div>
    </form>
</template>
<script>
    export default {
        name: "login-user",
        data () {
            return {
                user: {
                    email: "",
                    password: ""
                }
            }
        },
        methods: {
            async login() {
                await this.axios.post('/api/login', this.user).then(response => {
                    this.$router.push({name: "home"})
                }).catch(error => {
                    console.log(error)
                })
            }
        }
    }
</script>
