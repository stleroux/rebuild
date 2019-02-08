@if($recipe->image)
	<div class="col-sm-4">
		<div class="card mb-2">
			
			<div class="card-header card_header_2">Image</div>
			
			<div class="card-body text text-center">
				{{-- @if(checkACL('user')) --}}
					{{-- <a href="" data-toggle="modal" data-target="#imageModal"> --}}
						{{-- {{ Html::image("_recipes/" . $recipe->image, "", array('height'=>'150','width'=>'175')) }} --}}
						{{ Html::image("_recipes/" . $recipe->image, "", array('class'=>'card-img img-fluid img-rounded')) }}
					{{-- </a> --}}
				{{-- @else --}}
					{{-- {{ Html::image("_recipes/" . $recipe->image, "", array('height'=>'150','width'=>'175')) }} --}}
					{{-- {{ Html::image("_recipes/" . $recipe->image, "", array('class'=>'img-responsive img-rounded')) }} --}}
				{{-- @endif --}}
			</div>

		</div>
	</div>
@endif