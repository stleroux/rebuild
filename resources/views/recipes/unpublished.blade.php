@extends('layouts.recipes')

@section('stylesheets')
   {{ Html::style('css/recipes.css') }}
@endsection

@section('left_column')
@endsection

@section('right_column')
@endsection

@section('content')

   <form style="display:inline;">
      {!! csrf_field() !!}
      
      <div class="card mb-3">
         <div class="card-header">
            <i class="fa fa-address-card-o"></i>
            Unpublished Recipes
            <span class="float-right">
               @include('common.buttons.help', ['model'=>'recipe', 'bookmark'=>'recipes'])
               {{-- @include('recipes::backend.unpublished.help') --}}
               @include('common.buttons.add', ['model'=>'recipe'])
               @include('recipes.buttons.published')
               @include('recipes.buttons.new')
               @include('recipes.buttons.future')
               @include('recipes.buttons.trashed')
               @include('recipes.buttons.mine')
               @include('recipes.buttons.private')
            </span>
         </div>
         
         @if($recipes->count() > 0)
            <div class="card-body card_body p-2">
               @include('recipes.alphabet', ['model'=>'recipe', 'page'=>'unpublished'])
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
                           @include('common.buttons.edit', ['name'=>'recipe', 'model'=>$recipe])
                           @include('common.buttons.publish', ['name'=>'recipe', 'model'=>$recipe])
                           @include('common.buttons.trash', ['name'=>'recipe', 'model'=>$recipe])
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
