@extends('layouts.master')

@section('stylesheets')
   {{ Html::style('/css/woodbarn.css') }}
@endsection

@section('left_column')
   @include('blocks.main_menu')
@endsection

@section('right_column')
	@include('users.blocks.mostPermissions')
	@include('users.blocks.mostLogins')
	@include('users.blocks.mostAssignedPermissions')
@endsection

@section('content')

	<div class="row">
		<div class="col">
			<div class="card">
				<!--CARD HEADER-->
				<div class="card-header section_header p-2">
					<i class="fas fa-users"></i>
					Users
					<span class="float-sm-right">
						<div class="btn-group">
							@include('users.buttons.add', ['size'=>'xs'])
						</div>
					</span>
				</div>
				
				<!--CARD BODY-->
				<div class="card-body section_body p-2">
					<table id="datatable" class="table table-hover table-sm">
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
										<div class="btn-group">
											@if(checkPerm('user_show'))
												@include('users.buttons.show', ['size'=>'xs'])
											@endif

											@if(checkPerm('change_user_pwd'))
												<a href="{{ route('changePassword.edit', $user->id) }}"
													class="btn btn-xs btn-secondary text-light"
													title="Reset User's Password">
													<i class="fas fa-unlock-alt"></i>
												</a>
											@endif
											
											@if(checkPerm('user_edit'))
												@include('users.buttons.edit', ['size'=>'xs'])
											@endif

											@if(checkPerm('user_delete'))
												@include('users.buttons.delete', ['size'=>'xs'])
											@endif
										</div>
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