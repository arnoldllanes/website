<div id="rejectPost" class="modal fade" role="dialog">
        <div class="modal-dialog">
        <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times</button>
                    <h4 class="modal-title">Reason for rejecting</h4>
                </div>
                <div class="modal-body">
                <!-- Start form group directive -->
                    <form method="POST" action="{{ action('PostController@reject', ['post' => $post->id]) }}">
                    {{ csrf_field() }}
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="reason">Reason: </label>
                                    <textarea name="reason" class="form form-control" rows=5 id="reason"></textarea>
                                </div>
                                    <hr>
                                    <div class="form-group">        
                                        <button type="submit" class="btn btn-primary">Send rejection</button>
                                    </div>
                                </div>
                            </div>
                    </form>
                    <!-- End form group directive -->
                </div> 
            </div>
        </div>
    </div>  