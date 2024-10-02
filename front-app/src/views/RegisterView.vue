<template> 
  <div class="register-container">
    <form @submit.prevent="handleRegister" class="register-form">
      <h2>{{ $t('register.title') }}</h2>
      <input type="text" :placeholder="$t('register.namePlaceholder')" v-model="name" required />
      <input type="email" :placeholder="$t('register.emailPlaceholder')" v-model="email" required />
      <input type="password" :placeholder="$t('register.passwordPlaceholder')" v-model="password" required />
      <input type="password" :placeholder="$t('register.passwordConfirmationPlaceholder')" v-model="passwordConfirmation" required />
      <button type="submit">{{ $t('register.submitButton') }}</button>
      <p v-if="errorMessage" class="error-message">{{ errorMessage }}</p>
      <p>
        {{ $t('register.hasAccount') }} <router-link to="/login">{{ $t('register.loginHere') }}</router-link>
      </p>
    </form>
  </div>
</template>

<script>
  import { register } from '@/api';
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
        name: '',
        email: '',
        password: '',
        passwordConfirmation: '',
        errorMessage: ''
      };
    },
    methods: {
      ...mapActions(['setLoading']),
      async handleRegister() {
        

        if (this.password !== this.passwordConfirmation) {
          this.errorMessage = this.$t('error.passwordMismatch');
          return;
        }

        if (this.password.length < 8) {
          this.errorMessage = this.$t('error.passwordAtLeast');
          return;
        }

        this.setLoading(true);
        try {
          const userData = {
            name: this.name,
            email: this.email,
            password: this.password,
            password_confirmation: this.passwordConfirmation
          };
          const data = await register(userData);
          if (data) {
            this.$router.push('/login');
          }
        } catch (error) {
          this.errorMessage = this.$t('register.registerError');
        }
        this.setLoading(false);
      }
    }
  };
</script>

<style scoped>
  .register-container {
    display: flex;
    justify-content: center;
    align-items: center;
    height: 80vh;
  }
  
  .register-form {
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
  