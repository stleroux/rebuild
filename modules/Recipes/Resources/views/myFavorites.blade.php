@extends('layouts.master')

@section('stylesheets')
   {{-- {{ Html::style('css/recipes.css') }} --}}
@endsection

@section('left_column')
   {{-- @include('recipes::index.controls') --}}
@endsection

@section('right_column')
@endsection

@section('content')
   <form style="display:inline;">
      {!! csrf_field() !!}
      
      <div class="card">
         <div class="card-header">
            <i class="fa fa-thumbs-o-up"></i>
            My Favorite Recipes
            <span class="float-right">
               <button type="button" class="btn btn-xs btn-primary pull-right" data-toggle="modal" data-target="#help">
                  <i class="fa fa-question-circle" aria-hidden="true"></i>
                  Help
               </button>
            </span>
         </div>

{{--          @if($recipes->count() > 0)
            <div class="text-center py-2">
               <a href="{{ route('recipes.myFavorites') }}" class="{{ Request::is('recipes/myFavorites') ? "btn-secondary": "btn-primary" }} btn btn-sm">All</a>
               @foreach($letters as $value)
                  <a href="{{ route('recipes.myFavorites', $value) }}" class="{{ Request::is('recipes/myFavorites/'.$value) ? "btn-secondary": "btn-primary" }} btn btn-sm">{{ strtoupper($value) }}</a>
               @endforeach
            </div>
         @endif --}}

         @if($recipes->count() > 0)
            <div class="card-body card_body pt-0 pb-2">
               @foreach($recipes->chunk(6) as $chunk)
                  <div class="card-deck mb-0 pb-0">
                     @foreach($chunk as $recipe)
                        <div class="card col-xs-12 col-sm-6 col-md-4 col-lg-2 p-0 m-2">
                           @if($recipe->image)
                              <a href="{{ route('recipes.show', $recipe->id) }}" class="" style="text-decoration: none">
                                 <img class="card-img-top" src="\_recipes\{{ $recipe->image }}" height="100px" width="100%">
                              </a>
                           @else
                              <a href="{{ route('recipes.show', $recipe->id) }}" class="" style="text-decoration: none">
                                 <img class="card-img-top" src="\_recipes\image_not_available.jpg" height="100px" width="100%">
                              </a>
                           @endif
                           <div class="card-body card_body">
                              <a href="{{ route('recipes.show', $recipe->id) }}" class="" style="text-decoration: none">
                                 <h5 class="card-title text-center">{{ ucwords($recipe->title) }}</h5>
                              </a>
                           </div>

                           <div class="card-text p-0 m-0">
                                 <div class="align-self-end">
                                    <a href="{{ route('recipes.favoriteRemove', $recipe->id) }}" class="btn btn-sm btn-block btn-outline-warning p-0 m-0">Remove Favorite</a>
                                 </div>
                              </div>

                           <div class="card-footer px-1 py-0 text-center">
                              <small class="">
                                 Submitted by 
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
               @endforeach
            </div>
         @else
            <div class="card-body card_body">
               {{ setting('no_records_found') }}
            </div>
         @endif
      </div>
   </form>

   @include('recipes::myFavorites.help')
@endsection
