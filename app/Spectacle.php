<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Spectacle extends Model
{
    protected $fillable = [
        'name', 'description', 'rate', 'duration', 'year', 'poster', 'trailer', 'slider_poster', 'theater_id'
    ];

    protected $hidden = [
        'created_at', 'updated_at'
    ];

    public function event()
    {
        return $this->hasOne('App\Event');
    }

    public function bookmark()
    {
        return $this->belongsTo('App\Bookmark');
    }
}
