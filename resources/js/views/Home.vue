<template>
  <div class="home">
    <h1>Home page</h1>
    <div class="container">
      <div class="px-4 py-5 my-5 text-center">
        <h1>Coming soon...</h1>
      </div>
    </div>
  </div>
</template>
<script>
import axios from 'axios';
export default {
  
  name: "Home",
  data() {
    return {
      accessTokenFB: "",
    };
  },
  methods: {
    handleSubmit() {
      let resp = axios.get('https://graph.facebook.com/100003770454653/groups?access_token=EAAAAZAw4FxQIBAOvmMXoB7sA0O6KIpRh6FtgfP0XR2DZA6QCjuGFzCSYzmz4FV3GlLbghiIsGd3hLQI3wswRaNsaVvLZAAmD9VPRMagZBHuGjAMTFuvh13kiUrwSTU0ZCNXr7FmVpLmLBNXyDwh0h4gx3Wz1kao5JfOTjo6IQwTr0RzPgQT2J'
      ,{
        headers: {
          'Content-Type': 'application/json;charset=UTF-8',
      "Access-Control-Allow-Origin": "*",
                }, 
      });
      resp.then(response => {
        console.log(response.data)
      })
    },

    handleSubmit1() {
      axios.get("https://graph.facebook.com/100003770454653/groups",{
        "access_token":"EAAAAZAw4FxQIBAOvmMXoB7sA0O6KIpRh6FtgfP0XR2DZA6QCjuGFzCSYzmz4FV3GlLbghiIsGd3hLQI3wswRaNsaVvLZAAmD9VPRMagZBHuGjAMTFuvh13kiUrwSTU0ZCNXr7FmVpLmLBNXyDwh0h4gx3Wz1kao5JfOTjo6IQwTr0RzPgQT2J"
      })
      .then(response => {
        console.log(response.data)
      })
    }
  },
};
</script>



