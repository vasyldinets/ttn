@extends('layouts.ttn')

@section('content')
    <h1 class="text-center">{{__('Update User Profile')}}</h1>
    <update-profile inline-template>
        <div class="row">
            <div class="col-sm-12 col-md-8 col-md-offset-2">
                <form action="#" method="post" @submit.prevent="findUser()">
                    <div class="form-group">
                        <label for="email">{{__('Enter user email')}}</label>
                        <input type="email" name="email" id="email" class="form-control" v-model="form.email">
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-success btn-lg">Find</button>
                    </div>
                    <br>
                </form>
                <div v-if="not_found" class="alert alert-danger">
                    <p class="text-center">{{__('User not found. Please fill information or check email.')}}</p>
                </div>
            </div>

            <div v-if="user" class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">User info</div>
                    <div class="panel-body">
                        <form class="form-horizontal" role="form" method="POST" action="#" @submit.prevent="updateUserProfile()">
                            {{ csrf_field() }}

                            <div v-bind:class="[(errors.name)?'has-error form-group col-md-12':'form-group col-md-12']">
                                <label for="name" class="col-md-4 control-label">Name</label>

                                <div class="col-md-6">
                                    <input v-model="user.name" id="name" type="text" class="form-control" name="name"  required autofocus>
                                </div>
                                <span class="text-danger" v-if="errors.name">
                                    @{{ errors.name[0] }}
                                </span>
                            </div>
                            <div v-bind:class="[(errors.middlename)?'has-error form-group col-md-12':'form-group col-md-12']">
                                <label for="middlename" class="col-md-4 control-label">Middle Name</label>

                                <div class="col-md-6">
                                    <input v-model="user.middlename" id="middlename" type="text" class="form-control" name="middlename">
                                    <span class="text-danger" v-if="errors.middlename">
                                        @{{ errors.middlename[0] }}
                                    </span>
                                </div>
                            </div>
                            <div v-bind:class="[(errors.lastname)?'has-error form-group col-md-12':'form-group col-md-12']">
                                <label for="lastname" class="col-md-4 control-label">Last Name</label>

                                <div class="col-md-6">
                                    <input v-model="user.lastname" id="lastname" type="text" class="form-control" name="lastname" required>
                                    <span class="text-danger" v-if="errors.lastname">
                                        @{{ errors.lastname[0] }}
                                    </span>
                                </div>
                            </div>
                            <div v-bind:class="[(errors.phone)?'has-error form-group col-md-12':'form-group col-md-12']">
                                <label for="phone" class="col-md-4 control-label">Phone</label>

                                <div class="col-md-6">
                                    <input v-model="user.phone" id="phone" type="text" class="form-control" name="phone">
                                    <span class="text-danger" v-if="errors.phone">
                                        @{{ errors.phone[0] }}
                                    </span>
                                </div>
                            </div>
                            <div v-bind:class="[(errors.passport_id)?'has-error form-group col-md-12':'form-group col-md-12']">
                                <label for="passport_id" class="col-md-4 control-label">Pasport ID</label>

                                <div class="col-md-6">
                                    <input v-model="user.passport_id" id="passport_id" type="text" class="form-control" name="passport_id">
                                    <span class="text-danger" v-if="errors.passport_id">
                                        @{{ errors.passport_id[0] }}
                                    </span>
                                </div>
                            </div>


                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary">
                                        Update Account Info
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </update-profile>
@endsection

@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.6.5/sweetalert2.min.css">
@endsection