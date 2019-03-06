@extends('layouts.master')

@section('stylesheets')
   {{-- {{ Html::style('css/recipes.css') }} --}}
@stop

@section('left_column')
   @include('blocks.main_menu')
@endsection

@section('right_column')
   @include('blocks.popularRecipes')
   @include('recipes::frontend.blocks.archives')
@endsection

@section('content')

<div class="card">
   <div class="card-header">Recipes Categories</div>
</div>

<div class="row py-3">
@foreach($cats as $cat)

   
   <div class="col-md-2 col-sm-6">
      <a href="{{ $cat->name}}">
      <div class="card shadow p-1 m-2 bg-white rounded">
         <div class="card-block">
            <h3 class="card-title text-center">{{ ucfirst($cat->name) }}</h3>
         </div>
      </div>
      </a>
   </div>


@endforeach
</div>

@endsection