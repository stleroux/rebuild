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
      
      <div class="card mb-3">
         <div class="card-header">
            <i class="fa fa-address-card-o" aria-hidden="true"></i>
            My Recipes
            <span class="float-right">
               <button type="button" class="btn btn-xs btn-primary pull-right" data-toggle="modal" data-target="#help">
                  <i class="fa fa-question-circle" aria-hidden="true"></i>
                  Help
               </button>
            </span>
         </div>
         
         @if($recipes->count() > 0)
            <div class="pt-1 text-center">
               <a href="{{ route('recipes.myRecipes') }}" class="{{ Request::is('recipes/myRecipes') ? "btn-secondary": "btn-primary" }} btn btn-sm">All</a>
               @foreach($letters as $value)
                  <a href="{{ route('recipes.myRecipes', $value) }}" class="{{ Request::is('recipes/myRecipes/'.$value) ? "btn-secondary": "btn-primary" }} btn btn-sm">{{ strtoupper($value) }}</a>
               @endforeach
            </div>
         @endif

         @include('recipes::myRecipes.help')

         <div class="card-body card_body px-3 py-0">
            @if($recipes->count() > 0)
               @foreach($recipes->chunk(6) as $chunk)
                  <div class="card-deck mb-2 pb-2">
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
                           <div class="card-body pt-1">
                              <a href="{{ route('recipes.show', $recipe->id) }}" class="" style="text-decoration: none">
                                 <h5 class="card-title text-center pb-2 m-0">{{ ucwords($recipe->title) }}</h5>
                              </a>
                           </div>
                           
                           @auth
                              <div class="card-text p-0 m-0">
                                 <div class="text-center">
                                    {{-- @if($recipe->user_id === Auth::user()->id) --}}
                                    <a href="{{ route('recipes.edit', $recipe->id) }}" class="btn btn-sm btn-outline-secondary p-0 m-0 col-2" title="Edit">
                                       <i class="fas fa-edit"></i>
                                    </a>
                                    <a href="{{ route('recipes.makePrivate', $recipe->id) }}" class="btn btn-sm btn-outline-secondary p-0 m-0 col-2" title="Make Private">
                                       <i class="far fa-eye-slash"></i>
                                    </a>
                                    <a href="{{ route('recipes.removePrivate', $recipe->id) }}" class="btn btn-sm btn-outline-secondary p-0 m-0 col-2" title="Make Public">
                                       <i class="far fa-eye"></i>
                                    </a>
                                    {{-- @endif --}}
                                 </div>
                              </div>
                           @endauth

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
            @else
               {{ setting('no_records_found') }}
            @endif
         </div>
         {!! $recipes->links() !!}
      </div>
   </form>
   
@endsection

