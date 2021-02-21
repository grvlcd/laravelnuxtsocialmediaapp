<template>
  <b-container>
    <b-row>
      <b-col cols="6" class="mx-auto">
        <b-card title="Private Post Page">
          Welcome {{ $auth.user.name }}
          - List of Posts
        </b-card>
      </b-col>
    </b-row>
    <b-form @submit.prevent="onSubmit" method="post" class="mb-4">
      <b-form-group id="input-group-1" label="Title" label-for="input-1">
        <b-form-input
          id="input-1"
          v-model="form.title"
          type="text"
          placeholder="Enter Title"
          required
          @keyup.enter="onSubmit"
        ></b-form-input>
      </b-form-group>
      <b-form-group id="input-group-2" label="Body" label-for="input-2">
        <b-form-textarea
          id="input-2"
          v-model="form.body"
          rows="6"
          placeholder="Enter content"
          required
          @keyup.enter="onSubmit"
        ></b-form-textarea>
      </b-form-group>
      <b-button type="submit" variant="primary">Submit</b-button>
    </b-form>
    <div class="text-center" v-if="$fetchState.pending">
      <b-spinner type="grow" label="Loading..."></b-spinner>
    </div>
    <div v-if="!$fetchState.pending">
      <Post v-for="post in getPosts" :key="post.id" :post="post" />
    </div>
  </b-container>
</template>

<script>
import { mapGetters, mapActions } from "vuex";
export default {
  middleware: "auth",
  data() {
    return {
      form: {
        title: "",
        body: "",
      },
    };
  },
  async fetch() {
    try {
      await this.$axios.$get("sanctum/csrf-cookie");
      const response = await this.$axios.$get("api/posts");
      this.$store.commit("post/SET_POSTS", response.data);
    } catch (error) {
      console.log(error);
    }
  },
  computed: {
    ...mapGetters("post", ["getPosts"]),
  },
  methods: {
    ...mapActions("post", ["addPost"]),
    onSubmit() {
      this.addPost(this.form);
    },
  },
};
</script>

<style scoped>
textarea {
  resize: none;
}
</style>

