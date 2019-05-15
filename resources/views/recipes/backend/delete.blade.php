@extends('layouts.backend')

@section('stylesheets')
   {{ Html::style('css/recipes.css') }}
@endsection

@section('left_column')
   {{-- @include('blocks.adminNav') --}}
   {{-- @include('recipes::backend.sidebar') --}}
@endsection

@section('right_column')
@endsection

@section('content')

   <div class="card">
      <div class="card-header bg-danger text-white text-center">
         <b>
            ARE YOU SURE YOU WANT TO PERMANENTLY DELETE THIS RECIPE?<br />
            Title : {{ $recipe->title }}?
         </b>
      </div>
      <div class="card-body card_body text-center">
         {!! Form::open(['method'=>'POST', 'route'=>['recipes.deleteDestroy', $recipe->id]]) !!}
            {{ csrf_field() }}
            <input type="hidden" name="_method" value="DELETE" />

            <a href="{{-- {{ route('recipes.'. Session::get('pageName'), $recipe->id) }} --}}{{ URL::previous() }}" class="btn btn-outline-secondary">
               <i class="fas fa-angle-double-left"></i>
                No - Return To Previous Page
            </a>
            
            @if(checkPerm('post_delete'))
               <button type="submit" class="btn btn-outline-danger">
                  <i class="far fa-trash-alt"></i>
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