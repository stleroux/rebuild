{{-- Requires Model name --}}

@if (Auth::check())

	@if(setting('authorFormat') == "username")
		@if($field == 'user')
			<a href="" data-toggle="modal" data-target="#view{{ $field }}Modal{{ $model->id }}">
				{{ $model->user->username }}
			</a>
		@elseif($field == 'modifiedBy')
			@if($model->modified_by_id)
				<a href="" data-toggle="modal" data-target="#view{{ $field }}Modal{{ $model->id }}">
					{{ $model->modifiedBy->username }}
				</a>
			@else
				N/A
			@endif
		@elseif($field == 'lastViewedBy')
			@if($model->last_viewed_by_id)
				<a href="" data-toggle="modal" data-target="#view{{ $field }}Modal{{ $model->id }}">
					{{ $model->lastViewedBy->username }}
				</a>
			@else
				N/A
			@endif
		@endif


	
	@elseif (setting('authorFormat') == "last_name, first_name")
		@if($field == 'user')
			<a href="" data-toggle="modal" data-target="#view{{ $field }}Modal{{ $model->id }}">
				{{ $model->user->profile->last_name }}, {{ $model->user->profile->first_name }}
			</a>
		@elseif($field == 'modifiedBy')
			@if($model->modified_by_id)
				<a href="" data-toggle="modal" data-target="#view{{ $field }}Modal{{ $model->id }}">
					{{ $model->modifiedBy->profile->last_name }}, {{ $model->modifiedBy->profile->first_name }}
				</a>
			@else
				N/A
			@endif
		@elseif($field == 'lastViewedBy')
			@if($model->last_viewed_by_id)
				<a href="" data-toggle="modal" data-target="#view{{ $field }}Modal{{ $model->id }}">
					{{ $model->lastViewedBy->profile->last_name }}, {{ $model->lastViewedBy->profile->first_name }}
				</a>
			@else
				N/A
			@endif
		@endif
	




	@elseif (setting('authorFormat') == "first_name last_name")
		@if($field == 'user')
			<a href="" data-toggle="modal" data-target="#view{{ $field }}Modal{{ $model->id }}">
				{{ $model->user->profile->first_name }} {{ $model->user->profile->last_name }}
			</a>
		@elseif($field == 'modifiedBy')
			@if($model->modified_by_id)
				<a href="" data-toggle="modal" data-target="#view{{ $field }}Modal{{ $model->id }}">
					{{ $model->modifiedBy->profile->first_name }} {{ $model->modifiedBy->profile->last_name }}
				</a>
			@else
				N/A
			@endif
		@elseif($field == 'lastViewedBy')
			@if($model->last_viewed_by_id)
				<a href="" data-toggle="modal" data-target="#view{{ $field }}Modal{{ $model->id }}">
					{{ $model->lastViewedBy->profile->first_name }} {{ $model->lastViewedBy->profile->last_name }}
				</a>
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
