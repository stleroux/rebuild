@extends('layouts.backend')

@section('stylesheets')
   {{ Html::style('/css/woodbarn.css') }}
@endsection

@section('left_column')
   @include('blocks.main_menu')
@endsection

@section('right_column')
@endsection

@section ('content')
   
   {!! Form::model($material, ['route'=>['materials.update', $material->id], 'method' => 'POST', 'files' => true]) !!}
      @method("PATCH")
      
      <div class="card mb-3">
         
         <div class="card-header section_header p-2">
            <i class="fa fa-edit"></i>
            Edit Material
            <span class="float-right">
               @include('projects.materials.addins.links.help', ['size'=>'xs', 'bookmark'=>'materials'])
               @include('projects.materials.addins.links.back', ['size'=>'xs'])
               @include('projects.materials.addins.buttons.update', ['size'=>'xs'])
            </span>
         </div>

         <div class="card-body section_body p-2">
            @include('projects.materials.form')
         </div>

         <!-- CARD FOOTER -->
         <div class="card-footer pt-1 pb-1 pl-2">
            Fields marked with an <span class="required"></span> are required
         </div>

      </div>

   {!! Form::Close() !!}

@endsection