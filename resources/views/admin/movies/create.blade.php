@extends('layouts.master')

@section('stylesheets')
   {{ Html::style('css/woodbarn.css') }}
@endsection

@section('left_column')
@endsection

@section('right_column')
   @include('admin.movies.blocks.sidebar')
   @include('admin.movies.blocks.archives')
@endsection

@section('content')
   
   {!! Form::open(['route' => 'admin.movies.store', 'files'=>'true']) !!}
   
      <div class="card mb-3">

         <div class="card-header section_header p-2">
            <i class="fa fa-plus-square"></i>
            Create Movie
            <div class="float-right">
               <div class="btn-group">
                  @include('admin.movies.buttons.help', ['size'=>'xs', 'model'=>'movie', 'bookmark'=>'movies'])
                  @include('admin.movies.buttons.back', ['size'=>'xs', 'model'=>'movie'])
                  @include('admin.movies.buttons.save', ['size'=>'xs', 'model'=>'movie'])
               </div>
            </div>
         </div>

         <div class="card-body section_body p-2">
            @include('admin.movies.form')            
         </div>

      </div>
   
   {!! Form::close() !!}

@endsection
