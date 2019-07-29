@extends('layouts.backend')

@section('stylesheets')
   {{ Html::style('/css/woodbarn.css') }}
@endsection

@section('left_column')
   @include('blocks.main_menu')
@endsection

@section('right_column')
@endsection

@section('content')
   
   <div class="card mb-3">

      <div class="card-header section_header p-1 m-0">
         <span class="h5 align-middle pt-2">
            <i class="fa fa-plus-square"></i>
            Sow Material
         </span>
         <span class="float-right">
            @include('projects.materials.addins.links.help', ['size'=>'sm', 'bookmark'=>'materials'])
            @include('projects.materials.addins.links.back', ['size'=>'sm'])
         </span>
      </div>

      <div class="card-body section_body pb-0">

         <table class="table table-sm table-striped table-hover text-dark">
            <tbody>
               <tr>
                  <th class="col-2">ID</th>
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
                  <td>{{ $material->created_at ? $material->created_at->format('M d, Y') : 'no data found' }}</td>
               </tr>
               <tr>
                  <th>Updated On</th>
                  <td>{{ $material->updated_at ? $material->updated_at->format('M d, Y') : 'no data found' }}</td>
               </tr>
            </tbody>
         </table>
      </div>

   </div>
   
@endsection
