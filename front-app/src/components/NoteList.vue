<template>
  <p v-if="notes.length === 0">
    {{ $t('note.noRecords') }}
  </p>
  <table class="note-table" v-if="notes.length > 0">
    <thead>
      <tr>
        <th>ID</th>
        <th>{{ $t('note.title') }}</th>
        <th>{{ $t('note.description') }}</th>
        <th>{{ $t('note.tags') }}</th>
        <th>{{ $t('note.expirationDate') }}</th>
        <th>{{ $t('note.creationDate') }}</th>
        <th>{{ $t('note.actions') }}</th>
      </tr>
    </thead>
    <tbody>
      <tr v-for="note in notes" :key="note.id">
        <td>{{ note.id }}</td>
        <td>{{ note.title }}</td>
        <td>{{ note.description }}</td>
        <td>{{ note.tags }}</td>
        <td>{{ note.expirationDate }}</td>
        <td>{{ note.created_at }}</td>
        <td>
          <div class="buttonEdit">
            <button @click="$emit('edit', note)" class="edit-button">{{ $t('note.edit') }}</button>
            <button @click="$emit('delete', note.id)" class="delete-button">{{ $t('note.delete') }}</button>
          </div>
        </td>
      </tr>
    </tbody>
  </table>
  <div class="note-container" v-if="notes.length > 0">
    <div class="note-grid">
      <div v-for="note in notes" :key="note.id" class="note-card">
        
          <div class="note-actions">
            <button @click="$emit('edit', note)" class="edit-button">{{ $t('note.edit') }}</button>
            <button @click="$emit('delete', note.id)" class="delete-button">{{ $t('note.delete') }}</button>
          </div>
       
        <div class="note-body">
          <div><strong>ID:</strong> {{ note.id }}</div>

            <div><strong>{{ $t('note.title') }}:</strong> {{ note.title }}</div>
            <div><strong>{{ $t('note.description') }}:</strong> {{ note.description }}</div>
            <div><strong>{{ $t('note.tags') }}:</strong> {{ note.tags }}</div>
            <div><strong>{{ $t('note.expirationDate') }}:</strong> {{ note.expirationDate }}</div>
            <div><strong>{{ $t('note.creationDate') }}:</strong> {{ note.created_at }}</div>
        
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  props: {
    notes: Array
  }
}
</script>

<style scoped>
  .note-table {
      display: none;
  }
  @media (min-width: 1250px) {
    .note-table {
      display: block;
      width: 100%;
      border-collapse: collapse;
    }
  }
  
  .note-table th, .note-table td {
    padding: 0.5rem;
    text-align: left;
    border: 1px solid var(--bg-textColor);
  }

  .note-table th {
    background-color: var(--bg-background-2);
  }

  .edit-button, .delete-button {
    padding: 0.5rem 1rem;
    border: none;
    border-radius: 5px;
    cursor: pointer;
  }

  .edit-button {
    background-color: #2196F3;
    color: white;
  }

  .edit-button:hover {
    background-color: #1976D2;
  }

  .delete-button {
    background-color: #F44336;
    color: white;
    margin-left: 0.5rem;
  }

  .delete-button:hover {
    background-color: #D32F2F;
  }

  .buttonEdit{
    display: flex;
    gap: 10px;
  }

  .note-container {
    width: 100%;
  }
  @media (min-width: 1250px) {
    .note-container {
      display: none;
    }
  }

  .note-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
    gap: 20px;
  }

  .note-card {
    background-color: var(--bg-background-1);
    border: 1px solid var(--bg-textColor);
    border-radius: 10px;
    padding: 1rem;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    display: flex;
    flex-direction: column;
  }

  .note-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
  }

  .note-body {
    margin-top: 10px;
  }

  .note-description {
    margin: 0;
  }

  .note-actions {
    display: flex;
    margin: 10px;
    gap: 10px;
  }

  .edit-button,
  .delete-button {
    padding: 0.5rem 1rem;
    border: none;
    border-radius: 5px;
    cursor: pointer;
  }

  .edit-button {
    background-color: #2196F3;
    color: white;
  }

  .edit-button:hover {
    background-color: #1976D2;
  }

  .delete-button {
    background-color: #F44336;
    color: white;
    margin-left: 0.5rem;
  }

  .delete-button:hover {
    background-color: #D32F2F;
  }
</style>
