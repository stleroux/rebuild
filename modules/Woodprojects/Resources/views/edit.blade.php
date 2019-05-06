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
   
   {!! Form::model($woodproject, ['route'=>['woodprojects.update', $woodproject->id], 'method' => 'PUT', 'files' => true]) !!}

   <form action="/woodprojects/{{$woodproject->id}}" method="POST">
      @method("PATCH")
      
      <div class="card mb-3">
         
         <div class="card-header">
            <i class="fa fa-edit"></i>
            Edit Woodproject
            <span class="float-right">
               @include('common.buttons.help', ['model'=>'woodproject', 'bookmark'=>'woodprojects'])
               @include('common.buttons.cancel', ['model'=>'woodproject'])
               @include('common.buttons.update', ['model'=>'woodproject'])
            </span>
         </div>

         <div class="card-body">
            @include('woodprojects.form')
         </div>

      </div>

   {!! Form::Close() !!}

@endsection