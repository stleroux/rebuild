@extends('layouts.master')

@section('stylesheets')
   {{ Html::style('css/woodbarn.css') }}
@endsection

@section('left_column')
@endsection

@section('right_column')
   @include('admin.articles.blocks.sidebar')
   @include('admin.articles.blocks.archives')
@endsection

@section('content')
   
   <form action="{{ route('admin.articles.store') }}" enctype="multipart/form-data" method="POST">
      @csrf

      <div class="card mb-3">

         <div class="card-header section_header p-2">
            <i class="fa fa-plus-square"></i>
            Create Article
            <div class="float-right">
               <div class="btn-group">
                  @include('admin.articles.buttons.help', ['size'=>'xs', 'model'=>'article', 'bookmark'=>'articles'])
                  @include('admin.articles.buttons.back', ['size'=>'xs', 'model'=>'article'])
                  @include('admin.articles.buttons.save', ['size'=>'xs', 'model'=>'article'])
               </div>
            </div>
         </div>

         <div class="card-body section_body p-2">
            @include('admin.articles.forms.form', ['showFields'=>'add'])
         </div>

      </div>
   
   </form>

@endsection
