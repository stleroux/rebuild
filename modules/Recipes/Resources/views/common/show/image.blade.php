<div class="col-sm-4">
	<div class="card mb-2">
		
		<div class="card-header card_header_2">Image</div>
		
		<div class="card-body text text-center p-0 m-0">
			@if($recipe->image)
				{{-- {{ Html::image("_recipes/" . $recipe->image, "", array('class'=>'card-img img-fluid img-rounded')) }} --}}
				<img src="/_recipes/{{ $recipe->image }}" alt="" height="200px" width="auto" class="card-img">
			@else
				{{ Html::image("_recipes/image_not_available.jpg", "", array('class'=>'card-img img-fluid img-rounded')) }}
			@endif
		</div>

	</div>
</div>
