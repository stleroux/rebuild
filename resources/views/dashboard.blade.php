@extends ('layouts.backend')

@section ('stylesheets')
   {{-- {{ Html::style('css/woodbarn.css') }} --}}
@stop

@section('left_column')
   @include('blocks.adminNav')
   @include('blocks.admin_menu')
@endsection

{{-- @section('right_column') --}}
   {{-- @include('blocks.main_menu') --}}
{{-- @endsection --}}

@section('content')
DASHBOARD
@stop