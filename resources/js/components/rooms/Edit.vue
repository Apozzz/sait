<template>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4>Update Room</h4>
                </div>
                <div class="card-body">
                    <form @submit.prevent="update">
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
    name: "update-room",
    data () {
        return {
            room: {
                number: "",
                space: "",
                booked_from: "",
                booked_to: "",
                sector_id: "",
                _method: "put",
            }
        }
    },
    mounted () {
        this.showRoom()
    },
    methods: {
        async showRoom() {
            await this.axios.get('/api/v1/rooms/${this.$route.params.id}').then(response => {
                const {number, space, booked_from, booked_to, sector_id} = response.data
                this.number = number
                this.space = space
                this.booked_from = booked_from
                this.booked_to = booked_to
                this.sector_id = sector_id
            }).catch(error => {
                console.log(error)
            })
        },
        async update() {
            await this.axios.post('/api/v1/rooms/${this.$route.params.id}?_method=PUT', this.room).then(response => {
                this.$router.push({name: "roomList"})
            }).catch(error => {
                console.log(error)
            })
        }
    }
}
</script>
