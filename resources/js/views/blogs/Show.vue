<template>
  <div>
    <div class="container">
      <div class="row">
        <div class="col-lg-12 col-md-12 card-no-border">
          <h1>{{ showblog.title }}</h1>
          <p><i class="bi bi-calendar-date"></i> {{ showblog.created_at }} <i class="bi bi-person"></i> {{ showblog.creator }}</p>
          <hr>
          <img
              class="shadow rounded"
              :src="showblog.path"
              v-if="showblog.path"
              alt="Unsplash"
            />
          <p class="mt-4 text-inline">{{ showblog.body }}</p>
        </div>
      </div>
      <div class="row">
          <div class="col-lg-12 text-center mb-2 mt-4">
              <h3>Relate Blogs</h3>
          </div>
          
          <div class="col-lg-3" v-for="(blog, i) in blogs" :key="i">
            <div class="card p-1" @click.prevent="handleShow(blog.id)">
              <img
              class="card-img-top"
              :src="blog.path"
              v-if="blog.path"
              alt="Unsplash"
              height="80px"
            />
              <p class="p-2">{{blog.title}}</p>
            </div>
          </div>
      </div>
    </div>
  </div>
</template>
<script>
import { mapGetters, mapActions } from 'vuex';
export default {
  data() {
    return {
      id: this.$route.params.id,
      result: {},
      comment: ''
    }
  },
  methods: {
    ...mapActions(["showBlog", "fetchBlogs"]),
    handleShow(id) {
      this.$router.push({ path:'/blogs/view/'+id  })
      this.$router.go();
    }
  },
  created() {
    this.showBlog(this.$route.params.id);
    this.fetchBlogs();
  },
  computed: {
    ...mapGetters(["showblog", "blogs"]),
  },
}
</script>