@extends('layouts.master')

@section('stylesheets')
	{{ Html::style('css/recipes.css') }}
@endsection

@section('left_column')
	{{-- @include('blocks.main_menu') --}}
@endsection

@section('right_column')
	@include('recipes.blocks.sidebar')
	@include('recipes.blocks.popularRecipes')
	@include('recipes.blocks.archives')
@endsection

@section('content')

	<div class="card mb-3">

		<div class="card-header section_header p-2">
			<i class="fab fa-apple"></i>
			Recipes
			@if($byCatName)
				 :: {{  deliciousCamelcase(ucwords($byCatName->name)) }}
			@endif

			<span class="float-right">
				<div class="btn-group">
					@include('recipes.dropdown', ['size'=>'sm'])
					@include('recipes.buttons.printAll', ['size'=>'sm'])
					{{-- @include('admin.recipes.buttons.add', ['size'=>'sm']) --}}
				</div>
			</span>
		</div>

		@if($recipes->count() > 0)
			<div class="card-body section_body p-1">
				<div class="my-1">
					@include('recipes.alphabet_2')
				</div>
				
				<div class="row justify-content-center">
					@foreach ($recipes as $recipe)
						<div id="card-hover" class="card col-xs-10 col-sm-6 col-md-4 col-lg-3 col-xl-2 m-1 p-1"
								{{-- onMouseOver="this.style.backgroundColor='red', this.style.color='yellow'"
								onMouseOut="this.style.backgroundColor='', this.style.color=''" --}}>

							@if($recipe->image)
								<a href="{{ route('recipes.show', [$recipe->id, $byCatName]) }}" class="" style="text-decoration: none">
									<img class="card-img-top" src="\_recipes\{{ $recipe->image }}" height="120px" width="auto">
								</a>
							@else
								<a href="{{ route('recipes.show', [$recipe->id, $byCatName]) }}" class="" style="text-decoration: none">
									<img class="card-img-top" src="\_recipes\image_not_available.jpg" height="120px" width="auto">
								</a>
							@endif

							<div class="card-body pt-1 pb-0">
								{{-- <a href="{{ route('recipes.show', $recipe->id) }}" class="" style="text-decoration: none"> --}}
									<h6 class="card-title text-center pb-2 m-0 text-light">
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
											@include('recipes.buttons.favorite', ['size'=>'xs'])
										{{-- @else
											@include('common.buttons.favoriteRemove', ['name'=>'recipe', 'model'=>$recipe])
										@endif --}}
									</div>
								</div>
							@endauth

							<div class="card-footer px-1 py-0 text-center">
								<small class="">
									By
									@if($recipe->user->first_name && $recipe->user->last_name)
										{{ ucwords($recipe->user->first_name) }} {{ ucwords($recipe->user->last_name) }}
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
			
			<div class="card-body card_body p-2">
				{{ setting('no_records_found') }}
			</div>

		@endif

	</div>

@endsection
