@extends('layouts.master')

@section('stylesheets')
   {{ Html::style('css/woodbarn.css') }}
@endsection

@section('left_column')
@endsection

@section('right_column')
   @include('admin.recipes.blocks.sidebar')
@endsection

@section('content')

   {!! Form::open(['route'=>['admin.recipes.deleteDestroy', $recipe->id], 'method'=>'DELETE']) !!}

      <div class="card">
         <div class="card-header section_header text-center text-danger font-weight-bold p-2">
            ARE YOU SURE YOU WANT TO PERMANENTLY DELETE THIS RECIPE?<br />
            Title : {{ $recipe->title }}?
         </div>
         <div class="card-body bg-light text-center">
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
         </div>
      </div>
   
   {{ Form::close() }}

@endsection