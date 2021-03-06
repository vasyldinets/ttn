@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="text-center">{{__('Find TTN')}}</h1>
        <br>
        <find-ttn inline-template>
            <div class="row">
                <div class="col-md-6 col-md-push-3">
                    <form action="#" method="post" class="text-center" @submit.prevent="findTtn()">
                        <div class="form-group">
                            <label for="ttn_id">Enter TTN Number</label>
                            <input type="number" id="ttn_id" class="form-control" v-model="form.id">
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-info btn-lg text-bold"><i class="fa fa-search"></i> Find</button>
                        </div>
                    </form>
                </div>
                <div class="col-sm-12">
                    <div v-if="alert" class="alert alert-danger">
                        <p class="text-center">{{__('TTN not found. Please check TTN Number.')}}</p>
                    </div>
                </div>
                <div class="col-md-10 col-md-push-1" v-if="ttn">

                    <div class="alert alert-warning">
                        <p class="text-center">{{__('For more information please login o register!')}}</p>
                    </div>

                    <table class="table table-bordered table-responsive table-striped">
                        <thead>
                        <tr>
                            <h3 class="text-center text-success">{{__('TTN Info')}}</h3>
                        </tr>
                        </thead>
                        <tr>
                            <td class="text-bold">{{__('From:')}}</td>
                            <td>@{{ ttn.from_department.location.region.name }}, @{{ ttn.from_department.location.name }}, @{{ ttn.from_department.name }}</td>
                            <td class="text-bold">{{__('To:')}}</td>
                            <td>@{{ ttn.to_department.location.region.name }}, @{{ ttn.to_department.location.name }}, @{{ ttn.to_department.name }}</td>
                        </tr>
                        <tr>
                            <td class="text-bold">{{__('Current position:')}}</td>
                            <td>@{{ current_position }}</td>
                            <td class="text-bold">{{__('Status:')}}</td>
                            <td>@{{ ttn.status }}</td>
                        </tr>
                        <tr>
                            <td class="text-bold">{{__('Weight:')}}</td>
                            <td>@{{ ttn.weight }} {{__('kg')}}</td>
                            <td class="text-bold">{{__('Width:')}}</td>
                            <td>@{{ ttn.width }} {{__('sm')}}</td>
                        </tr>
                        <tr>
                            <td class="text-bold">{{__('Height:')}}</td>
                            <td>@{{ ttn.height }} {{__('sm')}}</td>
                            <td class="text-bold">{{__('Depth:')}}</td>
                            <td>@{{ ttn.depth }} {{__('sm')}}</td>
                        </tr>
                        <tr>
                            <td class="text-bold">{{__('Created at:')}}</td>
                            <td>@{{ ttn.created_at }}</td>
                            <td class="text-bold">{{__('Last updated at:')}}</td>
                            <td>@{{ ttn.updated_at }}</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td><h4 class="text-bold">{{__('Price:')}}</h4></td>
                            <td><h4>@{{ ttn.price }} {{__('$')}}</h4></td>
                        </tr>
                    </table>
                </div>
            </div>
        </find-ttn>
    </div>
@endsection