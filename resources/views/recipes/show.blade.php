@extends ('layouts.master')

@section ('stylesheets')
	{{ Html::style('css/recipes.css') }}
@stop

@section('left_column')
	@include('blocks.main_menu')
	@include('recipes.menu')
@endsection

@section('right_column')
	@include('recipes.sidebar')
	{{-- @include('recipes.blocks.information') --}}
	@include('recipes.blocks.popularRecipes')
	@include('recipes.blocks.archives')
	@include('recipes.show.leave_comment')
@endsection

@section ('content')

<form style="display:inline;">

	<div class="card mb-3">
		<div class="card-header section_header p-2">
			{{ $recipe->title }}
			<span class="float-right">
				<div class="btn-group">
					@include('recipes.buttons.back', ['size'=>'xs'])
					@include('recipes.buttons.print', ['size'=>'xs'])
					@include('recipes.buttons.printPDF', ['size'=>'xs'])
					@include('recipes.buttons.favorite', ['size'=>'xs'])
  		         @include('recipes.buttons.privatize', ['size'=>'xs'])
					@include('recipes.buttons.publish', ['size'=>'xs'])
					@include('recipes.buttons.edit', ['size'=>'xs'])
					@include('recipes.buttons.trash', ['size'=>'xs'])
				</div>
			</span>
		</div>
	
		<div class="card-body section_body p-2">
	
			<div class="row">
				@include('recipes.show.ingredients')
				@include('recipes.show.image')
			</div>

			{{-- <div class="row pb-2"> --}}
				@include('common.view_more', ['message'=>'If you would like to see the full recipe'])
			{{-- </div> --}}

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
					{{-- @include('recipes.show.author') --}}
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
					{{-- @include('recipes.show.comments') --}}
					@include('common.comments', ['model'=>$recipe])
				</div>
			</div>

		</div>
	</div>

	{{-- @include('modals.image', ['title'=>'Recipe Image', 'img_path'=>'_recipes', 'img_name'=>'image', 'model'=>$recipe]) --}}
   {{-- @include('modals.print', ['title'=>'Print','name'=>'recipes','model'=>$recipe]) --}}
</form>
@stop
