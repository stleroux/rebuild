{{-- @if(checkACL('user')) --}}
	<div class="col-md-3">
		<div class="card mb-2">
			<div class="card-header card_header_2">Prep Time <small>(Minutes)</small></div>
			<div class="card-body text-center">{{ $recipe->prep_time }}</div>
		</div>
	</div>
{{-- @endif --}}