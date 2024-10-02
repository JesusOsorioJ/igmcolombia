import axios from 'axios';
import store from '@/store';

const API_URL = process.env.VUE_APP_API_URL;
const authApi = axios.create({ baseURL: API_URL});
authApi.interceptors.request.use(async (config) => {
  const token = store.state.token;
  if (token) {
    config.headers.Authorization = `Bearer ${token}`;
  }
  config.headers.Authorization = `Bearer ${token}`;
  config.headers["Content-Type"] = "application/json";
  config.headers["access-control-allow-origin"] = "*";
  return config;
});

export const login = async (email, password) => {
  try {
    const response = await axios.post(`${API_URL}/login`, {
      email,
      password
    });
    return response.data;
  } catch (error) {
    return null;
  }
};

export const register = async (userData) => {
  try {
    const response = await axios.post(`${API_URL}/register`, userData);
    return response.data;
  } catch (error) {
    throw new Error('Error en el registro');
  }
};

export const createNote = async (noteData) => {
  try {
    const response = await authApi.post(`${API_URL}/notes`, noteData);
    return response.data;
  } catch (error) {
    throw new Error('Error al crear la nota');
  }
};

export const getNotes = async (orderBy = 'created_at', orderIn = 'asc') => {
  try {
    const response = await authApi.get(`${API_URL}/notes?orderBy=${orderBy}&orderIn=${orderIn}`);
    return response.data;
  } catch (error) {
    throw new Error('Error al obtener las notas');
  }
};

export const updateNote = async (id, noteData) => {
  try {
    const response = await authApi.put(`${API_URL}/notes/${id}`, noteData);
    return response.data;
  } catch (error) {
    throw new Error('Error al actualizar la nota');
  }
};

export const deleteNote = async (id) => {
  try {
    const response = await authApi.delete(`${API_URL}/notes/${id}`);
    return response.data;
  } catch (error) {
    throw new Error('Error al eliminar la nota');
  }
};