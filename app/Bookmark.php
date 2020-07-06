<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bookmark extends Model
{
    protected $fillable = [
        'user_id', 'spectacle_id'
    ];

    public function spectacle()
    {
        return $this->belongsTo('App\Spectacle');
    }
}
