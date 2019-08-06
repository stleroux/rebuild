@extends ('layouts.print')

@section ('title', 'Print Recipe')

@section ('stylesheets')
	{{ Html::style('css/print.css') }}
@stop

@section ('content')

	<div class="card mt-5">
		
		<div class="card-header">
			<span class="h3">{{ ucwords($recipe->title) }}</span>
			<span class="float-right">
				{{-- <a href="{{ route('recipes.show', $recipe->id) }}" class="btn btn-sm btn-outline-secondary d-print-none">Return</a> --}}
				{{-- @include('common.buttons.cancel') --}}
				{{-- @include('common.buttons.cancel', ['model'=>'recipe']) --}}
				@include('recipes.addins.links.back', ['size'=>'xs'])
				@include('common.buttons.print2')
			</span>
		</div>
		
		<div class="card-body">
			<div class="row">
				<div class="col-xs-12 col-sm-8">
					<div class="card mb-2">
						<div class="card-header">Ingredients</div>
						<div class="card-body">
							{!! $ingredients = str_replace(array('<p>','</p>'),array('','<br />'),$recipe->ingredients) !!}<br />
						</div>
					</div>
				</div>
				<div class="col-xs-12 col-sm-4">
					<div class="card mb-2">
						<div class="card-header card_header_2">Image</div>
						<div class="card-body text text-center p-0 m-0">
							@if($recipe->image)
								<img src="/_recipes/{{ $recipe->image }}" alt="" height="200px" width="auto" class="card-img">
							@else
								<img src="/_recipes/image_not_available.jpg" alt="" height="200px" width="auto" class="card-img">
							@endif
						</div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-xs-12 col-sm-8">
					<div class="card mb-2">
						<div class="card-header">Methodology</div>
						<div class="card-body">{!! $recipe->methodology !!}</div>
					</div>
					<div class="card" style="margin-bottom: 0px">
						<div class="card-header">Notes</div>
						<div class="card-body">
							@if ($recipe->public_notes) 
								{!! $recipe->public_notes !!}
							@else
								N/A
							@endif
						</div>
					</div>
				</div>
				<div class="col-xs-12 col-sm-4">
					<div class="card mb-2">
						<div class="card-header">Information</div>
						<div class="card-body">
							<table width="100%">
								<tr>
									<th>Category</th>
									<td>{{ ucwords($recipe->category->name) }}</td>
								</tr>
								<tr>
									<th>Servings</th>
									<td>{{ $recipe->servings }}</td>
								</tr>
								<tr>
									<th>Prep Time</th>
									<td>{{ $recipe->prep_time }} minutes</td>
								</tr>
								<tr>
									<th>Cook Time</th>
									<td>{{ $recipe->cook_time }} minutes</td>
								</tr>
								<tr>
									<th>Created By</th>
									<td>{{ $recipe->user->profile->first_name }} {{ $recipe->user->profile->last_name }}</td>
								</tr>
								<tr>
									<th>Created On</th>
		
									<td>
										{{-- @include('common.dateFormat', ['dateFormat'=>Auth::user()->dateFormat, 'model'=>$recipe, 'field'=>'created_at']) --}}
										@include('common.dateFormat', ['model'=>$recipe, 'field'=>'created_at'])
									</td>
								</tr>
								<tr>
									<th>Source</th>
									<td>
										@if ($recipe->source)
											{{ $recipe->source }}
										@else
											N/A
										@endif
									</td>
								</tr>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="panel-footer">
			From the Recipe Book at TheWoodBarn.ca
		</div>
	</div>

@stop
