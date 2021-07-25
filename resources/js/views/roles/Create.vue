<template>
    <div>
        <h1>Create a new</h1>
        <form @submit.prevent="handleSubmit">
            <div>
                <label for="name">Name</label>
                <input type="text" v-model="name">
            </div>
            <div>
                <label for="permission">Permission</label>
                <br>
                <span v-for="item in permissionsList" :key="item.id">
                    <input type="checkbox" :value="item.name" v-model="selectedPermission"> <span class="checkbox-label"> {{item.name}} </span> <br>
                </span>
                <hr>
            </div>
            <div>
                <button type="submit">Submit</button>
            </div>
        </form>
    </div>
</template>
<script>
import { mapGetters, mapActions } from "vuex";
export default {
    name: "CreateRole",
    data(){
        return {
            name: '',
            selectedPermission: []
        }
    },
    created() {
        this.fetchPermissions()
    },
    computed: {
        ...mapGetters(["permissionsList"])
    },
    methods:{
        ...mapActions(["fetchPermissions","addNewPermissions"]),
        handleSubmit(){
            let data = {
                name: this.name,
                permission: this.selectedPermission
            }
            console.log(data)
            let response = this.addNewPermissions(data)
            response.then((result) => {
                console.log(result) // "Some User token"
                this.$router.push({ path: '/role'})
                this.$router.go()
            })
        }
    }
}
</script>