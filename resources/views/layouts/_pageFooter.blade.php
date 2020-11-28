{{-- {{ "Page: ". Route::currentRouteName() }} --}}
@if (Route::currentRouteName() == 'home')
	<script src="{{ asset('vendors/js/charts/apexcharts.min.js') }}"></script>
	<script src="{{ asset('vendors/js/extensions/dragula.min.js') }}"></script>
	<script src="{{ asset('js/scripts/pages/dashboard-analytics.min.js') }}"></script>
	<script src="{{ asset('js/scripts/customizer.min.js') }}"></script>
@elseif(
Route::currentRouteName() == 'permissions.index'
|| Route::currentRouteName() == 'roles.index'
|| Route::currentRouteName() == 'roles.edit'
|| Route::currentRouteName() == 'admin-users.index'
|| Route::currentRouteName() == 'organizations.index'
)
<!-- BEGIN: Page Vendor JS-->
	<script src="{{ asset('vendors/js/tables/datatable/datatables.min.js') }}"></script>
	<script src="{{ asset('vendors/js/tables/datatable/dataTables.bootstrap4.min.js') }}"></script>
	<script src="{{ asset('vendors/js/tables/datatable/dataTables.buttons.min.js') }}"></script>
	<script src="{{ asset('vendors/js/tables/datatable/buttons.html5.min.js') }}"></script>
	<script src="{{ asset('vendors/js/tables/datatable/buttons.print.min.js') }}"></script>
	<script src="{{ asset('vendors/js/tables/datatable/buttons.bootstrap.min.js') }}"></script>
	<script src="{{ asset('vendors/js/tables/datatable/pdfmake.min.js') }}"></script>
	<script src="{{ asset('vendors/js/tables/datatable/vfs_fonts.js') }}"></script>
	<!-- END: Page Vendor JS-->
	<script src="{{ asset('js/scripts/datatables/datatable.min.js') }}"></script>
	<script src="{{ asset('fonts/LivIconsEvo/js/LivIconsEvo.tools.min.js') }}"></script>
	<script src="{{ asset('fonts/LivIconsEvo/js/LivIconsEvo.defaults.min.js') }}"></script>
	<script src="{{ asset('fonts/LivIconsEvo/js/LivIconsEvo.min.js') }}"></script>
	<script src="{{ asset('js/scripts/tooltip/tooltip.min.js') }}"></script>
	<script src='http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.5/jquery-ui.min.js'></script>


	<script type="text/javascript">
		$(document).ready(function () {
			
			$("#permissionsTable").DataTable();
			$("#rolesTable").DataTable();
		//   $('[data-toggle="modal"][title]').tooltip();


		$(function() {
			// setTimeout() function will be fired after page is loaded
			// it will wait for 5 sec. and then will fire
			// $("#successMessage").hide() function
			setTimeout(function() {
			$(".alert").hide('blind', {}, 500)
			}, 5000);
		});
		});
	</script>
@elseif(Route::currentRouteName() == 'admin-users.create'
|| Route::currentRouteName() == 'admin-users.edit'
|| Route::currentRouteName() == 'roles.create'
|| Route::currentRouteName() == 'roles.edit'
|| Route::currentRouteName() == 'admin-users.create'
|| Route::currentRouteName() == 'permissions.create'
)
	<script src="{{ asset('vendors/js/pickers/pickadate/picker.js') }}"></script>
	<script src="{{ asset('vendors/js/pickers/pickadate/picker.date.js') }}"></script>
	<script src="{{ asset('vendors/js/pickers/pickadate/picker.time.js') }}"></script>
	<script src="{{ asset('vendors/js/pickers/pickadate/legacy.js') }}"></script>
	<script src="{{ asset('vendors/js/pickers/daterange/moment.min.js') }}"></script>
	<script src="{{ asset('vendors/js/pickers/daterange/daterangepicker.js') }}"></script>
	<script src="{{ asset('js/scripts/pickers/dateTime/pick-a-datetime.min.js') }}"></script>
	<script src="{{ asset('vendors/js/forms/validation/jqBootstrapValidation.js') }}"></script>
	<script src="{{ asset('js/scripts/forms/validation/form-validation.js') }}"></script>
	<script src="{{ asset('vendors/js/forms/validation/jquery.validate.min.js') }}"></script>
@endif