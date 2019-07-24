{{-- @if(checkACL('user')) --}}
	<div class="col-md-3">
		<div class="card mb-2">
			<div class="card-header card_header">Personal</div>
			<div class="card-body p-1 text-center">
				@if ($recipe->personal)
					<i class="fa fa-check" aria-hidden="true"></i>
				@else
					<i class="fa fa-ban" aria-hidden="true"></i>
				@endif
			</div>
		</div>
	</div>
{{-- @endif --}}