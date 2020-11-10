{{-- {{ "Page: ". Route::currentRouteName() }} --}}

@if (Route::currentRouteName() == 'home')

<link rel="stylesheet" type="text/css" href="{{ asset('css/pages/dashboard-analytics.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('css/pages/dashboard-analytics.css') }}">

 <!-- BEGIN: Vendor CSS-->
<link rel="stylesheet" type="text/css" href="{{ asset('vendors/css/charts/apexcharts.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('vendors/css/extensions/dragula.min.css') }}">
<!-- END: Vendor CSS-->

@elseif(Route::currentRouteName() == 'permissions.index'
|| Route::currentRouteName() == 'roles.index'
|| Route::currentRouteName() == 'roles.edit'
|| Route::currentRouteName() == 'admin-users.index'
|| Route::currentRouteName() == 'organizations.index'
|| Route::currentRouteName() == 'roles.index'
)

<!-- BEGIN: Vendor CSS-->
<link rel="stylesheet" type="text/css" href="{{ asset('vendors/css/tables/datatable/datatables.min.css') }}">
<!-- END: Vendor CSS-->

@elseif(Route::currentRouteName() == 'admin-users.create'
|| Route::currentRouteName() == 'admin-users.edit'
|| Route::currentRouteName() == 'organizations.create'
|| Route::currentRouteName() == 'organizations.edit'
|| Route::currentRouteName() == 'roles.create'
|| Route::currentRouteName() == 'roles.edit'
)
<link rel="stylesheet" type="text/css" href="{{ asset('vendors/css/pickers/pickadate/pickadate.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('css/plugins/forms/validation/form-validation.css') }}">
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>

<!-- @elseif(Route::currentRouteName() == 'roles.create' 
)
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script> -->


@endif
