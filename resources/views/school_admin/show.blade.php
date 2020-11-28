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
                        Home            
                    </li>
                </ol>
            </div>
        </div>
    </div>
</div>
<div class="content-body">
    <!-- Basic Usage -->
    <section id="basic-usage" class="row">
        <div class=" col-12">
            <div class="card">
                <div class="card-header">

                    <h5 class="mt-0 mb-0"><i class="bx bx-info-circle"></i> Info</h5>

                    <div class="heading-elements">

                        <ul class="list-inline mb-0">

                            <!-- Back Option -->
                            <a href="{{ route('org-admin.index') }}" class="tooltip-light pl-0" data-toggle="tooltip"  
                               data-placement="top" data-animation="true" data-original-title="Go back">
                                <button class="btn btn-icon rounded-circle btn-primary glow">
                                    <i class="bx bx-left-arrow-circle"></i></button>
                            </a>
                            <!-- Back Option.End -->

                            <!-- Edit Option -->
                            <a href="{{ route('org-admin.edit',[$schoolAdminUser->id]) }}" class="tooltip-light pl-0" 
                               data-toggle="tooltip"  data-placement="top" data-animation="false" data-original-title="Edit">
                                <button type="button" class="btn btn-icon rounded-circle btn-warning glow">
                                    <i class="bx bxs-pencil"></i></button>
                            </a>
                            <!-- Edit Option.End -->

                            <!-- Delete Option -->
                            <form method="POST" action="{{ route('org-admin.destroy',[$schoolAdminUser->id]) }}" accept-charset="UTF-8" style="display:inline">
                                <input name="_method" type="hidden" value="DELETE"><input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <button class="btn btn-icon rounded-circle btn-danger glow tooltip-light" data-toggle="tooltip" 
                                        data-placement="top" data-animation="false" data-original-title="Delete"><i class="bx bx-trash"></i></button>
                            </form>
                            <!-- Delete Option.End -->

                        </ul>
                    </div>
                    
                </div>
                <div class="card-content">

                    <div class="card-body">

                        <div class="row">

                            <div class="col-12 col-md-8"> 

                                <table class="table table-borderless">
                                    <tbody>
                                        <tr>
                                            <td>Name:</td>
                                            <td class="users-view-username">{{$schoolAdminUser->FullName ??''}}</td>
                                        </tr>
                                        <tr>
                                            <td>User Name:</td>
                                            <td class="users-view-username">{{$schoolAdminUser->user_name??''}}</td>
                                        </tr>
                                        <tr>
                                            <td>Organization:</td>
                                            <td class="users-view-username">{{$schoolAdminUser->organization->name??''}}</td>
                                        </tr>
                                        <tr>
                                            <td>Date Of Birth:</td>
                                            <td class="users-view-username">{{$schoolAdminUser->dob ??''}}</td>
                                        </tr>
                                        <tr>
                                            <td>Contact Number:</td>
                                            <td class="users-view-username">{{$schoolAdminUser->phone_number ??''}}</td>
                                        </tr>
                                        <tr>
                                            <td>Gender:</td>
                                            <td class="users-view-username">{{$schoolAdminUser->gender ??''}}</td>
                                        </tr>
                                        <tr>
                                            <td>Status:</td>
                                            <td class="users-view-username"><span class="badge {{$schoolAdminUser->status == 'Active'?'badge-light-success':'badge-light-danger'}} users-view-status">{{$schoolAdminUser->status}}</span></td>
                                        </tr>
                                        <tr>
                                            <td>Created At:</td>
                                            <td class="users-view-role users-view-username">{{$schoolAdminUser->created_at?date('l, jS \of F Y \@ h:i:s A',strtotime($schoolAdminUser->created_at)):''}}</td>
                                        </tr>
                                        <tr>
                                            <td>Updated At:</td>
                                            <td class="users-view-role users-view-username">{{$schoolAdminUser->updated_at?date('l, jS \of F Y \@ h:i:s A',strtotime($schoolAdminUser->updated_at)):''}}</td>
                                        </tr>
                                    </tbody>
                                </table>

                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--/ Basic Usage -->
</div>
@endsection