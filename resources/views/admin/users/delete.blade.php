@extends('layouts.master')

@section('stylesheets')
   {{ Html::style('/css/woodbarn.css') }}
@endsection

@section('left_column')
   {{-- @include('blocks.main_menu') --}}
@endsection

@section('right_column')
   @include('admin.users.blocks.mostPermissions')
   @include('admin.users.blocks.mostLogins')
   @include('admin.users.blocks.mostAssignedPermissions')
@endsection

@section('content')

   {!! Form::open(['route'=>['admin.users.destroy', $user->id], 'method'=>'DELETE']) !!}

      <div class="card mb-2">
         <div class="card-header section_header text-center p-2">
            <b class="text-danger">ARE YOU SURE YOU WANT TO PERMANENTLY DELETE USER {{ strtoupper($user->username) }}?</b>
         </div>

         <div class="card-body bg-light text-center">
            <input type="hidden" name="_method" value="DELETE" />

            <a class="btn btn-secondary" href="{{ route('admin.users.index') }}">No - Return To Previous Page</a>
            
            @if(checkPerm('user_delete'))
               <button type="submit" class="btn btn-danger">
                  <i class="far fa-trash-alt" aria-hidden="true"></i>
                  Yes - Delete Permanently
               </button>
            @endif
         </div>

         <div class="card-footer pt-1 pb-1 pl-2">
            <b>Note: </b>This record will <b>not</b> be recoverable if deleted.<br />
         </div>
      </div>

   {{ Form::close() }}

@endsection
