@extends('layouts.master')

@section('stylesheets')
   {{ Html::style('css/woodbarn.css') }}
@endsection

@section('left_column')
@endsection

@section('right_column')
@endsection

@section('content')

   {!! Form::open(['route'=>['admin.comments.destroy', $comment->id], 'method'=>'DELETE']) !!}

   	<div class="card">
         <div class="card-header section_header text-center text-danger font-weight-bold p-2">
            ARE YOU SURE YOU WANT TO PERMANENTLY DELETE THIS COMMENT?
         </div>
         <div class="card-body bg-light p-2 text-center">
            @include('admin.comments.buttons.back', ['size'=>'', 'btn_label'=>'No - Return To Previous Page'])
            @include('admin.comments.buttons.btn_delete', ['size'=>'', 'btn_label'=>'Yes - Delete Permanently'])
   		</div>
   		<div class="card-footer pt-1 pb-1 pl-2">
   			<b>Note: </b>This record will not be recoverable if deleted.
   		</div>
   	</div>

   {{ Form::close() }}

@endsection
