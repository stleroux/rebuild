@extends('layouts.master')

@section('stylesheets')
   {{ Html::style('/css/woodbarn.css') }}
@endsection

@section('left_column')
@endsection

@section('right_column')
@endsection

@section('content')
   
   {!! Form::open(['route' => 'admin.projects.finishes.store', 'files'=>'true']) !!}
   
      <div class="card mb-3">

         <div class="card-header section_header p-2">
            <i class="fa fa-plus-square"></i>
            Create Finish
            <span class="float-right">
               <div class="btn-group">
                  @include('admin.projects.finishes.buttons.help', ['size'=>'xs', 'bookmark'=>'finishes'])
                  @include('admin.projects.finishes.buttons.back', ['size'=>'xs'])
                  @include('admin.projects.finishes.buttons.save', ['size'=>'xs'])
               </div>
            </span>
         </div>

         <div class="card-body section_body p-2">
            @include('admin.projects.finishes.form')
         </div>

         <!-- CARD FOOTER -->
         <div class="card-footer card_footer p-1">
            Fields marked with an <span class="required"></span> are required
         </div>

      </div>
   
   {!! Form::close() !!}

@endsection
