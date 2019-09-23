@extends('layouts.master')

@section('stylesheets')
   {{ Html::style('css/recipes.css') }}
@endsection

@section('left_column')
@endsection

@section('right_column')
   @include('admin.recipes.blocks.sidebar')
@endsection

@section('content')

   <div class="card">
      <div class="card-header bg-danger text-white text-center">
         <b>
            ARE YOU SURE YOU WANT TO PERMANENTLY DELETE THIS RECIPE?<br />
            Title : {{ $recipe->title }}?
         </b>
      </div>
      <div class="card-body bg-light text-center">
         {!! Form::open(['method'=>'POST', 'route'=>['admin.recipes.deleteDestroy', $recipe->id]]) !!}
            {{ csrf_field() }}
            <input type="hidden" name="_method" value="DELETE" />

            <a href="{{-- {{ route('recipes.'. Session::get('pageName'), $recipe->id) }} --}}{{ URL::previous() }}" class="btn btn-secondary">
               <i class="{{ Config::get('buttons.back') }}"></i>
                No - Return To Previous Page
            </a>
            
            @if(checkPerm('recipe_delete'))
               <button type="submit" class="btn btn-danger">
                  <i class="{{ Config::get('buttons.delete') }}"></i>
                  Yes - Permanently Delete This Recipe
               </button>
            @endif
         {{ Form::close() }}
      </div>
      {{-- <div class="card-footer pt-1 pb-1 pl-2">
         <b>Note: </b>This record will not be recoverable if deleted.
      </div> --}}
   </div>

@endsection