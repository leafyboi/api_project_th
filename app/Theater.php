<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Theater extends Model
{
    protected $fillable = [
        'name', 'description', 'address', 'logo', 'photo', 'preview', 'cash_desk_phone_number', 'phone_number_for_reference', 'contacts'
    ];

    protected $hidden = [
        'created_at', 'updated_at'
    ];

    public function event()
    {
        return $this->hasOne('App\Event');
    }
}
