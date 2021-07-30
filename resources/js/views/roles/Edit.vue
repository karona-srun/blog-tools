<template>
  <div>
    <div class="card bg-light p-2">
      <div class="card-body">
        <h5 class="card-title">Edit Role</h5>
        <h6 class="card-subtitle mb-2 text-muted">Please enter your datas</h6>
        <form @submit.prevent="handleSubmit" ref="Role">
          <div class="mb-3">
            <label for="name">Name</label>
            <input
              type="text"
              class="form-control"
              v-model="role.name"
              placeholder="Please enter your role name"
            />
          </div>
          <div class="mb-3">
            <label for="name">Permissions</label>
            <div v-for="(permission, index) in permissions" :key="index">
              <input
                type="checkbox"
                class="form-check-input"
                v-model="seletctedPermission"
                :value="permission.id"
              />
              <span class="form-check-label text-capitalize">
                {{ permission.name }}
              </span>
              <br />
            </div>
          </div>
          <div class="card-text mt-4">
            <button type="submit" class="btn btn-primary me-2">Submit</button>
            <button
              type="button"
              @click.prevent="handleBack"
              class="btn btn-danger"
            >
              Cancel
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>
</template>
<script>
import { mapGetters, mapActions } from "vuex";
export default {
  name: "EditRole",
  data() {
    return {
      seletctedPermission: [],
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
      let response = this.updateRole(data);
      response.then((result) => {
        if (result.status == "Success") {
          this.$vToastify.success(result.message, result.status);
          this.$refs.Role.reset();
          this.$router.push({ path: "/role" });
        }
        if (result.status == "Failed") {
          this.$vToastify.error(result.message, result.status);
        }
      });
    },
    handleBack() {
      this.$router.push({ path: "/role" });
    },
  },
};
</script>