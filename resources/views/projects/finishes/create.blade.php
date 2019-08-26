@extends('layouts.master')

@section('stylesheets')
   {{ Html::style('/css/woodbarn.css') }}
@endsection

@section('left_column')
   @include('blocks.main_menu')
@endsection

@section('right_column')
   @include('projects.blocks.popularProjects')
@endsection

@section('content')
   
   {!! Form::open(['route' => 'finishes.store', 'files'=>'true']) !!}
   
      <div class="card mb-3">

         <div class="card-header section_header p-2">
            <i class="fa fa-plus-square"></i>
            Create Finish
            <span class="float-right">
               <div class="btn-group">
                  @include('projects.finishes.addins.links.help', ['size'=>'xs', 'bookmark'=>'finishes'])
                  @include('projects.finishes.addins.links.back', ['size'=>'xs'])
                  @include('projects.finishes.addins.buttons.save', ['size'=>'xs'])
               </div>
            </span>
         </div>

         <div class="card-body section_body p-2">
            @include('projects.finishes.form')            
         </div>

         <!-- CARD FOOTER -->
         <div class="card-footer card_footer p-1">
            Fields marked with an <span class="required"></span> are required
         </div>

      </div>
   
   {!! Form::close() !!}

@endsection
