@extends('layouts.backend')

@section('left_column')
   @include('blocks.adminNav')
   @include('categories.sidebar')
@endsection

@section('right_column')
@endsection

@section('content')

   @include('categories.create.category')
   @include('categories.create.sub')
   @include('categories.create.main')

@endsection
