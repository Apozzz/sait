<template>
    <div class="row">
        <div class="col-12 mb-2 text-end">
            <router-link :to='{name:"roomAdd"}' class="btn btn-primary">Create</router-link>
        </div>
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4>Rooms</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Room Number</th>
                                <th>Room Space</th>
                                <th>Room Booked From</th>
                                <th>Room Booked To</th>
                                <th>Room Sector ID</th>
                            </tr>
                            </thead>
                            <tbody v-if="rooms.length > 0">
                            <tr v-for="{room, key} in rooms" :key="key">
                                <td>{{room.id}}</td>
                                <td>{{room.number}}</td>
                                <td>{{room.space}}</td>
                                <td>{{room.booked_from}}</td>
                                <td>{{room.booked_to}}</td>
                                <td>{{room.sector_id}}</td>
                                <td>
                                    <router-link :to='{name: "roomEdit", params: {id: room.id}}' class="btn btn-success">Edit</router-link>
                                    <button type="button" @click="deleteRoom(room.id)" class="btn btn-danger">Delete</button>
                                </td>
                            </tr>
                            </tbody>
                            <tbody v-else>
                            <tr>
                                <td colspan="4" align="center">No Rooms Were Found</td>
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
    name: "rooms",
    data () {
        return {
            rooms: []
        }
    },
    mounted () {
        this.getRooms()
    },
    methods: {
        async getRooms() {
            await this.axios.get('/api/v1/rooms').then(response => {
                this.rooms = response.data
            }).catch(error => {
                console.log(error)
                this.rooms = []
            })
        },
        deleteRoom (id) {
            if (confirm("Are you sure you want to delete this Room ?")) {
                this.axios.delete('/api/v1/rooms/${id}').then(response => {
                    this.getRooms()
                }).catch(error => {
                    console.log(error)
                })
            }
        }
    }
}
</script>
