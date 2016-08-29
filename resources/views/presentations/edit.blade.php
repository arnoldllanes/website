@extends('layouts.main')

@section('content')
	<h2>Edit presentation {{ $presentation->title }}</h2>

	<form action="/presentations/update" method="POST">
		{{ csrf_field() }}
		@include('presentations.edit-form')
	</form>
@endsection