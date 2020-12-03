@extends('layouts.app')
@section('content')
<div class="content-header-left col-12 mb-2 mt-1">
   <div class="row breadcrumbs-top">
      <div class="col-12">
         <h5 class="content-header-title float-left pr-1 mb-0">Sections</h5>
         <div class="breadcrumb-wrapper col-12">
            <ol class="breadcrumb p-0 mb-0">
               <li class="breadcrumb-item ">
                  <a href="{{ route('sections.index') }}"><i class="bx bx-home-alt"></i></a>
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
                  <h4 class="card-title">Create Section</h4>
                  <div class="heading-elements">
                     <ul class="list-inline mb-0">
                        <!-- Back Option -->
                        <a href="{{ route('sections.index') }}" class="tooltip-light pl-0" data-toggle="tooltip"  
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
                     <form class="form form-horizontal" action="{{ route('sections.store') }}" method="POST" id="form-admin_user" novalidate>
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <div class="form-body">
                           <div class="row">
                              @role(['Administrator'])
                              <div class="col-md-4 col-12">
                                 @include('partials._formElements', [  'type' => 'select',
                                 'field_name' => 'organization_id',
                                 'pname' => 'Organization',
                                 'options' => $organizations,
                                 'is_required'=>1
                                 ])
                              </div>
                              @endrole
                              @if(isset($orgID) && !empty($orgID))
                              <input type="hidden" name="organization_id" value="{{$orgID}}">
                              @endif
                              <div class="col-md-4 col-12" id="class-dropDown">
                                 @include('partials._formElements', [  'type' => 'select',
                                 'field_name' => 'classes_id',
                                 'pname' => 'Class',
                                 'options' => $classes,
                                 'is_required'=>1,
                                 'is_disabled'=>empty($orgID)? 1 :''
                                 ])
                              </div>
                              <div class="col-md-4 col-12">
                                 @include('partials._formElements', [ 'type' => 'text', 'field_name' => 'section_name', 
                                 'pname' => 'Section','is_required'=>1])
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
   $("#organization_id").on('change',function(e){
       var orgID=$("#organization_id").val();
       $.ajax({
                   url: "{{route('getClassDetailsMappedWithOrg')}}",
                   type: 'GET',
                   data: {orgID: orgID},
                   success: function (result) {
                       var organizations=result;
                       var html='<label for="classes_id">Class</label><fieldset class="form-group"><select class="form-control " required="" id="classes_id" name="classes_id"><option selected="" disabled="">Select Class</option>';
                       $.each(organizations, function (key, value) {
                           html+="<option value="+key+">"+value+"</option>";
                       });
                       html+='</select><div class="controls"><span class="help-block"></span></div></fieldset>';
                       $("#class-dropDown").html("");
                       $("#class-dropDown").html(html);
                   }
       });
    });
});
</script>
@endsection