<template>
    <main>
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container-fluid">
                <div class="collapse navbar-collapse">
                    <AppDropdown>
                        <template slot="toggler">
                            <button>Toggle</button>
                        </template>
                        <AppDropdownContent>
                            <AppDropdownItem>Action 1</AppDropdownItem>
                            <AppDropdownItem>Action 2</AppDropdownItem>
                            <AppDropdownItem>Action 3</AppDropdownItem>
                        </AppDropdownContent>
                    </AppDropdown>
                    <router-link exact-active-class="active" to="/" class="nav-item nav-link text-black">Home</router-link>
                    <router-link exact-active-class="active" to="/markets" class="nav-item nav-link text-black">Market</router-link>
                    <router-link exact-active-class="active" to="/sectors" class="nav-item nav-link text-black">Sector</router-link>
                    <router-link exact-active-class="active" to="/rooms" class="nav-item nav-link text-black">Room</router-link>
                    <router-link exact-active-class="active" to="/login" class="nav-item nav-link text-black">Login</router-link>
                    <router-link exact-active-class="active" to="/register" class="nav-item nav-link text-black">Register</router-link>
                    <router-link exact-active-class="active" to="/logout" class="nav-item nav-link text-black">Logout</router-link>
                </div>
            </div>
        </nav>
    </main>
</template>
<script>
    import AppDropdown from './components/elements/AppDropdown.vue'
    import AppDropdownContent from './components/elements/AppDropdownContent.vue'
    import AppDropdownItem from './components/elements/AppDropdownItem.vue'
    export default {
        name: 'app',
        components: {
            AppDropdown,
            AppDropdownContent,
            AppDropdownItem,
        }
    }
</script>
