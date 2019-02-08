@extends('layouts.master')

@section('left_column')
   @include('blocks.admin_menu')
@endsection

@section('right_column')
@endsection

@section('content')

	<div class="row">
		<div class="col">
			<div class="card">
				<!--CARD HEADER-->
				<div class="card-header card_header">
					<i class="fas fa-boxes"></i>
					Components
					<span class="float-sm-right">
						@if(checkPerm('component_create'))
							<a href="{{ route('components.create') }}"
								class="btn btn-sm btn-outline-success px-1 py-0">
								{{-- <i class="far fa-plus-square"></i> --}}
								<i class="fas fa-plus-square"></i>
								New Component
							</a>
						@endif
					</span>
				</div>
				
				<!--CARD BODY-->
				<div class="card-body card_body">
					<table id="datatable" class="table table-hover table-sm">
						<thead>
							<tr>
								<th>Component Name</th>
								<th class="no-sort"></th>
							</tr>
						</thead>
						<tbody>
							@foreach ($modules as $module)
								<tr>
									<td>{{ $module }}</td>
									<td class="text-right">
										@if(checkPerm('component_enable'))
											@if(\Module::enabled($module))
												<a class="btn btn-sm btn-outline-warning px-1 py-0"
													href="{{ route('components.disableModule', $module) }}"
													title="Disable Module">
													<i class="fas fa-thumbs-down"></i>
												</a>
											@endif
										@endif
										@if(checkPerm('component_disable'))
											@if(\Module::disabled($module))
												<a href="{{ route('components.enableModule', $module) }}"
													class="btn btn-sm btn-outline-success px-1 py-0"
													title="Edit User">
													<i class="fas fa-thumbs-up"></i>
												</a>
											@endif
										@endif
										@if(checkPerm('component_delete'))
											<a class="btn btn-sm btn-outline-danger px-1 py-0"
												href="{{ route('components.deleteModule', $module) }}"
												title="Delete Module">
												<i class="far fa-trash-alt"></i>
											</a>
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
