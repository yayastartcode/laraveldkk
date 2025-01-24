<?php

namespace App\Models;

use MongoDB\Laravel\Eloquent\Model;

class Appointment extends Model
{
    protected $connection = 'mongodb';
    protected $collection = 'appointments';

    protected $fillable = [
        'name',
        'email',
        'phone',
        'service',
        'preferred_date',
        'preferred_time',
        'message',
        'status' // pending, confirmed, completed, cancelled
    ];

    protected $casts = [
        'preferred_date' => 'date',
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];
}
