<template>
  <div class="m-0">
    <b-row>
      <b-col cols="2">
        <b-list-group>
          <b-list-group-item
            v-for="thread in getThreads"
            :key="thread.id"
            @click="onThread(thread.id)"
            >{{ thread.user.name }}</b-list-group-item
          >
        </b-list-group>
      </b-col>
      <b-col class="m-0">
        <Chat :messages="messages" />
      </b-col>
      {{ id }}
    </b-row>
  </div>
</template>

<script>
import { mapGetters } from "vuex";
export default {
  middleware: "auth",
  data() {
    return {
      body: "dick",
      title: "",
      messages: [],
      id: 0,
    };
  },
  computed: mapGetters("message", ["getThreads"]),
  async fetch() {
    try {
      await this.$axios.$get("sanctum/csrf-cookie");
      const response = await this.$axios.$get("api/thread");
      this.$store.commit("message/SET_THREADS", response);
    } catch (error) {
      console.log(error);
    }
  },
  methods: {
    async onThread(id) {
      if (id) {
        try {
          await this.$axios.$get("sanctum/csrf-cookie");
          const response = await this.$axios.$get(`api/thread/${id}/messages`);
          this.messages = response;
        } catch (error) {
          console.log(error);
        }
      }
    },
  },
};
</script>

