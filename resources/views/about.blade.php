@extends('layouts.master')

@section ('stylesheets')
   {{ Html::style('css/woodbarn.css') }}
@endsection

@section('left_column')
   @include('blocks.main_menu')
@endsection

@section('content')

   @include('errors.construction')

   {{-- ABOUT US  --}}
   <div class="card mb-2">
      <div class="card-header section_header">
         <i class="fa fa-question" aria-hidden="true"></i>
         About Us
      </div>

      <div class="card-body section_body">
         <p>Just some text about us</p>
      </div>
   </div>

   <div class="row">
      {{-- ABOUT STEPHANE --}}
      <div class="col-sm-6 pr-1">
         <div class="card mb-2">
            <div class="card-header section_header">About Stephane</div>
            <div class="card-body section_body">
               <p>Just some text about me</p>
               <p>Just some text about me</p>
            </div>
         </div>
      </div>

      {{-- ABOUT STACIE --}}
      <div class="col-sm-6 pl-1">
         <div class="card mb-2">
            <div class="card-header section_header">About Stacie</div>
            <div class="card-body section_body">
               <p>Just some text about her</p>
               <p>Just some text about her Just some text about her Just some text about her Just some text about her Just some text about her Just some text about her Just some text about her Just some text about her Just some text about her Just some text about her Just some text about her Just some text about her Just some text about her Just some text about her Just some text about her Just some text about her Just some text about her Just some text about her Just some text about her</p>
            </div>
         </div>
      </div>

   </div>

@endsection
