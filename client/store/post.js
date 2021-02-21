export const state = () => ({
  posts: [],
  post: {}
});
export const getters = {
  getPosts: state => {
    return state.posts;
  },
  getPost: state => {
    return state.post;
  }
};
export const mutations = {
  SET_POSTS(state, posts) {
    state.posts = posts;
  },
  ADD_POST(state, post) {
    state.posts.unshift(post);
  },
  SET_POST(state, post) {
    state.post = post;
  },
  DELETE_POST(state, id) {
    state.posts = state.posts.filter(post => post.id !== id);
  },
  UPDATE_POST(state, post) {
    const index = state.posts.findIndex(item => item.id === post.id);
    if (index !== -1) {
      state.posts.splice(index, 1, post);
    }
  }
};
export const actions = {
  async fetchPosts({ commit }) {
    try {
      await this.$axios.$get("sanctum/csrf-cookie");
      const response = await this.$axios.$get("api/posts");
      commit("SET_POSTS", response.data);
    } catch (error) {
      console.log(error);
    }
  },
  async addPost({ commit }, post) {
    try {
      await this.$axios.$get("sanctum/csrf-cookie");
      const response = await this.$axios.$post("api/posts", post);
      commit("ADD_POST", response.data);
    } catch (error) {
      console.log(error);
    }
  },
  async deletePost({ commit }, id) {
    try {
      await this.$axios.$get("sanctum/csrf-cookie");
      const response = await this.$axios.$delete(`api/posts/${id}`);
      commit("DELETE_POST", id);
    } catch (error) {
      console.log(error);
    }
  },
  async editPost({ commit }, payload) {
    try {
      await this.$axios.$get("sanctum/csrf-cookie");
      const response = await this.$axios.$put(
        `api/posts/${payload.id}`,
        payload
      );
      commit("UPDATE_POST", response.data);
    } catch (error) {
      console.log(error);
    }
  }
};
