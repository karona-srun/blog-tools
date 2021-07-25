<template>
  <div>
    <br />
    <router-link :to="{ path: '/role/create' }" class="btn btn-primary"><i class="bi bi-plus"></i> Create Role</router-link>
    <br /><br />
    <p>Role table</p>
    <table class="table">
      <thead>
      <tr>
        <th>No</th>
        <th>Role</th>
        <th>Created At / Updated At</th>
        <th>Actions</th>
      </tr>
      </thead>
      <tbody>
        <tr v-for="(role,i) in rolesList" :key="i">
          <td>{{ i+1 }}</td>
          <td>{{ role.name }}</td>
          <td><span>{{ role.created_date }}</span><br>
            <span>{{ role.updated_date }}</span></td>
          <td>
            <button class="btn btn-primary" @click.prevent="editRole(role.id)"><i class="bi bi-pencil"></i></button>
            <button class="btn btn-danger" @click.prevent="deleteRole(role.id)"><i class="bi bi-trash"></i></button>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</template>
<script>
import { mapGetters, mapActions } from "vuex";
export default {
  name: "Role",
  methods: {
    ...mapActions(["fetchRoles","deleteRole"]),

    editRole(id){
      this.$router.push({ path: '/role/'+id });
      this.$router.go()
    },
  },
  created() {
    this.fetchRoles()
  },
  computed: {
    ...mapGetters(["rolesList"]),
    // canListUsers() {
    //   return this.permissions.includes("user-list");
    // },
    // canCreateUsers() {
    //   return this.permissions.includes("user-create");
    // },
    // canEditUsers() {
    //   return this.permissions.includes("user-edit");
    // },
    // canDeleteUsers() {
    //   return this.permissions.includes("user-delete");
    // },
  },
};
</script>