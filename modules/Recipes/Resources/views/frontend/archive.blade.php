@extends ('layouts.master')

@section('stylesheets')
@endsection

@section('left_column')
   @include('blocks.home_menu')
   @include('recipes::frontend.sidebar')
   
@endsection

@section('right_column')
   @include('blocks.popularRecipes')
   @include('recipes::frontend.blocks.archives')
@endsection

@section ('content')
	@include('recipes::frontend.archive.main')
@endsection


