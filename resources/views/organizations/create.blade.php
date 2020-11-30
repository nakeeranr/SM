@extends('layouts.app')
@section('content')
<div class="content-header-left col-12 mb-2 mt-1">
    <div class="row breadcrumbs-top">
        <div class="col-12">
            <h5 class="content-header-title float-left pr-1 mb-0">Organizations</h5>
            <div class="breadcrumb-wrapper col-12">
                <ol class="breadcrumb p-0 mb-0">
                    <li class="breadcrumb-item ">
                        <a href="{{ route('organizations.index') }}"><i class="bx bx-home-alt"></i></a>
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
                        <h4 class="card-title">Create Organization</h4>
                        <div class="heading-elements">
                            <ul class="list-inline mb-0">
                                <!-- Back Option -->
                                <a href="{{ route('organizations.index') }}" class="tooltip-light pl-0" data-toggle="tooltip"
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
                            <form class="form form-horizontal" action="{{ route('organizations.store') }}" method="POST" id="form-organizations" novalidate>
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <div class="form-body">
                                    <div class="row">
                                        <!-- include partial and pass variable for form elements -->
                                        <div class="col-md-8 col-12">
                                            @include('partials._formElements', [ 'type' => 'text', 
                                            'field_name' => 'name', 'pname' => 'Organization Name'])
                                        </div>
                                        <div class="col-md-4 col-12">
                                            
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
                                        <div class="col-md-6 col-12">
                                            @include('partials._formElements', [ 'type' => 'tel', 
                                            'field_name' => 'primary_contact', 'pname' => 'Primary Contact Number', 
                                            'maxLen' => 10])
                                        </div>
                                        <div class="col-md-6 col-12">
                                            @include('partials._formElements', [ 'type' => 'tel', 'field_name' => 'secondary_contact', 'pname' => 'Secondary Contact Number', 'maxLen' => 10])
                                        </div>
                                        <div class="col-md-6 col-12">
                                            @include('partials._formElements', [ 'type' => 'email', 'field_name' => 'email', 'pname' => 'Email ID'])
                                        </div>
                                        <div class="col-md-6 col-12">
                                            @include('partials._formElements', [ 'type' => 'text', 'field_name' => 'website_url', 'pname' => 'Website URL'])
                                        </div>
                                        <div class="col-md-6 col-12">
                                            @include('partials._formElements', [ 'type' => 'select',
                                            'field_name' => 'curriculum',
                                            'pname' => 'Curriculum',
                                            'options' => $boards
                                            ])
                                        </div>
                                        <div class="col-md-6 col-12">
                                            @include('partials._formElements', [  'type' => 'select',
                                            'field_name' => 'classes',
                                            'pname' => 'Classes Offered',
                                            'options' => $classes,
                                            'is_multiple' => 'multiple=multiple'
                                            ])
                                        </div>
                                        <div class="col-md-12 col-12">
                                            @include('partials._formElements', [  'type' => 'textarea',
                                            'field_name' => 'description',
                                            'pname' => 'Description',
                                            'length' => 250,
                                            'rows' => 3
                                            ])
                                        </div>
                                        <div class="col-md-12 col-12">
                                            @include('partials._formElements', [ 'type' => 'text', 'field_name' => 'address', 
                                            'pname' => 'Address'])
                                        </div>
                                        <div class="col-md-3 col-12">
                                            @include('partials._formElements', [ 'type' => 'text', 'field_name' => 'city', 
                                            'pname' => 'City'])
                                        </div>
                                        <div class="col-md-3 col-12">
                                            @include('partials._formElements', [ 'type' => 'text', 'field_name' => 'state', 
                                            'pname' => 'State'])
                                        </div>
                                        <div class="col-md-3 col-12">
                                            @include('partials._formElements', [ 'type' => 'text', 'field_name' => 'country', 
                                            'pname' => 'Country'])
                                        </div>
                                        <div class="col-md-3 col-12">
                                            @include('partials._formElements', [ 'type' => 'tel', 'field_name' => 'pin_code', 
                                            'pname' => 'Postal Code', 'maxLen' => 6])
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
    $( document ).ready(function() {
        $("#classes").select2({
            placeholder: "Select Classes"
        });
   });
</script>
@endsection