@extends('layouts.master')

@section('left_column')
   @include('blocks.admin_menu')
@endsection

@section('right_column')
@endsection

@section('content')

   <div class="row">
      <div class="col">
         <div class="card mb-2">
            <div class="card-header card_header">
               <i class="fas fa-cog"></i>
               Site Settings
               <span class="float-right">
                  <a href="{{ route('settings.create') }}" class="btn btn-sm btn-outline-success px-1 py-0">
                     <i class="fas fa-plus-square"></i>
                     New Setting
                  </a>
               </span>
            </div>
            <div class="card-body card_body">
               <table id="datatable" class="table table-sm table-hover">
                  <thead>
                     <tr>
                        <th class="col-1">Key</th>
                        <th class="col-4">Value</th>
                        <th class="col-1">Tab</th>
                        <th class="no-sort">Description</th>
                        <th class="col-2 no-sort"></th>
                     </tr>
                  </thead>
                  <tbody>
                     @foreach($settings as $setting)
                        <tr>
                           <td>{{ $setting->key }}</td>
                           <td>{{ $setting->value }}</td>
                           <td>{{ ucfirst($setting->tab) }}</td>
                           <td>{{ $setting->description }}</td>
                           <td class="text-right">
                              {!! Form::open(['route' => ['settings.destroy', $setting->id], 'method' => 'DELETE', 'class'=>'inline']) !!}
                                 <a href="{{ route('settings.edit', $setting->id) }}" class="btn btn-sm btn-outline-bprimary px-1 py-0">Edit</a>
                                 {!! Form::submit('Delete', ['class'=>'btn btn-sm btn-outline-danger px-1 py-0', 'onclick'=>'return confirm("Are you sure?")']) !!}
                              {!! Form::close() !!}
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