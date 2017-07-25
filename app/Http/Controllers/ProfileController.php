<?php

namespace App\Http\Controllers;

use App\Profile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        $profile = $user->profile;
        return view('user.profile.profile', ['user'=>$user, 'profile'=>$profile]);
    }
    public function operatorIndex()
    {
        return view('operator.user.profile');
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
//        Validate
        $this->validate($request, [
            'name' => 'required|string|max:255',
            'middlename' => 'string|max:255|nullable',
            'lastname' => 'required|string|max:255',
            'phone' => 'required|string|regex:/(0)[0-9]{9}/',
            'passport_id' => 'required|string',
        ]);
//        Update in db
        $user = Auth::user();
        $profile = $user->profile;

        $profile->name = $request->name;
        $profile->middlename = $request->middlename;
        $profile->lastname = $request->lastname;
        $profile->phone = $request->phone;
        $profile->passport_id = $request->passport_id;

        if ($profile->save()){
            \Session::flash('success', 'Profile update!');
            return redirect('/home/profile');
        }
    }
    public function operatorUpdate(Request $request)
    {
//        Validate

        $validator = Validator::make(Input::all(), [
            'name' => 'required|string|max:255',
            'middlename' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'phone' => 'required|string|regex:/(0)[0-9]{9}/',
            'passport_id' => 'required|string',
        ]);

        if ($validator->fails()) {
            return Response::json(['errors' => $validator->getMessageBag()->toArray()], 200);
        }
//        Update in db
        $profile = Profile::where(['id'=>$request->id])->first();

        $profile->name = $request->name;
        $profile->middlename = $request->middlename;
        $profile->lastname = $request->lastname;
        $profile->phone = $request->phone;
        $profile->passport_id = $request->passport_id;

        if ($profile->save()){
            return $profile;
        }
    }


}
