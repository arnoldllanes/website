<div id="createTag" class="modal fade" role="dialog">
        <div class="modal-dialog">
        <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times</button>
                    <h4 class="modal-title">Create New Tag</h4>
                </div>
                <div class="modal-body">
                <!-- Start form group directive -->
                    <form method="POST" action="{{ action('TagController@store') }}">
                    {{ csrf_field() }}
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name">Tag Name:</label>     
                                    <input type="text" name="name" id="name" class="form-control" required>
                                </div>
                                    <hr>
                                    <div class="form-group">        
                                        <button type="submit" class="btn btn-primary">Create Tag</button>
                                    </div>
                                </div>
                            </div>
                    </form>
                    <!-- End form group directive -->
                </div> 
            </div>
        </div>
    </div>  