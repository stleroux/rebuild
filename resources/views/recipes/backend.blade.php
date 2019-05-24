@extends('layouts.recipes')

@section('stylesheets')
   {{ Html::style('css/recipes.css') }}
@stop

@section('left_column')
@endsection

@section('right_column')
@endsection

@section('content')

   <form style="display:inline;">
      {!! csrf_field() !!}
      
      <div class="card mb-3 pb-0 bg-transparent">
         <div class="card-header">
            <i class="fab fa-apple"></i>
            Published Recipes
            <span class="float-right">
               @include('common.buttons.help', ['model'=>'recipe', 'bookmark'=>'recipes'])
               {{-- @include('recipes::backend.published.help') --}}
               @include('common.buttons.add', ['model'=>'recipe'])
               @include('common.buttons.unpublishAll', ['model'=>'recipe'])
               @include('common.buttons.trashAll', ['model'=>'recipe'])
               @include('recipes.buttons.unpublished')
               @include('recipes.buttons.new')
               @include('recipes.buttons.future')
               @include('recipes.buttons.trashed')
               @include('recipes.buttons.mine')
               @include('recipes.buttons.private')
            </span>
         </div>

         @if($recipes->count() > 0)
            <div class="card-body card_body p-2">
               @include('recipes.alphabet', ['model'=>'recipe', 'page'=>'published'])
               {{-- @include('recipes::frontend.alphabet', ['model'=>'recipe']) --}}
               <table id="datatable" class="table table-sm table-hover">
                  <thead>
                     <tr>
                         <th><input type="checkbox" id="selectall" class="checked" /></th>
                        <th>Name</th>
                        <th>Category</th>
                        <th>Views</th>
                        <th>Favorited</th>
                        <th>Author</th>
                        <th>Created On</th>
                        <th>Published On</th>
                        <th>Deleted On</th>
                        <th data-orderable="false"></th>
                     </tr>
                  </thead>
                  <tbody>
                     @foreach($recipes as $recipe)
                     <tr {!! $recipe->deleted_at ? "class='bg-danger text-white'":"" !!}>
                        <td>
                           <input type="checkbox" onClick="checkbox_is_checked()" name="checked[]" value="{{$recipe->id}}" class="check-all">
                        </td>
                        <td><a href="{{ route('recipes.view', $recipe->id) }}">{{ ucwords($recipe->title) }}</a></td>
                        <td>{{ ucwords($recipe->category->name) }}</td>
                        <td>{{ $recipe->views }}</td>
                        <td>{{ \App\Models\Recipes\Recipe::withTrashed()->find($recipe->id)->favoritesCount }}</td>
                        <td>@include('common.authorFormat', ['model'=>$recipe, 'field'=>'user'])</td>
                        <td>@include('common.dateFormat', ['model'=>$recipe, 'field'=>'created_at'])</td>
                        <td>@include('common.dateFormat', ['model'=>$recipe, 'field'=>'published_at'])</td>
                        <td>@include('common.dateFormat', ['model'=>$recipe, 'field'=>'deleted_at'])</td>
                        <td class="text-right">
                           @include('recipes.buttons.edit')
                           {{-- <a href="{{ route('recipes.edit', $recipe->id) }}"><i class="far fa-edit"></i></a> --}}
                           @include('common.buttons.unpublish', ['name'=>'recipe', 'model'=>$recipe])
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
