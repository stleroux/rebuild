@extends('layouts.master')

@section('left_column')
   @include('blocks.admin_menu')
@endsection

@section('right_column')
@endsection

{{-- Pass along the ROUTE value of the previous page --}}
@php
   $ref = app('router')->getRoutes()->match(app('request')->create(URL::previous()))->getName();
   // get the last part of the route, after the last dot
   //$end = substr(strrchr($ref, '.'), 1);
   if(substr(strrchr($ref, '.'), 1) == 'index') {
      $end = 'Categories';
   } else {
      $end = substr(strrchr($ref, '.'), 1);
   }
@endphp

{{-- @section('sectionSidebar')
   @include('categories.sidebar')
@stop --}}

{{-- @section('breadcrumb')
      <li><a href="{{ route('dashboard') }}">Dashboard</a></li>
      <li><a href="{{ route($ref) }}">{{ ucfirst($end) }}</a></li>
      <li class="active"><span>View Category</span></li>
@stop --}}

@section('content')
   <div class="card">
      <div class="card-header card_header">
         <i class="fa fa-sitemap" aria-hidden="true"></i>
         Category Details
         <span class="float-right">
            <a href="{{ route('categories.index') }}" class="btn btn-sm btn-outline-secondary px-1 py-0">
               <i class="fas fa-angle-double-left"></i>
               Cancel
            </a>
         </span>
      </div>
      <div class="card-body card_body">
         <div class="row">
            <div class="col">
               <p><b>Name</b></p>
               <p>{{ $category->name }}</p>
            </div>
            <div class="col">
               <p><b>Value</b></p>
               <p>{{ $category->value ?? "N/A" }}</p>
            </div>
            <div class="col">
               <p><b>Module</b></p>
               <p>{{ $category->module->name }}</p>
            </div>
            <div class="w-100"></div>
            <div class="col">
               <p><b>Description</b></p>
               <p>{{ $category->description ?? "N/A" }}</p>
            </div>
         </div>
      </div>
   </div>
@stop

@section('blocks')
   {{-- @include('categories.show.controls') --}}
   {{-- @include('common.information', ['model'=>$category, 'title'=>'Category']) --}}
   {{-- @include('common.2_information', ['model'=>$category, 'title'=>'Category']) --}}
@stop

@section ('scripts')

      <script type="text/javascript">
            (function() {

         'use strict';

         // click events
         document.body.addEventListener('click', copy, true);

         // event handler
         function copy(e) {

            // find target element
            var
               t = e.target,
               c = t.dataset.copytarget,
               inp = (c ? document.querySelector(c) : null);

            // is element selectable?
            if (inp && inp.select) {

               // select text
               inp.select();

               try {
                  // copy text
                  document.execCommand('copy');
                  inp.blur();
               }
               catch (err) {
                  alert('please press Ctrl/Cmd+C to copy');
               }
            }
         }
      })();
      </script>
@stop