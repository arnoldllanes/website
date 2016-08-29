@extends('layouts.main')

@section('content')
	<h2>Edit presentation {{ $presentation->title }}</h2>
	@include('presentations.edit-form')
@endsection