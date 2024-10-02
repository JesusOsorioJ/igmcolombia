<template>
  <div class="appsettings">

    <!-- Botón para alternar entre temas -->
    <div class="theme-toggle" @click="toggleDarkMode">
      <div class="switch" :class="{ active: darkMode }">
        <span class="icon">{{ darkMode ? '🌙' : '☀️' }}</span>
      </div>
    </div>

    <!-- Selección de idioma -->
    <div class="logout-selection">

      <div class="language-selection">
        <button 
          v-for="lang in languages" 
          :key="lang.code" 
          :class="{ active: locale === lang.code }" 
          @click="changeLanguage(lang.code)" 
          class="language-button">
          {{ lang.name }}
        </button>
      </div>
      <!-- Mostrar el nombre del usuario -->
      <div class="user-info" v-if="userName">
        <span>{{ userName }}</span>
        <button @click="setLogout" class="logout-button">{{ $t('login.logout')}}</button>
      </div>
    </div>
    
    </div>

</template>

<script>
import { mapState, mapActions } from 'vuex';

export default {
  data() {
    return {
      languages: [
        { code: 'en', name: 'English' },
        { code: 'es', name: 'Español' },
      ],
    };
  },
  computed: {
    ...mapState(['darkMode', 'locale', 'userName']),
  },
  methods: {
    ...mapActions(['toggleDarkMode', 'changeLocale', 'logout']), 
    setLogout() {
      window.location.href = '/login';
      this.logout();
    },
    changeLanguage(langCode) {
      this.$i18n.locale = langCode;
      this.changeLocale(langCode);
    },
  },
};
</script>

<style scoped>
.appsettings {
  display: flex;
  justify-content: space-between;
  align-items:start;
  padding: 1rem;  
}

.user-info {
  display: flex;
  align-items: center;
}

.logout-button {
  margin-left: 1rem;
  background-color: #f44336;
  color: white;
  border: none;
  border-radius: 4px;
  cursor: pointer;
  padding: 0.5rem 1rem;
  transition: background-color 0.3s;
  font-weight: 600;
}

.logout-button:hover {
  background-color: #d32f2f;
}

.theme-toggle {
  cursor: pointer;
  display: flex;
  align-items: center;
}

.switch {
  width: 50px;
  height: 30px;
  background-color: #ccc;
  border-radius: 50px;
  position: relative;
  transition: background-color 0.3s;
  display: flex;
  align-items: center;
  justify-content: flex-start;
  padding-bottom: 3px;
}

.switch.active {
  background-color: #4caf50;
  justify-content: flex-end;
}

.icon {
  font-size: 1.5rem;
  transition: transform 0.3s;
}

.language-selection {
  display: flex;
}

.language-button {
  background: none;
  color: var(--bg-textColor);
  padding: 0.5rem 1rem;
  cursor: pointer;
  font-size: 1rem;
  transition: background-color 0.3s;
  border-radius: 4px;
}

.language-button:hover {
  font-weight: bold;
}

.language-button.active {
  border: 2px solid var(--bg-textColor);
  font-weight: bold;
}

.logout-selection{
  display: flex;
  gap: 30px;
}
</style>
