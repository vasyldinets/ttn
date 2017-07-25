<?php

namespace App\Http\Controllers;

use App\Car;
use App\Track;
use App\Ttn;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;

class TrackController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tracks = Track::orderBy('id', 'DESC')->paginate(7);
        return view('logist.track.index', compact('tracks'));
    }
    public function listall()
    {
        $tracks = Track::orderBy('id', 'DESC')
            ->with('car')
            ->with('toLocation')
            ->with('fromLocation')
            ->with('currentLocation')
            ->paginate(7);
        return $tracks;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('logist.track.create');
    }

    public function find()
    {
        return view('logist.track.find');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->input()['track'];
        $validator = Validator::make(Input::all()['track'],[
            'from' => 'required|integer',
            'to' => 'required|integer',
            'car' => 'required|integer',
        ]);
        if ($validator->fails()) {
            return Response::json(['errors' => $validator->getMessageBag()->toArray()], 200);
        }

        $track = Track::create([
            'from_location_id' => $data['from'],
            'to_location_id' => $data['to'],
            'current_location_id' => $data['from'],
            'car_id' => $data['car'],
            'status' => 'active'
        ]);


//        Update car status & ttns
        if ($track){
            $ttns = [];
            $ttns = Ttn::where(['from_location_id' => $data['from'], 'to_location_id' => $data['to'], 'status' => 'new'])->get();
            foreach ($ttns as $ttn){
                $ttn->track_id = $track->id;
                $ttn->status = 'in_progress';
                $ttn->save();
            }

            $car = Car::where(['id'=>$data['car']])->first();
            $car->status = 'busy';
            $car->save();
        }
        $track->fromLocation;
        $track->toLocation;
        $track->currentLocation;
        return $track;
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Track  $track
     * @return \Illuminate\Http\Response
     */
    public function edit(Track $track)
    {
        return view('logist.track.edit', compact('track'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Track  $track
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Track $track)
    {
        $track->current_location_id = $request->input()['current_location'];
        if ($track->to_location_id == $request->input()['current_location']){
            $track->status = 'done';
//        Car status update
            $car = Car::where(['id'=>$track->car_id])->first();
            $car->status = 'free';
            $car->save();

//        TTN status update
            $ttns = Ttn::where(['track_id'=> $track->id])->get();
            foreach ($ttns as $ttn){
                $ttn->status = 'completed';
                $ttn->save();
            }
        }

        if ($track->save()){
            return $track;
        }
    }

//    Find track
    public function findTrack($track_id){
        $track = Track::where(['id'=>$track_id])
            ->with('car')
            ->with('toLocation')
            ->with('fromLocation')
            ->with('currentLocation')
            ->first();

        return $track;
    }

}
