@extends('layouts.ttn')

@section('content')
            <h1>All Track</h1>
            <div class="pull-right">
                <a href="/logist/track/create" class="btn btn-success btn-lg">Create new Track</a>
            </div>
            <div class="clearfix"></div>
            <br>
            <table class="table table-bordered table-striped table-responsive">
                <tr>
                    <th>{{__('Track Number')}}</th>
                    <th>{{__('From Location')}}</th>
                    <th>{{__('To Location')}}</th>
                    <th>{{__('Current Location')}}</th>
                    <th>{{__('Create at')}}</th>
                    <th>{{__('Status')}}</th>
                    <th>{{__('Edit')}}</th>
                </tr>
                @foreach($tracks as $track)
                    <tr>
                        <td>{{$track->id}}</td>
                        <td>{{$track->fromLocation->name}}</td>
                        <td>{{$track->toLocation->name}}</td>
                        <td>{{$track->currentLocation->name}}</td>
                        <td>{{$track->created_at}}</td>
                        <td>{{$track->status}}</td>
                        <td>
                            <a href="/logist/track/edit/{{$track->id}}" class="btn btn-xs btn-warning"><i class="fa fa-edit"></i></a>
                        </td>
                    </tr>
                @endforeach
            </table>
            <div class="text-center">
                {{$tracks->links()}}
            </div>
@endsection