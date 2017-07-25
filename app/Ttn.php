<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ttn extends Model
{
    protected $fillable = [ 'user_id', 'recipient_id', 'from_department_id', 'to_department_id', 'from_location_id', 'to_location_id', 'track_id', 'weight', 'width', 'depth', 'height', 'price', 'status'];


    public function fromDepartment(){
        return $this->hasOne(Department::class, 'id', 'from_department_id');
    }
    public function toDepartment(){
        return $this->hasOne(Department::class, 'id', 'to_department_id');
    }
    public function fromLocation(){
        return $this->hasOne(Location::class, 'id', 'from_location_id');
    }
    public function toLocation(){
        return $this->hasOne(Location::class, 'id', 'to_location_id');
    }
    public function sender(){
        return $this->hasOne(User::class, 'id', 'user_id');
    }
    public function recipient(){
        return $this->hasOne(User::class, 'id', 'recipient_id');
    }
    public function track(){
        return $this->hasOne(Track::class, 'id', 'track_id');
    }
}
