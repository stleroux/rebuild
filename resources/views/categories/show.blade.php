@extends('layouts.master')

@section('stylesheets')
   {{ Html::style('css/woodbarn.css') }}
@endsection

@section('left_column')
   @include('blocks.main_menu')
@endsection

@section('right_column')
@endsection

@section('content')
   <div class="card">
      <div class="card-header section_header p-2">
         <i class="fa fa-sitemap" aria-hidden="true"></i>
         Category Details
         <span class="float-right">
            @include('categories.buttons.back', ['size'=>'xs'])
         </span>
      </div>
      <div class="card-body section_body p-2">
         <div class="row">
            <div class="col">
               <p><b>Category Name</b></p>
               <p>{{ $category->name }}</p>
            </div>
            <div class="col">
               <p><b>Sub Category</b></p>
               <p>{{ $category->parent_id ? ucfirst($category->parent->name) : '' }}</p>
            </div>
            <div class="col">
               <p><b>Value</b></p>
               <p>{{ $category->value ?? "N/A" }}</p>
            </div>
            
            <div class="w-100"></div>
            <div class="col">
               <p><b>Description</b></p>
               <p>{{ $category->description ?? "N/A" }}</p>
            </div>
         </div>
      </div>
   </div>
@endsection

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
@endsection