@extends('layouts.ttn')

@section('content')
            <h1>My TTN</h1>
            <div class="pull-right">
                <a href="/home/ttn/create" class="btn btn-success btn-lg">Create new ttn</a>
            </div>
            <div class="clearfix"></div>
            <br>
            <table class="table table-bordered table-striped table-responsive">
                <tr>
                    <th>{{__('TTN Number')}}</th>
                    <th>{{__('Create at')}}</th>
                    <th>{{__('Status')}}</th>
                    <th>{{__('View')}}</th>
                </tr>
                @foreach($ttns as $ttn)
                    <tr>
                        <td>{{$ttn->id}}</td>
                        <td>{{$ttn->created_at}}</td>
                        <td>{{$ttn->status}}</td>
                        <td>
                            <a href="/home/ttn/view/{{$ttn->id}}" class="btn btn-xs btn-info"><i class="fa fa-eye"></i></a>
                        </td>
                    </tr>
                @endforeach
            </table>
            <div class="text-center">
                {{--{{$ttns->links()}}--}}
            </div>
@endsection