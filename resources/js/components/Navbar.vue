<template>
  <nav class="navbar navbar-expand-lg navbar-light bg-white">
    <div class="container flex-nowrap-off">
      <router-link :to="{ name: user ? 'get-started' : 'welcome' }" class="navbar-brand">
        <img src="/limehome-logo-dark.png" class='logo' />
      </router-link>

      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarToggler" aria-controls="navbarToggler" aria-expanded="false">
        <span class="navbar-toggler-icon"/>
      </button>

      <div id="navbarToggler" class="collapse navbar-collapse">

        <ul class="navbar-nav ml-auto">
          <li class="nav-item">
            <router-link :to="{ name: 'get-started' }" class="nav-link" active-class="active">
              All Properties
            </router-link>
          </li>

          <!-- Authenticated -->
          <li v-if="user" class="nav-item dropdown">
            <a class="nav-link dropdown-toggle text-dark-off"
               href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <img :src="user.photo_url" class="rounded-circle profile-photo mr-1">
              {{ user.name }}
            </a>
            <div class="dropdown-menu">

              <router-link :to="{ name: 'home' }" class="dropdown-item pl-3">
                <fa icon="layer-group" fixed-width/> Dashboard
              </router-link>

              <div class="dropdown-divider"/>

              <router-link :to="{ name: 'settings.profile' }" class="dropdown-item pl-3">
                <fa icon="user-circle" fixed-width/> Proflie
              </router-link>
              <router-link :to="{ name: 'settings.password' }" class="dropdown-item pl-3">
                <fa icon="lock" fixed-width/> Password
              </router-link>

              <div class="dropdown-divider"/>

              <a href="#" class="dropdown-item pl-3" @click.prevent="logout">
                <fa icon="sign-out-alt" fixed-width/> Logout
              </a>
            </div>
          </li>
          <!-- Guest -->
          <template v-else>
            <li class="nav-item">
              <router-link :to="{ name: 'login' }" class="nav-link" active-class="active">
                {{ $t('login') }}
              </router-link>
            </li>
            <li class="nav-item">
              <router-link :to="{ name: 'register' }" class="nav-link" active-class="active">
                {{ $t('register') }}
              </router-link>
            </li>
          </template>
        </ul>
      </div>
    </div>
  </nav>
</template>

<script>
import { mapGetters } from 'vuex'
import LocaleDropdown from './LocaleDropdown'

export default {
  components: {
    LocaleDropdown
  },

  data: () => ({
    appName: window.config.appName
  }),

  computed: mapGetters({
    user: 'auth/user'
  }),

  methods: {
    async logout () {
      // Log out the user.
      await this.$store.dispatch('auth/logout')

      // Redirect to login.
      this.$router.push({ name: 'login' })
    }
  }
}
</script>

<style scoped>
.profile-photo {
  width: 2rem;
  height: 2rem;
  margin: -.375rem 0;
}
</style>
