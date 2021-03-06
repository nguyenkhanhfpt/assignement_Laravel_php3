<?php

namespace App\Policies;

use App\User;
use App\Wishlist;
use Illuminate\Auth\Access\HandlesAuthorization;

class WishlistPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        //
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\User  $user
     * @param  \App\Wishlist  $wishlist
     * @return mixed
     */
    public function view(User $user, Wishlist $wishlist)
    {
        //
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\User  $user
     * @param  \App\Wishlist  $wishlist
     * @return mixed
     */
    public function update(User $user, Wishlist $wishlist)
    {
        //
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\User  $user
     * @param  \App\Wishlist  $wishlist
     * @return mixed
     */
    public function delete(User $user, Wishlist $wishlist)
    {
        return $user->id == $wishlist->member_id;
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\User  $user
     * @param  \App\Wishlist  $wishlist
     * @return mixed
     */
    public function restore(User $user, Wishlist $wishlist)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\User  $user
     * @param  \App\Wishlist  $wishlist
     * @return mixed
     */
    public function forceDelete(User $user, Wishlist $wishlist)
    {
        //
    }
}
