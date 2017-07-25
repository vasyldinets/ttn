@extends('layouts.ttn')

@section('content')
    <h1>{{__('Create Track')}}</h1>

    <create-track inline-template>
        <div>
            <form action="#" method="post" class="row">
                <div class="form-group col-md-3">
                    <label for="from">{{__("Select from Location:")}}</label>
                    <select name="from" id="from" class="form-control" v-model="form.from" v-on:change="getToLocation()">
                        <option value="" selected disabled>{{__('Select...')}}</option>
                        <option v-for="(from_loc, key) in from_locations" :value="from_loc.id">@{{ from_loc.name }}</option>
                    </select>
                </div>
                <div class="form-group col-md-3">
                    <label for="to">{{__("Select to Location:")}}</label>
                    <select name="to" id="to" class="form-control" v-model="form.to">
                        <option value="" selected disabled>{{__('Select...')}}</option>
                        <option v-for="(to_loc, key) in to_locations" :value="to_loc.id">@{{ to_loc.name }}</option>
                    </select>
                </div>
                <div class="form-group col-md-3">
                    <label for="car">{{__("Select Car:")}}</label>
                    <select name="car" id="car" class="form-control">
                        <option value="" selected disabled>{{__('Select...')}}</option>
                        <option v-for="(car, key) in cars" :value="car.id">@{{ car.car_model }} - @{{ car.car_number }}</option>
                    </select>
                </div>
                <div class="col-md-3 text-center" style="padding-top: 25px;">
                    <button type="submit" class="btn btn-success btn-md">{{__('Create')}}</button>
                </div>
            </form>
        </div>
    </create-track>

    <h3>{{__('Track List')}}</h3>
    <list-track inline-template>
        <div>
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
                <tr v-for="(track, key) in tracks.data">
                    <td>@{{track.id}}</td>
                    <td>@{{track.from_location.name}}</td>
                    <td>@{{track.to_location.name}}</td>
                    <td>@{{track.current_location.name}}</td>
                    <td>@{{track.created_at}}</td>
                    <td>@{{track.status}}</td>
                    <td>
                        <a :href="'/logist/track/edit/' + track.id" class="btn btn-xs btn-warning"><i class="fa fa-edit"></i></a>
                    </td>
                </tr>
            </table>
            <div class="text-center">
                <ul class="pagination">
                    <li v-if="tracks.prev_page_url" >
                        <a href="" @click.prevent="prevPage()">
                            <span>{{__('Prev')}}</span>
                        </a>
                    </li>
                    <li v-for="num in tracks.last_page" v-bind:class="[(num == tracks.current_page)?'active':'']">
                        <a href="" @click.prevent="getPage(num)">
                            <span>@{{ num }}</span>
                        </a>
                    </li>
                    <li v-if="tracks.next_page_url">
                        <a href="" @click.prevent="nextPage()">
                            <span>{{__('Next')}}</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </list-track>
@endsection