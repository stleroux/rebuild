@extends ('layouts.master')

@section ('stylesheets')
   {{-- {{ Html::style('css/woodbarn.css') }} --}}
   {{-- {{ Html::style('css/menu.css') }} --}}
@endsection

@section('left_column')
   {{-- @include('blocks.main_menu') --}}
@endsection

@section('right_column')
   {{-- @include('blocks.main_menu') --}}
@endsection

@section('content')

   <div class="card">
      <div class="card-header">WELCOME TO YOUR DASHBOARD</div>
      <div class="card-body"></div>
      <div class="card-footer"></div>
   </div>


@endsection
