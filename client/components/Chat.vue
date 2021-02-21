<template>
  <b-container class="m-0">
    <b-list-group>
      <b-list-group-item v-for="message in messages" :key="message.id">
        {{ message.user_id }} - {{ message.body }}</b-list-group-item
      >
    </b-list-group>
    <b-form inline @submit.prevent="onSubmit" class="w-100">
      <b-input-group class="w-100">
        <b-form-input
          v-model="message"
          placeholder="Write something..."
        ></b-form-input>
        <b-input-group-append>
          <b-button type="submit" variant="primary">Save</b-button>
        </b-input-group-append>
      </b-input-group>
    </b-form>
    <button type="button" @click="addThread">Add Thread</button>
  </b-container>
</template>

<script>
export default {
  props: {
    messages: {
      type: [Object, Array],
    },
  },
  data() {
    return {
      chats: [],
      message: "",
    };
  },

  methods: {
    async onSubmit() {
      try {
        await this.$axios.$get("sanctum/csrf-cookie");
        const response = await this.$axios.post("api/thread/messages", {
          thread_id: this.messages[0].thread_id,
          body: this.message,
        });
        console.log(response);
      } catch (error) {
        console.log(error);
      }
    },
    async addThread() {
      try {
        await this.$axios.$get("sanctum/csrf-cookie");
        const response = await this.$axios.post("api/thread", {
          to_user_id: 5,
          body: "hello tanginamo too",
        });
        console.log(response);
      } catch (error) {
        console.log(error);
      }
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