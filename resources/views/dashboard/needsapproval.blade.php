@extends('layouts.app')

@section('content')
    <div class="container">

    <h2 class="text-center">Hello, {{ Auth::user()->name }} </h2>
        @include('dashboard.partials.navigation')

    <h2 class="text-center">Articles that need approval</h2>
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        {{ !Auth::user()->isAdmin() ? 'Your presentations' : 'Presentations needing approval' }}
                    </div>
                    <!-- /.panel-heading -->
                    <div class="panel-body">
                        <div class="dataTable_wrapper">
                            <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                                <thead>
                                    <tr>
                                        <th>Title</th>
                                        <th>Presenter</th>
                                        <th>Post Date</th>
                                        <th># of comments</th>
                                        <th>Approved</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($presentationApprovals as $approval)
                                    <tr class="odd gradeX">
                                        <td><a href="presentations/{{ $approval->id }}">{{ $approval->title }}</a></td>
                                        <td><a href="presenters/{{ $approval->presenter->id }}">{{ $approval->presenter->name }}</a></td>
                                        <td>{{ Carbon\Carbon::parse($approval->created_at)->diffForHumans() }}</td>
                                        <td class="center">{{ $approval->comments()->count() }}</td>
                                        <td class="center">{{ $approval->approved == 0 ? 'No' : 'Yes' }}</td>
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

        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        {{ !Auth::user()->isAdmin() ? 'Your blog posts' : 'Blogs needing approval' }}
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
                                @foreach($blogApprovals as $approval)
                                    <tr class="odd gradeX">
                                        <td><a href="posts/{{ $approval->id }}">{{ $approval->title }}</a></td>
                                        <td><a href="">{{ $approval->owner->name }}</a></td>
                                        <td>{{ Carbon\Carbon::parse($approval->created_at)->diffForHumans() }}</td>
                                        <td class="center"></td>
                                        <td class="center">{{ $approval->approved == 0 ? 'No' : 'Yes' }}</td>
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
