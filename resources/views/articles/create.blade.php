@extends('layouts.main')

@section('content')
	<h1>Create blog post</h1>

	<hr>
	<form>
		@include('articles.form')
	</form>

@endsection