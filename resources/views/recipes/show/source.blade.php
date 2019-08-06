{{-- @if(checkACL('user')) --}}
	<div class="col-md-3 px-1">
		<div class="card mb-2">
			<div class="card-header card_header p-2">Source</div>
			<div class="card-body p-1 text-center text-light">
				@if ($recipe->source)
					{{ $recipe->source }}
				@else
					N/A
				@endif
			</div>
		</div>
	</div>
{{-- @endif --}}