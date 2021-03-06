<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VolunteerInformation extends Model
{
    public function user()
    {
        return $this->hasOne('App\User','id','userid');
    }
}