<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $fillable = [
        'dated_at', 'description', 'is_premiere', 'is_chosen_for_main_page', 'available_seats_number', 'spectacle_id', 'hall_id', 'theater_id'
    ];

    protected $hidden = [
        'created_at', 'updated_at'
    ];

    public function spectacle()
    {
        return $this->belongsTo('App\Spectacle');
    }

    public function hall()
    {
        return $this->belongsTo('App\Hall');
    }

    public function theater()
    {
        return $this->belongsTo('App\Theater');
    }
}
