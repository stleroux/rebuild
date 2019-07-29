@extends('layouts.backend')

@section('stylesheets')
   {{ Html::style('/css/woodbarn.css') }}
@endsection

@section('left_column')
   @include('blocks.main_menu')
@endsection

@section('right_column')
@endsection

@section ('content')
   
   {!! Form::model($finish, ['route'=>['finishes.update', $finish->id], 'method' => 'POST', 'files' => true]) !!}
      @method("PATCH")
      
      <div class="card mb-3">
         
         <div class="card-header section_header p-1 m-0">
            <span class="h5 align-middle pt-2">
               <i class="fa fa-edit"></i>
               Edit Finish
            </span>
            <span class="float-right">
               @include('projects.finishes.addins.links.help', ['size'=>'sm', 'bookmark'=>'finishes'])
               @include('projects.finishes.addins.links.back', ['size'=>'sm'])
               @include('projects.finishes.addins.buttons.update', ['size'=>'sm'])
            </span>
         </div>

         <div class="card-body section_body pb-1">
            @include('projects.finishes.form')
         </div>

         <!-- CARD FOOTER -->
         <div class="card-footer pt-1 pb-1 pl-2">
            Fields marked with an <span class="required"></span> are required
         </div>

      </div>

   {!! Form::Close() !!}

@endsection