<template>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4>Add Room</h4>
                </div>
                <div class="card-body">
                    <form @submit.prevent="create">
                        <div class="row">
                            <div class="col-12 mb-2">
                                <div class="form-group">
                                    <label>Number</label>
                                    <input type="text" class="form-control" v-model="room.number">
                                </div>
                            </div>
                            <div class="col-12 mb-2">
                                <div class="form-group">
                                    <label>Space</label>
                                    <input type="text" class="form-control" v-model="room.space">
                                </div>
                            </div>
                            <div class="col-12 mb-2">
                                <div class="form-group">
                                    <label>Booked From</label>
                                    <input type="text" class="form-control" v-model="room.booked_from">
                                </div>
                            </div>
                            <div class="col-12 mb-2">
                                <div class="form-group">
                                    <label>Booked To</label>
                                    <input type="text" class="form-control" v-model="room.booked_to">
                                </div>
                            </div>
                            <div class="col-12 mb-2">
                                <div class="form-group">
                                    <label>Sector ID</label>
                                    <input type="text" class="form-control" v-model="room.sector_id">
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
    name: "add-room",
    data () {
        return {
            room: {
                number: "",
                space: "",
                booked_from: "",
                booked_to: "",
                sector_id: "",
            }
        }
    },
    methods: {
        async create() {
            await this.axios.post('/api/v1/rooms', this.room).then(response => {
                this.$router.push({name: "roomList"})
            }).catch(error => {
                console.log(error)
            })
        }
    }
}
</script>
