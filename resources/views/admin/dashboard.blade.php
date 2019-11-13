@extends ('layouts.backend')

@section ('stylesheets')
   {{ Html::style('css/woodbarn.css') }}
@endsection

@section('left_column')
@endsection

@section('right_column')
@endsection

@section('content')

   <div class="card">

      <div class="card-header section_header p-2">
         <i class="fas fa-tachometer-alt"></i>
         DASHBOARD
      </div>

      <div class="card-body section_body p-2">
         <div class="row">
            <div class="col">
               @include('admin.dashboard.block_1')
            </div>
            <div class="col">
               @include('admin.dashboard.block_2')
            </div>
            <div class="col">
               @include('admin.dashboard.block_3')
            </div>
            <div class="col">
               @include('admin.dashboard.stats')
            </div>
         </div>
      </div>
      
      <div class="card-footer p-1">
         Dashboard footer text goes here
      </div>

   </div>

@endsection
