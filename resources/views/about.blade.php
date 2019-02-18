@extends('layouts.master')

@section('left_column')
   @include('blocks.main_menu')
@endsection

@section('content')

   @include('errors.construction')

   {{-- ABOUT US  --}}
   <div class="card mb-2">
      <div class="card-header card_header">
         <i class="fa fa-question" aria-hidden="true"></i>
         About Us
      </div>

      <div class="card-body card_body">
         <p>Just some text about us</p>
      </div>

   </div>


   <div class="row">
      <div class="col-sm-6 pr-1">

         {{-- ABOUT STEPHANE --}}
         <div class="card mb-2">

            <div class="card-header card_header_2">About Stephane</div>

            <div class="card-body card_body">
               <p>Just some text about me</p>
               <p>Just some text about me</p>
            </div>
            
         </div>
      </div>

      <div class="col-sm-6 pl-1">

         {{-- ABOUT STACIE --}}
         <div class="card mb-2">

            <div class="card-header card_header_2">About Stacie</div>

            <div class="card-body card_body">
               <p>Just some text about her</p>
               <p>Just some text about her Just some text about her Just some text about her Just some text about her Just some text about her Just some text about her Just some text about her Just some text about her Just some text about her Just some text about her Just some text about her Just some text about her Just some text about her Just some text about her Just some text about her Just some text about her Just some text about her Just some text about her Just some text about her</p>
            </div>
            
         </div>
      </div>
   </div>


{{-- 
   <div class="row border">
      <div class="col-sm-6 py-1 border">
         @include('about.stephane')
      </div>

      <div class="col-sm-6 py-1 border">
         @include('about.stacie')
      </div>
   </div> --}}
   
@endsection