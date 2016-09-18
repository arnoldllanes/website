    <div class="form-group">
        <label for="title">Title:</label>
        <input class="form-control" type="text" name="title" id="title" required>
    </div>
    <div class="form-group">
        <label for="published_at">Publish presentation on: </label>
        <input class="form-control" type="date" name="published_at" id="published_at">
    </div>
    <div class="form-group">
        <label for="tag">Tag(s): </label>
        <select class="js-example-basic-multiple js-states form-control" name="tag_list[]" id="tag_list" multiple="multiple">
            @foreach($tags as $tag)
                <option value="{{ $tag->id }}">{{ $tag->name }}</option>
            @endforeach
        </select>
            <p style="display: inline-block">Your tag not included?</p>

            <a type="button" class="btn btn-primary" data-toggle="modal" data-target="#createTag">Create Tag</a>
    </div>            
    <div class="form-group">
        <label for="body">Content: </label>
        <textarea name="body" id="body" class="form-control" rows=15></textarea>
    </div>
    <div class="form-group">
        <button type="submit" class="btn btn-default">Submit Blog</button>
    </div>