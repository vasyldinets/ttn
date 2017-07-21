<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Track extends Model
{
    protected $fillable = ['from_location_id', 'to_location_id', 'current_location_id', 'car_id'];

    public function currentLocation(){
        return $this->hasOne(Location::class, 'id', 'current_location_id');
    }
}
