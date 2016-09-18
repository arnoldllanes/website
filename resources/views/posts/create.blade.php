@extends('layouts.app')

@section('content')

<div class="container">
    <h1 class="text-center">Create Blog Post</h1>

    <hr>

    <form action="{{ action('PostController@store') }}" method="POST">
        {{ csrf_field() }}
        @include('posts.form')
    </form>
    
    	@include('partials.modals.create-tag')
</div>    

@endsection