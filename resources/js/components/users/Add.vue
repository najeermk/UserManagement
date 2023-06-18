<template>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4>Add User</h4>
                </div>
                <div class="card-body">
                    <form @submit.prevent="create">
                        <div class="row">
                            <div class="col-12 mb-2">
                                <div class="form-group">
                                    <label>Name</label>
                                    <input type="text" class="form-control" v-model="user.name">
                                </div>
                            </div>
                            <div class="col-12 mb-2">
                                <div class="form-group">
                                    <label>Password</label>
                                    <input type="text" class="form-control" v-model="user.password">
                                </div>
                            </div>
                            <div class="col-12 mb-2">
                                <div class="form-group">
                                    <label>Password</label>
                                    <input type="date" class="form-control" v-model="user.password">
                                </div>
                            </div>
                            <div class="col-12 mb-2">
                                <div class="form-group">
                                    <label>Role</label>
                                    <input type="text" class="form-control" v-model="user.Role">
                                </div>
                            </div>
                            <div class="col-12">
                                <button type="submit" class="btn btn-primary">Add</button>
                            </div>
                        </div>                        
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import axios from 'axios'

export default {
    name:"add-user",
    data(){
        return {
            user:{
                name:"",
                email:"",
                password:"",
                role:""
            }
        }
    },
    methods:{
        async create(){
            await axios.post('/api/users/store',this.user).then(response=>{
                console.log(response)
                this.sendNotification(response.data.id)
                this.$router.push({name:"List"})
            }).catch(error=>{
                console.log(error)
            })
        },

        sendNotification(id) {
            const payload = {
            recipient_id: id, 
            content: 'Your account is being created'
            };

            axios.post('/api/notifications', payload)
            .then(response => {
                console.log(response.data.message);
            })
            .catch(error => {
                console.error(error);
            });
        }
    }
}
</script>