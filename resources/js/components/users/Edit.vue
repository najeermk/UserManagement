<template>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4>Update User</h4>
                </div>
                <div class="card-body">
                    <form @submit.prevent="update">
                        <div class="row">
                            <div class="col-12 mb-2">
                                <div class="form-group">
                                    <label>Name</label>
                                    <input type="text" class="form-control" v-model="user.name">
                                </div>
                            </div>
                            <div class="col-12 mb-2">
                                <div class="form-group">
                                    <label>Email</label>
                                    <input type="text" class="form-control" v-model="user.email">
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
                                    <label>Role</label>
                                    <input type="text" class="form-control" v-model="user.role">
                                </div>
                            </div>
                            <div class="col-12">
                                <button type="submit" class="btn btn-primary">Update</button>
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
    name:"update-user",
    data(){
        return {
            user:{
                title:"",
                quantity:"",
                price:"",
                description:"",
                _method:"patch"
            }
        }
    },
    mounted(){
        this.showuser()
    },
    methods:{
        async showuser(){
            await this.axios.get(`/api/users/${this.$route.params.id}`).then(response=>{
                const { title, quantity, price, description } = response.data
                this.user.title = title
                this.user.quantity = quantity
                this.user.price = price
                this.user.description = description
                this.sendNotification(response.data.id)
            }).catch(error=>{
                console.log(error)
            })
        },
        async update(){
            await this.axios.put(`/api/users/${this.$route.params.id}`,this.user).then(response=>{
                this.$router.push({title:"List"})
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