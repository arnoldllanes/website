@extends('layouts.main')

@section('content')
	<h1>Create blog post</h1>

	<hr>
	<form action="{{ action('ArticleController@store') }}" method="POST">
		{{ csrf_field() }}
		@include('articles.form')
	</form>

@endsection