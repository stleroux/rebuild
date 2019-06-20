@extends('layouts.backend')

@section('stylesheets')
@endsection

@section('left_column')
   @include('blocks.main_menu')
@endsection

@section('content')
   
   {!! Form::open(['route' => 'woodprojects.store', 'files'=>'true']) !!}
   
      <div class="card mb-3">

         <div class="card-header">
            <i class="fa fa-plus-square"></i>
            Create Woodproject
            <span class="float-right">
               @include('common.buttons.help', ['model'=>'woodproject', 'bookmark'=>'woodprojects'])
               @include('common.buttons.previous', ['model'=>'woodproject'])
               @include('common.buttons.save', ['model'=>'woodproject'])
            </span>
         </div>

         <div class="card-body">
            @include('woodprojects.form')            
         </div>

      </div>
   
   {!! Form::close() !!}

@endsection
