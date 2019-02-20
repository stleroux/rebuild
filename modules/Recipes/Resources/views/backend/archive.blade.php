@extends ('layouts.backend')

@section('stylesheets')
@endsection

@section('left_column')
   {{-- @include('recipes::sidebar') --}}
   @include('blocks.main_menu')
@endsection

@section('right_column')
   @include('recipes::blocks.archives')
@endsection

@section ('content')
	@include('recipes::archive.main')
@endsection


