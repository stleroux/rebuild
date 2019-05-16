@extends ('layouts.master')

@section ('stylesheets')
	{{ Html::style('css/recipes.css') }}
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
	   	@include('recipes.sidebar')
		@else
		   {{-- @include('blocks.adminNav') --}}
			@include('recipes.sidebar')
		@endif
@endsection

@section('right_column')
	@include('blocks.popularRecipes')
	@include('recipes.blocks.archives')
	@include('recipes.show.leave_comment')
@endsection

@section ('content')

<form style="display:inline;">

	<div class="card mb-3 bg-transparent">
		<div class="card-header card_header">
			{{ $recipe->title }}
			<span class="float-right">
				@include('common.buttons.cancel', ['model'=>'recipe'])
				@auth
					@include('common.buttons.print', ['model'=>'recipe', 'id'=>$recipe->id])
					@include('common.buttons.edit', ['name'=>'recipe', 'model'=>$recipe])
					@include('common.buttons.publish', ['name'=>'recipe', 'model'=>$recipe])
					@include('common.buttons.unpublish', ['name'=>'recipe', 'model'=>$recipe])
					@include('common.buttons.trash', ['name'=>'recipe', 'model'=>$recipe])
				@endauth
			</span>
		</div>
	
		<div class="card-body card_body">
	
			<div class="row">
				@include('recipes.show.ingredients')
				@include('recipes.show.image')
			</div>

			<div class="row">
				@include('common.view_more', ['message'=>'If you would like to see the full recipe'])
			</div>

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
					@include('recipes.show.author')
				</div>

				<div class="row">
					@include('recipes.show.public_notes')
					@include('recipes.show.private_notes')
				</div>

			@endauth

			<div class="row">
				@include('recipes.show.comments')
			</div>

		</div>
	</div>

	{{-- @include('modals.image', ['title'=>'Recipe Image', 'img_path'=>'_recipes', 'img_name'=>'image', 'model'=>$recipe]) --}}
   {{-- @include('modals.print', ['title'=>'Print','name'=>'recipes','model'=>$recipe]) --}}
</form>
@stop
