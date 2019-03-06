@extends ('layouts.backend')

@section ('stylesheets')
   {{-- <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet"> --}}
@stop

@section('left_column')
   @include('recipes::backend.sidebar')
@endsection

@section('right_column')
@endsection

@section ('content')
   {!! Form::model($recipe, ['route'=>['recipes.update', $recipe->id], 'method' => 'PUT', 'files' => true]) !!}
      {{-- <input type="hidden" value="{{ $ref }}" name="ref" size="50"/> --}}
      @include('recipes::backend.edit.datagrid')
   {!! Form::close() !!}
@stop

{{-- @section ('scripts')
   <script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
@stop --}}