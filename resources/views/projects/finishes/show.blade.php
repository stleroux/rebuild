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
            Show Finish
         </span>
         <span class="float-right">
            @include('projects.finishes..addins.links.help', ['model'=>'project', 'bookmark'=>'projects'])
            @include('projects.finishes.addins.links.back')
         </span>
      </div>

      <div class="card-body pb-0">

         <table class="table table-sm table-striped table-hover">
            <tbody>
               <tr>
                  <th class="col-2">ID</th>
                  <td>{{ $finish->id }}</td>
               </tr>
               <tr>
                  <th>Name</th>
                  <td>{{ $finish->name }}</td>
               </tr>
               <tr>
                  <th>Type</th>
                  <td>{{ $finish->type }}</td>
               </tr>
               <tr>
                  <th>Color Name</th>
                  <td>{{ $finish->color_name }}</td>
               </tr>
               <tr>
                  <th>Color Code</th>
                  <td>{{ $finish->color_code }}</td>
               </tr>
               <tr>
                  <th>Sheen</th>
                  <td>{{ $finish->sheen }}</td>
               </tr>
               <tr>
                  <th>Manufacturer</th>
                  <td>{{ $finish->manufacturer }}</td>
               </tr>
               <tr>
                  <th>UPC Code</th>
                  <td>{{ $finish->upc }}</td>
               </tr>
               <tr>
                  <th>Created On</th>
                  <td>{{ $finish->created_at ? $finish->created_at->format('M d, Y') : 'no data found' }}</td>
               </tr>
               <tr>
                  <th>Updated On</th>
                  <td>{{ $finish->updated_at ? $finish->updated_at->format('M d, Y') : 'no data found' }}</td>
               </tr>
            </tbody>
         </table>

         <p></p>
      </div>

   </div>
   
@endsection
