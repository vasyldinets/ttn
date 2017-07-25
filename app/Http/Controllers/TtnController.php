<?php

namespace App\Http\Controllers;

use App\Profile;
use App\Ttn;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;

class TtnController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ttns = Ttn::paginate(10);
        return view('user.profile.ttn', compact('ttns'));
    }

    public function userTtn()
    {
        $ttns= Ttn::where(['user_id'=>Auth::user()->id])->paginate(7);
        return view('user.profile.ttn', compact('ttns'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('user.ttn.create');
    }
    public function operatorCreate()
    {
        return view('operator.ttn.create');
    }
    public function operatorFind()
    {
        return view('operator.ttn.find');
    }
    public function unregisterFind()
    {
        return view('unregister.find');
    }


//    Find ttn
    public function find(Request $request)
    {
        $ttn_id = $request->input()['ttn_id'];
        if (!Auth::check() || Auth::user()->role == 'operator'){
            $ttn = Ttn::where(['id'=>$ttn_id])->first();
        } elseif (Auth::user()->role == 'user'){
            $ttn = Ttn::where(['id'=>$ttn_id])->where(function ($query){
                $query -> where('user_id', Auth::user()->id)
                       ->orWhere('recipient_id', Auth::user()->id);
            })->first();
        }
        if ($ttn){
            if (Auth::check()){
                $ttn->sender->profile;
                $ttn->recipient->profile;
            }
            $ttn->fromDepartment->location->region;
            $ttn->toDepartment->location->region;
            if ($ttn->track){
                $ttn->track->currentLocation;
            }
        }
        return $ttn;
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->input()['ttn'];

        $validator = Validator::make(Input::all()['ttn'],[
            'user' => 'boolean',
            'email' => 'required|string|email|max:255',
            'name' => 'required|string|max:255',
            'middlename' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'phone' => 'required|string|regex:/(0)[0-9]{9}/',
            'fromregion' => 'required',
            'fromlocation' => 'required',
            'fromdepartment' => 'required',
            'toregion' => 'required',
            'tolocation' => 'required',
            'todepartment' => 'required',
            'weight' => 'required|integer',
            'width' => 'required|integer',
            'height' => 'required|integer',
            'depth' => 'required|integer',
            'price' => 'required|integer',
        ]);

        if ($validator->fails()) {
            return Response::json(['errors' => $validator->getMessageBag()->toArray()], 200);
        }
        else {
            if ($data['user']){
                $recipient_id = $data['user_id'];
            } else {
                $user = User::create([
                    'email' => $data['email'],
                    'password' => bcrypt(time()),
                    'role' => 'user'
                ]);

                if ($user){
                    $profile = Profile::create([
                        'user_id' => $user->id,
                        'name' => $data['name'],
                        'middlename' => $data['middlename'],
                        'lastname' => $data['lastname'],
                        'phone' => $data['phone'],
                    ]);

                    if (!$profile){
                        $user->destroy($user->id);
                    }
                }
                $recipient_id = $user->id;
            }

            $ttn = Ttn::create([
                'user_id' => Auth::user()->id,
                'recipient_id' => $recipient_id,
                'from_department_id' => $data['fromdepartment'],
                'to_department_id' => $data['todepartment'],
                'from_location_id' => $data['fromlocation'],
                'to_location_id' => $data['tolocation'],
                'weight' => $data['weight'],
                'width' => $data['width'],
                'height' => $data['height'],
                'depth' => $data['depth'],
                'price' => $data['price'],
                'status' => 'new'
            ]);

        }

       return $ttn;
    }

    public function operatorStore(Request $request)
    {
        $data = $request->input()['ttn'];

        $validator = Validator::make(Input::all()['ttn'],[
            'sender_user' => 'boolean',
            'sender_email' => 'required|string|email|max:255',
            'sender_name' => 'required|string|max:255',
            'sender_middlename' => 'required|string|max:255',
            'sender_lastname' => 'required|string|max:255',
            'sender_phone' => 'required|string|regex:/(0)[0-9]{9}/',
            'recipient_user' => 'boolean',
            'recipient_email' => 'required|string|email|max:255',
            'recipient_name' => 'required|string|max:255',
            'recipient_middlename' => 'required|string|max:255',
            'recipient_lastname' => 'required|string|max:255',
            'recipient_phone' => 'required|string|regex:/(0)[0-9]{9}/',
            'fromregion' => 'required',
            'fromlocation' => 'required',
            'fromdepartment' => 'required',
            'toregion' => 'required',
            'tolocation' => 'required',
            'todepartment' => 'required',
            'weight' => 'required|integer',
            'width' => 'required|integer',
            'height' => 'required|integer',
            'depth' => 'required|integer',
            'price' => 'required|integer',
        ]);

        if ($validator->fails()) {
            return Response::json(['errors' => $validator->getMessageBag()->toArray()], 200);
        }
        else {
            if ($data['sender_user']){
                $sender_id = $data['sender_user_id'];
            } else {
                $sender_user = User::create([
                    'email' => $data['sender_email'],
                    'password' => bcrypt(time()),
                    'role' => 'user'
                ]);

                if ($sender_user){
                    $profile = Profile::create([
                        'user_id' => $sender_user->id,
                        'name' => $data['sender_name'],
                        'middlename' => $data['sender_middlename'],
                        'lastname' => $data['sender_lastname'],
                        'phone' => $data['sender_phone'],
                    ]);

                    if (!$profile){
                        $sender_user->destroy($user->id);
                    }
                }
                $sender_id = $sender_user->id;
            }
            if ($data['recipient_user']){
                $recipient_id = $data['recipient_user_id'];
            } else {
                $recipient_user = User::create([
                    'email' => $data['recipient_email'],
                    'password' => bcrypt(time()),
                    'role' => 'user'
                ]);

                if ($recipient_user){
                    $profile = Profile::create([
                        'user_id' => $recipient_user->id,
                        'name' => $data['recipient_name'],
                        'middlename' => $data['recipient_middlename'],
                        'lastname' => $data['recipient_lastname'],
                        'phone' => $data['recipient_phone'],
                    ]);

                    if (!$profile){
                        $recipient_user->destroy($user->id);
                    }
                }
                $recipient_id = $recipient_user->id;
            }

            $ttn = Ttn::create([
                'user_id' => $sender_id,
                'recipient_id' => $recipient_id,
                'from_department_id' => $data['fromdepartment'],
                'to_department_id' => $data['todepartment'],
                'from_location_id' => $data['fromlocation'],
                'to_location_id' => $data['tolocation'],
                'weight' => $data['weight'],
                'width' => $data['width'],
                'height' => $data['height'],
                'depth' => $data['depth'],
                'price' => $data['price'],
                'status' => 'new'
            ]);

        }

        return $ttn;
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Ttn  $ttn
     * @return \Illuminate\Http\Response
     */
    public function show(Ttn $ttn)
    {
        return view('user.ttn.show', compact('ttn'));
    }


//    Select from location for track
    public function cargoFrom(){
        $ttns = Ttn::where(['status'=> 'new'])->get();
        $from_locations = [];
        foreach ($ttns as $ttn){
            if (!in_array($ttn->fromLocationn, $from_locations)){
                $from_locations[] = $ttn->fromLocation;
            }
        }
        return $from_locations;
    }
    public function cargoTo($from_id){
        $ttns = Ttn::where(['status'=> 'new', 'from_location_id'=>$from_id])->get();
        $to_locations = [];
        foreach ($ttns as $ttn){
            if (!in_array($ttn->toLocation, $to_locations)){
                $to_locations[] = $ttn->toLocation;
            }
        }

        return $to_locations;
    }
}
