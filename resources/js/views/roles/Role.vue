<template>
  <div>
    <h1>Role page</h1>
    <p>Operation the role page.</p>
    <router-link :to="{ path: '/role/create' }" v-if="canCreateRoles" class="btn btn-primary"
      ><i class="bi bi-plus"></i> Create Role</router-link
    >
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
        <tr v-for="(role, i) in rolesList" :key="i">
          <td>{{ i + 1 }}</td>
          <td>{{ role.name }}</td>
          <td>
            <span>{{ role.created_date }}</span
            ><br />
            <span>{{ role.updated_date }}</span>
          </td>
          <td>
            <button class="btn btn-primary" v-if="canEditRoles" @click.prevent="editRole(role.id)">
              <i class="bi bi-pencil"></i>
            </button>
            <button class="btn btn-danger" v-if="canDeleteRoles" @click.prevent="removeRole(role.id)">
              <i class="bi bi-trash"></i>
            </button>
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
  data() {
    return {
      permissions: localStorage.getItem("userPermissions")
        ? localStorage.getItem("userPermissions")
        : "",
    }
  },
  methods: {
    ...mapActions(["fetchRoles", "deleteRole"]),

    editRole(id) {
      this.$router.push({ path: "/role/" + id });
      this.$router.go();
    },
    removeRole(id) {
      this.$vToastify.prompt({
          body: "Are you sure you want to delete this role?",
          answers: { Yes: true, No: false }
      }).then(value => {
          if (value) {
              this.deleteRole(id);
              this.$vToastify.success("Role deleted successfully.")
          }
      })
    }
  },
  created() {
    this.fetchRoles();
  },
  computed: {
    ...mapGetters(["rolesList"]),
    canListRoles() {
      return this.permissions.includes("role-list");
    },
    canCreateRoles() {
      return this.permissions.includes("role-create");
    },
    canEditRoles() {
      return this.permissions.includes("role-edit");
    },
    canDeleteRoles() {
      return this.permissions.includes("role-delete");
    },
  },
};
</script>