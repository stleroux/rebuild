@extends('layouts.master')

@section('stylesheets')
   {{ Html::style('css/woodbarn.css') }}
@endsection

@section('left_column')
@endsection

@section('right_column')
   @include('admin.categories.blocks.help')
@endsection

@section('content')

   @include('admin.categories.create_category')
   @include('admin.categories.create_sub')
   @include('admin.categories.create_main')

@endsection
