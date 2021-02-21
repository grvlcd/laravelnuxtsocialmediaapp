<template>
  <b-navbar toggleable="lg" class="mb-4" type="dark" variant="transparent">
    <b-navbar-brand>
      <NuxtLink
        class="text-decoration-none text-dark"
        v-if="!$auth.loggedIn"
        to="/"
      >
        Home
      </NuxtLink>
    </b-navbar-brand>
    <b-navbar-toggle target="nav-collapse"></b-navbar-toggle>

    <b-collapse id="nav-collapse" is-nav>
      <b-navbar-nav v-if="$auth.loggedIn">
        <b-nav-item>
          <NuxtLink class="text-decoration-none text-dark" to="dashboard">
            Dashboard
          </NuxtLink>
        </b-nav-item>
        <b-nav-item>
          <NuxtLink class="text-decoration-none text-dark" to="posts">
            Posts
          </NuxtLink>
        </b-nav-item>
        <b-nav-item>
          <NuxtLink class="text-decoration-none text-dark" to="messages">
            Messages
          </NuxtLink>
        </b-nav-item>
      </b-navbar-nav>

      <!-- Right aligned nav items -->
      <b-navbar-nav class="ml-auto">
        <b-nav-item-dropdown v-if="$auth.loggedIn" right>
          <!-- Using 'button-content' slot -->
          <template #button-content>
            <em class="text-dark">{{ $auth.user.name }}</em>
          </template>
          <b-dropdown-item
            ><NuxtLink class="text-decoration-none text-dark" to="profile"
              >Profile</NuxtLink
            ></b-dropdown-item
          >
          <b-dropdown-item href="#" @click="onLogout">Sign Out</b-dropdown-item>
        </b-nav-item-dropdown>
        <NuxtLink class="text-black-50" v-if="!$auth.loggedIn" to="login"
          >Login</NuxtLink
        >
        &nbsp;&nbsp;&nbsp;
        <NuxtLink class="text-black-50" v-if="!$auth.loggedIn" to="register"
          >Register</NuxtLink
        >
      </b-navbar-nav>
    </b-collapse>
  </b-navbar>
</template>

<script>
export default {
  methods: {
    async onLogout() {
      try {
        await this.$auth.logout();
      } catch (error) {
        console.log(error);
      }
    },
  },
};
</script>

<style>
</style>