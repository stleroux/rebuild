@extends('layouts.master')

@section('stylesheets')
   {{-- {{ Html::style('css/woodbarn.css') }} --}}
@endsection

@section('left_column')
   @include('blocks.main_menu')
@endsection

@section('right_column')
@endsection

@section('content')

	<div class="row">
		<div class="col">
			<div class="card">
				<div class="card-header section_header p-2">
					<i class="fas fa-shield-alt"></i>
					Permissions
					@if(checkPerm('permission_create'))
						<span class="float-sm-right">
							@include('permissions.buttons.add', ['size'=>'xs'])
						</span>
					@endif
				</div>
				<div class="card-body section_body p-2">
					<table id="datatable" class="table table-hover table-sm">
						<thead>
							<tr>
								<th>Name</th>
								<th>Display Name</th>
								<th>Model</th>
								<th>Core</th>
								<th>Allow member to</th>
								<th class="no-sort"></th>
							</tr>
						</thead>
						<tbody>
							@foreach($permissions as $permission)
								<tr>
									<td>{{ $permission->name }}</td>
									<td>{{ ucwords($permission->display_name) }}</td>
									<td>{{ ucfirst($permission->model) }}</td>
									<td>{{ $permission->type }}</td>
									<td>{{ ucwords($permission->description) }}</td>
									<td class="text-right" nowrap="nowrap">
										@if(checkPerm('permission_show'))
											@include('permissions.buttons.show', ['size'=>'xs'])
										@endif

										@if(checkPerm('permission_edit'))
											@include('permissions.buttons.edit', ['size'=>'xs'])
										@endif

										@if(checkPerm('permission_delete'))
											@include('permissions.buttons.delete', ['size'=>'xs'])
										@endif
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
