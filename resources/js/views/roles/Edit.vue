<template>
  <div>
    <form @submit.prevent="handleSubmit">
      <div>
        <strong>Role:</strong>
        <input type="text" v-model="role.name" />
      </div>
      <div>
        <strong>Permission:</strong>
        <div v-for="(permission, index) in permissions" :key="index">
          <input
            type="checkbox"
            v-model="seletctedPermission"
            :value="permission.id"
          />{{ permission.name }}
        </div>
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
  name: "EditRole",
  data() {
    return {
        seletctedPermission: []
    };
  },
  created() {
    this.fetchRole(this.$route.params.id);
    this.seletctedPermission = this.rolePermissions;
  },
  computed: {
    ...mapGetters(["role", "permissions", "rolePermissions"]),
  },
  methods: {
    ...mapActions(["fetchRole", "updateRole"]),
    handleSubmit() {
      let data = {
        id: this.$route.params.id,
        name: this.role.name,
        permission: this.seletctedPermission,
      };
      let response = this.updateRole(data)
      response.then((result) => {
        console.log(result)
        this.$router.push({ path: '/role'})
        this.$router.go()
      })
      
    }
  }
};
</script>