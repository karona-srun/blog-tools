<template>
  <div class="home">
    <h1>User page</h1>
    <p>
      Operation the user page.
    </p>
    <div>
      <div v-if="canCreateUsers">
      <router-link :to="{ path: '/users/create' }" v-if="canListUsers" class="btn btn-primary"><i class="bi bi-plus"></i> Create User</router-link>
    </div>
      <table class="table">
        <thead>
        <tr>
          <td>No</td>
          <th>Name</th>
          <th>Email</th>
          <th>Created at / Updated at</th>
          <th>Action</th>
        </tr>
        </thead>
        <tbody>
        <tr v-for="(user, index) in usersList" :key="index">
          <td>{{ index+1 }}</td>
          <td>{{ user.name }}</td>
          <td>{{ user.email }}</td>
          <td>
            <span>{{ user.created_at }}</span><br>
            <span>{{ user.updated_at }}</span>
          </td>
          <td>
            <button @click.prevent="editUser(user.id)" v-if="canEditUsers" class="btn btn-primary"><i class="bi bi-pencil"></i></button>
            <button @click.prevent="removeUser(user.id)" v-if="canDeleteUsers" class="btn btn-danger"><i class="bi bi-trash"></i></button>
          </td>
        </tr>
        </tbody>
      </table>
    </div>
  </div>
</template>
<script>
import UserService from "../../services/user.service";
import { mapGetters, mapActions } from "vuex";
export default {
  name: "User",
  data() {
    return {
      currentUser: [],
      roles: [],
      accessToken: localStorage.getItem("accessToken"),
      permissions: localStorage.getItem("userPermissions")
        ? localStorage.getItem("userPermissions")
        : "",
      currentUser: {},
    };
  },
  mounted() {
    if (!this.currentUser) {
      this.$router.push("/login");
    };
    UserService.getUserBoard().then(
      (response) => {
        this.currentUser = response.data;
        this.roles = response.roles;
        this.permissions = response.permissions;
      },
      (error) => {
        this.currentUser =
          (error.response && error.response.data) ||
          error.message ||
          error.toString();
      }
    );
  },
  methods: {
    ...mapActions(["fetchUsers", "deleteUser"]),
    editUser(id){
      this.$router.push({ path: 'user/'+id });
      this.$router.go();
    },
    removeUser(id){
      this.$vToastify.prompt({
          body: "Are you sure you want to delete this user?",
          answers: { Yes: true, No: false }
      }).then(value => {
          if (value) {
              this.deleteUser(id);
              this.$vToastify.success("User deleted successfully.")
          }
      })
    }
  },
  created() {
    this.fetchUsers();
  },
  computed: {
    ...mapGetters(["usersList"]),
    canListUsers() {
      return this.permissions.includes("user-list");
    },
    canCreateUsers() {
      return this.permissions.includes("user-create");
    },
    canEditUsers() {
      return this.permissions.includes("user-edit");
    },
    canDeleteUsers() {
      return this.permissions.includes("user-delete");
    },
  },
};
</script>