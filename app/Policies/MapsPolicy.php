<?php

namespace App\Policies;

use App\Models\Maps;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class MapsPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasRole(['super-admin', 'marketing']) && $user->can('view-maps');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Maps $maps): bool
    {
        return $user->hasRole(['super-admin', 'marketing']) && $user->can('view-maps');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasRole(['super-admin', 'marketing']) && $user->can('create-maps');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Maps $maps): bool
    {
        return $user->hasRole(['super-admin', 'marketing']) && $user->can('update-maps');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Maps $maps): bool
    {
        return $user->hasRole(['super-admin', 'marketing']) && $user->can('delete-maps');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Maps $maps): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Maps $maps): bool
    {
        return false;
    }
}
