<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\Response;

class UserPolicy
{


    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return  $user->email === 'nazlinurakyol@yahoo.com';
    }

    public function edit(User $user, User $model): bool
    {
        return  $user->email === 'nazlinurakyol@yahoo.com' || $user->email === $model->email;
    }

    public function show(User $user, User $model): bool
    {
        return true;
    }

}
