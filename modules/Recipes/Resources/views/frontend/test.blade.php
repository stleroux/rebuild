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

<div class="row pt-2">
 <div class="col-lg-4 col-md-3 col-sm-6">
   <div class="card mb-3">
      <img class="card-img-top" data-src="..." alt="Card image cap">
      <div class="card-block">
         <h4 class="card-title">Card title</h4>
         <p class="card-text">This is a longer card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
          <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
      </div>
    </div>
 </div>
  <div class="col-lg-4 col-md-3 col-sm-6">
   <div class="card">
      <img class="card-img-top" data-src="..." alt="Card image cap">
      <div class="card-block">
         <h4 class="card-title">Card title</h4>
         <p class="card-text">This is a longer card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
          <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
      </div>
    </div>
 </div>
  <div class="col-lg-4 col-md-3 col-sm-6">
   <div class="card">
      <img class="card-img-top" data-src="..." alt="Card image cap">
      <div class="card-block">
         <h4 class="card-title">Card title</h4>
         <p class="card-text">This is a longer card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
          <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
      </div>
    </div>
 </div>
  <div class="col-lg-4 col-md-3 col-sm-6">
   <div class="card">
      <img class="card-img-top" data-src="..." alt="Card image cap">
      <div class="card-block">
         <h4 class="card-title">Card title</h4>
         <p class="card-text">This is a longer card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
          <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
      </div>
    </div>
 </div>
  <div class="col-lg-4 col-md-3 col-sm-6">
   <div class="card">
      <img class="card-img-top" data-src="..." alt="Card image cap">
      <div class="card-block">
         <h4 class="card-title">Card title</h4>
         <p class="card-text">This is a longer card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
          <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
      </div>
    </div>
 </div>
</div>

@endsection