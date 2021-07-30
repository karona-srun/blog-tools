<template>
  <div>
    <div class="card bg-light p-2">
      <div class="card-body">
        <h5 class="card-title">Create Role</h5>
        <h6 class="card-subtitle mb-2 text-muted">Please enter your datas</h6>
        <form @submit.prevent="handleSubmit" ref="Role">
          <div class="mb-3">
            <label for="name">Name</label>
            <input
              type="text"
              v-model="name"
              class="form-control"
              placeholder="Please enter your role"
            />
          </div>
          <div class="mb-3">
            <label for="name">Permissions</label>
            <div v-for="(item, index) in permissionsList" :key="index">
              <input
                type="checkbox"
                class="form-check-input"
                :value="item.name"
                v-model="selectedPermission"
              />
              <span class="form-check-label text-capitalize">
                {{ item.name }}
              </span>
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
  name: "CreateRole",
  data() {
    return {
      name: "",
      selectedPermission: [],
      itemsPerRow: 4,
    };
  },
  created() {
    this.fetchPermissions();
  },
  computed: {
    ...mapGetters(["permissionsList"]),
  },
  methods: {
    ...mapActions(["fetchPermissions", "addNewPermissions"]),
    handleSubmit() {
      let data = {
        name: this.name,
        permission: this.selectedPermission,
      };
      let response = this.addNewPermissions(data);
      response.then((result) => {
        if (result.status == "Success") {
          this.$router.push({ path: "/role" });
          this.$vToastify.success(result.message, result.status);
        }
        if (result.status == "Failed")
          this.$vToastify.error(result.message, result.status);
      });
      this.$refs.Role.reset();
    },
    handleBack() {
      this.$router.push({ path: "/role" });
    },
  },
};
</script>