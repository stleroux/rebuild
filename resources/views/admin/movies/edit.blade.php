@extends ('layouts.master')

@section ('stylesheets')
   {{ Html::style('css/woodbarn.css') }}
@stop

@section('left_column')
@endsection

@section('right_column')
   @include('admin.movies.blocks.sidebar')
   @include('admin.movies.blocks.archives')
@endsection

@section ('content')
   
   {!! Form::model($movie, ['route'=>['admin.movies.update', $movie->id], 'method' => 'PUT', 'files' => true]) !!}
      
      <div class="card mb-3">
         
         <div class="card-header section_header p-2">
            <i class="fa fa-edit"></i>
            Edit Movie
            <div class="float-right">
               <div class="btn-group">
                  @include('admin.movies.buttons.help', ['size'=>'xs', 'bookmark'=>'movies'])
                  @include('admin.movies.buttons.back', ['size'=>'xs'])
                  @include('admin.movies.buttons.update', ['size'=>'xs'])
               </div>
            </div>
         </div>

         <div class="card-body section_body p-2">
            @include('admin.movies.form')
         </div>

      </div>

   {!! Form::Close() !!}

@endsection