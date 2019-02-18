@extends('layouts.master')

@section('left_column')
   {{-- @include('blocks.admin_menu') --}}
   @include('permissions.sidebar')
@endsection

@section('right_column')
@endsection

@section('content')

{{-- 	@if ($message = Session::get('success'))
		<div class="alert alert-success alert-dismissible fade show" role="alert">
			<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
			</button>
			{{ $message }}
		</div>
	@endif --}}
	
	<div class="row">
		<div class="col">
			<div class="card">
				<div class="card-header card_header">
					<i class="fas fa-shield-alt"></i>
					Permissions
					@if(checkPerm('permission_create'))
						<a href="{{ route('permissions.create') }}"
							class="float-right btn btn-sm btn-outline-success px-1 py-0">
							{{-- <i class="far fa-plus-square"></i> --}}
							<i class="fas fa-plus-square"></i>
							New Permission
						</a>
					@endif
				</div>
				<div class="card-body card_body">
					<table id="datatable" class="table table-hover table-sm">
						<thead>
							<tr>
								{{-- <th>ID</th> --}}
								<th>Name</th>
								<th>Display Name</th>
								<th>Model</th>
								<th>Core</th>
								<th>Allow member to</th>
								{{-- <th>Created</th> --}}
								<th class="no-sort"></th>
							</tr>
						</thead>
						<tbody>
							@foreach($permissions as $permission)
								<tr>
									{{-- <th>{{ $permission->id }}</th> --}}
									<td>{{ $permission->name }}</td>
									<td>{{ ucwords($permission->display_name) }}</td>
									<td>{{ ucfirst($permission->model) }}</td>
									<td>{{ $permission->core }}</td>
									<td>{{ $permission->description }}</td>
									{{-- <td>{{ optional($permission->created_at)->format('M d, Y') }}</td> --}}
									<td class="text-right" nowrap="nowrap">
										@if(checkPerm('permission_show'))
											<a href="{{ route('permissions.show', $permission->id) }}"
												class="btn btn-sm btn-outline-secondary px-1 py-0">
												<i class="far fa-eye"></i>
											</a>
										@endif

										@if(checkPerm('permission_edit'))
											<a href="{{ route('permissions.edit', $permission->id) }}"
												class="btn btn-sm btn-outline-bprimary px-1 py-0">
												<i class="far fa-edit"></i>
											</a>
										@endif

										@if(checkPerm('permission_delete'))
											<a href="{{ route('permissions.delete', $permission->id) }}"
												class="btn btn-sm btn-outline-danger px-1 py-0">
												<i class="far fa-trash-alt"></i>
											</a>
										@endif
									</td>
								</tr>
							@endforeach
						</tbody>
					</table>
				</div>
				{{-- <div class="card-footer pb-0 mb-0 pagination pagination-sm justify-content-center"> --}}
					{{-- {{ $permissions->links() }} --}}
				{{-- </div> --}}
			</div>
		</div>
	</div>

	{{-- @endif --}}


@endsection
