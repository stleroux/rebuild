@extends ('layouts.master')

@section ('stylesheets')
	{{-- {{ Html::style('css/recipes.css') }} --}}
@stop

@section('left_column')
		@if(
				(Session::get('pageName') === 'recipes_index') ||
				(Session::get('pageName') === 'myFavorites') ||
				(Session::get('pageName') === 'archive') ||
				(Session::get('pageName') === 'home') ||
				(Session::get('pageName') === 'bycat') ||
				(Session::get('pageName') === 'show')
			)
	   	@include('blocks.home_menu')
	   	@include('recipes::frontend.sidebar')
		@else
		   @include('blocks.adminNav')
			@include('recipes::backend.sidebar')
		@endif
@endsection

@section('right_column')
	@include('blocks.popularRecipes')
	@include('recipes::frontend.blocks.archives')
	@include('recipes::common.show.leave_comment')
@endsection

@section ('content')

<form style="display:inline;">

	<div class="card mb-3 bg-transparent">
		<div class="card-header card_header">
			{{ $recipe->title }}
			<span class="float-right">
				@include('common.buttons.cancel', ['model'=>'recipe', 'type'=>''])
				@auth
					@include('common.buttons.print', ['model'=>'recipe', 'id'=>$recipe->id])
				@endauth
			</span>
		</div>
	
		<div class="card-body card_body">
	
			<div class="row">
				@include('recipes::common.show.ingredients')
				@include('recipes::common.show.image')
			</div>

			<div class="row">
				@include('common.view_more', ['message'=>'If you would like to see the full recipe'])
			</div>

			@auth

				<div class="row">
					@include('recipes::common.show.methodology')
				</div>

				<div class="row">
					@include('recipes::common.show.category')
					@include('recipes::common.show.servings')
					@include('recipes::common.show.prep_time')
					@include('recipes::common.show.cook_time')
					@include('recipes::common.show.personal')
					@include('recipes::common.show.views')
					@include('recipes::common.show.source')
					@include('recipes::common.show.author')
				</div>

				<div class="row">
					@include('recipes::common.show.public_notes')
					@include('recipes::common.show.private_notes')
				</div>

			@endauth

			<div class="row">
				@include('recipes::common.show.comments')
			</div>

		</div>
	</div>

	{{-- @include('modals.image', ['title'=>'Recipe Image', 'img_path'=>'_recipes', 'img_name'=>'image', 'model'=>$recipe]) --}}
   {{-- @include('modals.print', ['title'=>'Print','name'=>'recipes','model'=>$recipe]) --}}
</form>
@stop
