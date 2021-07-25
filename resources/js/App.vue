<template>
  <div id="app">
    <div class="container">
      <Header></Header>
      <nav class="navbar navbar-expand-lg navbar-light bg-light px-3">
        <router-link :to="{ path:'/' }" class="navbar-brand" href="#">
          <i class="bi bi-arrow-bar-right"></i>
        </router-link>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
          aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
          <ul class="navbar-nav">
            <li class="nav-item">
              <router-link :to="{ path:'/' }" class="nav-link link-dark" href="#">Home</router-link>
            </li>
            <li class="nav-item">
              <router-link :to="{ path:'/blogs' }" class="nav-link link-dark" href="#">Blogs</router-link>
            </li>
            <li class="nav-item" v-if="isLoggedIn">
              <router-link :to="{ path:'/user' }" class="nav-link link-dark" href="#">Users</router-link>
            </li>
            <li class="nav-item" v-if="isLoggedIn">
              <router-link :to="{ path:'/role' }" class="nav-link link-dark" href="#">Roles</router-link>
            </li>
          </ul>
        </div>
      </nav>
    </div>
    <div class="container py-4">
      <router-view></router-view>
    </div>
    <Footer></Footer>
  </div>
</template>
<script>
  import UserService from "./services/user.service";
  import Footer from './components/Footer.vue'
  import Header from './components/Header.vue'
  export default {
    components: {
      Footer,
      Header
    },
    data() {
      return {
        logo: "https://getbootstrap.com/docs/5.0/assets/img/favicons/favicon.ico",
        isLoggedIn: localStorage.getItem("accessToken") ? true : false,
      }
    },
    mounted() {
      this.$nextTick(function () {
        UserService.getUserBoard().then((response) => {
          console.log("accessToken Successfully")
        }).catch((error) => {
          console.log("accessToken Failed")
        })
      })
    }
  }
</script>
<style>
  html body {
    font-family: 'Nunito Sans', sans-serif;
    /* font-family: 'Yomogi', cursive !important; */
  }

  .navbar-toggler {
    border-color: transparent !important;
    outline: 0 !important;
  }

  button:focus {
    outline: 0 !important;
    border-color: #0d6efd !important;
    box-shadow: 0 0 0 0 !important;
  }

  .btn{
    border-radius: .15rem !important;
  }

  .form-control, select {
    padding: .3rem .5rem !important;
    border-color: #cbced1 !important;
    border-radius: .15rem !important;
  }

  .form-control:hover, select:hover {
    border-color: #0d6efd !important;
  }

  a,
  a .nav-link {
    font-weight: 100 !important;
    text-decoration: none !important;
  }

  textarea:focus,
  textarea.form-control:focus,
  select:focus,
  .form-control:focus,
  input.form-control:focus,
  input[type=text]:focus,
  input[type=password]:focus,
  input[type=email]:focus,
  input[type=number]:focus,
  [type=text].form-control:focus,
  [type=password].form-control:focus,
  [type=email].form-control:focus,
  [type=tel].form-control:focus,
  [contenteditable].form-control:focus {
    box-shadow: inset 0 -0px 0 #ddd !important;
  }

  /* enable absolute positioning */
  .inner-addon {
    position: relative;
  }

  /* style icon */
  .inner-addon .bi {
    position: absolute;
    padding: 6px 10px;
    pointer-events: none;
  }

  /* align icon */
  .left-addon .bi {
    left: 0px;
  }

  .right-addon .bi {
    right: 0px;
  }

  /* add padding  */
  .left-addon input, .left-addon textarea {
    padding-left: 30px !important;
  }

  .right-addon input, .right-addon textarea {
    padding-right: 30px !important;
  }

  .multiselect__tags{
    border: 1px solid #999999 !important;
  }
  .multiselect__tags:hover{
    border-color: #0d6efd !important;
  }
</style>