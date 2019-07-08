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
   
   {!! Form::model($material, ['route'=>['materials.update', $material->id], 'method' => 'POST', 'files' => true]) !!}
      @method("PATCH")
      
      <div class="card mb-3">
         
         <div class="card-header">
            <i class="fa fa-edit"></i>
            Edit Material
            <span class="float-right">
               @include('projects.materials.addins.links.help', ['model'=>'material', 'bookmark'=>'materials'])
               @include('projects.materials.addins.links.back', ['model'=>'material'])
               @include('projects.materials.addins.buttons.update', ['model'=>'material'])
            </span>
         </div>

         <div class="card-body pb-1">
            @include('projects.materials.form')
         </div>

         <!-- CARD FOOTER -->
         <div class="card-footer pt-1 pb-1 pl-2">
            Fields marked with an <span class="required"></span> are required
         </div>

      </div>

   {!! Form::Close() !!}

@endsection