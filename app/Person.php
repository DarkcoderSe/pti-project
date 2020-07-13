<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Person extends Model
{
    public function Regions(){
        return $this->hasMany(PersonRegion::class, 'person_id');
    }

    public function Committee(){
        return $this->belongsTo(Committee::class);
    }
    //
}
