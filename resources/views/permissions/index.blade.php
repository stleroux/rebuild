@extends('layouts.backend')

@section('stylesheets')
   {{-- {{ Html::style('css/recipes.css') }} --}}
@endsection

@section('left_column')
   @include('blocks.adminNav')
   @include('permissions.sidebar')
@endsection

@section('right_column')
@endsection

@section('content')

	<div class="row">
		<div class="col">
			<div class="card">
				<div class="card-header card_header">
					<i class="fas fa-shield-alt"></i>
					Permissions
					@if(checkPerm('permission_create'))
						<span class="float-sm-right">
							@include('common.buttons.add', ['model'=>'permission', 'type'=>''])
						</span>
					@endif
				</div>
				<div class="card-body card_body">
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
											@include('common.buttons.show', ['model'=>'permission', 'id'=>$permission->id, 'type'=>''])
										@endif

										@if(checkPerm('permission_edit'))
											@include('common.buttons.edit', ['model'=>'permission', 'id'=>$permission->id, 'type'=>''])
										@endif

										@if(checkPerm('permission_delete'))
											@include('common.buttons.delete', ['model'=>'permission', 'id'=>$permission->id, 'type'=>''])
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
