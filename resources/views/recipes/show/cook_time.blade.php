{{-- @if(checkACL('user')) --}}
	<div class="col-md-3 pl-md-1 pr-md-3">
		<div class="card mb-2">
			<div class="card-header card_header p-2">Cook Time <small>(Minutes)</small></div>
			<div class="card-body p-1 text-center text-light">{{ $recipe->cook_time }}</div>
		</div>
	</div>
{{-- @endif --}}