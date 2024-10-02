import { createI18n } from 'vue-i18n';

const messages = {
  en: {
    login: {
      title: 'Login',
      logout: 'Logout',
      emailPlaceholder: 'Email',
      passwordPlaceholder: 'Password',
      submitButton: 'Login',
      noAccount: 'Don\'t have an account?',
      registerHere: 'Register here',
      invalidCredentials: 'Invalid email or password',
      loginError: 'Error logging in'
    },
    register: {
      title: 'Register',
      namePlaceholder: 'Name',
      emailPlaceholder: 'Email',
      passwordPlaceholder: 'Password',
      passwordConfirmationPlaceholder: "Password confirmation",
      submitButton: 'Create Account',
      hasAccount: 'Already have an account?',
      loginHere: 'Login here',
      registerError: 'Error registering. Please try again.'
    },
    note: {
      notes: 'Note List',
      createNote: 'Create note',
      editNote: 'Create note',
      title: 'Title',
      description: 'Description',
      tags: 'Tags',
      expirationDate: 'Expiration date',
      creationDate: 'Creation date',
      save: 'Save',
      update: 'Update',
      close: 'Close',
      edit: 'Edit',
      delete: 'Delete',
      actions: "Actions",
      sortCreatedAsc: "By Creation Date Ascending",
      sortCreatedDesc: "By Creation Date Descending",
      sortExpirationAsc: "By Expiration Date Ascending",
      sortExpirationDesc: "By Expiration Date Descending",
      confirmDelete: "Are you sure you want to delete this note?",
      noRecords: "No hay registros aún"
    },
    error: {
      loginError: "Login error",
      invalidCredentials: "Invalid credentials",
      passwordMismatch: "Password mismatch",
      registerError: "Register error",
      passwordAtLeast: "The password field must be at least 8 characters"
    }
  },
  es: {
    login: {
      title: 'Iniciar Sesión',
      logout: 'Salir',
      emailPlaceholder: 'Correo Electrónico',
      passwordPlaceholder: 'Contraseña',
      submitButton: 'Ingresar',
      noAccount: '¿No tienes cuenta?',
      registerHere: 'Regístrate aquí',
      invalidCredentials: 'Usuario o contraseña inválidos',
      loginError: 'Error al iniciar sesión'
    },
    register: {
      title: 'Registrarse',
      namePlaceholder: 'Nombre',
      emailPlaceholder: 'Correo Electrónico',
      passwordPlaceholder: 'Contraseña',
      passwordConfirmationPlaceholder: "Confirmar contraseña",
      submitButton: 'Crear cuenta',
      hasAccount: '¿Ya tienes cuenta?',
      loginHere: 'Inicia sesión aquí',
      registerError: 'Error al registrarse. Intenta de nuevo.'
    },
    note: {
      notes: 'Lista de notas',
      createNote: 'Crear nota',
      editNote: 'Crear nota',
      title: 'Título',
      description: 'Descripción',
      tags: 'Etiquetas',
      expirationDate: 'Fecha de Vencimiento',
      creationDate: 'Fecha de creacion',
      save: 'Guardar',
      update: 'Actualizar',
      close: 'Cerrar',
      delete: 'Eliminar',
      edit: 'Editar',
      actions: "Acciones",
      sortCreatedAsc: "Por Fecha de Creación Ascendente",
      sortCreatedDesc: "Por Fecha de Creación Descendente",
      sortExpirationAsc: "Por Fecha de Vencimiento Ascendente",
      sortExpirationDesc: "Por Fecha de Vencimiento Descendente",
      confirmDelete: "¿Estás seguro de que deseas eliminar esta nota?",
      noRecords: "No hay registros aún"
    },
    error: {
      loginError: "Error de inicio de sesión",
      invalidCredentials: "Credenciales no válidas",
      passwordMismatch: "La contraseña no coincide",
      registerError: "Error de registro",
      passwordAtLeast: "La contraseña debe tener al menos 8 caracteres."
    }
  }
};

const i18n = createI18n({
  locale: 'en', 
  fallbackLocale: 'en',
  messages,
});

export default i18n;