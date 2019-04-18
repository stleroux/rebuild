@extends('layouts.backend')

@section('stylesheets')
   {{-- {{ Html::style('css/recipes.css') }} --}}
@endsection

@section('left_column')
   @include('blocks.adminNav')
   @include('modules.sidebar')
@endsection

@section('right_column')
@endsection

@section('content')

	<div class="row">
		<div class="col">
			<div class="card">
				<!--CARD HEADER-->
				<div class="card-header card_header">
					<i class="fa fa-cubes"></i>
					Modules
					<span class="float-sm-right">
						@if(checkPerm('module_create'))
							@include('common.buttons.add', ['model'=>'module', 'type'=>''])
						@endif
					</span>
				</div>
				
				<!--CARD BODY-->
				<div class="card-body card_body">
					<table id="datatable" class="table table-hover table-sm">
						<thead>
							<tr>
								<th>Module Name</th>
								<th class="no-sort"></th>
							</tr>
						</thead>
						<tbody>
							@foreach ($modules as $module)
								<tr>
									<td>{{ $module }}</td>
									<td class="text-right">
										@if(checkPerm('module_enable'))
											@if(\Module::enabled($module))
												@include('common.buttons.moduleDisable', ['model'=>'module', 'type'=>''])
											@endif
										@endif
										@if(checkPerm('module_disable'))
											@if(\Module::disabled($module))
												@include('common.buttons.moduleEnable', ['model'=>'module', 'type'=>''])
											@endif
										@endif
										@if(checkPerm('module_delete'))
											@include('common.buttons.moduleDelete', ['model'=>'module', 'type'=>''])
										@endif
									</td>
								</tr>
							@endforeach

						</tbody>
					</table>
				</div> {{-- End of card-body --}}
			</div>
		</div>
	</div>

@endsection
