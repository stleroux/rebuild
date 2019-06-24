@extends ('layouts.backend')

@section ('stylesheets')
   {{-- {{ Html::style('css/.css') }} --}}
@stop

@section('left_column')
   @include('blocks.main_menu')
@endsection

@section('right_column')
@endsection

@section ('content')
   
   {!! Form::model($woodproject, ['route'=>['woodprojects.update', $woodproject->id], 'method' => 'POST', 'files' => true]) !!}

   <form action="/woodprojects/{{$woodproject->id}}" method="POST">
      @method("PATCH")
      
      <div class="card mb-3">
         
         <div class="card-header">
            <i class="fa fa-edit"></i>
            Edit Woodproject
            <span class="float-right">
               @include('woodprojects.addins.links.help', ['model'=>'woodproject', 'bookmark'=>'woodprojects'])
               @include('woodprojects.addins.links.back', ['model'=>'woodproject'])
               @include('woodprojects.addins.buttons.update', ['model'=>'woodproject'])
            </span>
         </div>

         <div class="card-body">
            @include('woodprojects.form')
         </div>

      </div>

   {!! Form::Close() !!}

@endsection