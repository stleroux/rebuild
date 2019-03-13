@extends('layouts.help')

@section('left_column')
   dsdsd
@endsection

@section('content')

   <h1>Main system help</h1>
   @include('help.categories.index')
   @include('help.recipes.index')
   
@endsection