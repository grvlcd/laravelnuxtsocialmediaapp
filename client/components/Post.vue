<template>
  <div v-if="post">
    <div v-if="post.user">
      <b-card :sub-title="post.user.email" class="mb-3">
        <b-form-input
          type="text"
          v-model="title"
          :disabled="post.user.id !== $auth.user.id"
          class="form-control-plaintext"
        ></b-form-input>
        <b-form-textarea
          rows="6"
          v-model="body"
          :disabled="post.user.id !== $auth.user.id"
          class="form-control-plaintext"
        >
        </b-form-textarea>
        <NuxtLink v-if="!$route.params.id" :to="`${post.id}`">View</NuxtLink>
        <template v-if="post.created_at !== post.updated_at">
          <b-card-text>Updated: {{ post.updated_at }}</b-card-text>
        </template>
        <template v-else>
          <b-card-text>Created: {{ post.created_at }}</b-card-text>
        </template>
        <div v-if="post.user.id === $auth.user.id">
          <b-button
            class="btn-sm"
            type="button"
            @click="onDelete"
            variant="danger"
            >Delete</b-button
          >
          <b-button
            class="btn-sm"
            type="button"
            @click="onEdit"
            variant="success"
            >Edit</b-button
          >
          <i class="text-muted">Click on your title/body to edit.</i>
        </div>
      </b-card>
    </div>
  </div>
</template>

<script>
import { mapActions } from "vuex";
export default {
  props: {
    post: {
      type: Object,
      required: true,
    },
  },
  data() {
    return {
      body: this.post.body,
      title: this.post.title,
    };
  },
  methods: {
    ...mapActions("post", ["deletePost", "editPost"]),
    onDelete() {
      this.deletePost(this.post.id);
    },
    onEdit() {
      let payload = {
        id: this.post.id,
        body: this.body,
        title: this.title,
      };
      this.editPost(payload);
    },
  },
};
</script>

<style scoped>
textarea {
  resize: none;
}
input[type="text"]:disabled,
textarea:disabled {
  background-color: transparent;
}
input[type="text"]:focus,
textarea:focus {
  outline: none !important;
}
</style>