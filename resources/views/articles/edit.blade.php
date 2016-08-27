@extends('layouts.main')

@section('content')
	<h2>Edit article {{ $article->title }}</h2>
	@include('articles.edit-form')
@endsection