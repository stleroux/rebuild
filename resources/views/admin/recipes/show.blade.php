@extends ('layouts.master')

@section ('stylesheets')
   {{ Html::style('css/woodbarn.css') }}
@endsection

@section('left_column')
@endsection

@section('right_column')
   @include('admin.recipes.blocks.sidebar')
@endsection

@section ('content')

<form style="display:inline;">

   <div class="card mb-3">
      <div class="card-header section_header p-2">
         {{ $recipe->title }}
         <span class="float-right">
            <div class="btn-group">
               @include('admin.recipes.buttons.back', ['size'=>'sm'])
               {{-- @include('admin.recipes.buttons.print', ['size'=>'sm']) --}}
               {{-- @include('admin.recipes.buttons.privatize', ['size'=>'sm']) --}}
               @include('admin.recipes.buttons.edit', ['size'=>'sm'])
               {{-- @include('admin.recipes.buttons.favorite', ['size'=>'sm']) --}}
               @include('admin.recipes.buttons.publish', ['size'=>'sm'])
               @include('admin.recipes.buttons.trash', ['size'=>'sm'])
            </div>
         </span>
      </div>
   
      <div class="card-body section_body p-2">
   
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

         {{-- <div class="row"> --}}
            {{-- @include('recipes.show.comments') --}}
            @include('common.comments', ['model'=>$recipe])
         {{-- </div> --}}

      </div>
   </div>

   {{-- @include('modals.image', ['title'=>'Recipe Image', 'img_path'=>'_recipes', 'img_name'=>'image', 'model'=>$recipe]) --}}
   {{-- @include('modals.print', ['title'=>'Print','name'=>'recipes','model'=>$recipe]) --}}
</form>
@endsection
