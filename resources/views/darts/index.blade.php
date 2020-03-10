@extends ('layouts.master')

@section ('stylesheets')
@endsection

@section('left_column')
@endsection

@section('right_column')
   @include('darts.blocks.sidebar')
@endsection

@section('content')

   <div class="card mb-2">

      <div class="card-header section_header p-2 d-flex justify-content-between">
         <div>
            <i class="fas fa-bullseye fa-fw"></i>
            Dart Keeper
         </div>
         <div class="text text-danger">
            Statistics module not completed
         </div>
      </div>

      <div class="card-body section_body p-2">
         <div class="form-row">
            <div class="col">
               @include('darts.statistics.zeroOneTeams')
            </div>
            <div class="col">
               @include('darts.statistics.zeroOneIndividuals')
            </div>
         </div>

         <div class="form-row">
            <div class="col">
               @include('darts.statistics.cricketTeams')
            </div>
            <div class="col">
               @include('darts.statistics.cricketIndividuals')               
            </div>
         </div>
      </div>

      <div class="card-footer card_footer p-1 d-flex justify-content-between">
         <div>
            Statistics do not include games listed as Practice in the Games Board
         </div>
         <div>
            Statistics only accounts for Completed games
         </div>
      </div>
   </div>

@endsection
