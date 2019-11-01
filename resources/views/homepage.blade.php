@extends('layouts.master')

@section ('stylesheets')
   {{ Html::style('css/woodbarn.css') }}
@endsection

@section('left_column')
@endsection

@section('right_column')
   @include('blocks.popularItems')
   @include('projects.blocks.popular')
   @include('blog.blocks.popular')
   @include('recipes.blocks.popular')
   @include('articles.blocks.popular')
   @include('tests.blocks.popular')
@endsection

@section('content')

   @include('homepage.greeting')
   @include('homepage.warning')
   @include('homepage.newUser')
   @include('homepage.interests')
   @include('homepage.blog')

@endsection
