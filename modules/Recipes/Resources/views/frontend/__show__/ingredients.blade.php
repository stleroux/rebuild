<div class="{{ $recipe->image ? 'col-sm-8' : 'col-sm-12' }}">
	<div class="card mb-2">
		<div class="card-header card_header_2">Ingredients</div>
		<div class="card-body card_body">
			@auth
				{!! $recipe->ingredients !!}
			@else
				@if(strlen($recipe->ingredients > 50))
					{!! str_limit($recipe->ingredients, $limit = 110, $end = ' [More...]') !!}
				@else
					{!! str_limit($recipe->ingredients, $limit = 35, $end = ' [More...]') !!}
				@endif
			@endif
		</div>
	</div>
</div>
