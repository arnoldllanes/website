@extends('layouts.main')

@section('content')
	<h2>Edit presentation {{ $post->title }}</h2>

	<form action="{{ action('PostController@update', ['post' => $post->id]) }}" method="POST">
		{{ csrf_field() }}
		{{ method_field('PATCH') }}
		@include('posts.edit-form')
	</form>

		@include('partials.modals.create-tag')

@endsection