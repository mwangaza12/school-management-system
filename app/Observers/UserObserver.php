<?php

namespace App\Observers;

use App\Models\Student;
use App\Models\User;
use App\Models\Teacher;

class UserObserver
{
    /**
     * Handle the User "created" event.
     */
    public function created(User $user)
    {
        if ($user->role === 'teacher') {
            Teacher::create([
                'user_id' => $user->id,
                // Add other necessary fields here
            ]);
        }elseif($user->role === 'student'){
            Student::create([
                'user_id' => $user->id,
                // Add other necessary fields here
            ]);
        }
    }

    /**
     * Handle the User "updated" event.
     */
    public function updated(User $user): void
    {
        //
    }

    /**
     * Handle the User "deleted" event.
     */
    public function deleted(User $user): void
    {
        //
    }

    /**
     * Handle the User "restored" event.
     */
    public function restored(User $user): void
    {
        //
    }

    /**
     * Handle the User "force deleted" event.
     */
    public function forceDeleted(User $user): void
    {
        //
    }
}
