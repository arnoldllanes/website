@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Dashboard</div>

                    <div class="panel-body">
                        <h2><a href="/presentations/create">Post a Presentation</a></h2>
                    </div>
                    @if(Auth::user()->isAdmin())
                        @foreach($toApprove as $presentation)
                            <p>{{ $presentation->title }}</p>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
