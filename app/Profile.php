<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $fillable = [ 'user_id', 'name', 'middlename', 'lastname', 'phone', 'passport_id'];
}
