<template>
  <div>
    <main class="form-signin col-lg-4 col-md-8 col-sm-12 mx-auto">
      <h2>Login Page</h2>
      <form @submit.prevent="handleLogin">
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
          <label for="exampleInputEmail1" class="form-label"
            >Password</label
          >
          <div class="inner-addon left-addon">
            <i class="bi bi-lock"></i>
            <input type="password" class="form-control" v-model="password" />
          </div>
        </div>
        <div class="mb-3 form-check">
          <input type="checkbox" class="form-check-input" id="exampleCheck1" />
          <label class="form-check-label" for="exampleCheck1"
            >Check me out</label
          >
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
      email: "",
      password: "",
    };
  },
  computed: {
    loggedIn() {
      return this.$store.state.auth.status.loggedIn;
    },
  },
  created() {
    if (this.loggedIn) {
      this.$router.push("/user");
    }
  },
  methods: {
    handleLogin() {
      let user = {
        email: this.email,
        password: this.password,
      };

      this.$store
        .dispatch("auth/login", user)
        .then(() => {
          this.$router.push("/user");
          this.$router.go();
        })
        .catch((error) => {
          throw new Error(error);
          // console.log(error)
        });
    },
  },
};
</script>