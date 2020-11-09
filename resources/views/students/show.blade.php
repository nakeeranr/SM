@extends('layouts.app')
@section('content')

<div class="content-header-left col-12 mb-2 mt-1">
    <div class="row breadcrumbs-top">
        <div class="col-12">
            <h5 class="content-header-title float-left pr-1 mb-0">Students</h5>
            <div class="breadcrumb-wrapper col-12">
                <ol class="breadcrumb p-0 mb-0">
                    <li class="breadcrumb-item ">
                        <a href="{{ route('students.index') }}"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active">
                        Info
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
                    
                    <h5 class="mt-0 mb-0 font-size-1-5"><i class="bx bx-info-circle"></i> Student Info</h5>

                    <div class="heading-elements">

                        <ul class="list-inline mb-0">

                            <!-- Back Option -->
                            <a href="{{ route('students.index') }}" class="tooltip-light pl-0" data-toggle="tooltip"  
                               data-placement="top" data-animation="true" data-original-title="Go back">
                                <button class="btn btn-icon rounded-circle btn-primary glow">
                                    <i class="bx bx-left-arrow-circle"></i></button>
                            </a>
                            <!-- Back Option.End -->

                            <!-- Edit Option -->
                            <a href="{{ route('students.edit',[$student->id]) }}" class="tooltip-light pl-0" 
                               data-toggle="tooltip"  data-placement="top" data-animation="false" data-original-title="Edit">
                                <button type="button" class="btn btn-icon rounded-circle btn-warning glow">
                                    <i class="bx bxs-pencil"></i></button>
                            </a>
                            <!-- Edit Option.End -->

                            <!-- Delete Option -->
                            <form method="POST" action="{{ route('students.destroy',[$student->id]) }}" 
                            	accept-charset="UTF-8" style="display:inline">
                                <input name="_method" type="hidden" value="DELETE">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <button class="btn btn-icon rounded-circle btn-danger glow tooltip-light" data-toggle="tooltip" 
                                        data-placement="top" data-animation="false" data-original-title="Delete"><i class="bx bx-trash"></i>
                                </button>
                            </form>
                            <!-- Delete Option.End -->

                        </ul>
                    </div>
                    
                </div>

                <div class="card-content">
					<hr/>
                    <div class="card-body">

                        <div class="table-responsive">

                            <div class="col-12 col-md-12"> 

                                <table class="table table-bordered">
                                    <tbody>
                                        <tr>
                                            <td>Name</td>
                                            <td class="">{{ $student->name ?? '' }}</td>
                                        </tr>
                                        <tr>
                                            <td>Org Code</td>
                                            <td class="">{{ $student->org_code ?? '' }}</td>
                                        </tr>
                                        <tr>
                                            <td>Primary Contact Number</td>
                                            <td class="">{{ $student->primary_contact ?? '' }}</td>
                                        </tr>
                                        <tr>
                                            <td>Secondary Contact Number</td>
                                            <td class="">{{ $student->secondary_contact ?? '' }}</td>
                                        </tr>
                                        <tr>
                                            <td>Website URL</td>
                                            <td class=""><a href="{{ $student->website_url ?? '' }}">{{ $student->website_url ?? '' }}</a></td>
                                        </tr>
                                        <tr>
                                            <td>Curriculum</td>
                                            <td class="">{{ $student->curriculum ?? '' }}</td>
                                        </tr>
                                        <tr>
                                            <td>Classes</td>
                                            <td class="">
                                            	@foreach($student->classes as $class)
                                            		<span class="badge badge-primary">{{ $class->name ?? '' }}</span>
                                            	@endforeach
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Email</td>
                                            <td class=""><a href="mailto:{{ $student->email ?? '' }}">{{ $student->email ?? '' }}</a></td>
                                        </tr>
                                        <tr>
                                            <td>Description</td>
                                            <td class="">{{ $student->description ?? '' }}</td>
                                        </tr>

                                        <tr>
                                            <td>Address</td>
                                            <td class="">{{ $student->address ?? '' }}</td>
                                        </tr>
                                        
                                        <tr>
                                            <td>City</td>
                                            <td class="">{{ $student->city ?? '' }}</td>
                                        </tr>
                                        
                                        <tr>
                                            <td>State</td>
                                            <td class="">{{ $student->state ?? '' }}</td>
                                        </tr>
                                        
                                        <tr>
                                            <td>Country</td>
                                            <td class="">{{ $student->country ?? '' }}</td>
                                        </tr>
                                        <tr>
                                            <td>Postal Code</td>
                                            <td class="">{{ $student->pin_code ?? '' }}</td>
                                        </tr>

                                        <tr>
                                            <td>Status</td>
                                            <td class=""><span class="badge {{ $student->status == 'Active'?'badge-light-success':'badge-light-danger'}} users-view-status">{{ $student->status}}</span></td>
                                        </tr>
                                        <tr>
                                            <td>Created At</td>
                                            <td class="users-view-role ">{{ $student->created_at?date('l, jS \of F Y \@ h:i:s A',strtotime($student->created_at)): '' }}</td>
                                        </tr>
                                        <tr>
                                            <td>Updated At</td>
                                            <td class="users-view-role ">{{ $student->updated_at?date('l, jS \of F Y \@ h:i:s A',strtotime($student->updated_at)): '' }}</td>
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