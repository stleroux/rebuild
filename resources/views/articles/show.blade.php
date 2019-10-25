@extends('layouts.master')

@section('stylesheets')
   {{ Html::style('css/woodbarn.css') }}
@endsection

@section('left_column')
@endsection

@section('right_column')
   {{-- @include('articles.show.controls') --}}
   {{-- @include('articles.sidebar') --}}
   @include('articles.blocks.archives')
@endsection

@section('content')

   <div class="card mb-3">
      
      <div class="card-header section_header p-2">
         Article Details
         <span class="float-right">
            <div class="btn-group">
               @include('articles.buttons.back', ['size'=>'xs', 'btn_label'=>'Back'])
               Add\Remove Favorite
            </div>
         </span>
      </div>

      <div class="card-body section_body p-2">
         <div class="row">
            <div class="col-xs-8 col-sm-8 col-md-8">
               <div class="form-group">
                  {{ Form::label('title', 'Title') }}
                  {{ Form::text('title', $article->title, ['class'=>'form-control form-control-sm', 'readonly']) }}
                  {{-- <div class="well well-sm">{!! $article->title !!}</div> --}}
               </div>
            </div>
            <div class="col-xs-4 col-sm-4 col-md-4">
               <div class="form-group">
                  {{ Form::label('category', 'Category', ['class'=>'required']) }}
                  {{ Form::text('category', $article->category, ['class'=>'form-control form-control-sm', 'readonly']) }}
                  {{-- <div class="well well-sm">{{ $article->category->name}}</div> --}}
               </div>
            </div>
         </div>

         <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
               <div class="form-group">
                  {{ Form::label('description_eng', 'Description (En)', ['class'=>'required']) }}
                  {{-- <div class="well">{!! $article->description_eng !!}</div> --}}
                  {{ Form::textarea('decription_eng', strip_tags($article->description_eng), ['class'=>'form-control form-control-sm', 'readonly'=>'readonly']) }}
               </div>
            </div>
         </div>  

         <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
               <div class="form-group">
                  {{ Form::label('description_fre', 'Description (Fr)', ['class'=>'required']) }}
                  {{ Form::textarea('decription_fre', strip_tags($article->description_fre), ['class'=>'form-control form-control-sm', 'readonly']) }}
                  {{-- <div class="well">{!! $article->description_fre !!}</div> --}}
               </div>
            </div>
         </div>
      </div>
   </div>

   {{-- @include('articles.modals.delete') --}}
   {{-- @include('articles.modals.publish') --}}
   {{-- @include('articles.modals.restore') --}}
@endsection

@section('blocks')
   {{-- @include('articles.trashed.help') --}}
@endsection

@section ('scripts')
   {{-- @include('scripts.modals.delete') --}}
   {{-- @include('scripts.modals.publish') --}}
   {{-- @include('scripts.modals.restore') --}}
@endsection