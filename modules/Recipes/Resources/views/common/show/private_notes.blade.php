@if(Auth::user()->id == $recipe->user_id)
	<div class="col-md-12">
		<div class="card mb-2">
			<div class="card-header card_header_2">Author's Private Notes <small>(Only showed to the creator of the item)</small></div>
			<div class="card-body">
				@if ($recipe->private_notes) 
					{!! $recipe->private_notes !!}
				@else
					N/A
				@endif
			</div>
		</div>
	</div>
@endif