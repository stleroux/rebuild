<div class="col-sm-4">
	<div class="card mb-2">
		
		<div class="card-header card_header p-2">Image</div>
		
		<div class="card-body text text-center p-2">
			@if($recipe->image)
				<img src="/_recipes/{{ $recipe->image }}" alt="" height="200px" width="auto" class="card-img">
			@else
				<img src="/_recipes/image_not_available.jpg" alt="" height="200px" width="auto" class="card-img">
			@endif
		</div>

	</div>
</div>
