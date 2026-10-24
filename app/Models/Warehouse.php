<?php

namespace App\Models;

use App\Models\Concerns\BelongsToUser;
use Illuminate\Database\Eloquent\Model;

class Warehouse extends Model
{
    use BelongsToUser;

    protected $fillable = ['warehouse_name', 'aisle_number', 'rack_code', 'physical_capacity'];
}
