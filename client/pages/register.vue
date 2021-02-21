<template>
  <div>
    <b-container>
      <b-form @submit.prevent="onSubmit">
        <b-form-group id="input-group-0" label="Full name:" label-for="input-0">
          <b-form-input
            id="input-0"
            v-model="form.name"
            type="text"
            placeholder="Enter full name"
            required
          ></b-form-input>
        </b-form-group>
        <b-form-group
          id="input-group-1"
          label="Email address:"
          label-for="input-1"
          description="We'll never share your email with anyone else."
        >
          <b-form-input
            id="input-1"
            v-model="form.email"
            type="email"
            placeholder="Enter email"
            required
          ></b-form-input>
        </b-form-group>
        <b-form-group id="input-group-2" label="Password:" label-for="input-2">
          <b-form-input
            id="input-2"
            v-model="form.password"
            type="password"
            placeholder="Enter password"
            required
          ></b-form-input>
        </b-form-group>
        <b-button type="submit" variant="primary">Submit</b-button>
      </b-form>
    </b-container>
  </div>
</template>

<script>
export default {
  middleware: "guest",
  data() {
    return {
      form: {
        name: "",
        email: "",
        password: "",
      },
    };
  },
  methods: {
    async onSubmit() {
      try {
        const response = await this.$axios.post("api/register", this.form);
        if (response.data.status === 201) {
          alert("Registration complete");
          this.$router.push("/login");
        }
      } catch (error) {
        console.log(error);
      }
    },
  },
};
</script>

