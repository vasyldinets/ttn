<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    protected $fillable = ['car_number', 'car_model', 'carrying_capacity', 'status'];
}
