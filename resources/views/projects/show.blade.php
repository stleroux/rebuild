@extends('layouts.master')

@section('stylesheets')
	{{ Html::style('css/woodbarn.css') }}
@endsection

@section('left_column')
	@include('blocks.main_menu')
@endsection

@section('right_column')
  @include('projects.blocks.leave_comment')
  @include('projects.blocks.imageSlider')
  @include('projects.blocks.purchase')
@endsection

@section('content')
	
	<div class="card mb-3 bg-transparent">

		<div class="card-header section_header">
			<i class="far fa-eye"></i>
			Show Project
			<span class="float-right">
				@include('projects.addins.links.help', ['model'=>'project', 'bookmark'=>'projects'])
				@include('projects.addins.links.back', ['model'=>'project'])
			</span>
		</div>

		<div class="card-body section_body p-1">
			<div class="row">
				<div class="col-8">
					
<div class="card">
	<div class="card-header card_header">Project Information</div>
	<div class="card-body">

	</div>
	<div class="card-footer"></div>
</div>

				</div>
				<div class="col-4">
					<div class="card text text-center p-2 m-0">
						@if($image)
							<img src="/_projects/{{ $image->name }}" alt="{{ $project->name}}">
						@else
							<img src="/images/no_image.jpg" alt="No Image" height="100%" width="100%">
						@endif
					</div>
				</div>
			</div>
		</div>
</div>








@endsection
