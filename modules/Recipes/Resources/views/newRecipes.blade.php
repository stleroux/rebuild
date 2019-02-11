@extends('layouts.master')

@section ('stylesheets')
   {{-- {{ Html::style('css/recipes.css') }} --}}
@endsection

@section('left_column')
   {{-- @include('recipes::index.controls') --}}
   @include('blocks.admin_menu')
@endsection

@section('right_column')
@endsection

@section('content')
   <form style="display:inline;">
      {!! csrf_field() !!}
      
      <div class="card">
         <div class="card-header">
            <i class="fa fa-address-card-o" aria-hidden="true"></i>
            New Recipes
            <span class="float-right">
               <button type="button" class="btn btn-xs btn-primary pull-right" data-toggle="modal" data-target="#help">
                  <i class="fa fa-question-circle" aria-hidden="true"></i>
                  Help
               </button>
            </span>
         </div>

         @if($recipes->count() > 0)
            <div class="pt-1 text-center">
               <a href="{{ route('recipes.newRecipes') }}" class="{{ Request::is('recipes/newRecipes') ? "btn-secondary": "btn-primary" }} btn btn-sm">All</a>
               @foreach($letters as $value)
                  <a href="{{ route('recipes.newRecipes', $value) }}" class="{{ Request::is('recipes/newRecipes/'.$value) ? "btn-secondary": "btn-primary" }} btn btn-sm">{{ strtoupper($value) }}</a>
               @endforeach
            </div>
         @endif

         @include('recipes::newRecipes.help')

         {{-- <div class="card-body card_body px-3 py-0">
            @if($recipes->count() > 0)
               @foreach($recipes->chunk(6) as $chunk)
                  <div class="card-deck mb-2 pb-2">
                     @foreach($chunk as $recipe)
                        <a href="{{ route('recipes.show', $recipe->id) }}" class="card col-xs-12 col-sm-6 col-md-4 col-lg-2 p-0 m-2" style="text-decoration: none">
                           @if($recipe->image)
                              <img class="card-img-top" src="\_recipes\{{ $recipe->image }}" height="100px" width="100%">
                           @else
                              <img class="card-img-top" src="\_recipes\image_not_available.jpg" height="100px" width="100%">
                           @endif
                           <div class="card-body card_body">
                              <h5 class="card-title text-center">{{ ucwords($recipe->title) }}</h5>
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
                        </a>
                     @endforeach
                  </div>
               @endforeach
            @else
               No records found
            @endif
         </div> --}}
         @if($recipes->count() > 0)
            <div class="card-body card_body px-1 py-0">
               @include('recipes::table')
            </div>
         @else
            <div class="card-body card_body">
               {{ setting('no_records_found') }}
              </div>
         @endif

      </div>
   </form>
   
@endsection
