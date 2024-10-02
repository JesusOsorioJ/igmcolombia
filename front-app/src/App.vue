<template>
  <div :class="darkMode ? 'dark-theme' : 'light-theme'" id="app">
    <BackgroundColor />
    <AppSettings />
    <router-view />
    <LoadingColor v-if="loading" />
  </div>
</template>

<script>
import { mapState } from 'vuex'
import AppSettings from './components/AppSettings.vue'
import BackgroundColor from './components/BackgroundColor.vue'
import LoadingColor from './components/LoadingColor.vue'


export default {
  name: 'App',
  components: { AppSettings, BackgroundColor, LoadingColor },
  created() {
    const allowedRoutes = ['/login', '/register', '/notes'];
    if (!allowedRoutes.includes(window.location.pathname)) {
      window.location.href = '/login';
    }
  },
  computed: {
    ...mapState(['darkMode', 'loading']),
  }
}
</script>

<style>
  .light-theme {
    --bg-background-1: #fffefe;
    --bg-background-2:#b8b7b7;
    --bg-textColor: #1b1b1b;
  }

  .dark-theme {
    --bg-background-1: #1b1b1b;
    --bg-background-2:#000000;
    --bg-textColor: #fffefe;

  }

  #app {
    font-family: Avenir, Helvetica, Arial, sans-serif;
    -webkit-font-smoothing: antialiased;
    -moz-osx-font-smoothing: grayscale;
    min-height: 100vh;
    color: var(--bg-textColor);

  }

  input {
    padding: 1rem;
    border: 1px solid #ccc;
    border-radius: 5px;
  }

  select {
    padding: 0.7rem;
    border: 1px solid #ccc;
    border-radius: 5px;
    margin-bottom: 15px;
  }

  button {
    padding: 1rem;
    background-color: #2196F3;
    border: none;
    color:#ffffff;
    border-radius: 5px;
    font-size: 16px;
    font-weight: 600;
    cursor: pointer;
    width: 100%;
  }

  a {
    color: var(--bg-textColor);
    font-weight: 600;

  }

  button:hover {
    background-color: #1976D2;
  }
</style>
