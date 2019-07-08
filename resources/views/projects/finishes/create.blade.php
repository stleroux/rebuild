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
   
   {!! Form::open(['route' => 'finishes.store', 'files'=>'true']) !!}
   
      <div class="card mb-3">

         <div class="card-header">
            <i class="fa fa-plus-square"></i>
            Create Finish
            <span class="float-right">
               @include('projects.finishes.addins.links.help', ['model'=>'finish', 'bookmark'=>'finishes'])
               @include('projects.finishes.addins.links.back', ['model'=>'finish'])
               @include('projects.finishes.addins.buttons.save', ['model'=>'finish'])
            </span>
         </div>

         <div class="card-body pb-1">
            @include('projects.finishes.form')            
         </div>

         <!-- CARD FOOTER -->
         <div class="card-footer pt-1 pb-1 pl-2">
            Fields marked with an <span class="required"></span> are required
         </div>

      </div>
   
   {!! Form::close() !!}

@endsection
