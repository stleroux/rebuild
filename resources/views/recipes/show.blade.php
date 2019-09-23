@extends ('layouts.master')

@section ('stylesheets')
	{{ Html::style('css/woodbarn.css') }}
@endsection

@section('left_column')
	{{-- @include('blocks.main_menu') --}}
@endsection

@section('right_column')
	@include('recipes.blocks.sidebar')
	@include('recipes.blocks.popularRecipes')
	@include('recipes.blocks.archives')
	@include('recipes.show.leave_comment')
@endsection

@section ('content')

	<form style="display:inline;">
		<div class="card mb-3">
			<div class="card-header section_header p-2">
				<div class="row p-0 m-0">
					<div class="col-sm-12 col-md-12 col-lg-4 px-0">
						&nbsp;{{ $recipe->title }}
					</div>
					<div class="col-sm-12 col-md-6 col-lg-4 px-0">
						<div class="text-center">
							<div class="btn-group">
								@if($byCatName)
									@include('recipes.buttons.previous', ['size'=>'xs', $previous, $byCatName])
									@include('recipes.buttons.next', ['size'=>'xs', $next, $byCatName])
								@else
									@include('recipes.buttons.previousAll', ['size'=>'xs', $previous])
									@include('recipes.buttons.nextAll', ['size'=>'xs', $next])
								@endif
							</div>
						</div>
					</div>
					<div class="col-sm-12 col-md-6 col-lg-4 px-0">
						<div class="text-right">
							<div class="btn-group">
								@include('recipes.buttons.back', ['size'=>'xs'])
								@include('recipes.buttons.print', ['size'=>'xs'])
								@include('recipes.buttons.printPDF', ['size'=>'xs'])
								@include('recipes.buttons.favorite', ['size'=>'xs'])
							</div>
						</div>
					</div>
				</div>
			</div>

			<div class="card-body section_body p-2">
				<div class="row">
					@include('recipes.show.ingredients')
					@include('recipes.show.image')
				</div>

				@include('common.view_more', ['message'=>'If you would like to see the full recipe'])

				@auth
					<div class="row">
						@include('recipes.show.methodology')
					</div>

					<div class="row">
						@include('recipes.show.category')
						@include('recipes.show.servings')
						@include('recipes.show.prep_time')
						@include('recipes.show.cook_time')
						@include('recipes.show.personal')
						@include('recipes.show.views')
						@include('recipes.show.source')
						@include('recipes.show.publishDate')
					</div>

					<div class="row">
						@include('recipes.show.public_notes')
						@include('recipes.show.private_notes')
					</div>

					<div class="row">
						@include('recipes.show.information')
					</div>
				@endauth

				<div class="row m-0 p-0">
					<div class="col m-0 p-0">
						@include('common.comments', ['model'=>$recipe])
					</div>
				</div>

			</div>
		</div>
	</form>
@endsection
