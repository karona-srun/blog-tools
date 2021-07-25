<template>
  <div>
    <form @submit.prevent="handleUpdateUser" ref="User">
      <div>
        <input type="text" v-model="user.name" />
      </div>
      <div>
        <input type="email" v-model="user.email" />
      </div>
      <!-- <div>
        <select v-model="user.roles[0].name">
          <option v-for="data in roles" :key="data" :value="data">
            {{ data }}
          </option>
        </select>
      </div> -->
      <div>
        <multiselect
          v-model="optionRoles"
          :options="roles"
          :multiple="true"
          :searchable="false" 
          :allow-empty="false"
          placeholder="Select one role you want to"
        ></multiselect>
      </div>
      <div>
        <input type="password" v-model="user.password" />
      </div>
      <div>
        <input type="password" v-model="user.password_confirmation" />
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
  name: "EditUser",
  data() {
    return {
      id: this.$route.params.id,
      optionRoles: []
    };
  },
  methods: {
    ...mapActions(["editUser"]),
    ...mapActions(["updateUser"]),
    handleUpdateUser() {
      let data = {
        id: this.id,
        name: this.user.name,
        email: this.user.email,
        password: this.user.password,
        password_confirmation: this.user.password_confirmation,
        roles: this.optionRoles
      };
      console.log(data)
      let response = this.updateUser(data);
      response.then(function(result) {
        console.log(result)
      })
      this.$refs.User.reset();
      this.$router.push({ path: '/user'});
    },
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