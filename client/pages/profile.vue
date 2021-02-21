<template>
  <b-container>
    <b-row>
      <b-col cols="6" class="mx-auto">
        <b-card :title="$auth.user.name" :sub-title="$auth.user.email">
          <b-card-text
            >Lorem ipsum dolor sit amet consectetur, adipisicing elit.
            Reprehenderit, magni, ratione inventore eos debitis minus unde odit
            facere voluptas maxime vel, placeat pariatur rerum eligendi
            perspiciatis ullam delectus vitae fuga.</b-card-text
          >
        </b-card>
      </b-col>
    </b-row>
  </b-container>
</template>

<script>
export default {
  middleware: "auth",
};
</script>

