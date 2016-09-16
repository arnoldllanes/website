@extends('layouts.main')

@section('content')

    <h1 class="text-center">Create Blog Post</h1>

    <hr>

    <form action="{{ action('PostController@store') }}" method="POST">
        {{ csrf_field() }}
        @include('posts.form')
    </form>
    
    	@include('partials.modals.create-tag')
        

@endsection