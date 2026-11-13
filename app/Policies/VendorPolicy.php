<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Vendor;

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
