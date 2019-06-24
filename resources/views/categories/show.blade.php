@extends('layouts.backend')

@section('stylesheets')
   {{-- {{ Html::style('css/woodbarn.css') }} --}}
@endsection

@section('left_column')
   @include('blocks.main_menu')
@endsection

@section('right_column')
@endsection

@section('content')
   <div class="card">
      <div class="card-header card_header">
         <i class="fa fa-sitemap" aria-hidden="true"></i>
         Category Details
         <span class="float-right">
            @include('categories.buttons.back')
         </span>
      </div>
      <div class="card-body card_body">
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