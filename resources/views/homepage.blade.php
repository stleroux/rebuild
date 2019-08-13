@extends('layouts.master')

@section ('stylesheets')
   {{ Html::style('css/woodbarn.css') }}
@endsection

@section('left_column')
   @include('blocks.main_menu')
@endsection

@section('right_column')
   @include('blocks.popularItems')
   @include('projects.blocks.popularProjects')
   @include('blog.blocks.popularPosts')
   @include('recipes.blocks.popularRecipes')
@endsection

@section('content')

   @include('homepage.greeting')
   @include('homepage.warning')
   @include('homepage.newUser')
   @include('homepage.interests')
   @include('homepage.blog')

@endsection
