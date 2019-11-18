@extends('layouts.master')

@section('stylesheets')
   {{ Html::style('/css/woodbarn.css') }}
@endsection

@section('left_column')
@endsection

@section('right_column')
@endsection

@section('content')

   <div class="row">
      <div class="col">
         <div class="card mb-2">
            <!--CARD HEADER-->
            <div class="card-header section_header p-2">
               <i class="fa fa-hammer"></i>
               Project Materials
               <span class="float-right">
                  <div class="btn-group">
                     @include('admin.projects.buttons.help', ['size'=>'xs', 'bookmark'=>'projects'])
                     @include('admin.projects.buttons.BEProjects', ['size'=>'xs'])
                     @include('admin.projects.finishes.buttons.finishes', ['size'=>'xs'])
                     @include('admin.projects.materials.buttons.materials', ['size'=>'xs'])
                     @include('admin.projects.materials.buttons.add', ['size'=>'xs'])
                  </div>
               </span>
            </div>

            <!--CARD BODY-->
            @if($materials->count() > 0)
               <div class="card-body section_body p-2">
                  {{-- @include('common.alphabet', ['model'=>'woodproject', 'page'=>'index']) --}}
                  <table id="datatable" class="table table-hover table-sm">
                     <thead>
                        <tr>
                           <th>ID</th>
                           <th>Name</th>
                           <th>Type</th>
                           <th>Created On</th>
                           {{-- <th>Updated On</th> --}}
                           <th class="no-sort"></th>
                        </tr>
                     </thead>
                     <tbody>
                        @foreach ($materials as $material)
                           <tr>
                              <td>{{ $material->id }}</td>
                              <td><a href="{{ route('admin.projects.materials.show', $material->id) }}">{{ $material->name }}</a></td>
                              <td>{{ $material->type }}</td>
                              {{-- Add more columns here --}}
                              <td data-order="{{ $material->created_at}}">{{ $material->created_at }}</td>
                              <td class="text-right">
                                 <div class="btn-group">
                                    @include('admin.projects.materials.buttons.show', ['size'=>'xs'])
                                    @include('admin.projects.materials.buttons.edit', ['size'=>'xs'])
                                    @include('admin.projects.materials.buttons.delete', ['size'=>'xs'])
                                 </div>
                              </td>
                           </tr>
                        @endforeach
                     </tbody>
                  </table>
               </div>
            @else
               <div class="card-body card_body">
                  {{ setting('no_records_found') }}
               </div>
            @endif
            
         </div>
      </div>
   </div>

@endsection
