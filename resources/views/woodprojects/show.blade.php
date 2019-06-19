@extends('layouts.backend')

@section('stylesheets')
   {{-- {{ Html::style('css/recipes.css') }} --}}
@endsection

@section('left_column')
   {{-- @include('blocks.adminNav') --}}
   {{-- @include('recipes::backend.sidebar') --}}
@endsection

@section('right_column')
@endsection

@section('content')
   
   <div class="card mb-3">

      <div class="card-header">
         <i class="fa fa-plus-square"></i>
         Show Woodproject
         <span class="float-right">
            @include('common.buttons.help', ['model'=>'woodproject', 'bookmark'=>'woodprojects'])
            @include('common.buttons.cancel', ['model'=>'category'])
         </span>
      </div>

      <div class="card-body">
         <p>{{ $woodproject->name }}</p>
      </div>

   </div>
   
@endsection
