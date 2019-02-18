@extends ('layouts.master')

@section('stylesheets')
@endsection

@section('left_column')
   {{-- @include('recipes::sidebar') --}}
   @include('blocks.main_menu')
@endsection

@section('right_column')
   @include('recipes::frontend.blocks.archives')
@endsection

@section ('content')
	@include('recipes::frontend.archive.main')
@endsection


