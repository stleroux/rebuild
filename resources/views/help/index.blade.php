@extends('layouts.help')

@section('stylesheets')
   {{ Html::style('css/woodbarn.css') }}
@endsection

@section('left_column')
	@include('help.toc')
@endsection

@section('content')

	<h1 id="mainTOC">Main system help</h1>
	@include('help.categories.index')
	@include('help.recipes.index')

@endsection
