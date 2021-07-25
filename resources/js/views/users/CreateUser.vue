<template>
  <div>
    <form @submit.prevent="handleCreateUser" ref="User">
      <div>
        <input type="text" class="form-control" v-model="user.name" />
      </div>
      <div>
        <input type="email" class="form-control" v-model="user.email" />
      </div>
      <div>
        <select class="form-select" v-model="selectedRoles">
          <option
            v-for="data in roles"
            :key="data.id"
            v-show="data.id"
            :value="data.name"
          >
            {{ data.name }}
          </option>
        </select>
      </div>
      <div>
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
      <div>
        <input type="password" class="form-control" v-model="user.password" />
      </div>
      <div>
        <input
          type="password"
          class="form-control"
          v-model="user.password_confirmation"
        />
      </div>
      <div>
        <button type="submit" class="btn btn-primary">Submit</button>
      </div>
    </form>
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
      });
      this.$refs.User.reset();
    },
  },
};
</script>