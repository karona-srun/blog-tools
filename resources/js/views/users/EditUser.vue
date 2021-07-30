<template>
  <div>
    <div class="card bg-light p-2">
      <div class="card-body">
        <h5 class="card-title">Edit Users</h5>
        <h6 class="card-subtitle mb-2 text-muted">Please enter your datas</h6>
        <form @submit.prevent="handleUpdateUser" ref="User">
          <div class="mb-3">
            <label class="form-label">Name</label>
            <input
              type="text"
              class="form-control"
              placeholder="Please enter your name"
              v-model="user.name"
            />
          </div>
          <div class="mb-3">
            <label class="form-label">Email Address</label>
            <input
              type="email"
              class="form-control"
              placeholder="Please enter your email address"
              v-model="user.email"
            />
          </div>
          <div class="mb-3">
            <label class="form-label">Role</label>
            <multiselect
              v-model="optionRoles"
              :options="roles"
              :multiple="true"
              :searchable="false"
              :allow-empty="false"
              placeholder="Select one role you want to"
            ></multiselect>
          </div>
          <div class="mb-3">
            <label class="form-label">Password</label>
            <input type="password" class="form-control" v-model="user.password" />
          </div>
          <div class="mb-3">
            <label class="form-label">Re-type Password</label>
            <input type="password" class="form-control" v-model="user.password_confirmation" />
          </div>
          <div class="card-text mt-4">
            <button type="submit" class="btn btn-primary me-2">Submit</button>
            <button type="button" @click.prevent="handleBack" class="btn btn-danger">Cancel</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</template>
<script>
import { mapGetters, mapActions } from "vuex";
export default {
  name: "EditUser",
  data() {
    return {
      id: this.$route.params.id,
      optionRoles: [],
    };
  },
  methods: {
    ...mapActions(["editUser","updateUser"]),
    handleUpdateUser() {
      let data = {
        id: this.id,
        name: this.user.name,
        email: this.user.email,
        password: this.user.password,
        password_confirmation: this.user.password_confirmation,
        roles: this.optionRoles,
      };
      let response = this.updateUser(data);
      response.then((result) => {
        if (result.status == "Success"){
          this.$vToastify.success(result.message, result.status);
          this.$refs.User.reset();
          this.$router.push({ path: "/user" });
        }
        if(result.status == "Failed"){
          this.$vToastify.error(result.message, result.status);
        }
      });
    },
    handleBack(){
      this.$router.push({ path: "/user" })
    }
  },
  created() {
    this.editUser(this.id);
  },
  mounted() {
    this.optionRoles = this.userRoles;
  },
  computed: {
    ...mapGetters(["user", "roles", "userRoles"]),
  },
};
</script>