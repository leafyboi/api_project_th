<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    protected $fillable = [
        'price', 'event_id', 'hall_id', 'is_bought'
    ];

    protected $hidden = [
        'local_id', 'created_at', 'updated_at'
    ];
}
