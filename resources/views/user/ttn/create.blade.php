@extends('layouts.ttn')

@section('content')
<h1 class="text-center">{{__('Create new TTN')}}</h1>
    <create-ttn inline-template>
        <div class="row">
            <div class="col-sm-12">
                <form action="#" method="post" @submit.prevent="findUser()">
                    <div v-bind:class="[(errors.email)?'has-error form-group':'form-group']">
                        <label for="email">{{__('Enter recipient email')}}</label>
                        <input type="email" name="email" id="email" class="form-control" v-model="form.email">
                        <span class="text-danger" v-if="errors.email">
                            @{{ errors.email[0] }}
                        </span>
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-success btn-lg">Find</button>
                    </div>
                </form>
            </div>
            <div v-if="show" class="col-sm-12">

                <br>
                <div v-if="!ttn.user" class="alert alert-danger">
                    <p class="text-center">{{__('User not found. Please fill information or check email.')}}</p>
                </div>
                <form action="#" method="post" class="create-ttn" @submit.prevent="createTtn()">
                    <h3 class="text-success text-center col-sm-12">{{__('Recipient Info')}}</h3>
                    <div v-bind:class="[(errors.name)?'has-error form-group col-md-6':'form-group col-md-6']">
                        <label for="name">{{__('Name:')}}</label>
                        <input type="text" name="name" id="name" class="form-control" v-model="ttn.name">
                        <span class="text-danger" v-if="errors.name">
                            @{{ errors.name[0] }}
                        </span>
                    </div>
                    <div v-bind:class="[(errors.middlename)?'has-error form-group col-md-6':'form-group col-md-6']">
                        <label for="middlename">{{__('Middle Name:')}}</label>
                        <input type="text" name="middlename" id="middlename" class="form-control" v-model="ttn.middlename">
                        <span class="text-danger" v-if="errors.middlename">
                            @{{ errors.middlename[0] }}
                        </span>
                    </div>
                    <div v-bind:class="[(errors.lastname)?'has-error form-group col-md-6':'form-group col-md-6']">
                        <label for="lastname">{{__('Last Name:')}}</label>
                        <input type="text" name="lastname" id="lastname" class="form-control" v-model="ttn.lastname">
                        <span class="text-danger" v-if="errors.lastname">
                            @{{ errors.lastname[0] }}
                        </span>
                    </div>
                    <div v-bind:class="[(errors.phone)?'has-error form-group col-md-6':'form-group col-md-6']">
                        <label for="phone">{{__('Phone:')}}</label>
                        <input type="text" name="phone" id="phone" class="form-control" v-model="ttn.phone">
                        <span class="text-danger" v-if="errors.phone">
                            @{{ errors.phone[0] }}
                        </span>
                    </div>
                    <h3 class="text-success text-center col-sm-12">{{__('From Location Info')}}</h3>
                    <div v-bind:class="[(errors.fromregion)?'has-error form-group col-md-4':'form-group col-md-4']">
                        <label for="fromregion">{{__('From Region:')}}</label>
                        <select name="region" id="region" class="form-control" v-model="ttn.fromregion" v-on:change="getFromLocation(ttn.fromregion)">
                            <option value="" selected disabled>{{__('Select region:')}}</option>
                            <option v-for="(fromregion, key) in fromregions" :value="fromregion.id">@{{ fromregion.name }}</option>
                        </select>
                        <span class="text-danger" v-if="errors.fromregion">
                            @{{ errors.fromregion[0] }}
                        </span>
                    </div>
                    <div v-bind:class="[(errors.fromlocation)?'has-error form-group col-md-4':'form-group col-md-4']">
                        <label for="fromlocation">{{__('From City:')}}</label>
                        <select name="fromlocation" id="fromlocation" class="form-control" v-model="ttn.fromlocation" v-on:change="getFromDepartments(ttn.fromlocation)">
                            <option value="" selected disabled>{{__('Select city:')}}</option>
                            <option v-for="(fromlocation, key) in fromlocations" :value="fromlocation.id">@{{ fromlocation.name }}</option>
                        </select>
                        <span class="text-danger" v-if="errors.fromlocation">
                            @{{ errors.fromlocation[0] }}
                        </span>
                    </div>
                    <div v-bind:class="[(errors.fromdepartment)?'has-error form-group col-md-4':'form-group col-md-4']">
                        <label for="fromdepartment">{{__('From Department:')}}</label>
                        <select name="fromdepartment" id="fromdepartment" class="form-control" v-model="ttn.fromdepartment">
                            <option value="" selected disabled>{{__('Select department:')}}</option>
                            <option v-for="(fromdepartment, key) in fromdepartments" :value="fromdepartment.id">@{{ fromdepartment.name }}</option>
                        </select>
                        <span class="text-danger" v-if="errors.fromdepartment">
                            @{{ errors.fromdepartment[0] }}
                        </span>
                    </div>

                    <h3 class="text-success text-center col-sm-12">{{__('To Location Info')}}</h3>
                    <div v-bind:class="[(errors.toregion)?'has-error form-group col-md-4':'form-group col-md-4']">
                        <label for="toregion">{{__('To Region:')}}</label>
                        <select name="toregion" id="toregion" class="form-control" v-model="ttn.toregion" v-on:change="getToLocation(ttn.toregion)">
                            <option value="" selected disabled>{{__('Select region:')}}</option>
                            <option v-for="(toregion, key) in toregions" :value="toregion.id">@{{ toregion.name }}</option>
                        </select>
                        <span class="text-danger" v-if="errors.toregion">
                            @{{ errors.toregion[0] }}
                        </span>
                    </div>
                    <div v-bind:class="[(errors.tolocation)?'has-error form-group col-md-4':'form-group col-md-4']">
                        <label for="tolocation">{{__('To City:')}}</label>
                        <select name="tolocation" id="tolocation" class="form-control" v-model="ttn.tolocation" v-on:change="getToDepartments(ttn.tolocation)">
                            <option value="" selected disabled>{{__('Select city:')}}</option>
                            <option v-for="(tolocation, key) in tolocations" :value="tolocation.id">@{{ tolocation.name }}</option>
                        </select>
                        <span class="text-danger" v-if="errors.tolocation">
                            @{{ errors.tolocation[0] }}
                        </span>
                    </div>
                    <div v-bind:class="[(errors.todepartment)?'has-error form-group col-md-4':'form-group col-md-4']">
                        <label for="todepartment">{{__('To Department:')}}</label>
                        <select name="todepartment" id="todepartment" class="form-control" v-model="ttn.todepartment">
                            <option value="" selected disabled>{{__('Select department:')}}</option>
                            <option v-for="(todepartment, key) in todepartments" :value="todepartment.id">@{{ todepartment.name }}</option>
                        </select>
                        <span class="text-danger" v-if="errors.todepartment">
                            @{{ errors.todepartment[0] }}
                        </span>
                    </div>

                    <h3 class="text-success text-center col-sm-12">{{__('Cargo Info')}}</h3>
                    <div v-bind:class="[(errors.weight)?'has-error form-group col-md-6':'form-group col-md-6']">
                        <label for="weight">{{__('Weight(kg):')}}</label>
                        <input type="number" name="weight" id="weight" class="form-control" min="1" step="0.1" v-model="ttn.weight" v-on:change="calcPrice()">
                        <span class="text-danger" v-if="errors.weight">
                            @{{ errors.weight[0] }}
                        </span>
                    </div>
                    <div v-bind:class="[(errors.width)?'has-error form-group col-md-6':'form-group col-md-6']">
                        <label for="width">{{__('Width(sm):')}}</label>
                        <input type="number" name="width" id="width" class="form-control" min="10" step="1" v-model="ttn.width" v-on:change="calcPrice()">
                        <span class="text-danger" v-if="errors.width">
                            @{{ errors.width[0] }}
                        </span>
                    </div>
                    <div v-bind:class="[(errors.height)?'has-error form-group col-md-6':'form-group col-md-6']">
                        <label for="height">{{__('Height(sm):')}}</label>
                        <input type="number" name="height" id="height" class="form-control" min="10" step="1" v-model="ttn.height" v-on:change="calcPrice()">
                        <span class="text-danger" v-if="errors.height">
                            @{{ errors.height[0] }}
                        </span>
                    </div>
                    <div v-bind:class="[(errors.depth)?'has-error form-group col-md-6':'form-group col-md-6']">
                        <label for="depth">{{__('Depth(sm):')}}</label>
                        <input type="number" name="depth" id="depth" class="form-control" min="10" step="1" v-model="ttn.depth" v-on:change="calcPrice()">
                        <span class="text-danger" v-if="errors.depth">
                            @{{ errors.depth[0] }}
                        </span>
                    </div>
                    <h3 class="col-sm-12">{{__('Total Price:')}} <span><b>@{{ ttn.price }}$</b></span></h3>
                    <div class="text-center col-sm-12">
                        <button class="btn btn-lg btn-success">Create TTN</button>
                    </div>
                </form>
            </div>
        </div>
    </create-ttn>
@endsection

@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.6.5/sweetalert2.min.css">
@endsection