<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    protected $fillable = ['name', 'region_id'];


    public function region(){
        return $this->hasOne(Region::class, 'id', 'region_id');
    }

}