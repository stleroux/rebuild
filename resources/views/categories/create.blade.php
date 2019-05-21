@extends('layouts.master')

@section('stylesheets')
   {{-- {{ Html::style('css/recipes.css') }} --}}
@endsection

@section('left_column')
   {{-- @include('blocks.adminNav') --}}
   @include('blocks.main_menu')
   {{-- @include('categories.sidebar') --}}
@endsection

@section('right_column')
@endsection

@section('content')

   @include('categories.create.category')
   @include('categories.create.sub')
   @include('categories.create.main')

@endsection
