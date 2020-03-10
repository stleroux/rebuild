@auth
	<div class="card mb-2">
		<div class="card-header block_header p-2">
			<i class="{{ Config::get('buttons.movies') }}"></i>
			Search
		</div>
		<div class="card-body pb-2 p-0 m-0">

			<form action="{{ route('movies.search') }}" method="get">
				<div class="container-fluid pt-2 pb-0">

					<div class="form-group row">
						<div class="col px-2">
							<input type="text" name="title" id="title" class="form-control form-control-sm" placeholder="Title" />
							<div class="pl-1 bg-danger">{{ $errors->first('title') }}</div>
						</div>
					</div>

					<div class="form-group row">
						<label for="overview" class="col-sm-10 col-form-label col-form-label-sm">Also search in Overview :</label>
						<input type="checkbox" name="overview" id="overview" value="overview" />
					</div>

					<div class="form-row">
						<button type="submit" class="col btn btn-sm btn-primary">Search</button>
						<a href="{{ route('movies.index') }}" class="btn btn-sm btn-secondary">Reset Search</a>
					</div>

				</div>
			</form>

		</div>
	</div>

@endauth
