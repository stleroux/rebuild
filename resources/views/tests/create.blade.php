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
   
   {!! Form::open(['route' => 'tests.store', 'files'=>'true']) !!}
   
      <div class="card mb-3">

         <div class="card-header">
            <i class="fa fa-plus-square"></i>
            Create Test
            <span class="float-right">
               @include('tests.addins.links.help', ['model'=>'test', 'bookmark'=>'tests'])
               @include('tests.addins.links.back', ['model'=>'test'])
               @include('tests.addins.buttons.save', ['model'=>'test'])
            </span>
         </div>

         <div class="card-body">
            @include('tests.form')            
         </div>

      </div>
   
   {!! Form::close() !!}

@endsection
