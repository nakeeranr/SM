@extends('layouts.app')
@section('content')
<div class="content-header-left col-12 mb-2 mt-1">
   <div class="row breadcrumbs-top">
      <div class="col-12">
         <h5 class="content-header-title float-left pr-1 mb-0">Admin Users</h5>
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
                  <h4 class="card-title">Admin Users</h4>
                  <div class="heading-elements">
                     <ul class="list-inline mb-0">
                        <a href="{{ route('admin-users.create') }}">
                           <button class="btn btn-icon rounded-circle btn-success glow tooltip-light" data-toggle="tooltip"  data-placement="top" data-animation="true" data-original-title="Add">
                           <i class="bx bx-plus-circle"></i></button>
                        </a>
                     </ul>
                  </div>
               </div>
               <div class="card-content">
                  <div class="card-body card-dashboard">
                     <p class="card-text"></p>
                     <div class="table-responsive">
                        <table class="table zero-configuration" id="usersTable">
                           <thead>
                              <tr>
                                 <th>Name</th>
                                 <th>Status</th>
                                 <th>Created Date</th>
                                 <th class="text-center">Actions</th>
                              </tr>
                           </thead>
                           <tbody>
                              @if(!empty($adminUsers))
                              @foreach($adminUsers as $user)
                              <tr>
                                 <td>{{ $user->fullName ? $user->fullName:'' }}</td>
                                 <td>{{ $user->status }}</td>
                                 <td>{{ $user->created_at ? $user->created_at :'' }}</td>
                                 <td class="text-center">
                                    <!-- info option -->
                                    <a href="{{ route('admin-users.show',[$user->id]) }}" class="tooltip-light"  data-toggle="tooltip"  data-placement="top" data-animation="false" data-original-title="Info">
                                       <button type="button" class="btn btn-icon rounded-circle btn-primary glow mr-1">
                                       <i class="bx bx-info-circle"></i></button>
                                    </a>
                                    <!-- info option.End -->
                                    
                                    <!-- Edit Option -->
                                    <a href="{{ route('admin-users.edit',[$user->id]) }}" class="tooltip-light"  data-toggle="tooltip"  data-placement="top" data-animation="false" data-original-title="Edit">
                                       <button type="button" class="btn btn-icon rounded-circle btn-warning glow mr-1">
                                       <i class="bx bxs-pencil"></i></button>
                                    </a>
                                    <!-- Edit Option.End -->
                                    <!-- Delete Option -->
                                    <form method="POST" action="{{ route('admin-users.destroy',[$user->id]) }}" accept-charset="UTF-8" style="display:inline">
                                       <input name="_method" type="hidden" value="DELETE"><input type="hidden" name="_token" value="{{ csrf_token() }}">
                                       <button class="btn btn-icon rounded-circle btn-danger glow mr-1 tooltip-light" data-toggle="tooltip"  data-placement="top" data-animation="false" data-original-title="Delete"><i class="bx bx-trash"></i></button>
                                    </form>
                                    <!-- Delete Option.End -->
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
                              <th class="text-center font-small-2 text-uppercase">Actions</th>
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
<!--warning theme Modal -->
<div class="modal fade text-left" id="warning" tabindex="-1" role="dialog"
   aria-labelledby="myModalLabel140" aria-hidden="true">
   <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
      <div class="modal-content">
         <div class="modal-header bg-warning">
            <h5 class="modal-title white" id="myModalLabel140">Warning Modal</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <i class="bx bx-x"></i>
            </button>
         </div>
         <div class="modal-body">
            Tart lemon drops macaroon oat cake chocolate toffee chocolate bar icing. Pudding jelly beans
            carrot cake pastry gummies cheesecake lollipop. I love cookie lollipop cake I love sweet
            gummi bears cupcake dessert.
         </div>
         <div class="modal-footer">
            <button type="button" class="btn btn-light-secondary" data-dismiss="modal">
            <i class="bx bx-x d-block d-sm-none"></i>
            <span class="d-none d-sm-block">Close</span>
            </button>
            <button type="button" class="btn btn-warning ml-1" data-dismiss="modal">
            <i class="bx bx-check d-block d-sm-none"></i>
            <span class="d-none d-sm-block">Accept</span>
            </button>
         </div>
      </div>
   </div>
</div>
@endsection