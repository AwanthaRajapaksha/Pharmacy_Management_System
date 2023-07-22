<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prescription extends Model
{
    use HasFactory;

    protected $fillable = [

        'id',
        'user_id',
        'note',
        'address',
        'prescription_token',
        'delivery_date',
        'delivery_time',
        'image1',
        'image2',
        'image3',
        'image4',
        'image5',
        'states',
        'created_at',

    ];

}
