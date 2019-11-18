@extends('layouts.master')

@section('stylesheets')
   {{ Html::style('/css/woodbarn.css') }}
@endsection

@section('left_column')
@endsection

@section('right_column')
@endsection

@section('content')

   <div class="card mb-3">

      <div class="card-header section_header p-2">
         <i class="fa fa-plus-square"></i>
         Sow Material
         <span class="float-right">
            <div class="btn-group">
               @include('admin.projects.materials.buttons.help', ['size'=>'xs', 'bookmark'=>'materials'])
               @include('admin.projects.materials.buttons.back', ['size'=>'xs'])
            </div>
         </span>
      </div>

      <div class="card-body section_body p-2">

         {{-- <table class="table table-sm table-striped table-hover text-dark">
            <tbody>
               <tr>
                  <th class="col-sm-2">ID</th>
                  <td>{{ $material->id }}</td>
               </tr>
               <tr>
                  <th>Name</th>
                  <td>{{ $material->name }}</td>
               </tr>
               <tr>
                  <th>Type</th>
                  <td>{{ $material->type }}</td>
               </tr>
               <tr>
                  <th>Manufacturer</th>
                  <td>{{ $material->manufacturer }}</td>
               </tr>
               <tr>
                  <th>UPC Code</th>
                  <td>{{ $material->upc }}</td>
               </tr>
               <tr>
                  <th>Created On</th>
                  <td>{{ $material->created_at }}</td>
               </tr>
               <tr>
                  <th>Updated On</th>
                  <td>{{ $material->updated_at }}</td>
               </tr>
            </tbody>
         </table> --}}

         @include('admin.projects.materials.form')

      </div>

   </div>
   
@endsection
