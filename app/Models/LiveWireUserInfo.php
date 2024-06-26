<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LiveWireUserInfo extends Model
{
    use HasFactory;
    protected $fillable = [
        'first_name',
        'last_name',
        'address', 'city',
        'country', 'dob',
        'is_previously_married',
        'is_widow',
        'country_of_marriage',
        'dom'
    ];
}
