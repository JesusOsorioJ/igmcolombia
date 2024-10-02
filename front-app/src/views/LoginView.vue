<template>
  <div class="login-container">
    <form @submit.prevent="handleLogin" class="login-form">
      <h2>{{ $t('login.title') }}</h2>
      <input type="email" :placeholder="$t('login.emailPlaceholder')" v-model="email" required />
      <input type="password" :placeholder="$t('login.passwordPlaceholder')" v-model="password" required />
      <button type="submit">{{ $t('login.submitButton') }}</button>
      <p v-if="errorMessage" class="error-message">{{ errorMessage }}</p>
      <p>
        {{ $t('login.noAccount') }} <router-link to="/register">{{ $t('login.registerHere') }}</router-link>
      </p>
    </form>
  </div>
</template>

<script>
import { login } from '@/api';
import { mapActions, mapState } from 'vuex';

export default {
  computed: {
    ...mapState(['token']),
  },
  created() {
    if (this.token) {
      window.location.href = '/notes';
    }
  },
  data() {
    return {
      email: '',
      password: '',
      errorMessage: ''
    };
  },
  methods: {
    ...mapActions(['setToken', 'setLoading']),
    async handleLogin() {
      this.setLoading(true);
      try {
        const data = await login(this.email, this.password);
        if (data.token) {
          console.log({data})
          this.setToken({
            token: data.token,
            username: this.email
          });
          window.location.href = '/notes';
        } else {
          this.errorMessage = this.$t('login.loginError');
        }
      } catch (error) {
        this.errorMessage = this.$t('login.invalidCredentials');
      }
      this.setLoading(false);
    }
  }
};
</script>

<style scoped>
.login-container {
  display: flex;
  justify-content: center;
  align-items: center;
  height: 80vh;
}

.login-form {
  background-color: var(--bg-background-1);
  padding: 2rem;
  border-radius: 10px;
  box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
  width: 100%;
  max-width: 500px;
  text-align: center;
  display: flex;
  flex-direction: column;
  gap: 20px;
}

.error-message {
  color: red;
  font-weight: bold;
}
</style>
