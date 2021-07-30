<template>
  <div class="home">
    <h1>
      Blogs page
      <router-link
        :to="{ path: 'blogs/create' }"
        class="btn btn-primary"
        v-if="canCreateRoles"
        ><i class="bi bi-plus"></i> Create Blog</router-link
      >
    </h1>
    <div class="container">
      <div class="my-5 text-center">
        <hr />
      </div>
      <div class="row">
        <div
          v-for="(blog, i) in blogs"
          :key="i"
          class="col-lg-3 col-md-4 col-sm-12 mb-4"
        >
          <div class="card">
            <img class="card-img-top" :src="blog.path" v-if="blog.path" alt="Unsplash" />
            <div class="card-body">
              <div class="row clearfix">
                <div class="col-lg-10 col-md-10 col-sm-10">
                  <span class="small">
                    <i class="bi bi-calendar-date"></i> {{ blog.created_at }}
                    <i class="bi bi-person"></i> {{ blog.creator }}
                  </span>
                </div>
                <div class="col-lg-2 col-md-2 col-sm-2" v-if="canEditRoles">
                  <div class="card-actions">
                    <div class="dropdown show">
                      <a
                        href="#"
                        class="text-dark"
                        data-toggle="dropdown"
                        data-display="static"
                      >
                        <i class="bi bi-three-dots-vertical"></i>
                      </a>
                      <div class="dropdown-menu dropdown-menu-right">
                        <a class="dropdown-item" @click="editBlogs(blog.id)">Edit Blog</a>
                        <a class="dropdown-item" @click="deleteBlogs(blog.id)">Delete Blog</a>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <h5 class="card-title mb-0">{{ blog.title }}</h5>
              <p class="card-subtitle mb-0 mt-1">{{ blog.summary }}</p>
              <button class="btn btn-primary my-2" @click="showBlogs(blog.id)">
                Read more
              </button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
import { mapGetters, mapActions } from "vuex";
export default {
  data() {
    return {
      image: "",
      permissions: localStorage.getItem("userPermissions")
        ? localStorage.getItem("userPermissions")
        : "",
    };
  },
  methods: {
    ...mapActions(["fetchBlogs","removeBlog"]),
    showBlogs(id) {
      this.$router.push({ path: "/blogs/view/" + id });
    },
    editBlogs(id) {
      this.$router.push({ path: "/blogs/edit/" + id });
    },
    deleteBlogs(id) {
      this.$vToastify.prompt({
          body: "Are you sure you want to delete this blog?",
          answers: { Yes: true, No: false }
      }).then(value => {
          if (value) {
              this.removeBlog(id);
              this.$vToastify.success("Blog deleted successfully.")
          }
      })
    }
  },
  created() {
    let result = this.fetchBlogs();
    result.then((result) => {});
  },
  computed: {
    ...mapGetters(["blogs"]),
    canListRoles() {
      return this.permissions.includes("blog-list");
    },
    canCreateRoles() {
      return this.permissions.includes("blog-create");
    },
    canEditRoles() {
      return this.permissions.includes("blog-edit");
    },
    canDeleteRoles() {
      return this.permissions.includes("blog-delete");
    },
  },
};
</script>
<style>
.card-subtitle,
.card-title {
  font-weight: 400;
}
.card-title {
  font-size: 0.875rem;
  color: #495057;
}
.card {
  margin-bottom: 24px;
  box-shadow: 0 0 0.875rem 0 rgba(33, 37, 41, 0.05);
}
.card {
  position: relative;
  display: flex;
  flex-direction: column;
  min-width: 0;
  word-wrap: break-word;
  background-color: #fff;
  background-clip: initial;
  border: 0 solid transparent;
  border-radius: 0.25rem;
}
.card-body {
  flex: 1 1 auto;
  padding: 1.25rem;
}
.card-header:first-child {
  border-radius: 0.25rem 0.25rem 0 0;
}
.card-header {
  border-bottom-width: 1px;
}
.pb-0 {
  padding-bottom: 0 !important;
}
.card-header {
  padding: 1rem 1.25rem;
  margin-bottom: 0;
  background-color: #fff;
  border-bottom: 0 solid transparent;
}
</style>