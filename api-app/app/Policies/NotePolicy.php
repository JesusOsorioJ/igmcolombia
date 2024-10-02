<?php

namespace App\Policies;

use App\Models\Note;
use App\Models\User;
use Illuminate\Support\Facades\Log;

class NotePolicy
{
    /**
     * Determine if the user can view the note.
     */
    public function view(User $user, Note $note)
    {
        Log::info('User ID: ' . $user->id);
        Log::info('Note User ID: ' . $note->user_id);
        return $user->id === $note->user_id;
    }

    /**
     * Determine if the user can update the note.
     */
    public function update(User $user, Note $note)
    {
        return $user->id === $note->user_id;
    }

    /**
     * Determine if the user can delete the note.
     */
    public function delete(User $user, Note $note)
    {
        return $user->id === $note->user_id;
    }
}
