@extends('layouts.master')

@section('stylesheets')
   {{ Html::style('css/recipes.css') }}
@endsection

@section('left_column')
   {{-- @include('recipes::index.controls') --}}
@endsection

@section('right_column')
   {{-- @include('recipes::create.controls') --}}
@endsection

@section('content')
   {!! Form::open(['route' => 'recipes.store', 'files'=>'true']) !!}
      @include('recipes::create.datagrid')
   {!! Form::close() !!}
@endsection

@section('scripts')

@endsection