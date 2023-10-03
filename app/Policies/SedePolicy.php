<?php

namespace App\Policies;

use App\Models\Sede;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class SedePolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        //
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Sede $sede): bool
    {
        return $user->hasPermissionTo('sede index') ? true : false;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasPermissionTo('sede create') ? true : false;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Sede $sede): bool
    {
        return $user->hasPermissionTo('sede update') ? true : false;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Sede $sede): bool
    {
        return $user->hasPermissionTo('sede delete') ? true : false;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Sede $sede): bool
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Sede $sede): bool
    {
        //
    }
}
