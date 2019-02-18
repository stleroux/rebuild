@extends('layouts.master')

@section('left_column')
	{{-- @include('blocks.admin_menu') --}}
	@include('users.sidebar')
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
				<!--CARD HEADER-->
				<div class="card-header card_header">
					<i class="fas fa-users"></i>
					Users
					<span class="float-sm-right">
						@if(checkPerm('user_create'))
							<a href="{{ route('users.create') }}"
								class="btn btn-sm btn-outline-success px-1 py-0">
								{{-- <i class="far fa-plus-square"></i> --}}
								<i class="fas fa-plus-square"></i>
								New User
							</a>
						@endif
					</span>
				</div>
				
				<!--CARD BODY-->
				<div class="card-body card_body">
					<table id="datatable" class="table table-hover table-sm">
						<thead>
							<tr>
								<th>No</th>
								<th>Username</th>
								<th>Email</th>
								<th>Created</th>
								<th class="no-sort"></th>
							</tr>
						</thead>
						<tbody>
							@foreach ($users as $user)
								<tr>
									<td>{{ $user->id }}</td>
									<td>{{ $user->username }}</td>
									<td>{{ $user->email }}</td>
									<td>{{ $user->created_at->format('M d, Y') }}</td>
									<td class="text-right">
										@if(checkPerm('user_show'))
											<a class="btn btn-sm btn-outline-secondary px-1 py-0"
												href="{{ route('users.show', $user->id) }}"
												title="View User">
												<i class="far fa-eye"></i>
											</a>
										@endif

										@if(checkPerm('change_user_pwd'))
											<a href="{{ route('users.changeUserPWD', $user->id) }}"
												class="btn btn-sm btn-outline-secondary px-1 py-0"
												title="Reset User's Password">
												<i class="fas fa-unlock-alt"></i>
											</a>
										@endif
										
										@if(checkPerm('user_edit'))
											<a href="{{ route('users.edit', $user->id) }}"
												class="btn btn-sm btn-outline-bprimary px-1 py-0"
												title="Edit User">
												<i class="far fa-edit"></i>
											</a>
										@endif

										@if(checkPerm('user_delete'))
											<a href="{{ route('users.delete', $user->id) }}"
												class="btn btn-sm btn-outline-danger px-1 py-0"
												title="Delete User">
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
			{{-- <div class="row justify-content-center"> --}}
				{{-- {!! $users->links() !!} --}}
			{{-- </div> --}}
		</div>
	</div>

@endsection
