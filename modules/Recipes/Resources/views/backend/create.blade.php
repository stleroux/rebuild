@extends('layouts.backend')

@section('stylesheets')
   {{ Html::style('css/recipes.css') }}
@endsection

@section('left_column')
   {{-- @include('blocks.main_menu') --}}
   @include('recipes::backend.sidebar')
@endsection

@section('right_column')
   {{-- @include('recipes::create.controls') --}}
@endsection

@section('content')
   {!! Form::open(['route' => 'recipes.store', 'files'=>'true']) !!}
   {{-- <form style="display:inline;">
      {!! csrf_field() !!} --}}
      @include('recipes::backend.create.datagrid')
   {!! Form::close() !!}
   {{-- </form> --}}
@endsection

@section('scripts')

@endsection