@extends('layouts.backend')

@section('stylesheets')
   {{-- {{ Html::style('css/.css') }} --}}
@endsection

@section('left_column')
   @include('blocks.main_menu')
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
               @include('woodprojects.addins.links.help', ['model'=>'woodproject', 'bookmark'=>'woodprojects'])
               @include('woodprojects.addins.links.back', ['model'=>'woodproject'])
               @include('woodprojects.addins.buttons.save', ['model'=>'woodproject'])
            </span>
         </div>

         <div class="card-body">
            @include('woodprojects.form')            
         </div>

      </div>
   
   {!! Form::close() !!}

@endsection
