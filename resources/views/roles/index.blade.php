@extends('layouts.app')
@section('content')
<div class="content-header-left col-12 mb-2 mt-1">
   <div class="row breadcrumbs-top">
      <div class="col-12">
         <h5 class="content-header-title float-left pr-1 mb-0">Roles</h5>
         <div class="breadcrumb-wrapper col-12">
            <ol class="breadcrumb p-0 mb-0">
               <li class="breadcrumb-item ">
                  <a href="{{ route('home') }}"><i class="bx bx-home-alt"></i></a>
               </li>
               <li class="breadcrumb-item active">
                  Home
               </li>
            </ol>
         </div>
      </div>
   </div>
</div>
<div class="content-body">

   @if(Session::has('alertType') && Session::has('alertMessage'))
      @include('partials._alerts', [ 'alertType' => Session::get('alertType'), 'alertMessage' => Session::get('alertMessage')])
   @endif

   <!-- Zero configuration table -->
   <section id="basic-datatable">
      <div class="row">
         <div class="col-12">
            <div class="card">
               <div class="card-header">
                  <h4 class="card-title">Roles</h4>
                  <div class="heading-elements">
                     <ul class="list-inline mb-0">
                        <a href="{{ route('roles.create') }}">
                           <button class="btn btn-icon rounded-circle btn-success glow tooltip-light" data-toggle="tooltip"  data-placement="top" data-animation="true" data-original-title="Add Role"><i class="bx bx-plus-circle"></i>
                           </button>
                        </a>
                     </ul>
                  </div>
               </div>
               
               <div class="card-content">
                  <div class="card-body card-dashboard">
                     
                     <div class="table-responsive">
                        <table class="table zero-configuration" id="rolesTable">
                           <thead>
                              <tr>
                                 <th>Name</th>
                                 <th>Status</th>
                                 <th>Created Date</th>
                                 <th class="text-center">Actions</th>
                              </tr>
                           </thead>
                           <tbody>
                              @if(!empty($roles))
                              @foreach($roles as $role)
                              <tr>
                                 <td><a href="{{ route('roles.show',[$role->id]) }}">{{ $role->name??''}}</a></td>
                                 <td>{{ $role->status}}</td>
                                 <td>{{ $role->created_at ? date('D M y',strtotime($role->created_at)) : '' }}</td>
                                 <td class="text-center">

                                    <!-- info option -->
                                    <a href="{{ route('roles.show', [$role->id]) }}" class="tooltip-light"  data-toggle="tooltip"  data-placement="top" data-animation="false" data-original-title="Info">
                                          <button type="button" class="btn btn-icon rounded-circle btn-primary glow mr-1">
                                          <i class="bx bx-info-circle"></i></button>
                                       </a>
                                    <!-- info option.End -->
                                    <!-- Edit Option -->
                                    <a href="{{ route('roles.edit', [$role->id]) }}" class="tooltip-light"  data-toggle="tooltip"  data-placement="top" data-animation="false" data-original-title="Edit">
                                       <button type="button" class="btn btn-icon rounded-circle btn-warning glow mr-1">
                                       <i class="bx bxs-pencil"></i></button>
                                    </a>
                                    <!-- Edit Option.End -->
                              </td>
                              </tr>
                              @endforeach
                              @endif
                           </tbody>
                           <tfoot>
                           <tr>
                              <th class="font-small-2 text-uppercase">Name</th>
                              <th class="font-small-2 text-uppercase">Status</th>
                              <th class="font-small-2 text-uppercase">Created Date</th>
                              <th class="font-small-2 text-uppercase text-center">Actions</th>
                           </tr>
                           </tfoot>
                        </table>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </section>
   <!--/ Zero configuration table -->
</div>
@endsection