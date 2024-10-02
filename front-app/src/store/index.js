import { createStore } from 'vuex';

export default createStore({
  state: {
    darkMode: JSON.parse(localStorage.getItem('darkMode')) || false,
    locale: localStorage.getItem('locale') || 'en',                 
    token: localStorage.getItem('token') || null,                   
    userName: localStorage.getItem('username') || null,
    loading: false,
    errorMessage: '',
  },
  mutations: {
    toggleDarkMode(state) {
      state.darkMode = !state.darkMode;
      localStorage.setItem('darkMode', JSON.stringify(state.darkMode));
    },
    setLocale(state, locale) {
      state.locale = locale;
      localStorage.setItem('locale', locale);
    },
    setToken(state, data) {
      state.token = data.token;
      state.username = data.username;
      localStorage.setItem('token', data.token);
      localStorage.setItem('username', data.username);
    },
    logout(state) {
      state.token = null;
      localStorage.removeItem('token');
      localStorage.removeItem('username');                                              
    },
    setLoading(state, data) {
      state.loading = data;
      localStorage.setItem('loading', data);                                             
    },
  },
  actions: {
    toggleDarkMode({ commit }) {
      commit('toggleDarkMode');
    },
    changeLocale({ commit }, locale) {
      commit('setLocale', locale);
    },
    setToken({ commit }, token) {
      commit('setToken', token);
    },
    logout({ commit }) {
      commit('logout');
    },
    setLoading({ commit }, value) {
      commit('setLoading', value);
    },
  },
});
