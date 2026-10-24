<?php

namespace App\Models\Concerns;

use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Auth;

/**
 * Makes a model private to the logged-in user.
 *
 * - Every query is automatically filtered by user_id (no admin, no shared data).
 * - user_id is filled in automatically when a record is created.
 * - Route-model binding uses the same scope, so opening another user's record returns 404.
 * - If nobody is logged in the scope returns nothing (fails closed).
 */
trait BelongsToUser
{
    protected static function bootBelongsToUser(): void
    {
        static::addGlobalScope('owner', function (Builder $builder) {
            $table = $builder->getModel()->getTable();

            if (Auth::check()) {
                $builder->where("{$table}.user_id", Auth::id());
            } else {
                $builder->whereRaw('1 = 0');
            }
        });

        static::creating(function ($model) {
            if (Auth::check()) {
                $model->user_id = Auth::id();
            }
        });
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
