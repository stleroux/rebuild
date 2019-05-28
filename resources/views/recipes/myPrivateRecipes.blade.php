@extends('layouts.recipes')

@section ('stylesheets')
   {{ Html::style('css/recipes.css') }}
@endsection

@section('left_column')
@endsection

@section('right_column')
@endsection

@section('content')
   <form style="display:inline;">
      {!! csrf_field() !!}
      
      <div class="card">
         <div class="card-header">
            <i class="fa fa-address-card-o" aria-hidden="true"></i>
            My Private Recipes
            <span class="float-right">
               @include('recipes.addins.links.help', ['bookmark'=>'recipes'])
               @include('recipes.addins.links.add')
               @include('recipes.addins.pages.published')
               @include('recipes.addins.pages.unpublished')
               @include('recipes.addins.pages.new')
               @include('recipes.addins.pages.future')
               @include('recipes.addins.pages.trashed')
               @include('recipes.addins.pages.mine')
            </span>
         </div>

         @if($recipes->count() > 0)
            <div class="card-body card_body p-2">
               @include('recipes.alphabet_2', ['model'=>'recipe', 'page'=>'myPrivateRecipes'])
               <table id="datatable" class="table table-sm table-hover">
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
                        <td><a href="{{ route('recipes.view', $recipe->id) }}">{{ ucwords($recipe->title) }}</a></td>
                        <td>{{ ucwords($recipe->category->name) }}</td>
                        <td>{{ $recipe->views }}</td>
                        <td>@include('common.authorFormat', ['model'=>$recipe, 'field'=>'user'])</td>
                        <td>@include('common.dateFormat', ['model'=>$recipe, 'field'=>'created_at'])</td>
                        <td>@include('common.dateFormat', ['model'=>$recipe, 'field'=>'published_at'])</td>
                        <td class="text-right">
                           @include('recipes.addins.links.edit', ['size'=>'xs'])
                           @include('recipes.addins.links.trash', ['size'=>'xs'])
                        </td>
                     </tr>
                     @endforeach
                  </tbody>
               </table>
            </div>
         @else
            <div class="card-body card_body">
               {{ setting('no_records_found') }}
              </div>
         @endif

      </div>
   </form>
   
@endsection
