@extends('layouts.master')

@section ('stylesheets')
   {{ Html::style('css/recipes.css') }}
@endsection

@section('left_column')
   @include('blocks.main_menu')
@endsection

@section('right_column')
   @include('recipes.blocks.popularRecipes')
   @include('recipes.blocks.archives')
@endsection

@section('content')
   <form style="display:inline;">
      {!! csrf_field() !!}
      
      <div class="card mb-3">
         <div class="card-header section_header p-2">
            <i class="{{ Config::get('buttons.mine') }}"></i>
            My Recipes
            <span class="float-right">
               {{-- @include('recipes.addins.links.help', ['bookmark'=>'recipes']) --}}
               @include('recipes.addins.links.recipes', ['size'=>'xs'])
               @include('recipes.addins.pages.published', ['size'=>'xs'])
               @include('recipes.addins.pages.unpublished', ['size'=>'xs'])
               @include('recipes.addins.pages.new', ['size'=>'xs'])
               @include('recipes.addins.pages.future', ['size'=>'xs'])
               @include('recipes.addins.pages.trashed', ['size'=>'xs'])
               @include('recipes.addins.pages.myPrivate', ['size'=>'xs'])
               @include('recipes.addins.links.add', ['size'=>'xs'])
            </span>
         </div>

         @if($recipes->count() > 0)
            <div class="card-body card_body p-2">
               @include('recipes.alphabet_2', ['model'=>'recipe', 'page'=>'newRecipes'])
               <table id="datatable" class="table table-sm table-hover">
                  <thead>
                     <tr>
                        <th><input type="checkbox" id="selectall" class="checked" /></th>
                        <th>Name</th>
                        <th>Category</th>
                        <th>Views</th>
                        {{-- <th>Author</th> --}}
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
                        <td><a href="{{ route('recipes.view', $recipe->id) }}">{{ ucwords($recipe->title) }}</a></td>
                        <td>{{ ucwords($recipe->category->name) }}</td>
                        <td>{{ $recipe->views }}</td>
                        {{-- <td>@include('common.authorFormat', ['model'=>$recipe, 'field'=>'user'])</td> --}}
                        <td>@include('common.dateFormat', ['model'=>$recipe, 'field'=>'created_at'])</td>
                        <td>@include('common.dateFormat', ['model'=>$recipe, 'field'=>'published_at'])</td>
                        <td class="text-right">
                           @include('recipes.addins.links.edit', ['size'=>'xs'])
                           {{-- @if(!$recipe->personal) --}}
                              {{-- @include('recipes.addins.links.privatize', ['size'=>'xs']) --}}
                           {{-- @else
                              @include('recipes.addins.links.makePublic', ['size'=>'xs'])
                           @endif --}}
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
