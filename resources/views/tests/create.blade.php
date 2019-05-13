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
   
   {!! Form::open(['route' => 'tests.store', 'files'=>'true']) !!}
   
      <div class="card mb-3">

         <div class="card-header">
            <i class="fa fa-plus-square"></i>
            Create Test
            <span class="float-right">
               @include('common.buttons.help', ['model'=>'test', 'bookmark'=>'tests'])
               @include('common.buttons.cancel', ['model'=>'test'])
               @include('common.buttons.save', ['model'=>'test'])
            </span>
         </div>

         <div class="card-body">
            @include('tests.form')            
         </div>

      </div>
   
   {!! Form::close() !!}

@endsection
