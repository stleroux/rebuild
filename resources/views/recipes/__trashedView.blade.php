@extends ('layouts.master')

@section ('stylesheets')
   {{-- {{ Html::style('css/recipes.css') }} --}}
@stop

@section('left_column')
   {{-- @include('blocks.adminNav') --}}
   {{-- @include('recipes::backend.sidebar') --}}
@endsection

@section('right_column')
   {{-- @include('recipes::backend.trashedView.controls') --}}
   {{-- @include('recipes::backend.trashedView.leave_comment') --}}
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
            @include('recipes::backend.trashedView.ingredients')
            @include('recipes::backend.trashedView.image')
         </div>

         <div class="row">
            @include('common.view_more', ['message'=>'If you would like to see the full recipe'])
         </div>

         @auth
            <div class="row">
               @include('recipes::backend.trashedView.methodology')
            </div>

            <div class="row">
               @include('recipes::backend.trashedView.category')
               @include('recipes::backend.trashedView.servings')
               @include('recipes::backend.trashedView.prep_time')
               @include('recipes::backend.trashedView.cook_time')
               @include('recipes::backend.trashedView.personal')
               @include('recipes::backend.trashedView.views')
               @include('recipes::backend.trashedView.source')
            </div>

            <div class="row">
               @include('recipes::backend.trashedView.author_notes')
            </div>
         @endauth

         <div class="row">
            @include('recipes::backend.trashedView.comments')
         </div>

      </div>
   </div>

   {{-- @include('modals.image', ['title'=>'Recipe Image', 'img_path'=>'_recipes', 'img_name'=>'image', 'model'=>$recipe]) --}}
   {{-- @include('modals.print', ['title'=>'Print','name'=>'recipes','model'=>$recipe]) --}}
@stop

@section('blocks')
   {{-- @include('recipes::backend.trashedView.controls') --}}
   {{-- @include('recipes::backend.trashedView.information') --}}
   {{-- @include('common.information', ['model'=>$recipe, 'title'=>'Recipe']) --}}
   {{-- @include('recipes::blocks.archives') --}}
   {{-- @include('recipes::backend.trashedView.leave_comment') --}}
@stop

@section ('scripts')
@stop