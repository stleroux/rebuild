@extends('layouts.master')

@section('stylesheets')
   {{ Html::style('css/woodbarn.css') }}
@endsection

@section('left_column')
@endsection

@section('right_column')
@endsection

@section('content')

{!! Form::open(['route'=>['admin.articles.deleteDestroy', $article->id], 'method'=>'DELETE']) !!}
   {{ csrf_field() }}

   <div class="card">

      <div class="card-header bg-danger text-white text-center">
         <b>
            ARE YOU SURE YOU WANT TO PERMANENTLY DELETE THIS ARTICLE?<br />
            {{-- Title : {{ $article->title }}? --}}
         </b>
      </div>

      <div class="card-body card_body text-center">
         @include('admin.articles.buttons.back', ['size'=>'', 'btn_label'=>'No - Return To Previous Page'])
         @include('admin.articles.buttons.btn_delete', ['size'=>'', 'btn_label'=>'Yes - Delete Permanently'])
      </div>

      <div class="card-footer pt-1 pb-1 pl-2">
         <b>Note: </b>This record will not be recoverable if deleted.
      </div>

   </div>
{{ Form::close() }}

@endsection
