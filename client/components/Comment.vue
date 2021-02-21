<template>
  <div v-if="comment.post_id == $route.params.id">
    <b-card class="mb-3">
      <b-form-textarea
        rows="3"
        v-model="body"
        :disabled="comment.user.id !== $auth.user.id"
        class="form-control-plaintext"
      >
      </b-form-textarea>
      <template v-if="comment.created_at !== comment.updated_at">
        <b-card-text>Updated: {{ comment.updated_at }}</b-card-text>
      </template>
      <template v-else>
        <b-card-text>Created: {{ comment.created_at }}</b-card-text>
      </template>
      <div v-if="comment.user.id === $auth.user.id">
        <b-button
          class="btn-sm"
          type="button"
          @click="onDelete"
          variant="danger"
          >Delete</b-button
        >
        <b-button class="btn-sm" type="button" @click="onEdit" variant="success"
          >Edit</b-button
        >
        <i class="text-muted">Click on your comment to edit.</i>
      </div>
    </b-card>
  </div>
</template>

<script>
import { mapActions } from "vuex";
export default {
  props: {
    comment: {
      type: Object,
      required: true,
    },
  },
  data() {
    return {
      body: this.comment.body,
    };
  },
  methods: {
    ...mapActions("comment", ["deleteComment", "editComment"]),
    onDelete() {
      this.deleteComment(this.comment.id);
    },
    onEdit() {
      let payload = {
        id: this.comment.id,
        body: this.body,
      };
      console.log(payload);
      this.editComment(payload);
    },
  },
};
</script>

<style scoped>
textarea {
  resize: none;
}
textarea:disabled {
  background-color: transparent;
}
textarea:focus {
  outline: none !important;
}
</style>