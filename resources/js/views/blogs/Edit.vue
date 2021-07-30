<template>
  <div>
    <div class="card bg-light p-2">
      <div class="card-body">
        <h5 class="card-title">Create Blog</h5>
        <h6 class="card-subtitle mb-2 text-muted">Please enter your datas</h6>
        <form @submit.prevent="handleSubmit" ref="Blog" enctype="multipart/form-data">
          <div class="row">
            <div class="col-lg-6 col-sm-12">
              <div class="mb-3">
                <label for="name">Title</label>
                <textarea
                  type="text"
                  v-model="blog.title"
                  class="form-control"
                  rows="3"
                  placeholder="Please enter your title"
                />
              </div>
                <div class="mb-3">
                <label for="name">Summary</label>
                <textarea
                  type="text"
                  v-model="blog.summary"
                  class="form-control"
                  rows="2"
                  placeholder="Please enter your summary"
                />
              </div>
              <div class="mb-3">
                <label for="name">Status</label>
                <multiselect
                  v-model="option"
                  :options="options"
                  :multiple="false"
                  :searchable="false"
                  :allow-empty="false"
                  track-by="label"
                  label="label"
                  placeholder="Select one role you want to"
                  open-direction="bottom"
                ></multiselect>
              </div>
            </div>
            <div class="col-lg-6 col-sm-12">
              <div class="mb-3">
                <label for="name" class="form-control form-control-sm mb-1">Image 
                <input type="file" @change="onFileChange" accept="image/*" />
                </label>
                <div id="preview">
                    <img v-if="url" :src="url ? url : blog.path" class="rounded mx-auto d-block" />
                </div>
              </div>
            </div>
          </div>
          <div class="mb-3">
                <label for="name">Body</label>
                <textarea
                  type="text"
                  v-model="blog.body"
                  class="form-control"
                  rows="5"
                  placeholder="Please enter your body"
                />
              </div>
          <div class="card-text mt-4">
            <button type="submit" class="btn btn-primary me-2">Submit</button>
            <button
              type="button"
              @click.prevent="handleBack"
              class="btn btn-danger"
            >
              Cancel
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>
</template>
<script>
import { mapGetters, mapActions } from 'vuex';
export default {
  data() {
    return {
        id:  this.$route.params.id,
        url: 'https://productbuilder.rednao.com/wp-content/uploads/sites/4/2019/08/iconfinder_icon-image_211677-1.png',
        options: [
            { value: 1, label: "Published" },
            { value: 0, label: "Draft" },
        ],
        option: [],
        blog: [],
    };
  },
  methods: {
    ...mapActions(["updateBlogs", "showBlog"]),
    handleSubmit() {
      let data = new FormData();
      data.append("id", this.id);
      data.append("title", this.blog.title);
      data.append("summary", this.blog.summary);
      data.append("status", this.option.value);
      data.append("pic", this.image);
      data.append("body", this.blog.body);

      let result = this.updateBlogs(data);
      
      result.then(( result ) => {
        if (result.status == "Success") {
          this.$router.push({ path: "/blogs" });
          this.$vToastify.success(result.message, result.status);
        }
        if (result.status == "Failed")
          this.$vToastify.error(result.message, result.status);
      });
      //this.$refs.Blog.reset();

    },
    handleBack() {
      this.$router.push("/blogs");
    },
    onFileChange(e) {
      const file = e.target.files[0];
      this.image = e.target.files[0];
      this.url = URL.createObjectURL(file);
    },
  },
  created(){
    this.showBlog(this.$route.params.id);
    this.option = this.showblog.status;
    this.blog = this.showblog;
  },
  computed: {
    ...mapGetters(["showblog"]),
    editor() {
      return this.$refs.QuillEditor.quill;
    },
  },
};
</script>
<style>
#preview {
  display: flex;
  justify-content: center;
  align-items: center;
}

#preview img {
  max-width: max-content;
  max-height: 230px;
}
</style>