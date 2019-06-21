{{-- @if(checkACL('user')) --}}
	<div class="col-md-3">
		<div class="card mb-2">
			<div class="card-header card_header_2">Source</div>
			<div class="card-body text-center">
				@if ($recipe->source)
					{{ $recipe->source }}
				@else
					N/A
				@endif
			</div>
		</div>
	</div>
{{-- @endif --}}