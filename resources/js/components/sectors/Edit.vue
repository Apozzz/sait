<template>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4>Update Sector</h4>
                </div>
                <div class="card-body">
                    <form @submit.prevent="update">
                        <div class="row">
                            <div class="col-12 mb-2">
                                <div class="form-group">
                                    <label>Code</label>
                                    <input type="text" class="form-control" v-model="sector.code">
                                </div>
                            </div>
                            <div class="col-12 mb-2">
                                <div class="form-group">
                                    <label>Sector Market ID</label>
                                    <input type="text" class="form-control" v-model="sector.market_id">
                                </div>
                            </div>
                            <div class="col-12 mb-2">
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary">Update</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    name: "update-sector",
    data () {
        return {
            sector: {
                code: "",
                market_id: "",
                _method: "put"
            }
        }
    },
    mounted () {
        this.showSector()
    },
    methods: {
        async showSector() {
            await this.axios.get('/api/v1/sectors/${this.$route.params.id}').then(response => {
                const {code, market_id} = response.data
                this.code = code
                this.market_id = market_id
            }).catch(error => {
                console.log(error)
            })
        },
        async update() {
            await this.axios.post('/api/v1/sectors/${this.$route.params.id}?_method=PUT', this.sector).then(response => {
                this.$router.push({name: "sectorList"})
            }).catch(error => {
                console.log(error)
            })
        }
    }
}
</script>
