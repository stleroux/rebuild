{{--
	Requires Model and Field values
	
	Check the value of the logged in user's dateFormat preference
	If a value is present in the date field($field) of the table($model), then format the date
	Otherwise, display "N/A"
--}}

@if (Auth::check())
	{{ ($model->$field) ? date(setting('dateFormat'), strtotime($model->$field)) : 'N/A' }}
@else
	{{-- Jan 1, 2017 --}}
	{{ ($model->$field) ? date('M j, Y', strtotime($model->$field)) : 'N/A' }}
@endif