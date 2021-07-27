<template>
  <div>
    <div class="card bg-light p-2">
      <div class="card-body">
        <h5 class="card-title">Create Users</h5>
        <h6 class="card-subtitle mb-2 text-muted">Please enter your datas</h6>
        <form @submit.prevent="handleCreateUser" ref="User">
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
            <label class="form-label">Roles</label>
            <multiselect
              v-model="value"
              :options="values"
              :multiple="true"
              :searchable="false"
              :allow-empty="false"
              placeholder="Select one role you want to"
              open-direction="bottom"
            ></multiselect>
          </div>
          <div class="mb-3">
            <label class="form-label">Password</label>
            <input
              type="password"
              class="form-control"
              v-model="user.password"
            />
          </div>
          <div class="mb-3">
            <label class="form-label">Re-type Password</label>
            <input
              type="password"
              class="form-control"
              v-model="user.password_confirmation"
            />
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
import UserService from "../../services/user.service";
import { mapActions } from "vuex";
export default {
  name: "CreateUser",
  data() {
    return {
      user: [],
      roles: {},
      selectedRoles: "User Normal",
      value: "User Normal",
      values: [],
    };
  },
  mounted() {
    UserService.getRoles().then(
      (response) => {
        this.roles = response;
      },
      (error) => {
        this.currentUser =
          (error.response && error.response.data) ||
          error.message ||
          error.toString();
      }
    );
    UserService.getRolesForUsersCreate().then((response) => {
      this.values = response;
    });
  },
  methods: {
    ...mapActions(["addUsers"]),
    handleCreateUser() {
      let data = {
        name: this.user.name,
        email: this.user.email,
        password: this.user.password,
        password_confirmation: this.user.password_confirmation,
        roles: this.value,
      };

      let response = this.addUsers(data);
      response.then((result) => {
        console.log(result); // "Some User token"
        if (result.status == "Success")
          this.$vToastify.success(result.message, result.status);
        if (result.status == "Failed")
          this.$vToastify.error(result.message, result.status);
      });
      this.$refs.User.reset();
    },
    handleBack(){
      this.$router.push({ path: "/user" })
    }
  },
};
</script>