<?php

namespace App\Models;

use App\Models\Concerns\BelongsToUser;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use BelongsToUser;

    public const CATEGORIES = ['Electronics', 'Mechanical Parts', 'Raw Materials', 'Consumables', 'Packaging'];

    protected $fillable = ['item_name', 'tech_spec', 'unit_size', 'category'];
}
