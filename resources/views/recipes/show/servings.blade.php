{{-- @if(checkACL('user')) --}}
	<div class="col-md-3">
		<div class="card mb-2">
			<div class="card-header card_header">Servings</div>
			<div class="card-body p-1 text-center">{{ $recipe->servings }}</div>
		</div>
	</div>
{{-- @endif --}}