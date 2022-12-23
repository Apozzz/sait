<template>
    <div class="row">
        <div class="col-12 mb-2 text-end">
            <router-link :to='{name:"sectorAdd"}' class="btn btn-primary">Create</router-link>
        </div>
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4>Sectors</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Sector Code</th>
                                <th>Sector Market ID</th>
                            </tr>
                            </thead>
                            <tbody v-if="sectors.length > 0">
                            <tr v-for="{sector, key} in sectors" :key="key">
                                <td>{{sector.id}}</td>
                                <td>{{sector.code}}</td>
                                <td>{{sector.market_id}}</td>
                                <td>
                                    <router-link :to='{name: "sectorEdit", params: {id: sector.id}}' class="btn btn-success">Edit</router-link>
                                    <button type="button" @click="deleteSector(sector.id)" class="btn btn-danger">Delete</button>
                                </td>
                            </tr>
                            </tbody>
                            <tbody v-else>
                            <tr>
                                <td colspan="4" align="center">No Sectors Were Found</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    name: "sectors",
    data () {
        return {
            sectors: []
        }
    },
    mounted () {
        this.getSectors()
    },
    methods: {
        async getSectors() {
            await this.axios.get('/api/v1/sectors').then(response => {
                this.sectors = response.data
            }).catch(error => {
                console.log(error)
                this.sectors = []
            })
        },
        deleteSector (id) {
            if (confirm("Are you sure you want to delete this Sector ?")) {
                this.axios.delete('/api/v1/sectors/${id}').then(response => {
                    this.getSectors()
                }).catch(error => {
                    console.log(error)
                })
            }
        }
    }
}
</script>
