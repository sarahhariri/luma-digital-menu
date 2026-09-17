<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
#[Fillable ([
    'cafe_name',
    'tagline',
    'address',
    'phone',
    'whatsapp',
    'instagram',
    'opening_hours',
    'maps_url'
])
]
class CafeSetting extends Model
{
    //
}
