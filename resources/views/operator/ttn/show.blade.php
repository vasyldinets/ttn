@extends('layouts.ttn')

@section('content')
    <h2>TTN #{{$ttn->id}}</h2>
        <table class="table table-responsive table-bordered table-striped">
            <tr>
                <th>Property</th>
                <th>Value</th>
            </tr>
            <tr>
                <td>Recipient:</td>
                <td>{{$ttn->recipient->profile->name}} {{$ttn->recipient->profile->middlename}} {{$ttn->recipient->profile->lastname}}</td>
            </tr>
            <tr>
                <td>Recipient Phone:</td>
                <td>{{$ttn->recipient->profile->phone}}</td>
            </tr>
            <tr>
                <td>Recipient Email:</td>
                <td>{{$ttn->recipient->email}}</td>
            </tr>
            <tr>
                <td>From:</td>
                <td>{{$ttn->fromDepartment->location->region->name}}, {{$ttn->fromDepartment->location->name}}, {{$ttn->fromDepartment->name}}</td>
            </tr>
            <tr>
                <td>To:</td>
                <td>{{$ttn->toDepartment->location->region->name}}, {{$ttn->toDepartment->location->name}}, {{$ttn->toDepartment->name}}</td>
            </tr>
            <tr>
                <td>Width:</td>
                <td>{{$ttn->weight}}kg</td>
            </tr>
            <tr>
                <td>Price:</td>
                <td>{{$ttn->price}}$</td>
            </tr>
        </table>
    <div class="text-center">
        <a href="{{ URL::previous() }}" class="btn btn-success btn-lg">Back</a>
    </div>
@endsection