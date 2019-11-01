<div class="card mb-3 p-0 m-0">

	<div class="card-header block_header p-2 m-0">Tests Menu</div>

	<div class="list-group">

		<a href="{{ route('admin.tests.index') }}" class="list-group-item list-group-item-action p-1
			{{ Route::is('admin.tests.index') ? 'active' : '' }}">
			<i class="fa fa-file-text-o" aria-hidden="true"></i>
			Tests
			<div class="badge badge-secondary float-right">
				{{ App\Models\Tests\Test::published()->count() }}
			</div>
		</a>

		<a href="{{ route('admin.tests.newTests') }}" class="list-group-item list-group-item-action p-1 
			{{ Route::is('admin.tests.newTests') ? 'active' : '' }}">
			<i class="fa fa-file-text-o" aria-hidden="true"></i>
			New Tests
			<div class="badge badge-secondary float-right">
				{{ App\Models\Tests\Test::newTests()->count() }}
			</div>
		</a>

		<a href="{{ route('admin.tests.myTests') }}" class="list-group-item list-group-item-action p-1
			{{ Route::is('admin.tests.myTests') ? 'active' : '' }}">
			<i class="fa fa-file-text-o" aria-hidden="true"></i>
			Created By Me
			<div class="badge badge-secondary float-right">
				{{ App\Models\Tests\Test::myTests()->count() }}
			</div>
		</a>

		<a href="{{ route('admin.tests.unpublished') }}" class="list-group-item list-group-item-action p-1
			{{ Route::is('admin.tests.unpublished') ? 'active' : '' }}">
			<i class="fa fa-file-text-o" aria-hidden="true"></i>
			Unpublished
			<div class="badge badge-secondary float-right">
				{{ App\Models\Tests\Test::unpublished()->count() }}
			</div>
		</a>

		<a href="{{ route('admin.tests.future') }}" class="list-group-item list-group-item-action p-1
			{{ Route::is('admin.tests.future') ? 'active' : '' }}">
			<i class="fa fa-file-text-o" aria-hidden="true"></i>
			Future
			<div class="badge badge-secondary float-right">
				{{ App\Models\Tests\Test::future()->count() }}
			</div>
		</a>

		<a href="{{ route('admin.tests.trashed') }}" class="list-group-item list-group-item-action p-1
			{{ Route::is('admin.tests.trashed') ? 'active' : '' }}">
			<i class="fa fa-trash-o" aria-hidden="true"></i>
			Trashed
			<div class="badge badge-secondary float-right">
				{{ App\Models\Tests\Test::trashedCount()->count() }}
			</div>
		</a>
	</div>
</div>
