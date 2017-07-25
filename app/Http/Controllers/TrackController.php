<?php

namespace App\Http\Controllers;

use App\Car;
use App\Track;
use App\Ttn;
use Illuminate\Http\Request;

class TrackController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tracks = Track::orderBy('status', 'ASC')->paginate(7);
        return view('logist.track.index', compact('tracks'));
    }
    public function listall()
    {
        $tracks = Track::orderBy('status', 'ASC')
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
        //
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
