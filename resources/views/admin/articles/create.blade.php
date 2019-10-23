{{-- @extends('layouts.master')

@section('stylesheets')
   {{ Html::style('css/woodbarn.css') }}
@endsection

@section('left_column')
@endsection

@section('right_column')
@endsection


@section('content')
	{!! Form::open(['route'=>'admin.articles.store']) !!}
		@include('admin.articles.form')
	{!! Form::close() !!}
@endsection

@section ('scripts')
@endsection
 --}}
@extends('layouts.master')

@section('stylesheets')
   {{ Html::style('css/woodbarn.css') }}
@endsection

@section('left_column')
@endsection

@section('right_column')
   @include('admin.articles.sidebar')
@endsection

@section('content')

   {!! Form::open(['route'=>'admin.articles.store']) !!}

      <div class="card mb-3">
         
         <div class="card-header section_header p-2">
            Create Article
            <div class="float-right">
               {{-- <a href="{{ route('admin.articles.index') }}" class="btn btn-xs btn-primary">Cancel</a> --}}
               {{-- {{ Form::button('<i class="fa fa-save"></i> Save ', array('type' => 'submit', 'class' => 'btn btn-xs btn-success')) }} --}}
               @include('admin.articles.buttons.back', ['size'=>'xs'])
               @include('admin.articles.buttons.save', ['size'=>'xs'])
            </div>
         </div>

         <div class="card-body section_body p-2">
            @include('admin.articles.form')
         </div>
      </div>

   {!! Form::close() !!}

@endsection