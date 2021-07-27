<template>
  <footer class="bd-footer py-1 bg-light">
    <div class="container py-5">
      <div class="row">
        <div class="col-lg-6 mb-3">
          <a
            class="
              d-inline-flex
              align-items-center
              mb-2
              link-primary
              text-decoration-none
            "
            href="/"
            aria-label="Facebook Tools"
          >
            <img :src="logo_footer" alt="" width="210px" height="50px"  srcset="">
          </a>
          <ul class="list-unstyled small text-muted">
            <li class="mb-2">
              Designed and built with all the love in the world by the
              <a href="https://web.facebook.com/karona.srun" target="_blink">Karona team</a> 
            </li>
          </ul>
        </div>
        <div class="col-lg-6 mb-3 text-end">
          <p><span>JOIN OUR NEWSLETTER</span><br>
          subscribe newsletter</p>
          <ul class="list-unstyled">
            <li class="mb-2">
              <form>
                <div class="mb-3">
                  <div class="inner-addon left-addon">
                    <i class="bi bi-envelope"></i>
                    <input
                      type="text"
                      class="form-control"
                      placeholder="Please enter your email *"
                    />
                  </div>
                </div>
                <button type="submit" class="btn btn-primary"><i class="bi bi-cursor"></i> Send</button>
              </form>
            </li>
            <li class="mb-2">
              <router-link
                :to="{ path: '/contact-us' }"
                class="link-primary"
                href="https://blog.getbootstrap.com/"
                >Contact US</router-link
              >
              |
              <router-link
                :to="{ path: '/faqs' }"
                class="link-primary"
                href="https://blog.getbootstrap.com/"
                >Faqs</router-link
              >
              |
              <router-link
                :to="{ path: '/plans' }"
                class="link-primary"
                href="https://blog.getbootstrap.com/"
                >Plans and Pricing</router-link
              >
              |
              <router-link
                :to="{ path: '/terms' }"
                class="link-primary"
                href="https://blog.getbootstrap.com/"
                >Terms and Conditions</router-link
              >
              |
              <router-link
                :to="{ path: '/privacy' }"
                class="link-primary"
                href="https://blog.getbootstrap.com/"
                >Privacy and Policy</router-link
              >
            </li>
          </ul>
        </div>
      </div>
    </div>
  </footer>
</template>
<script>
export default {
  data() {
    return {
      logo_footer: '/logo_footer.png'
    }
  }
}
</script>