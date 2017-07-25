@extends('layouts.ttn')

@section('content')
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
                <div class="row">
                    <div class="col-sm-6">
                        <h3 class="text-center text-success">{{__('Sender Info')}}</h3>
                        <p><b>Name:</b> @{{ sender.name }} @{{ sender.middlename }} @{{ sender.lastname }}</p>
                        <p><b>Email:</b> @{{ ttn.sender.email }}</p>
                        <p><b>Phone:</b> @{{ sender.phone }}</p>
                        <p><b>Passport ID:</b> @{{ sender.passport_id }}</p>
                    </div>
                    <div class="col-sm-6">
                        <h3 class="text-center text-success">{{__('Recipient Info')}}</h3>
                        <p><b>Name:</b> @{{ recipient.name }} @{{ recipient.middlename }} @{{ recipient.lastname }}</p>
                        <p><b>Email:</b> @{{ ttn.recipient.email }}</p>
                        <p><b>Phone:</b> @{{ recipient.phone }}</p>
                        @if(Auth::user()->role == 'operator')
                            <p v-if="recipient.passport_id"><b>Passport ID:</b> 
                                @{{ recipient.passport_id }}
                            </p>
                            <p v-if="!recipient.passport_id"><b>Passport ID:</b>
                                <a href="/operator/user/profile" class="btn btn-sm btn-success">{{__('Update')}}</a>
                            </p>
                        @endif
                    </div>
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
@endsection