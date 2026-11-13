<?php

namespace App\Models;

use App\Models\Concerns\BelongsToUser;
use Illuminate\Database\Eloquent\Model;

class Vendor extends Model
{
    use BelongsToUser;

    public const LEGALITIES = ['PT', 'CV', 'Firma'];

    protected $fillable = ['vendor_name', 'office_address', 'company_legality', 'pic_name', 'pic_contact'];
}
