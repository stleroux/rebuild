@extends('layouts.master')

@section('stylesheets')
   {{ Html::style('css/recipes.css') }}
@endsection

@section('left_column')
   @include('recipes.sidebar')
@endsection

@section('right_column')
   @include('recipes.blocks.popularRecipes')
   @include('recipes.blocks.archives')
@endsection

@section('content')

   <form style="display:inline;">
      {!! csrf_field() !!}
      
      <div class="card">
         <div class="card-header section_header p-2">
            <i class="{{ Config::get('buttons.new') }}"></i>
            New Recipes
            <span class="float-right">
               @include('recipes.addins.links.help', ['size'=>'xs', 'bookmark'=>'recipes'])
               @include('recipes.addins.buttons.unpublishAll', ['size'=>'xs'])
               @include('recipes.addins.buttons.trashAll', ['size'=>'xs'])
               @include('recipes.addins.pages.published', ['size'=>'xs'])
               @include('recipes.addins.pages.unpublished', ['size'=>'xs'])
               @include('recipes.addins.pages.new', ['size'=>'xs'])
               @include('recipes.addins.pages.future', ['size'=>'xs'])
               @include('recipes.addins.pages.trashed', ['size'=>'xs'])
               @include('recipes.addins.pages.mine', ['size'=>'xs'])
               @include('recipes.addins.pages.myPrivate', ['size'=>'xs'])
               @include('recipes.addins.links.add', ['size'=>'xs'])
            </span>
         </div>

         @if($recipes->count() > 0)
            <div class="card-body section_body p-2 text-light">
               @include('recipes.alphabet', ['model'=>'recipe', 'page'=>'newRecipes'])
               <table id="datatable" class="table table-sm table-hover text-light">
                  <thead>
                     <tr>
                         <th><input type="checkbox" id="selectall" class="checked" /></th>
                        <th>Name</th>
                        <th>Category</th>
                        <th>Views</th>
                        <th>Author</th>
                        <th>Created On</th>
                        <th>Publish(ed) On</th>
                        <th data-orderable="false"></th>
                     </tr>
                  </thead>
                  <tbody>
                     @foreach($recipes as $recipe)
                     <tr>
                        <td>
                           <input type="checkbox" onClick="checkbox_is_checked()" name="checked[]" value="{{$recipe->id}}" class="check-all">
                        </td>
                        <td>{{ ucwords($recipe->title) }}</td>
                        <td>{{ ucwords($recipe->category->name) }}</td>
                        <td>{{ $recipe->views }}</td>
                        <td>@include('common.authorFormat', ['model'=>$recipe, 'field'=>'user'])</td>
                        <td>@include('common.dateFormat', ['model'=>$recipe, 'field'=>'created_at'])</td>
                        <td>@include('common.dateFormat', ['model'=>$recipe, 'field'=>'published_at'])</td>
                        <td class="text-right">
                           @include('recipes.addins.links.view', ['size'=>'xs'])
                           @include('recipes.addins.links.edit', ['size'=>'xs'])
                           @include('recipes.addins.links.trash', ['size'=>'xs'])
                        </td>
                     </tr>
                     @endforeach
                  </tbody>
               </table>
            </div>
         @else
            <div class="card-body card_body p-2">
               {{ setting('no_records_found') }}
              </div>
         @endif

      </div>
   </form>
   
@endsection
