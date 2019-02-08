@extends ('layouts.master')

@section('stylesheets')
@endsection

@section('left_column')
@endsection

@section('right_column')
   @include('recipes::blocks.archives')
@endsection

@section ('content')
	@include('recipes::archive.main')
@endsection


