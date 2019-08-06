<div class="col-sm-8 pr-1">
	<div class="card mb-2">
		<div class="card-header card_header p-2">Ingredients</div>
		<div class="card-body p-1 text-light">
			@auth
				{!! $recipe->ingredients !!}
			@else
				@if(strlen($recipe->ingredients))
					{{-- {!! str_limit($recipe->ingredients, $limit = 110, ' [More...]') !!}
				@else --}}
					{!! str_limit($recipe->ingredients, $limit = 52, ' [More...]') !!}
				@endif
			@endif
		</div>
	</div>
</div>
