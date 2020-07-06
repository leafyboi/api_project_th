<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Seat extends Model
{
    protected $fillable = [
        'zone', 'column', 'row', 'hall_id'
    ];
    public $timestamps = false;

}
