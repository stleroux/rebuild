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
         <div class="card mb-3">
            <!--CARD HEADER-->
            <div class="card-header section_header p-2">
               <i class="fas fa-brush"></i>
               Finishes
               <span class="float-right">
                  <div class="btn-group">
                     @include('projects.buttons.help', ['size'=>'xs', 'bookmark'=>'projects'])
                     @include('projects.buttons.BEProjects', ['size'=>'xs'])
                     @include('projects.finishes.buttons.finishes', ['size'=>'xs'])
                     @include('projects.materials.buttons.materials', ['size'=>'xs'])
                     @include('projects.finishes.buttons.add', ['size'=>'xs'])
                  </div>
               </span>
            </div>

            <!--CARD BODY-->
            @if($finishes->count() > 0)
               <div class="card-body section_body p-2">
                  {{-- @include('common.alphabet', ['model'=>'test', 'page'=>'index']) --}}
                  <table id="datatable" class="table table-hover table-sm">
                     <thead>
                        <tr>
                           <th>ID</th>
                           <th>Name</th>
                           <th>Type</th>
                           <th>Color Name</th>
                           <th>Sheen</th>
                           <th>Created On</th>
                           {{-- <th>Updated On</th> --}}
                           <th class="no-sort"></th>
                        </tr>
                     </thead>
                     <tbody>
                        @foreach ($finishes as $finish)
                           <tr>
                              <td>{{ $finish->id }}</td>
                              <td>{{ $finish->name }}</td>
                              <td>{{ $finish->type }}</td>
                              <td>{{ $finish->color_name }}</td>
                              <td>{{ $finish->sheen }}</td>
                              {{-- Add more columns here --}}
                              <td data-order="{{ $finish->created_at}}">{{ $finish->created_at ? $finish->created_at->format('M d, Y') : 'no data found' }}</td>
                              {{-- <td data-order="{{ $finish->updated_at}}">{{ $finish->updated_at ? $finish->updated_at->format('M d, Y') : 'no data found' }}</td> --}}
                              <td class="text-right">
                                 <div class="btn-group">
                                    @include('projects.finishes.buttons.show', ['size'=>'xs'])
                                    @include('projects.finishes.buttons.edit', ['size'=>'xs'])
                                    @include('projects.finishes.buttons.delete', ['size'=>'xs'])
                                 </div>
                              </td>
                           </tr>
                        @endforeach
                     </tbody>
                  </table>
               </div>
            @else
               <div class="card-body card_body p-2">
                  {{ setting('no_records_found') }}
               </div>
            @endif
            
         </div>
      </div>
   </div>

@endsection
