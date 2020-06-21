<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Region extends Model
{
    public function Parent(){
        return $this->belongsTo(Region::class, 'parent_id');
    }
    public function Childs(){
        return $this->hasMany(Region::class, 'parent_id');
    }
    //
}
