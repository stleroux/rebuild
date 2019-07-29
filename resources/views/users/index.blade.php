@extends('layouts.backend')

@section('stylesheets')
   {{ Html::style('/css/woodbarn.css') }}
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
				<!--CARD HEADER-->
				<div class="card-header section_header p-1 m-0">
					<span class="h5 align-middle pt-2">
						<i class="fas fa-users"></i>
						Users
					</span>
					<span class="float-sm-right">
						@if(checkPerm('user_create'))
							@include('users.addins.add')
						@endif
					</span>
				</div>
				
				<!--CARD BODY-->
				<div class="card-body section_body">
					<table id="datatable" class="table table-hover table-sm text-dark">
						<thead>
							<tr>
								<th>No</th>
								<th>Username</th>
								<th>Email</th>
								<th>Permissions</th>
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
									<td>{{ $user->permissions->count() }}</td>
									<td>{{ $user->created_at->format('M d, Y') }}</td>
									<td class="text-right">
										@if(checkPerm('user_show'))
											@include('users.addins.show')
										@endif

										@if(checkPerm('change_user_pwd'))
											<a href="{{ route('users.changeUserPWD', $user->id) }}"
												class="btn btn-sm btn-secondary"
												title="Reset User's Password">
												<i class="fas fa-unlock-alt"></i>
											</a>
										@endif
										
										@if(checkPerm('user_edit'))
											@include('users.addins.edit')
										@endif

										@if(checkPerm('user_delete'))
											@include('users.addins.delete')
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

@section('scripts')

@endsection