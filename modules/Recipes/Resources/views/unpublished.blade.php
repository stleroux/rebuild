@extends('layouts.master')

@section('stylesheets')
   {{-- {{ Html::style('css/recipes.css') }} --}}
@endsection

@section('left_column')
   {{-- @include('recipes::index.controls') --}}
   @include('blocks.admin_menu')
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
               <button type="button" class="btn btn-xs btn-primary" data-toggle="modal" data-target="#help">
                  <i class="fa fa-question-circle" aria-hidden="true"></i>
                  Help
               </button>
            </span>
         </div>
         
         @if($recipes->count() > 0)
            <div class="pt-1 text-center">
               <a href="{{ route('recipes.unpublished') }}" class="{{ Request::is('recipes/unpublished') ? "btn-primary": "btn-default" }} btn btn-sm">All</a>
               @foreach($letters as $value)
                  <a href="{{ route('recipes.unpublished', $value) }}" class="{{ Request::is('recipes/unpublished/'.$value) ? "btn-primary": "btn-default" }} btn btn-sm">{{ strtoupper($value) }}</a>
               @endforeach
            </div>
         @endif

         @include('recipes::unpublished.help')
         
         @if($recipes->count() > 0)
            <div class="card-body card_body px-1 py-0">
               @include('recipes::table')
            </div>
         @else
            <div class="card-body card_body">
               {{ setting('no_records_found') }}
              </div>
         @endif

      </div>
   </form>
@endsection
