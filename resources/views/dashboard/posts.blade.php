@extends('layouts.app')

@section('content')
    <div class="container">

    <h2 class="text-center">Hello, {{ Auth::user()->name }} </h2>
        @include('dashboard.partials.navigation')

    <h2 class="text-center">Blog list</h2>
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        {{ !Auth::user()->isAdmin() ? 'Your blogs' : 'List of all blog posts' }}
                    </div>
                    <!-- /.panel-heading -->
                    <div class="panel-body">
                        <div class="dataTable_wrapper">
                            <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                                <thead>
                                    <tr>
                                        <th>Title</th>
                                        <th>Blogger</th>
                                        <th>Post Date</th>
                                        <th># of comments</th>
                                        <th>Approved</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($posts as $post)
                                    <tr class="odd gradeX">
                                        <td><a href="/posts/{{ $post->id }}">{{ $post->title }}</a></td>
                                        <td><a href="">{{ $post->owner->name }}</a></td>
                                        <td>{{ Carbon\Carbon::parse($post->created_at)->diffForHumans() }}</td>
                                        <td class="center"></td>
                                        <td class="center">{{ $post->approved == 0 ? 'No' : 'Yes' }}</td>
                                    </tr>
                                @endforeach
                                    
                                </tbody>
                            </table>
                        </div>
                        
                    </div>
                    <!-- /.panel-body -->
                </div>
                <!-- /.panel -->
            </div>
            <!-- /.col-lg-12 -->
        </div>
            <!-- /.row -->
    </div>
@endsection
