<form>
	<div class="form-group">
		<label for="title">Title:</label>
			<input class="form-control" type="text" name="title" id="title">
	</div>
	<div class="form-group">
		<label for="author">Author:</label>
		<input type="text" class="form-control" name="author" id="author">
	</div>
	<div class="form-group">
		<label for="published_at">Publish article on: </label>
		<input class="form-control" type="date" name="published_at" id="published_at">
	</div>
	<div class="form-group">
		<label for="tag">Tag(s): </label>
		 <select class="js-example-basic-multiple js-states form-control" name="tag_list[]" id="tag_list" multiple="multiple">
		 	@foreach($tags as $tag)
		 		<option value="{{ $tag->id }}">{{ $tag->name }}</option>
		 	@endforeach
		 </select>
	</div>
	<div class="form-group">
		<label for="body">Content: </label>
		<textarea name="body" id="body" class="form-control" rows=75></textarea>
	</div>
	<div class="form-group">		
		<button type="submit" class="btn btn-default">Submit Article</button>
	</div>
