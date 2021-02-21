export const state = () => ({
  comments: []
});
export const getters = {
  getComments: state => {
    return state.comments;
  }
};
export const mutations = {
  SET_COMMENTS(state, comments) {
    state.comments = comments;
  },
  ADD_COMMENT(state, comment) {
    state.comments.push(comment);
  },
  DELETE_COMMENT(state, id) {
    state.comments = state.comments.filter(comment => comment.id !== id);
  },
  UPDATE_COMMENT(state, comment) {
    const index = state.comments.findIndex(
      oldComment => oldComment.id === comment.id
    );
    if (index !== -1) {
      state.comments.splice(index, 1, comment);
    }
  }
};
export const actions = {
  async addComment({ commit }, payload) {
    try {
      await this.$axios.$get("sanctum/csrf-cookie");
      const response = await this.$axios.$post("api/comments", payload);
      console.log(response);
      commit("ADD_COMMENT", response.data);
    } catch (error) {
      console.log(error);
    }
  },
  async deleteComment({ commit }, id) {
    try {
      await this.$axios.$get("sanctum/csrf-cookie");
      const response = await this.$axios.delete(`api/comments/${id}`);
      console.log(response);
      commit("DELETE_COMMENT", id);
    } catch (error) {
      console.log(error);
    }
  },
  async editComment({ commit }, payload) {
    try {
      await this.$axios.$get("sanctum/csrf-cookie");
      const response = await this.$axios.put(`api/comments/${payload.id}`, {
        body: payload.body
      });
      commit("UPDATE_COMMENT", response.data.data);
      console.log(response);
    } catch (error) {
      console.log(error);
    }
  }
};
