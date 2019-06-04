@extends('layouts.master')

@section('stylesheets')
	{{ Html::style('css/recipes.css') }}
@stop

@section('left_column')
	{{-- @include('blocks.home_menu') --}}
	@include('recipes.sidebar')
@endsection

@section('right_column')
	@include('recipes.blocks.popularRecipes')
	@include('recipes.blocks.archives')
@endsection

@section('content')

	<div class="card mb-3 bg-transparent">

		<div class="card-header card_header">
			<span class="h5 align-middle pt-2">
				<i class="fab fa-apple"></i>
				Recipes
			</span>
			<span class="float-right">
				@include('recipes.addins.links.printAll')
				@include('recipes.addins.pages.myFavorites')
				@include('recipes.addins.pages.published')
				@include('recipes.addins.pages.unpublished')
				@include('recipes.addins.pages.new')
				@include('recipes.addins.pages.future')
				@include('recipes.addins.pages.trashed')
				@include('recipes.addins.pages.mine')
				@include('recipes.addins.pages.myPrivate')
				@include('recipes.addins.links.add')
			</span>
		</div>

		@if($recipes->count() > 0)
			<div class="card-body p-1">
				<div class="my-1">
					@include('recipes.alphabet')
				</div>
				
				<div class="row justify-content-center">
					@foreach ($recipes as $recipe)
						<div id="card-hover" class="card col-xs-10 col-sm-6 col-md-4 col-lg-3 col-xl-2 m-1 p-1"
								{{-- onMouseOver="this.style.backgroundColor='red', this.style.color='yellow'"
								onMouseOut="this.style.backgroundColor='', this.style.color=''" --}}>

							@if($recipe->image)
								<a href="{{ route('recipes.show', $recipe->id) }}" class="" style="text-decoration: none">
									<img class="card-img-top" src="\_recipes\{{ $recipe->image }}" height="120px" width="auto">
								</a>
							@else
								<a href="{{ route('recipes.show', $recipe->id) }}" class="" style="text-decoration: none">
									<img class="card-img-top" src="\_recipes\image_not_available.jpg" height="120px" width="auto">
								</a>
							@endif

							<div class="card-body pt-1 pb-0">
								{{-- <a href="{{ route('recipes.show', $recipe->id) }}" class="" style="text-decoration: none"> --}}
									<h6 class="card-title text-center pb-2 m-0">
										{{ ucwords($recipe->title) }}
									</h6>
								{{-- </a> --}}
							</div>

							<div class="card-text p-0 m-0 text-center">
								<div class="align-self-end">
									<p>
										<span class="badge badge-light text-dark" title="Times Viewed">{{ $recipe->views }} Views</span>
										<span class="badge badge-light text-dark" title="Comments">{{ $recipe->comments->count() }} Comments</span>
										<br />
										<span class="badge badge-light text-dark" title="Times Favorited">{{ \App\Models\Recipes\Recipe::find($recipe->id)->favoritesCount }} Favorited</span>
									</p>
								</div>	
							</div>

							@auth
								<div class="card-text pb-1 m-0">
									<div class="align-self-end text-center">
										{{-- @if(!$recipe->isFavorited()) --}}
											@include('recipes.addins.links.favorite')
										{{-- @else
											@include('common.addins.links.favoriteRemove', ['name'=>'recipe', 'model'=>$recipe])
										@endif --}}
									</div>
								</div>
							@endauth

							<div class="card-footer px-1 py-0 text-center">
								<small class="">
									By
									@if($recipe->user->profile->first_name && $recipe->user->profile->last_name)
										{{ ucwords($recipe->user->profile->first_name) }} {{ ucwords($recipe->user->profile->last_name) }}
									@else
										{{ $recipe->user->username }}
									@endif
								</small>
							</div>

						</div>
					@endforeach
				</div>
			</div>

			<div class="card-footer px-1 py-1">
				{{ $recipes->links() }}
			</div>

		@else
			
			<div class="card-body card_body bg-danger text-dark">
				<b>{{ setting('no_records_found') }}</b>
			</div>

		@endif

	</div>

@stop
