@extends ('layouts.master')

@section ('stylesheets')
	{{ Html::style('css/recipes.css') }}
@stop

@section('left_column')
	@include('recipes.sidebar')
@endsection

@section('right_column')
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
				@include('recipes.addins.links.back')
				@include('recipes.addins.links.print')
				@include('recipes.addins.links.favorite', ['size'=>'sm'])
  	         @include('recipes.addins.links.privatize', ['size'=>'sm'])
				@include('recipes.addins.links.publish', ['size'=>'sm'])
				@include('recipes.addins.pages.published')
				@include('recipes.addins.pages.unpublished')
				@include('recipes.addins.pages.new')
				@include('recipes.addins.pages.trashed')
				@include('recipes.addins.pages.mine')
				@include('recipes.addins.pages.myPrivate')
				@include('recipes.addins.links.edit', ['size'=>'sm'])
				@include('recipes.addins.links.trash', ['size'=>'sm'])
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
				</div>

				<div class="row">
					@include('recipes.show.public_notes')
					@include('recipes.show.private_notes')
				</div>

				<div class="row">
					@include('recipes.show.information')
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
