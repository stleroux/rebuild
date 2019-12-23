@extends ('layouts.master')

@section ('stylesheets')
   {{ Html::style('css/woodbarn.css') }}
@stop

@section('left_column')
@endsection

@section('right_column')
   @include('admin.articles.blocks.sidebar')
   @include('admin.articles.blocks.archives')
@endsection

@section ('content')
   
   {!! Form::model($article, ['route'=>['admin.articles.update', $article->id], 'method' => 'PUT', 'files' => true]) !!}
      
      <div class="card mb-3">
         
         <div class="card-header section_header p-2">
            <i class="fa fa-edit"></i>
            Edit Article
            <div class="float-right">
               <div class="btn-group">
                  @include('admin.articles.buttons.help', ['size'=>'xs', 'bookmark'=>'articles'])
                  @include('admin.articles.buttons.back', ['size'=>'xs'])
                  @include('admin.articles.buttons.update', ['size'=>'xs'])
               </div>
            </div>
         </div>

         <div class="card-body section_body p-2">
            @include('admin.articles.form')
         </div>

      </div>

   {!! Form::Close() !!}

@endsection