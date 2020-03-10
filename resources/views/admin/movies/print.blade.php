@extends ('common.layouts.print')

@section ('stylesheets')
	{{ Html::style('css/print.css') }}
@endsection

@section ('content')
	<br />
	<div class="card mb-3">
		<div class="card-header section_header p-2">Movies</div>
		<div class="card-body section_body p-2">
			<div class="row">
				<div class="col-xs-12 col-sm-8 col-md-9">
					<div class="card">
						<div class="card-header">Title</div>
						<div class="card-body">{{ ucwords($movie->title) }}</div>
					</div>
				</div>
				<div class="col-xs-12 col-sm-4 col-md-3">
					<div class="card mb-2">
						<div class="card-header card_header p-2">Category</div>
						<div class="card-body p-2">{!! $movie->category->name !!}</div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-xs-12">
					<div class="card mb-2">
						<div class="card-header card_header p-2">Description (En)</div>
						<div class="card-body p-2">
							@if($movie->description_eng)
								{!! $movie->description_eng !!}
							@else
								N/A
							@endif
						</div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-xs-12">
					<div class="card mb-2">
						<div class="card-header card_header p-2">Description (Fr)</div>
						<div class="card-body p-2">
							@if($movie->description_fre)
								{!! $movie->description_fre !!}
							@else
								N/A
							@endif
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="panel-footer">
			From the movies list at TheWoodBarn.ca
		</div>
	</div>
@endsection
