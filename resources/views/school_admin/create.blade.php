@extends('layouts.app')
@section('content')
<div class="content-header-left col-12 mb-2 mt-1">
    <div class="row breadcrumbs-top">
        <div class="col-12">
            <h5 class="content-header-title float-left pr-1 mb-0">Organization Admin User</h5>
            <div class="breadcrumb-wrapper col-12">
                <ol class="breadcrumb p-0 mb-0">
                    <li class="breadcrumb-item ">
                        <a href="{{ route('org-admin.index') }}"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active">
                        Create
                    </li>
                </ol>
            </div>
        </div>
    </div>
</div>
<div class="content-body">
    <!-- // Basic multiple Column Form section start -->
    <section id="multiple-column-form">
        <div class="row match-height">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Create Organization Admin User</h4>

                        <div class="heading-elements">

                            <ul class="list-inline mb-0">

                                <!-- Back Option -->
                                <a href="{{ route('org-admin.index') }}" class="tooltip-light pl-0" data-toggle="tooltip"  
                                   data-placement="top" data-animation="true" data-original-title="Go back">
                                    <button class="btn btn-icon rounded-circle btn-primary glow">
                                        <i class="bx bx-left-arrow-circle"></i></button>
                                </a>
                                <!-- Back Option.End -->

                            </ul>
                        </div>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            
                            <form class="form form-horizontal" action="{{ route('org-admin.store') }}" method="POST" id="form-admin_user" novalidate>
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <div class="form-body">
                                    <div class="row">

                                        <!-- include partial and pass variable for form elements -->
                                        <div class="col-md-6 col-12">

                                            @include('partials._formElements', [ 'type' => 'text', 
                                            'field_name' => 'first_name', 
                                            'pname' => 'First Name',
                                            'is_required' => 1
                                            ])
                                        </div>

                                        <div class="col-md-6 col-12">
                                            @include('partials._formElements', [ 'type' => 'text', 'field_name' => 'last_name', 'pname' => 'Last Name', 'is_required' => 1])
                                        </div>

                                        <div class="col-md-6 col-12">
                                            @include('partials._formElements', [ 'type' => 'text', 'field_name' => 'user_name', 'pname' => 'User Name', 'is_disabled' => 'readonly'])
                                        </div>

                                        <div class="col-md-6 col-12">
                                            @include('partials._formElements', [ 'type' => 'select',
                                            'field_name' => 'organizationID',
                                            'pname' => 'Organization',
                                            'options' => $organizations
                                            ])
                                        </div>

                                        <div class="col-md-6 col-12">
                                            @include('partials._formElements', [ 'type' => 'tel', 'field_name' => 'phone_number', 'pname' => 'Mobile Number', 'maxLen' => 10, 'is_required' => 1])
                                        </div>

                                        <div class="col-md-6 col-12">
                                            @include('partials._formElements', [ 'type' => 'email', 'field_name' => 'email_id', 'pname' => 'Email ID', 'is_required' => 1])
                                        </div>

                                        <div class="col-md-6 col-12">
                                            @include('partials._formElements', [  'type' => 'datePicker', 'field_name' => 'dob', 'pname' => 'Date of Birth', 'is_required' => 1])
                                        </div>

                                        <div class="col-md-6 col-12">
                                            <label for="gender">Gender</label>
                                            <ul class="list-unstyled mb-0">
                                                <!-- <p>Gender</p> -->

                                                @include('partials._formElements', [  'type' => 'radio', 
                                                'field_name' => 'gender', 
                                                'id' => 'customRadio1', 
                                                'pname' => 'Male', 
                                                'val' => 0,
                                                'is_checked' => 'checked'
                                                ])

                                                @include('partials._formElements', [  'type' => 'radio', 
                                                'field_name' => 'gender', 
                                                'id' => 'customRadio2', 
                                                'pname' => 'Female', 
                                                'val' => 1,
                                                'is_checked' => ''
                                                ])

                                                @include('partials._formElements', [  'type' => 'radio', 
                                                'field_name' => 'gender', 
                                                'id' => 'customRadio3', 
                                                'pname' => 'Others', 
                                                'val' => 2,
                                                'is_checked' => ''
                                                ])
                                            </ul>
                                            <span class="help-block">{{ $errors->first('gender') }}</span>
                                        </div>

                                        <div class="col-md-6 col-12">
                                            <label for="status">Status</label>
                                            <ul class="list-unstyled mb-0">
                                                <!-- <p>Status</p> -->

                                                @include('partials._formElements', [  'type' => 'radio', 
                                                'field_name' => 'status', 
                                                'id' => 'customRadio4', 
                                                'pname' => 'Active', 
                                                'val' => 1,
                                                'is_checked' => 'checked'
                                                ])

                                                @include('partials._formElements', [  'type' => 'radio', 
                                                'field_name' => 'status', 
                                                'id' => 'customRadio5', 
                                                'pname' => 'Inactive', 
                                                'val' => 0,
                                                'is_checked' => ''
                                                ])

                                            </ul>
                                            <span class="help-block">{{ $errors->first('status') }}</span>
                                        </div>
                                        

                                        <div class="col-sm-12 d-flex justify-content-end">

                                            @include('partials._formElements', [ 'type' => 'button', 
                                            'class' => 'btn btn-primary mr-1 mb-1', 
                                            'field_name' => 'submit', 
                                            'pname' => 'Submit'
                                            ])

                                            @include('partials._formElements', [ 'type' => 'button', 
                                            'class' => 'btn btn-light-secondary mr-1 mb-1', 
                                            'field_name' => 'reset', 
                                            'pname' => 'Reset'
                                            ])

                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- // Basic multiple Column Form section end -->
</div>


<script>


    function createUsername() {
        var fname = $('#form-admin_user input[name=first_name]').val().toLowerCase();
        var lname = $('#form-admin_user input[name=last_name]').val().toLowerCase();
        var username = fname + '.' + lname;
        $('#form-admin_user input[name=user_name]').val(username);
    }

    $('#form-admin_user input[name=first_name]').on('keyup', createUsername);
    $('#form-admin_user input[name=last_name]').on('keyup', createUsername);


</script>

@endsection
