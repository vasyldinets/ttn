@extends('layouts.ttn')

@section('content')
<div class="row">
    <div class="col-md-8 col-md-push-2">
        <h1>Edit Track</h1>

        <edit-track :track="{{$track}}" :to_location="{{$track->toLocation}}" :from_location="{{$track->fromLocation}}" :current_location="{{$track->currentLocation}}" :car="{{$track->car}}" inline-template>
            <div>
                <form action="#" method="post" @submit.prevent="saveTrack()">
                    <table class="table table-bordered table-striped table-responsive">
                        <tr>
                            <th><b>{{__('Property')}}</b></th>
                            <th><b>{{__('Value')}}</b></th>
                        </tr>
                        <tr>
                            <td><b>{{__('Track ID')}}</b></td>
                            <td>@{{ track.id }}</td>
                        </tr>
                        <tr>
                            <td><b>{{__('Status')}}</b></td>
                            <td>@{{ status }}</td>
                        </tr>
                        <tr>
                            <td><b>{{__('From Location')}}</b></td>
                            <td>@{{ from_location.name}}</td>
                        </tr>
                        <tr>
                            <td><b>{{__('To Location')}}</b></td>
                            <td>@{{ to_location.name }}</td>
                        </tr>
                        <tr>
                            <td><b>{{__('Car Model')}}</b></td>
                            <td>@{{ car.car_model }}</td>
                        </tr>
                        <tr>
                            <td><b>{{__('Car Number')}}</b></td>
                            <td>@{{ car.car_number }}</td>
                        </tr>
                        <tr v-if="status != 'done'">
                            <td><b>{{__('Current Location')}}</b></td>
                            <td>
                                <select name="current_location" id="curloc" class="form-control" v-model="form.current_location">
                                    <option disabled selected>{{__('Select current location')}}</option>
                                    <option v-for="(location, key) in locations"   :value="location.id" :selected="location.id == current_location.id ? true : false">@{{ location.name }}</option>
                                </select>
                            </td>
                        </tr>
                    </table>
                    <div v-if="status != 'done'" class="text-center">
                        <button type="submit" class="btn btn-success btn-lg">{{__('SAVE')}}</button>
                    </div>
                </form>
            </div>
        </edit-track>
    </div>
</div>
@endsection

@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.6.5/sweetalert2.min.css">
@endsection