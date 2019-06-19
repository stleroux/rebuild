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
   
   {!! Form::open(['route' => 'woodprojects.store', 'files'=>'true']) !!}
   
      <div class="card mb-3">

         <div class="card-header">
            <i class="fa fa-plus-square"></i>
            Create Woodproject
            <span class="float-right">
               @include('common.buttons.help', ['model'=>'woodproject', 'bookmark'=>'woodprojects'])
               @include('common.buttons.cancel', ['model'=>'woodproject'])
               @include('common.buttons.save', ['model'=>'woodproject'])
            </span>
         </div>

         <div class="card-body">
            @include('woodprojects.form')            
         </div>

      </div>
   
   {!! Form::close() !!}

@endsection
