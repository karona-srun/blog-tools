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
          <label for="exampleInputEmail1" class="form-label">Password</label>
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
        <div class="d-grid gap-2 mx-auto">
          <button type="submit" class="btn btn-block btn-primary">
            Submit
          </button>
          <div class="col-md-12">
            <div class="login-or">
              <hr class="hr-or" />
              <span class="span-or">Or</span>
            </div>
          </div>
          <button
            type="button"
            @click.prevent="authProvider('facebook')"
            class="btn btn-primary btn-block"
          >
            <i class="bi bi-facebook"></i> Login with Facebook
          </button>
        </div>
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
        });
    },
    authProvider(provider) {
      var bb = this;
      this.$auth
        .authenticate(provider)
        .then((response) => {
          this.SocialLogin(provider, response);
        })
        .catch((err) => {
          console.log({ err: err });
        });
    },
    SocialLogin(provider, response) {
      this.$http
        .post("/sociallogin/" + provider, response)
        .then((response) => {
          console.log(response.data);
        })
        .catch((err) => {
          console.log({ err: err });
        });
    },
  },
};
</script>
<style>
.login-or {
  position: relative;
  color: #000;
  margin-top: 10px;
  margin-bottom: 10px;
  padding-top: 10px;
  padding-bottom: 10px;
}
.span-or {
  display: block;
  position: absolute;
  left: 50%;
  top: -2px;
  margin-left: -25px;
  background-color: #fff;
  width: 50px;
  text-align: center;
}
.hr-or {
  height: 1px;
  margin-top: 0px !important;
  margin-bottom: 0px !important;
}
</style>