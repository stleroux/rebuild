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

   <div class="row">
      <div class="col">
         <div class="card mb-2">
            <!--CARD HEADER-->
            <div class="card-header card_header">
               <i class="fas fa-brush"></i>
               Finishes
               <span class="float-right">
                  @include('projects.addins.links.help', ['bookmark'=>'projects'])
                  @include('projects.addins.links.BEProjects')
                  @if(checkPerm('projects_index'))
                     @include('projects.materials.addins.links.materials')
                  @endif
                  @if(checkPerm('projects_create'))
                     @include('projects.finishes.addins.links.add', ['model'=>'finish'])
                  @endif
               </span>
            </div>

            <!--CARD BODY-->
            @if($finishes->count() > 0)
               <div class="card-body card_body pb-1">
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
                           <th>Updated On</th>
                           <th class="no-sort"></th>
                        </tr>
                     </thead>
                     <tbody>
                        @foreach ($finishes as $finish)
                           <tr>
                              <td>{{ $finish->id }}</td>
                              <td><a href="{{ route('finishes.show', $finish->id) }}">{{ $finish->name }}</a></td>
                              <td>{{ $finish->type }}</td>
                              <td>{{ $finish->color_name }}</td>
                              <td>{{ $finish->sheen }}</td>
                              {{-- Add more columns here --}}
                              <td data-order="{{ $finish->created_at}}">{{ $finish->created_at ? $finish->created_at->format('M d, Y') : 'no data found' }}</td>
                              <td data-order="{{ $finish->updated_at}}">{{ $finish->updated_at ? $finish->updated_at->format('M d, Y') : 'no data found' }}</td>
                              <td class="text-right">
                                 @if(checkPerm('projects_edit'))
                                    @include('projects.finishes.addins.links.edit', ['size'=>'xs'])
                                 @endif
                                 @if(checkPerm('projects_delete'))
                                    @include('projects.finishes.addins.links.delete', ['size'=>'xs'])
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
