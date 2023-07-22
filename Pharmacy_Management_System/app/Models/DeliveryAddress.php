<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeliveryAddress extends Model
{
    public function prescription()
    {
        return $this->belongsTo(Prescription::class);
    }
}
