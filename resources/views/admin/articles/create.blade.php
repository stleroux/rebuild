@extends('layouts.master')

@section('stylesheets')
   {{ Html::style('css/woodbarn.css') }}
@endsection

@section('left_column')
@endsection

@section('right_column')
@endsection


@section('content')
	{!! Form::open(['route'=>'admin.articles.store']) !!}
		@include('admin.articles.create.form')
	{!! Form::close() !!}
@endsection

@section ('scripts')
@endsection
