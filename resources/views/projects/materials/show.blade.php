@extends('layouts.backend')

@section('stylesheets')
   {{-- {{ Html::style('css/.css') }} --}}
@endsection

@section('left_column')
   @include('blocks.main_menu')
@endsection

@section('right_column')
@endsection

@section('content')
   
   <div class="card mb-3">

      <div class="card-header">
         <i class="fa fa-plus-square"></i>
         Show Material
         <span class="float-right">
            @include('projects.materials.addins.links.help', ['model'=>'material', 'bookmark'=>'materials'])
            @include('projects.materials.addins.links.back', ['model'=>'material'])
         </span>
      </div>

      <div class="card-body pb-0">

         <table class="table table-sm table-striped table-hover">
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

         <p></p>
      </div>

   </div>
   
@endsection
