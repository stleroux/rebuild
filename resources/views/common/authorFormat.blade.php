{{-- Requires Model name --}}

@if (Auth::check())

	@if(setting('authorFormat') == "username")
		@if($field == 'user')
			<i class="fas fa-sm fa-link"></i>
			<a href="" data-toggle="modal" data-target="#view{{ $field }}Modal{{ $model->id }}">
				{{ $model->user->username }}
			</a>
		@elseif($field == 'modifiedBy')
			@if($model->modified_by_id)
				<i class="fas fa-sm fa-link"></i>
				<a href="" data-toggle="modal" data-target="#view{{ $field }}Modal{{ $model->id }}">
					{{ $model->modifiedBy->username }}
				</a>
			@else
				N/A
			@endif
		@elseif($field == 'lastViewedBy')
			@if($model->last_viewed_by_id)
				<i class="fas fa-sm fa-link"></i>
				<a href="" data-toggle="modal" data-target="#view{{ $field }}Modal{{ $model->id }}">
					{{ $model->lastViewedBy->username }}
				</a>
			@else
				N/A
			@endif
		@endif

	@elseif (setting('authorFormat') == "last_name, first_name")
		@if($field == 'user')
			<i class="fas fa-sm fa-link"></i>
			<a href="" data-toggle="modal" data-target="#view{{ $field }}Modal{{ $model->id }}">
				@if($model->user->first_name && $model->user->last_name)
				 	{{ $model->user->last_name }}, {{ $model->user->first_name }}
				@else
					{{ $model->user->username }}
				@endif
			</a>
		@elseif($field == 'modifiedBy')
			@if($model->modified_by_id)
				<i class="fas fa-sm fa-link"></i>
				<a href="" data-toggle="modal" data-target="#view{{ $field }}Modal{{ $model->id }}">
					@if($model->modifiedBy->first_name && $model->modifiedBy->last_name)
						{{ $model->modifiedBy->last_name }}, {{ $model->modifiedBy->first_name }}
					@else
						{{ $model->modifiedBy->username }}
					@endif
				</a>
			@else
				N/A
			@endif
		@elseif($field == 'lastViewedBy')
			@if($model->last_viewed_by_id)
				<i class="fas fa-sm fa-link"></i>
				<a href="" data-toggle="modal" data-target="#view{{ $field }}Modal{{ $model->id }}">
					{{ $model->lastViewedBy->last_name }}, {{ $model->lastViewedBy->first_name }}
					@if($model->lastViewedBy->first_name && $model->lastViewedBy->last_name)
						{{ $model->lastViewedBy->last_name }}, {{ $model->lastViewedBy->first_name }}
					@else
						{{ $model->lastViewedBy->username }}
					@endif
				</a>
			@else
				N/A
			@endif
		@endif

	@elseif (setting('authorFormat') == "first_name last_name")
		@if($field == 'user')
			<i class="fas fa-sm fa-link"></i>
			<a href="" data-toggle="modal" data-target="#view{{ $field }}Modal{{ $model->id }}">
				@if($model->user->first_name && $model->user->last_name)
					{{ $model->user->first_name }} {{ $model->user->last_name }}
				@else
					{{ $model->user->username }}
				@endif
			</a>
		@elseif($field == 'modifiedBy')
			@if($model->modified_by_id)
				<i class="fas fa-sm fa-link"></i>
				<a href="" data-toggle="modal" data-target="#view{{ $field }}Modal{{ $model->id }}">
					@if($model->modifiedBy->first_name && $model->modifiedBy->last_name)
						{{ $model->modifiedBy->first_name }} {{ $model->modifiedBy->last_name }}
					@else
						{{ $model->modifiedBy->username }}
					@endif
				</a>
			@else
				N/A
			@endif
		@elseif($field == 'lastViewedBy')
			@if($model->last_viewed_by_id)
				<i class="fas fa-sm fa-link"></i>
				<a href="" data-toggle="modal" data-target="#view{{ $field }}Modal{{ $model->id }}">
					{{ $model->lastViewedBy->first_name }} {{ $model->lastViewedBy->last_name }}</a>
			@else
				N/A
			@endif
		@endif
	@endif





@else
	{{-- Username --}}
	@if($field == 'user')
		{{ $model->user->username }}
	@elseif($field == 'modifiedBy')
		{{ $model->modifiedBy->username }}
	@elseif($field == 'lastViewedBy')
		{{ $model->lastViewedBy->username }}
	@endif
	
@endif

@include('modals.author')
