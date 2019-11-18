@extends('layouts.master')

@section('stylesheets')
   {{ Html::style('/css/woodbarn.css') }}
@endsection

@section('left_column')
   {{-- @include('blocks.main_menu') --}}
@endsection

@section('right_column')
	{{-- @include('admin.users.blocks.totalPermissions') --}}
	{{-- @include('admin.users.blocks.mostLogins') --}}
	{{-- @include('admin.users.blocks.mostAssignedPermissions') --}}
@endsection

@section('content')

	<div class="row">
		<div class="col">
			<div class="card mb-3">
				<!--CARD HEADER-->
				<div class="card-header section_header p-2">
					<i class="fas fa-users"></i>
					Users
					<span class="float-sm-right">
						<div class="btn-group">
							@include('admin.users.buttons.add', ['size'=>'xs'])
						</div>
					</span>
				</div>
				
				<!--CARD BODY-->
				<div class="card-body section_body p-2">
					<table id="datatable" class="table table-hover table-sm">
						<thead>
							<tr>
								<th>ID</th>
								<th>Username</th>
								<th>Email</th>
								<th>Permissions</th>
								<th>Logins</th>
								<th>Last Login</th>
								<th>Created</th>
								<th class="no-sort"></th>
							</tr>
						</thead>
						<tbody>
							@foreach ($users as $user)
								<tr>
									<td>{{ $user->id }}</td>
									<td><a href="{{ route('admin.users.show', $user->id) }}">{{ $user->username }}</a>
										@if(
												$user->username === Setting('admin_user_account') ||
												$user->username === 'lerouxs' ||
												$user->username === 'administrator'
											)
											<small>(Super Admin)</small>
										@endif
									</td>
									<td>{{ $user->email }}</td>
									<td>{{ $user->permissions->count() }}</td>
									<td>{{ $user->login_count }}</td>
									<td>{{ $user->last_login_date }}</td>
									<td>{{ $user->created_at }}</td>
									<td class="text-right">
										<div class="btn-group">
											@if(checkPerm('user_show'))
												@include('admin.users.buttons.show', ['size'=>'xs'])
											@endif

											@if(checkPerm('change_user_pwd'))
												<a href="{{ route('admin.users.changePassword.edit', $user->id) }}"
													class="btn btn-xs btn-secondary text-light"
													title="Reset User's Password">
													<i class="fas fa-unlock-alt"></i>
												</a>
											@endif
											
											@include('admin.users.buttons.edit', ['size'=>'xs'])
											@include('admin.users.buttons.delete', ['size'=>'xs'])
										</div>
									</td>
								</tr>
							@endforeach
						</tbody>
					</table>
				</div> {{-- End of card-body --}}
				<div class="card-footer p-1">
					<b>Note : </b> Super Admin users do not require any access permissions as they have GOD like powers on the site.
				</div>
			</div>
			
			{{-- <div class="row justify-content-center"> --}}
				{{-- {!! $users->links() !!} --}}
			{{-- </div> --}}
		</div>
	</div>

@endsection

@section('scripts')

@endsection