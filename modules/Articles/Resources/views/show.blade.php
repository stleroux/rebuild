@extends('articles::layouts.master')

@section('content')
    <h1>Show</h1>

    <p>
        This view is loaded from module: {!! config('articles.name') !!}
    </p>
@stop
