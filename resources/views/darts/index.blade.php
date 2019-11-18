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
      <div class="card-header section_header p-2">
         Dart Keeper
      </div>
      <div class="card-body section_body p-2">
         <table class="table table-sm table-striped table-hover">
            <thead>
               <tr>
                  <td></td>
                  <td colspan="3">01 - Team</td>
                  <td colspan="3">01 - Individual</td>
                  <td colspan="2">Cricket - Team</td>
                  <td colspan="2">Cricket - Individual</td>
                  <td></td>
               </tr>
               <tr>
                  <th>Player Name</th>
                  <th>Games Played</th>
                  <th>Games Won</th>
                  <th>Best Score</th>
                  <th>Games Played</th>
                  <th>Games Won</th>
                  <th>Best Score</th>
                  <th>Games Played</th>
                  <th>Games Won</th>
                  <th>Games Played</th>
                  <th>Games Won</th>
                  <th></th>
               </tr>
            </thead>
            <tbody>
               <tr>
                  <td>Stephane</td>
                  <td>10</td>
                  <td>7</td>
                  <td>95</td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td>3</td>
                  <td>2</td>
                  <td></td>
                  <td></td>
                  <td></td>
               </tr>
               <tr>
                  <td>Stacie</td>
                  <td>10</td>
                  <td>3</td>
                  <td>120</td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td>3</td>
                  <td>1</td>
                  <td></td>
                  <td></td>
                  <td></td>
               </tr>
            </tbody>
         </table>
      </div>
      <div class="card-footer p-1">
         Footer
      </div>
   </div>
@endsection
