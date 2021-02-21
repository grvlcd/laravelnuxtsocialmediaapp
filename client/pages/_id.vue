<template>
  <div>
    <div class="text-center" v-if="$fetchState.pending">
      <b-spinner type="grow" label="Loading..."></b-spinner>
    </div>
    <div class="container-md" v-if="!$fetchState.pending">
      <Post :post="getPost"></Post>
      <b-form @submit.prevent="onSubmit" method="post" class="mb-4">
        <b-form-group id="input-group-2" label="Body" label-for="input-2">
          <b-form-textarea
            id="input-2"
            v-model="body"
            rows="3"
            placeholder="Enter comment"
            @keyup.enter="onSubmit"
            required
          ></b-form-textarea>
        </b-form-group>
        <b-button type="submit" variant="primary">Submit</b-button>
      </b-form>
      <div class="container-comments" v-if="!$fetchState.pending">
        <Comment
          v-for="comment in getComments"
          :key="comment.id"
          :comment="comment"
        />
      </div>
    </div>
  </div>
</template>

<script>
import { mapActions, mapGetters } from "vuex";
export default {
  computed: {
    ...mapGetters("post", ["getPost"]),
    ...mapGetters("comment", ["getComments"]),
  },
  data() {
    return {
      body: "",
      post_id: this.$route.params.id,
    };
  },
  async fetch() {
    try {
      await this.$axios.$get("sanctum/csrf-cookie");
      const response = await this.$axios.$get(`api/posts/${this.post_id}`);
      if (response.data.id == this.post_id) {
        this.$store.commit("post/SET_POST", response.data);
        this.$store.commit("comment/SET_COMMENTS", response.data.comments);
      } else {
        // set status code on server and
        if (process.server) {
          this.$nuxt.context.res.statusCode = 404;
        }
        // use throw new Error()
        throw new Error("Post not found");
      }
    } catch (error) {
      console.log(error);
    }
  },
  methods: {
    ...mapActions("comment", ["addComment"]),
    onSubmit() {
      this.addComment({ body: this.body, post_id: this.post_id });
      this.body = "";
    },
  },
};
</script>
<style scoped>
.container-comments {
  display: flex;
  flex-direction: column-reverse;
}
</style>

