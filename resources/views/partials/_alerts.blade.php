@if($alertType == 'success' && !empty($alertMessage))
<div class="alert alert-success alert-dismissible mb-2" role="alert">
	<button type="button" class="close" data-dismiss="alert" aria-label="Close">
	<span aria-hidden="true">&times;</span>
	</button>
	<div class="d-flex align-items-center">
		<i class="bx bx-like"></i>
		<span>
			{{ $alertMessage }}
		</span>
	</div>
</div>
@elseif($alertType == 'error' && !empty($alertMessage))
<div class="alert alert-danger alert-dismissible mb-2" role="alert">
	<button type="button" class="close" data-dismiss="alert" aria-label="Close">
	<span aria-hidden="true">&times;</span>
	</button>
	<div class="d-flex align-items-center">
		<i class="bx bx-error"></i>
		<span>
			{{ $alertMessage }}
		</span>
	</div>
</div>
@elseif($alertType == 'warning' && !empty($alertMessage))
<div class="alert alert-warning alert-dismissible mb-2" role="alert">
	<button type="button" class="close" data-dismiss="alert" aria-label="Close">
	<span aria-hidden="true">&times;</span>
	</button>
	<div class="d-flex align-items-center">
		<i class="bx bx-error-circle"></i>
		<span>
			{{ $alertMessage }}
		</span>
	</div>
</div>
@endif