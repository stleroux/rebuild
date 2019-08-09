@extends('layouts.master')

@section('stylesheets')
   {{ Html::style('/css/woodbarn.css') }}
@endsection

@section('left_column')
   @include('blocks.main_menu')
@endsection

@section('right_column')
   @include('projects.blocks.popularProjects')
@endsection

@section('content')

   <div class="row">
      <div class="col">
         <div class="card mb-2">
            <!--CARD HEADER-->
            <div class="card-header section_header p-2">
               <i class="fa fa-hammer"></i>
               Materials
               <span class="float-right">
                  @include('projects.addins.links.help', ['size'=>'xs', 'bookmark'=>'projects'])
                  @include('projects.addins.links.BEProjects', ['size'=>'xs'])
                  @include('projects.finishes.addins.links.finishes', ['size'=>'xs'])
                  @include('projects.materials.addins.links.materials', ['size'=>'xs'])
                  @include('projects.materials.addins.links.add', ['size'=>'xs'])
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
                           <th>Updated On</th>
                           <th class="no-sort"></th>
                        </tr>
                     </thead>
                     <tbody>
                        @foreach ($materials as $material)
                           <tr>
                              <td>{{ $material->id }}</td>
                              <td>{{ $material->name }}</td>
                              <td>{{ $material->type }}</td>
                              {{-- Add more columns here --}}
                              <td data-order="{{ $material->created_at}}">{{ $material->created_at ? $material->created_at->format('M d, Y') : 'no data found' }}</td>
                              <td data-order="{{ $material->updated_at}}">{{ $material->updated_at ? $material->updated_at->format('M d, Y') : 'no data found' }}</td>
                              <td class="text-right">
                                 @include('projects.materials.addins.links.show', ['size'=>'xs'])
                                 @if(checkPerm('projects_edit'))
                                    @include('projects.materials.addins.links.edit', ['size'=>'xs'])
                                 @endif
                                 @if(checkPerm('projects_delete'))
                                    @include('projects.materials.addins.links.delete', ['size'=>'xs'])
                                 @endif
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
