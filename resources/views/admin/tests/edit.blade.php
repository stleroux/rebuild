@extends ('layouts.backend')

@section ('stylesheets')
   {{ Html::style('css/woodbarn.css') }}
@stop

@section('left_column')
@endsection

@section('right_column')
@endsection

@section ('content')
   
   {!! Form::model($test, ['route'=>['admin.tests.update', $test->id], 'method' => 'POST', 'files' => true]) !!}

   <form action="/tests/{{$test->id}}" method="POST">
      @method("PATCH")
      
      <div class="card mb-3">
         
         <div class="card-header">
            <i class="fa fa-edit"></i>
            Edit Test
            <span class="float-right">
               @include('tests.addins.links.help', ['model'=>'test', 'bookmark'=>'tests'])
               @include('tests.addins.links.back', ['model'=>'test'])
               @include('tests.addins.buttons.update', ['model'=>'test'])
            </span>
         </div>

         <div class="card-body">
            @include('tests.form')
         </div>

      </div>

   {!! Form::Close() !!}

@endsection