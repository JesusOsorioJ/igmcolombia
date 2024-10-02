<template>
  <div class="modal-overlay">
    <div class="modal-content">
      <h2 v-if="localNote && localNote.id">{{ $t('note.editNote') }} #{{ localNote.id }}</h2>
      <h2 v-else>{{ $t('note.createNote') }}</h2>
      <form @submit.prevent="saveNote" class="form-content">
        <input v-model="localNote.title" :placeholder="$t('note.title')" required />
        <textarea v-model="localNote.description" :placeholder="$t('note.description')" required></textarea>
        <input v-model="localNote.tags" :placeholder="$t('note.tags')" />
        <input type="date" v-model="localNote.expirationDate" />
        <div class="button-content">
          <button @click="$emit('close')" type="button" class="close-button">{{ $t('note.close') }}</button>
          <button type="submit">{{ localNote && localNote.id ? $t('note.update') : $t('note.save') }}</button>
        </div>
      </form>
    </div>
  </div>
</template>

<script>
import { createNote, updateNote } from '@/api';
import { mapActions } from 'vuex';

export default {
  props: {
    note: {
      type: Object,
      default: () => ({ title: '', description: '', tags: '', expirationDate: '', image: null })
    }
  },
  data() {
    return {
      localNote: { ...this.note }
    };
  },
  watch: {
    note: {
      handler(newNote) {
        this.localNote = { ...newNote };
      },
      deep: true,
    }
  },
  methods: {
    ...mapActions(['setLoading']),

    async saveNote() {
      this.setLoading(true);
      try {
        if (this.localNote.id) {
          await updateNote(this.localNote.id, {
            title: this.localNote.title,
            description: this.localNote.description,
            tags: this.localNote.tags,
            imagenUrl: "https://example.com/imagen.jpg",
            expirationDate: this.localNote.expirationDate,
          });
        } else {
          await createNote({
            title: this.localNote.title,
            description: this.localNote.description,
            tags: this.localNote.tags,
            imagenUrl: "https://example.com/imagen.jpg",
            expirationDate: this.localNote.expirationDate,
          });
        }
        window.location.href = '/notes';
        this.$emit('saveNote');
        this.$emit('close');
      } catch (error) {
        console.error(error);
      }
      this.setLoading(false);

    },
    handleFileUpload(event) {
      const file = event.target.files[0];
      this.localNote.image = file;
    },
  }
}
</script>

<style scoped>
.modal-overlay {
  position: fixed;
  top: 0;
  left: 0;
  width: 100vw;
  height: 100%;
  overflow: auto;
  background: rgba(0, 0, 0, 0.5);
  display: flex;
  justify-content: center;
  align-items: center;
}

.modal-content {
  background: var(--bg-background-1);;
  padding: 3rem;
  margin: 40px;
  border-radius: 10px;
  max-width: 500px;
  width: 100%;
  box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
}

.form-content{
  display: flex;
  flex-direction: column;
  justify-content: center;
  align-items: center;
  gap: 15px;
}

.button-content{
  display: flex;
  width: 100%;
  justify-content: space-between;
}

input, textarea {
  width: 100%;
  padding: 0.8rem;
  border: 1px solid #ddd;
  border-radius: 5px;
}

button {
  padding: 1rem;
  background-color: #4CAF50;
  color: white;
  border: none;
  border-radius: 5px;
  cursor: pointer;
  width: fit-content;
}

button:hover {
  background-color: #45A049;
}

.close-button {
  background-color: #F44336;
}

.close-button:hover {
  background-color: #D32F2F;
}


</style>
  