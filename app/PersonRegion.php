<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PersonRegion extends Model
{
    public function Region(){
        return $this->belongsTo(Region::class);
    }
    //
}
