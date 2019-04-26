@extends ('layouts.backend')

@section ('stylesheets')
   {{-- {{ Html::style('css/recipes.css') }} --}}
@stop

@section('left_column')
   {{-- @include('blocks.adminNav') --}}
   {{-- @include('recipes::backend.sidebar') --}}
@endsection

@section('right_column')
@endsection

@section ('content')
   
   {!! Form::model($test, ['route'=>['tests.update', $test->id], 'method' => 'PUT', 'files' => true]) !!}
      
      <div class="card mb-3">
         
         <div class="card-header">
            <i class="fa fa-edit"></i>
            Edit Test
            <span class="float-right">
               @include('common.buttons.help', ['model'=>'test', 'bookmark'=>'tests'])
               @include('common.buttons.cancel', ['model'=>'test'])
               @include('common.buttons.update', ['model'=>'test'])
            </span>
         </div>

         <div class="card-body">
            @include('tests.form')
         </div>

      </div>

   {!! Form::Close() !!}

@endsection