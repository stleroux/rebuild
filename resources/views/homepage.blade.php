@extends('layouts.master')

@section ('stylesheets')
   {{ Html::style('css/woodbarn.css') }}
@endsection

@section('left_column')
@endsection

@section('right_column')
   @include('blocks.popularItems')
@endsection

@section('content')
   {{-- <example-component></example-component> --}}
   @include('homepage.greeting')
   @include('homepage.warning')
   @include('homepage.newUser')
   @include('homepage.interests')
   @include('homepage.blog')
@endsection
