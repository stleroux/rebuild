@extends('layouts.master')

@section('stylesheets')
   {{-- {{ Html::style('css/woodbarn.css') }} --}}
@endsection

@section('left_column')
   @include('blocks.main_menu')
@endsection

@section('right_column')
   @include('categories.blocks.help')
@endsection

@section('content')

   @include('categories.create_category')
   @include('categories.create_sub')
   @include('categories.create_main')

@endsection
