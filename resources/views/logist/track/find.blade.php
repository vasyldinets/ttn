@extends('layouts.ttn')

@section('content')
    <div class="row">
        <div class="col-md-8 col-md-push-2">
            <h1>{{__('Find Track')}}</h1>
            <find-track inline-template>
                <div>
                    <form action="#" method="post" @submit.prevent="findTrack()">
                        <div class="form-group">
                            <label for="track_id">Enter track ID</label>
                            <input type="number" v-model="form.track_id" id="track_id" class="form-control">
                        </div>
                        <div class="form-group text-center">
                            <button type="submit" class="btn btn-success btn-lg">{{__('Find')}}</button>
                        </div>
                    </form>
                    <br>
                    <div v-if="alert" class="alert alert-danger">
                        <p class="text-center">{{__('Track not found. Please check track number.')}}</p>
                    </div>
                    <div v-if="track">
                        <edit-track :track="track" :to_location="track.to_location" :from_location="track.from_location" :current_location="track.current_location" :car="track.car" inline-template>
                            <div>
                                <form action="#" method="post" @submit.prevent="saveTrack()">
                                    <table class="table table-bordered table-striped table-responsive">
                                        <tr>
                                            <th style="width:50%;"><b>{{__('Property')}}</b></th>
                                            <th style="width:50%;"><b>{{__('Value')}}</b></th>
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
            </find-track>
        </div>
    </div>
@endsection

@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.6.5/sweetalert2.min.css">
@endsection