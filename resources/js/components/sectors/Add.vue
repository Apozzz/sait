<template>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4>Add Sector</h4>
                </div>
                <div class="card-body">
                    <form @submit.prevent="create">
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
                                <button type="submit" class="btn btn-primary">Save</button>
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
    name: "add-sector",
    data () {
        return {
            sector: {
                code: "",
                market_id: ""
            }
        }
    },
    methods: {
        async create() {
            await this.axios.post('/api/v1/sectors', this.sector).then(response => {
                this.$router.push({name: "sectorList"})
            }).catch(error => {
                console.log(error)
            })
        }
    }
}
</script>
