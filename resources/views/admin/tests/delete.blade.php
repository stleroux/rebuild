@extends('layouts.master')

@section('stylesheets')
   {{ Html::style('css/woodbarn.css') }}
@endsection

@section('left_column')
@endsection

@section('right_column')
@endsection

@section('content')

{!! Form::open(['method'=>'POST', 'route'=>['admin.tests.destroy', $test->id]]) !!}
   {{ csrf_field() }}

   <div class="card">

      <div class="card-header bg-danger text-white text-center">
         <b>
            ARE YOU SURE YOU WANT TO PERMANENTLY DELETE THIS TEST?<br />
            {{-- Title : {{ $test->title }}? --}}
         </b>
      </div>

      <div class="card-body card_body text-center">
            <input type="hidden" name="_method" value="DELETE" />

            @include('admin.tests.buttons.back', ['size'=>'', 'btn_label'=>'No - Return To Previous Page'])
            @include('admin.tests.buttons.btn_delete', ['size'=>'', 'btn_label'=>'Yes - Delete Permanently'])
         {{ Form::close() }}
      </div>

      <div class="card-footer pt-1 pb-1 pl-2">
         <b>Note: </b>This record will not be recoverable if deleted.
      </div>

   </div>

@endsection
