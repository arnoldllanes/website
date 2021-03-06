@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="text-center">Create presentation</h1>
       
        <hr>
        @if(Auth::user()->isGuest())
        	<p class="text-center">** Your post will need to be approved by an admin before it will be listed **</p>
        @endif

        <form action="{{ action('PresentationController@store') }}" method="POST">
            {{ csrf_field() }}
            @include('presentations.form')
        </form>
        
        	@include('partials.modals.create-tag')
    </div>        

@endsection