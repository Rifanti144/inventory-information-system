<?php

namespace App\Models\Concerns;

use App\Models\User;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Auth;

/**
 * Records who created a row ("created by").
 *
 * - user_id is filled in automatically when a record is created.
 * - It no longer hides other users' rows: who may SEE / EDIT / DELETE a record
 *   is now decided by roles (route middleware) and policies (e.g. VendorPolicy).
 */
trait BelongsToUser
{
    protected static function bootBelongsToUser(): void
    {
        static::creating(function ($model) {
            if (Auth::check() && ! $model->user_id) {
                $model->user_id = Auth::id();
            }
        });
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
