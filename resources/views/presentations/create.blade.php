@extends('layouts.main')

@section('content')
    <h1>Create blog post</h1>

    <hr>
    <form action="{{ action('PresentationController@store') }}" method="POST">
        {{ csrf_field() }}
        @include('presentations.form')
    </form>
    
    	@include('partials.modals.create-tag')

@endsection