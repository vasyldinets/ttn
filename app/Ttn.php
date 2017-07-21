<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ttn extends Model
{
    protected $fillable = [ 'user_id', 'recipient_id', 'from_department_id', 'to_department_id', 'track_id', 'weight', 'width', 'depth', 'height', 'price', 'status'];


    public function fromDepartment(){
        return $this->hasOne(Department::class, 'id', 'from_department_id');
    }
    public function toDepartment(){
        return $this->hasOne(Department::class, 'id', 'to_department_id');
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
