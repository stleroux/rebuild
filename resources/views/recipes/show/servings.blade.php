{{-- @if(checkACL('user')) --}}
	<div class="col-md-3 px-md-1">
		<div class="card mb-2">
			<div class="card-header card_header p-2">Servings</div>
			<div class="card-body p-1 text-center text-light">
            {{ $recipe->servings }}
         </div>
		</div>
	</div>
{{-- @endif --}}