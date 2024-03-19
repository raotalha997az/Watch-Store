<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Store extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'address',
        'contact_person',
        'country_id',
        'city_id',
        'landmark_id',
        'created_at',
        'updated_at',
    ];
}
