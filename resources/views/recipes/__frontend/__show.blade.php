@extends ('layouts.master')

@section ('stylesheets')
	{{-- {{ Html::style('css/recipes.css') }} --}}
@stop

@section('left_column')
   @include('blocks.main_menu')
@endsection

@section('right_column')
	{{-- @include('recipes::frontend.show.controls') --}}
	@include('recipes::frontend.show.leave_comment')
@endsection

@section ('content')

	<div class="card mb-3 bg-transparent">
		<div class="card-header card_header">
			{{ $recipe->title }}
			<span class="float-right">
				{{-- @include('common.buttons.cancelWithId', ['model'=>'recipe', 'id'=>$recipe->id]) --}}
				@include('common.buttons.cancel', ['model'=>'recipe'])
			</span>
		</div>
	
		<div class="card-body card_body">
	
			<div class="row">
				@include('recipes::frontend.show.ingredients')
				@include('recipes::frontend.show.image')
			</div>

			<div class="row">
				@include('common.view_more', ['message'=>'If you would like to see the full recipe'])
			</div>

			@auth
				<div class="row">
					@include('recipes::frontend.show.methodology')
				</div>

				<div class="row">
					@include('recipes::frontend.show.category')
					@include('recipes::frontend.show.servings')
					@include('recipes::frontend.show.prep_time')
					@include('recipes::frontend.show.cook_time')
					@include('recipes::frontend.show.personal')
					@include('recipes::frontend.show.views')
					@include('recipes::frontend.show.source')
				</div>

				<div class="row">
					@include('recipes::frontend.show.author_notes')
				</div>
			@endauth

			<div class="row">
				@include('recipes::frontend.show.comments')
			</div>

		</div>
	</div>

	{{-- @include('modals.image', ['title'=>'Recipe Image', 'img_path'=>'_recipes', 'img_name'=>'image', 'model'=>$recipe]) --}}
   {{-- @include('modals.print', ['title'=>'Print','name'=>'recipes','model'=>$recipe]) --}}
@stop

@section('blocks')
	@include('recipes::frontend.show.controls')
	{{-- @include('recipes::frontend.show.information') --}}
	{{-- @include('common.information', ['model'=>$recipe, 'title'=>'Recipe']) --}}
	@include('recipes::frontend.blocks.archives')
	@include('recipes::frontend.show.leave_comment')
@stop

@section ('scripts')
@stop