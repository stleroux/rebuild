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
         Show Finish
         <span class="float-right">
            <div class="btn-group">
               @include('admin.projects.finishes.buttons.help', ['size'=>'xs', 'bookmark'=>'projects'])
               @include('admin.projects.finishes.buttons.back', ['size'=>'xs'])
            </div>
         </span>
      </div>

      {{-- <div class="card-body section_body p-2"> --}}

         {{-- <table class="table table-sm table-striped table-hover text-dark">
            <tr>
               <th class="w-25">ID</th>
               <td class="w-75">{{ $finish->id }}</td>
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
         </table> --}}

         {{-- <p></p> --}}

      {{-- </div> --}}



<div class="card-body section_body p-2">
   @include('admin.projects.finishes.form')
</div>




   </div>
   
@endsection
