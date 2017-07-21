<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    protected $fillable = ['name', 'location_id'];


    public function location(){
        return $this->hasOne(Location::class, 'id', 'location_id');
    }

}
