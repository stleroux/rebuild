@extends('layouts.master')

@section('stylesheets')
   {{ Html::style('css/woodbarn.css') }}
@endsection

@section('left_column')
@endsection

@section('right_column')
   @include('articles.blocks.popular')
   @include('articles.blocks.archives')
@endsection

@section('content')
   
   <div class="card mb-3">

      <div class="card-header section_header p-2">
         <div class="row d-flex justify-content-center">
            <div class="col-sm-4 float-left">
               {{ ucwords($article->title) }}
            </div>
            <div class="col-sm-4 text-center">
               @include('articles.buttons.previous', ['size'=>'xs', 'btn_label'=>'Previous'])
               @include('articles.buttons.next', ['size'=>'xs', 'btn_label'=>'Next'])
            </div>
            <div class="col-sm-4 text text-right">
               <div class="float-right">
                  <div class="btn-group">
                     @include('articles.buttons.back', ['size'=>'xs', 'btn_label'=>'Back'])
                  </div>
               </div>
            </div>
         </div>
      </div>

      <div class="card-body section_body p-2">
         @include('admin.articles.forms.form', ['showFields'=>'show'])
      </div>

   </div>
   
@endsection
