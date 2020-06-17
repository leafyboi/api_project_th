<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Hall extends Model
{
    protected $fillable = [
        'name', 'scheme', 'capacity', 'theater_id'
    ];

    protected $hidden = [
        'created_at', 'updated_at'
    ];

    public function event()
    {
        return $this->hasOne('App\Event');
    }
}
