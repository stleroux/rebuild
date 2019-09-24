@extends('layouts.master')

@section('stylesheets')
   {{ Html::style('css/woodbarn.css') }}
@endsection

@section('left_column')
@endsection

@section('right_column')
@endsection

@section('content')

   <div class="card">
      <div class="card-header section_header text-center p-2">
         <b class="text-danger">ARE YOU SURE YOU WANT TO PERMANENTLY DELETE THIS CATEGORY?</b>
      </div>
      <div class="card-body bg-light p-2 text-center">
         <form>
            @csrf
            @method('DELETE')

            @include('admin.categories.buttons.back', ['size'=>'', 'btn_label'=>'No - Return To Previous Page'])
            @include('admin.categories.buttons.btn_delete', ['size'=>'', 'btn_label'=>'Yes - Delete Permanently'])
         </form>
      </div>
      <div class="card-footer pt-1 pb-1 pl-2">
         <b>Note: </b>This record will not be recoverable if deleted.
      </div>
   </div>

@endsection