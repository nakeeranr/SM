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
                        Edit
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
                        <h4 class="card-title">Edit Organization Admin User</h4>

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
                            <form class="form" action="{{ route('org-admin.update',[ $schoolAdminUser->id] ) }}" method="POST" id="form-admin_user" novalidate>
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <input type="hidden" name="_method" value="PUT"/>
                                <div class="form-body">
                                    <div class="row">

                                        <!-- include partial and pass variable for form elements -->
                                        <div class="col-md-6 col-12">

                                            @include('partials._formElements', [ 'type' => 'text', 
                                            'field_name' => 'first_name', 
                                            'pname' => 'First Name', 
                                            'val' => $schoolAdminUser->first_name,
                                            'is_required' => 1
                                            ])
                                        </div>

                                        <div class="col-md-6 col-12">
                                            @include('partials._formElements', [ 'type' => 'text', 
                                            'field_name' => 'last_name', 
                                            'pname' => 'Last Name',
                                            'val' => $schoolAdminUser->last_name,
                                            'is_required' => 1
                                            ])
                                        </div>

                                        <div class="col-md-6 col-12">
                                            @include('partials._formElements', [ 'type' => 'text', 
                                            'field_name' => 'user_name', 
                                            'pname' => 'User Name',
                                            'val' => $schoolAdminUser->user_name,
                                            'is_disabled' => '',
                                            'is_required' => ''
                                            ])
                                        </div>

                                        <div class="col-md-6 col-12">
                                            @include('partials._formElements', [ 'type' => 'select',
                                            'field_name' => 'organizationID',
                                            'pname' => 'Organization',
                                            'options' => $organizations,
                                            'val' => $schoolAdminUser->organization_id
                                            ])
                                        </div>

                                        <div class="col-md-6 col-12">
                                            @include('partials._formElements', [ 'type' => 'tel', 
                                            'field_name' => 'phone_number', 
                                            'pname' => 'Mobile Number', 
                                            'maxLen' => 10,
                                            'val' => $schoolAdminUser->phone_number,
                                            'is_required' => 1
                                            ])
                                        </div>

                                        <div class="col-md-6 col-12">
                                            @include('partials._formElements', [ 'type' => 'email', 
                                            'field_name' => 'email_id', 
                                            'pname' => 'Email ID',
                                            'val' => $schoolAdminUser->user->email,
                                            'is_required' => 1
                                            ])
                                        </div>

                                        <div class="col-md-6 col-12">
                                            @include('partials._formElements', [  'type' => 'datePicker', 
                                            'field_name' => 'dob', 
                                            'pname' => 'Date of Birth',
                                            'val' => $schoolAdminUser->dob,
                                            'is_required' => 1
                                            ])
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
                                                'is_checked' => ($schoolAdminUser->gender) == 'Male' ? 'checked' : '',
                                                'is_required' => ''
                                                ])

                                                @include('partials._formElements', [  'type' => 'radio', 
                                                'field_name' => 'gender', 
                                                'id' => 'customRadio2', 
                                                'pname' => 'Female', 
                                                'val' => 1,
                                                'is_checked' => ($schoolAdminUser->gender) == 'Female' ? 'checked' : '',
                                                'is_required' => ''
                                                ])

                                                @include('partials._formElements', [  'type' => 'radio', 
                                                'field_name' => 'gender', 
                                                'id' => 'customRadio3', 
                                                'pname' => 'Others', 
                                                'val' => 2,
                                                'is_checked' => ($schoolAdminUser->gender) == 'Other' ? 'checked' : '',
                                                'is_required' => ''
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
                                                'is_checked' => ($schoolAdminUser->status) == 'Inactive' ? 'checked' : '',
                                                'is_required' => ''
                                                ])

                                                @include('partials._formElements', [  'type' => 'radio', 
                                                'field_name' => 'status', 
                                                'id' => 'customRadio5', 
                                                'pname' => 'Inactive', 
                                                'val' => 0,
                                                'is_checked' => ($schoolAdminUser->status) == 'Inactive' ? 'checked' : '',
                                                'is_required' => ''
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



</script>

@endsection
