{{-- @if(checkACL('user')) --}}
	<div class="col-md-3 px-1">
		<div class="card mb-2">
			<div class="card-header card_header p-2">Prep Time <small>(Minutes)</small></div>
			<div class="card-body p-1 text-center text-light">
            {{ $recipe->prep_time }}
         </div>
		</div>
	</div>
{{-- @endif --}}