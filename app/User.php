<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Mail;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
         'email', 'password', 'role'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public static function sendWelcomeEmail($user)
    {
        // Generate a new reset password token
        $token = app('auth.password.broker')->createToken($user);

        // Send email
        Mail::send('emails.welcome', ['user' => $user, 'token' => $token], function ($m) use ($user) {
            $m->from('hello@appsite.com', 'Your App Name');
            $m->to($user->email, $user->name)->subject('Welcome to APP');
        });
    }

    public function profile(){
        return $this->hasOne(Profile::class, 'user_id', 'id');
    }
    public function ttn(){
        return $this->hasMany(Ttn::class, 'user_id', 'id');
    }
}
