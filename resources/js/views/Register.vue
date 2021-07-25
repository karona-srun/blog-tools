<template>
  <div>
    <main class="form-signin col-lg-4 col-md-8 col-sm-12 mx-auto">
      <h2>Register Page</h2>
      <form @submit.prevent="handleRegister">
        <div class="mb-3">
          <label for="exampleInputEmail1" class="form-label">Name</label>
          <div class="inner-addon left-addon">
            <i class="bi bi-person"></i>
            <input type="text" class="form-control" v-model="name" />
          </div>
        </div>
        <div class="mb-3">
          <label for="exampleInputEmail1" class="form-label"
            >Email address</label
          >
          <div class="inner-addon left-addon">
            <i class="bi bi-envelope"></i>
            <input type="text" class="form-control" v-model="email" />
          </div>
        </div>
        <div class="mb-3">
          <label for="exampleInputEmail1" class="form-label">Password</label>
          <div class="inner-addon left-addon">
            <i class="bi bi-lock"></i>
            <input
              type="password"
              class="form-control"
              placeholder="Password"
              v-model="password"
            />
          </div>
        </div>
        <div class="mb-3">
          <label for="exampleInputEmail1" class="form-label"
            >Confirm password</label
          >
          <div class="inner-addon left-addon">
            <i class="bi bi-lock"></i>
            <input
              type="password"
              class="form-control"
              placeholder="Confirm password"
              v-model="password_confirmation"
            />
          </div>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
      </form>
    </main>
  </div>
</template>
<script>
export default {
  data() {
    return {
      name: "",
      email: "",
      password: "",
      password_confirmation: "",
    };
  },
  methods: {
    handleRegister() {
      let user = {
        name: this.name,
        email: this.email,
        password: this.password,
        password_confirmation: this.password_confirmation,
      };
      this.$store.dispatch("auth/register", user).then(
        (data) => {
          this.$router.push("/login");
          // this.message = data.message;
          // this.successful = true;
        },
        (error) => {
          // this.message =
          //   (error.response && error.response.data) ||
          //   error.message ||
          //   error.toString();
          // this.successful = false;
        }
      );
    },
  },
};
</script>