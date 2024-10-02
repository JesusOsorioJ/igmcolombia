<template>
  <div class="note-view">
    <div class="note-layout">
      <h2>{{ $t('note.notes') }}</h2>
      <div class="sort-box">
        <button @click="openNoteForm()" class="create-button">{{ $t('note.createNote') }}</button>    
        <select id="sortOrder" v-model="sortOrder" @change="fetchNotes">
          <option value="created_at.asc">{{ $t('note.sortCreatedAsc') }}</option>
          <option value="created_at.desc">{{ $t('note.sortCreatedDesc') }}</option>
          <option value="expirationDate.asc">{{ $t('note.sortExpirationAsc') }}</option>
          <option value="expirationDate.desc">{{ $t('note.sortExpirationDesc') }}</option>
        </select>
      </div>
      <NoteList :notes="notes" @edit="openNoteForm" @delete="confirmDeleteNote" />
      <NoteForm v-if="isNoteFormVisible" 
                :note="selectedNote" 
                @save="saveNote" 
                @close="closeNoteForm" 
      />
    </div>
  </div>
</template>

<script>
  import NoteList from '@/components/NoteList.vue'
  import NoteForm from '@/components/NoteForm.vue'
  import { getNotes, deleteNote } from '@/api'
  import { mapState } from 'vuex';

  export default {
    components: {
      NoteList,
      NoteForm
    },
    computed: {
      ...mapState(['token']),
    },
    created() {
      if (!this.token) {
        window.location.href = '/login';
      }
    },

    data() {
      return {
        notes: [],
        isNoteFormVisible: false,
        selectedNote: null,
        sortOrder: 'created_at.desc',
      }
    },
    methods: {
      async fetchNotes() {
        try {
          this.notes = await getNotes(this.sortOrder.split('.')[0], this.sortOrder.split('.')[1]);
        } catch (error) {
          console.error('Error al cargar las notas:', error);
        }
      },
      openNoteForm(note = null) {
        this.selectedNote = note ? { ...note } : null;
        this.isNoteFormVisible = true;
      },
      closeNoteForm() {
        this.isNoteFormVisible = false;
      },
      confirmDeleteNote(id) {
        if (confirm(this.$t('note.confirmDelete'))) {
          this.deleteNote(id);
        }
      },
      async deleteNote(id) {
        try {
          await deleteNote(id);
          this.fetchNotes();
        } catch (error) {
          console.error('Error al eliminar la nota:', error);
        }
      },
      resetSortOrder() {
        this.sortOrder = 'created_at.desc';
        this.fetchNotes();
      }
    },
    mounted() {
      this.fetchNotes();
    }
  }
</script>

<style scoped>
  .note-view {
    display: flex;
    justify-content: center;
    align-items: center;
    padding-top: 30px;
  }

  .note-layout{
    width: 80%;
  }

  .clear-button {
    background-color: #f44336;
    color: white;
    padding: 0.5rem 1rem;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    margin-left: 1rem;
  }

  .clear-button:hover {
    background-color: #d32f2f;
  }

  .create-button {
    background-color: #4CAF50;
    color: white;
    padding: 0.7rem 1.5rem;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    margin-bottom: 1rem;
    width: fit-content;
  }

  .create-button:hover {
    background-color: #45A049;
  }

  .sort-box{
    display: flex;
    align-items: center;
    gap: 20px;
  }
</style>
