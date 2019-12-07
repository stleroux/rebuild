@extends('layouts.master')

@section('title','Unauthorized Access')

@section ('stylesheets')
	{{ Html::style('css/woodbarn.css') }}
@endsection

@section('sectionSidebar')
  {{-- @include('backend.projects.sidebar') --}}
@endsection

{{-- @section('breadcrumb') --}}
	{{-- <li><a href="/">Home</a></li> --}}
{{-- @endsection --}}

@section('content')
	
		<div class="card bg-danger">
			
			<div class="card-header">
				<h3 class="text-center text-danger">Unauthorized access.</h3>
			</div>
			
			<div class="card-body">
				<div class="col-xs-12 text-center">
					<img src="\images\dog.jpg">
				</div>
				
				<div class="col-xs-12 text-center">
					<br />
					<p>It seems like you do not have sufficient permissions to view this page or your session has timed out due to inactiviy.</p>
				</div>
				
				<div class="col-xs-12 text-center">
					<p>If you think this is an error, please contact the system administrator by using the <a href="/contact">Contact Us</a> page</p>
				</div>
			</div>

			<div class="panel-footer mb-3 text-center">
				<a href="{{ URL::previous() }}" class="btn btn-sm btn-primary">Return to previous page</a>
			</div>
		</div>
	
@endsection