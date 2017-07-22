<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Track extends Model
{
    protected $fillable = ['from_location_id', 'to_location_id', 'current_location_id', 'car_id', 'status'];

    public function currentLocation(){
        return $this->hasOne(Location::class, 'id', 'current_location_id');
    }
    public function toLocation(){
        return $this->hasOne(Location::class, 'id', 'to_location_id');
    }
    public function fromLocation(){
        return $this->hasOne(Location::class, 'id', 'from_location_id');
    }
    public function car(){
        return $this->hasOne(Car::class, 'id', 'car_id');
    }
}
