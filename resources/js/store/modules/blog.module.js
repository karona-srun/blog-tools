import axios from "axios";
import api from "../../api";

let url = api.setAPIURL() + "blogs";
let header = api.setHeaders();

const state = {
    blogs       : {},
    blog        : {},
    showblog    : []
};

const getters = {
    blogs       : state => state.blogs,
    blog        : state => state.blog,
    showblog    : state => state.blog,
}

const actions = {
    async fetchBlogs({ commit }){
        return await axios.get(url , {
            headers: header
        }).then(response => {
            commit("FETCH_BLOGS", response.data.data);
        }).catch(error => {
            console.log(error);
        })
    },
    async addBlogs({ commit }, data){
        return await axios.post(url, data , {
            headers: header
        }).then(response => {
            commit("ADD_NEW_BLOGS", response.data.data);
            return response.data
        }).catch(error => {
            console.log(error);
        })
    },
    async showBlog({ commit }, id){
        
        return axios.get(`${url}/${id}` , {
            headers: header
        }).then(response => {
            commit("SHOW_BLOG", response.data.data);
            return response.data.data
        }).catch(error => {
            console.log(error);
        })
    },
    async editBlogs({ commit }, id){
        return axios.get(`${url}/${id}` , {
            headers: header
        }).then(response => {
            commit("SHOW_BLOG", response.data.data);
            return response.data.data
        }).catch(error => {
            console.log(error);
        })
    },
    async updateBlogs({ commit }, data){
        return axios.post(`${url}/blogs-update`, data , {
            headers: header
        }).then(response => {
            console.log(response.data)
            commit("UPDATE_BLOG", response.data.data);
            return response.data
        }).catch(error => {
            console.log(error);
        })
    },
    removeBlog({ commit }, id){
        return axios.delete(`${url}/${id}` , {
            headers: header
        }).then(response => {
            console.log(response.data.data)
            commit("REMOVE_BLOG", id);
            return response.data.data
        }).catch(error => {
            console.log(error);
        })
    }
}

const mutations = {
    FETCH_BLOGS: (state, blogs) => (state.blogs = blogs),
    ADD_NEW_BLOGS: (state, blog) => (state.blog = blog),
    SHOW_BLOG:  (state, payload) => {
        state.blogs = state.blogs.map(blog => {
          if (blog.id === payload.id) {
            return Object.assign({}, blog, payload.data)
          }
          return blog;
        });
    },
    UPDATE_BLOG: (state,  payload) => {
        state.blogs = state.blogs.map(blog => {
          if (blog.id === payload.id) {
            return Object.assign({}, blog, payload.data)
          }
          return blog;
        });
    },
    REMOVE_BLOG: (state, id) => (
        state.blogs.filter(blog => blog.id !== id),
        state.blogs.splice(blog => blog.id, 1)
    )
}

export default {
    state,
    getters,
    actions,
    mutations
};



