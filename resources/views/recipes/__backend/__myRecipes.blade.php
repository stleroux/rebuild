@extends('layouts.master')

@section('stylesheets')
   {{-- {{ Html::style('css/recipes.css') }} --}}
@endsection

@section('left_column')
   @include('blocks.main_menu')
@endsection

@section('right_column')
   @include('recipes::frontend.blocks.archives')
@endsection

@section('content')

   <div class="card mb-3">
      <div class="card-header">
         <i class="fas fa-dot-circle"></i>
         MY RECIPES
         <span class="float-right">
            @include('common.buttons.help', ['model'=>'recipe', 'type'=>''])
            @include('recipes::frontend.myRecipes.help')
            {{-- @include('common.buttons.recipes', ['model'=>'recipe', 'type'=>'']) --}}
            {{-- @include('common.buttons.myFavorites', ['model'=>'recipe', 'type'=>'']) --}}
         </span>
      </div>
      
      @if($recipes->count() > 0)
         <div class="card-body card_body p-2">
            @include('common.alphabet', ['model'=>'recipe', 'page'=>'myRecipes'])
            @foreach($recipes->chunk(6) as $chunk)
               <div class="card-deck mb-0 px-2">
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
                        <div class="card-body pt-1 pb-0">
                           <a href="{{ route('recipes.show', $recipe->id) }}" class="" style="text-decoration: none">
                              <h6 class="card-title text-center pb-2 m-0">
                                 {{ ucwords($recipe->title) }}
                              </h6>
                           </a>
                        </div>
                        
                        <div class="card-text p-0 m-0 text-center">
                           <div class="align-self-end">
                              <p>
                                 <span class="badge badge-light text-dark" title="Views">{{ $recipe->views }} Views</span>
                                 <span class="badge badge-light text-dark" title="Comments">{{ $recipe->comments->count() }} Comments</span>
                              </p>
                           </div>   
                        </div>

                        @auth
                           <div class="card-text pb-1 m-0">
                              <div class="align-self-end text-center">
                                 @include('common.buttons.edit', ['model'=>'recipe', 'id'=>$recipe->id, 'type' =>''])
                                 @if($recipe->personal == 0)
                                    @include('common.buttons.makePrivate', ['model'=>'recipe', 'id'=>$recipe->id, 'type' =>''])
                                 @else
                                    @include('common.buttons.makePublic', ['model'=>'recipe', 'id'=>$recipe->id, 'type' =>''])
                                 @endif
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
         </div>

         <div class="card-footer px-1 py-1">
            {{-- {{ $recipes->links("pagination::bootstrap-4") }} --}}
            {{-- {{ $recipes->links("pagination::simple-default") }} --}}
            @if($recipes->count() > 17)
               {{ $recipes->links() }}
            @else
               &nbsp;
            @endif
         </div>
      @else
         <div class="card-body card_body">
            {{ setting('no_records_found') }}
         </div>
      @endif
   </div>

@endsection

