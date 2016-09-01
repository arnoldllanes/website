@extends('layouts.main')

@section('content')
	<h2>Edit presentation {{ $presentation->title }}</h2>

	<form action="{{ action('PresentationController@update', ['presentation' => $presentation->id]) }}" method="POST">
		{{ csrf_field() }}
		{{ method_field('PATCH') }}
		@include('presentations.edit-form')
	</form>

		@include('partials.modals.create-tag')

@endsection