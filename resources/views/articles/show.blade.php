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
         <i class="fa fa-plus-square"></i>
         Show Article
         <div class="float-right">
            <div class="btn-group">
               @include('articles.buttons.back', ['size'=>'xs', 'btn_label'=>'Back'])
            </div>
         </div>
      </div>

      <div class="card-body section_body p-2">
         <p>{{ $article->title }}</p>
      </div>

   </div>
   
@endsection
