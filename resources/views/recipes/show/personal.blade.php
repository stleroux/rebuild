{{-- @if(checkACL('user')) --}}
	<div class="col-md-3 pl-md-3 pr-md-1">
		<div class="card mb-2">
			<div class="card-header card_header p-2">Personal</div>
			<div class="card-body p-1 text-center text-light">
				@if ($recipe->personal)
					<i class="fa fa-check" aria-hidden="true"></i>
				@else
					<i class="fa fa-ban" aria-hidden="true"></i>
				@endif
			</div>
		</div>
	</div>
{{-- @endif --}}