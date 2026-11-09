<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Vendor;

/**
 * Action-level rules for the Vendor module.
 *
 *            | view list | create | edit            | delete
 *  admin     |    yes    |  yes   | any vendor      | any vendor
 *  staff     |    yes    |  yes   | only their own  | no
 *  viewer    |    yes    |  no    | no              | no
 */
class VendorPolicy
{
    public function viewAny(User $user): bool
    {
        return true;
    }

    public function create(User $user): bool
    {
        return $user->hasRole(User::ROLE_ADMIN, User::ROLE_STAFF);
    }

    public function update(User $user, Vendor $vendor): bool
    {
        if ($user->isAdmin()) {
            return true;
        }

        return $user->hasRole(User::ROLE_STAFF) && $vendor->user_id === $user->id;
    }

    public function delete(User $user, Vendor $vendor): bool
    {
        return $user->isAdmin();
    }
}
