@extends ('layouts.master')

@section ('stylesheets')
   {{ Html::style('css/woodbarn.css') }}
@stop

@section('left_column')
@endsection

@section('right_column')
   @include('admin.tests.blocks.sidebar')
   @include('admin.tests.blocks.archives')
@endsection

@section ('content')
   
   {!! Form::model($test, ['route'=>['admin.tests.update', $test->id], 'method' => 'PUT', 'files' => true]) !!}
      
      <div class="card mb-3">
         
         <div class="card-header section_header p-2">
            <i class="fa fa-edit"></i>
            Edit Test
            <div class="float-right">
               <div class="btn-group">
                  @include('admin.tests.buttons.help', ['size'=>'xs', 'bookmark'=>'tests'])
                  @include('admin.tests.buttons.back', ['size'=>'xs'])
                  @include('admin.tests.buttons.update', ['size'=>'xs'])
               </div>
            </div>
         </div>

         <div class="card-body section_body p-2">
            @include('admin.tests.form')
         </div>

      </div>

   {!! Form::Close() !!}

@endsection