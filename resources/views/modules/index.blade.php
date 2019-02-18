@extends('layouts.master')

@section('left_column')
   {{-- @include('blocks.admin_menu') --}}
   @include('modules.sidebar')
@endsection

@section('right_column')
   @include('modules.blocks.new')
@endsection

@section('content')

<div class="row">
   <div class="col-sm-12">
      <div class="card">
         <div class="card-header card_header">
            <i class="fa fa-cubes"></i>
            Modules
         </div>
         
         <div class="card-body card_body">
            <table id="datatable" class="table table-hover table-sm">
               <thead>
                  <tr>
                     <th>ID</th>
                     <th>Name</th>
                     <th data-orderable="false"></th>
                  </tr>
               </thead>
               <tbody>
                  @foreach ($modules as $module)
                     <tr>
                        <td>{{ $module->id }}</td>
                        <td>{{ $module->name }}</td>
                        <td class="text-right">
                           @if(checkPerm('module_edit'))
                              <a href="{{ route('modules.edit', $module->id) }}" class="btn btn-sm btn-outline-bprimary px-1 py-0" title="Edit">
                                 <i class="far fa-edit"></i>
                              </a>
                           @endif
                           @if(checkPerm('module_delete'))
                              <a href="{{ route('modules.delete', $module->id) }}" class="btn btn-sm btn-outline-danger px-1 py-0" title="Delete">
                                 <i class="far fa-trash-alt"></i>
                              </a>
                           @endif
                        </td>
                     </tr>
                  @endforeach
               </tbody>
            </table>
         </div>
      </div>
   </div>
</div>

@endsection