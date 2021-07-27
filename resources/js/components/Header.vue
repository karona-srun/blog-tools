<template>
  <header
    class="
      d-flex
      flex-wrap
      align-items-center
      justify-content-center justify-content-md-between
      py-3
      mb-4
      border-bottom
    "
  >
    <router-link
      :to="{ path: '/' }"
      class="
        d-flex
        align-items-center
        col-md-3
        mb-2 mb-md-0
        text-dark text-decoration-none
      "
    >
      
      <img v-bind:src="logo" width="50px" height="50px" />
    </router-link>

    <ul class="nav col-12 col-md-auto mb-2 justify-content-center mb-md-0">
      <li>
        <router-link :to="{ path: '/' }" class="nav-link px-2 link-primary"
          >Home</router-link
        >
      </li>
      <li><router-link :to="{ path: '/plans' }" class="nav-link px-2 link-primary">Features and Pricing</router-link></li>
      <li><router-link :to="{ path: '/faqs' }" class="nav-link px-2 link-primary">FAQs</router-link></li>
      <li>
        <router-link :to="{ path: '/about' }" class="nav-link px-2 link-primary"
          >About</router-link
        >
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="http://example.com" id="dropdown09" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><span class="flag-icon flag-icon-us"> </span> English</a>
        <div class="dropdown-menu" aria-labelledby="dropdown09">
          <a class="dropdown-item" href="#kh"><span class="flag-icon flag-icon-kh"> </span>  ភាសាខ្មែរ</a>
          <a class="dropdown-item" href="#kh"><span class="flag-icon flag-icon-us"> </span>  English</a>
        </div>
      </li>
    </ul>
    <div class="col-md-3 text-end">
      <router-link v-if="!isLogOut"
        class="btn btn-outline-primary me-2"
        :to="{ path: '/login' }"
        ><i class="bi bi-person"></i> Login</router-link
      >
      <router-link v-if="!isLogOut"
        class="btn btn-primary"
        :to="{ path: '/register' }"
        ><i class="bi bi-person-lines-fill"></i> Register</router-link
      >
      <button v-if="isLogOut" @click.prevent="handleLogout" class="btn btn-outline-primary"><i class="bi bi-chevron-bar-left"></i> Log-Out</button>
    </div>
  </header>
</template>

<script>
export default {
  data() {
    return {
      logo: "/favicon.ico",
      isLogOut: localStorage.getItem("accessToken"),
    };
  },
  methods: {
    handleLogout(){
      this.$store.dispatch("auth/logout");
      this.$router.go();
    }
  }
};
</script>
