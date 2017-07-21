<?php

namespace App\Http\Controllers\Auth;

use App\Profile;
use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Auth\Events\Registered;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|string|max:255',
            'middlename' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'passport_id' => 'required|string',
            'phone' => 'required|string|regex:/(0)[0-9]{9}/',
            'email' => 'required|string|email|max:255',
            'password' => 'required|string|min:6|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        $user = User::where('email', '=', $data['email'])->first();
        if ($user === null) {
            // user doesn't exist
            $user = User::create([
                'email' => $data['email'],
                'password' => bcrypt($data['password']),
                'role' => 'user'
            ]);

            if ($user){
                $profile = Profile::create([
                    'user_id' => $user->id,
                    'name' => $data['name'],
                    'middlename' => $data['middlename'],
                    'lastname' => $data['lastname'],
                    'passport_id' => $data['passport_id'],
                    'phone' => $data['phone'],
                ]);

                if ($profile){
                    return  $user;
                } else {
                    $user->destroy($user->id);
                }
            }
        } else {
            User::sendWelcomeEmail($user);
        }
        return $user;

    }
    public function register(Request $request)
    {
        $this->validator($request->all())->validate();

        event(new Registered($user = $this->create($request->all())));


        if ($user->wasRecentlyCreated){
            return redirect('/login')->with('status', __('Registration complete successful! You can login now!'));
        }

        return redirect('/login')->with('warning', __('You profile already exist in our system. Check your email, we send instruction for the next step!'));
    }
}
