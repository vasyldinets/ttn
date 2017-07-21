@extends('layouts.ttn')

@section('content')
<h1 class="text-center">{{__('Create new TTN')}}</h1>
    <operator-create-ttn inline-template>
        <div class="row">
            <div class="col-sm-6">
                <form action="#" method="post" @submit.prevent="findSenderUser()" >
                    <div v-bind:class="[(errors.sender_email)?'has-error form-group':'form-group']">
                        <label for="email_sender">{{__('Enter sender email')}}</label>
                        <input type="email" name="email" id="email_sender" class="form-control" v-model="form_sender.email">
                        <span class="text-danger" v-if="errors.sender_email">
                            @{{ errors.sender_email[0] }}
                        </span>
                    </div>

                    <div class="text-center">
                        <button type="submit" class="btn btn-success btn-lg">Find</button>
                    </div>
                    <br>
                    <div v-if="showSenderErr" class="alert alert-danger">
                        <p class="text-center">{{__('User sender not found. Please fill information or check email.')}}</p>
                    </div>
                </form>
            </div>
            <div class="col-sm-6">
                <form action="#" method="post" @submit.prevent="findRecipientUser()">
                    <div v-bind:class="[(errors.recipient_email)?'has-error form-group':'form-group']">
                        <label for="email_recipient">{{__('Enter recipient email')}}</label>
                        <input type="email" name="email_recipient" id="email_recipient" class="form-control" v-model="form_recipient.email">
                        <span class="text-danger" v-if="errors.recipient_email">
                            @{{ errors.recipient_email[0] }}
                        </span>
                    </div>

                    <div class="text-center">
                        <button type="submit" class="btn btn-success btn-lg">Find</button>
                    </div>
                    <br>
                    <div v-if="showPecipientErr" class="alert alert-danger">
                        <p class="text-center">{{__('User recipient not found. Please fill information or check email.')}}</p>
                    </div>
                </form>
            </div>
            <div class="clearfix"></div>
            <div>

                <form action="#" method="post" class="create-ttn" @submit.prevent="createTtn()">
                    <div class="row">
                        <div class="col-md-6">

                            <h3 class="text-success text-center col-sm-12">{{__('Sender Info')}}</h3>
                            <div v-bind:class="[(errors.sender_name)?'has-error form-group col-md-12':'form-group col-md-12']">
                                <label for="sender_name">{{__('Sender Name:')}}</label>
                                <input type="text" name="sender_name" id="sender_name" class="form-control" v-model="ttn.sender_name">
                                <span class="text-danger" v-if="errors.sender_name">
                                    @{{ errors.sender_name[0] }}
                                </span>
                            </div>
                            <div v-bind:class="[(errors.sender_middlename)?'has-error form-group col-md-12':'form-group col-md-12']">
                                <label for="sender_middlename">{{__('Sender Middle Name:')}}</label>
                                <input type="text" name="sender_middlename" id="sender_middlename" class="form-control" v-model="ttn.sender_middlename">
                                <span class="text-danger" v-if="errors.sender_middlename">
                                    @{{ errors.sender_middlename[0] }}
                                </span>
                            </div>
                            <div v-bind:class="[(errors.sender_lastname)?'has-error form-group col-md-12':'form-group col-md-12']">
                                <label for="sender_lastname">{{__('Sender Last Name:')}}</label>
                                <input type="text" name="sender_lastname" id="sender_lastname" class="form-control" v-model="ttn.sender_lastname">
                                <span class="text-danger" v-if="errors.sender_lastname">
                                    @{{ errors.sender_lastname[0] }}
                                </span>
                            </div>
                            <div v-bind:class="[(errors.sender_phone)?'has-error form-group col-md-12':'form-group col-md-12']">
                                <label for="sender_phone">{{__('Sender Phone:')}}</label>
                                <input type="text" name="sender_phone" id="sender_phone" class="form-control" v-model="ttn.sender_phone">
                                <span class="text-danger" v-if="errors.sender_phone">
                                    @{{ errors.sender_phone[0] }}
                                </span>
                            </div>
                        </div>
                        <div class="col-md-6">

                            <h3 class="text-success text-center col-sm-12">{{__('Recipient Info')}}</h3>
                            <div v-bind:class="[(errors.recipient_name)?'has-error form-group col-md-12':'form-group col-md-12']">
                                <label for="recipient_name">{{__('Recipient Name:')}}</label>
                                <input type="text" name="recipient_name" id="recipient_name" class="form-control" v-model="ttn.recipient_name">
                                <span class="text-danger" v-if="errors.recipient_name">
                                    @{{ errors.recipient_name[0] }}
                                </span>
                            </div>
                            <div v-bind:class="[(errors.recipient_middlename)?'has-error form-group col-md-12':'form-group col-md-12']">
                                <label for="recipient_middlename">{{__('Recipient Middle Name:')}}</label>
                                <input type="text" name="recipient_middlename" id="recipient_middlename" class="form-control" v-model="ttn.recipient_middlename">
                                <span class="text-danger" v-if="errors.recipient_middlename">
                                    @{{ errors.recipient_middlename[0] }}
                                </span>
                            </div>
                            <div v-bind:class="[(errors.recipient_lastname)?'has-error form-group col-md-12':'form-group col-md-12']">
                                <label for="recipient_lastname">{{__('Recipient Last Name:')}}</label>
                                <input type="text" name="recipient_lastname" id="recipient_lastname" class="form-control" v-model="ttn.recipient_lastname">
                                <span class="text-danger" v-if="errors.recipient_lastname">
                                    @{{ errors.recipient_lastname[0] }}
                                </span>
                            </div>
                            <div v-bind:class="[(errors.recipient_phone)?'has-error form-group col-md-12':'form-group col-md-12']">
                                <label for="recipient_phone">{{__('Recipient Phone:')}}</label>
                                <input type="text" name="recipient_phone" id="recipient_phone" class="form-control" v-model="ttn.recipient_phone">
                                <span class="text-danger" v-if="errors.recipient_phone">
                                    @{{ errors.recipient_phone[0] }}
                                </span>
                            </div>
                        </div>
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
    </operator-create-ttn>
@endsection

@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.6.5/sweetalert2.min.css">
@endsection