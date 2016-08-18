<form>
	<div class="form-group">
		<label for="title">Title:</label>
			<input class="form-control" type="text" name="title" id="title" required>
	</div>
	<div class="form-group">
		<label for="presenter">Presenter:</label>
		<input type="text" class="form-control" name="presenter" id="presenter" required>
	</div>
	<div class="form-group">
		<label for="presenter_email">Presenter's email:
			<input type="email" class="form-control" name="presenter_email" id="presenter_email">
		</label>
		<label for="presenter_website">Presenter's website:
			<input type="text" class="form-control" name="presenter_website" id="presenter_website">
		</label>
	</div>
	<div class="form-group">
		<label for="published_at">Publish article on: </label>
		<input class="form-control" type="date" name="published_at" id="published_at">
	</div>
	<div class="form-group">
		<label for="tag">Tag(s): </label>
		 <select class="js-example-basic-multiple js-states form-control" name="tag_list[]" id="tag_list" multiple="multiple">
		 		<option>Create new tag ...</option>
		 	@foreach($tags as $tag)
		 		<option value="{{ $tag->id }}">{{ $tag->name }}</option>
		 	@endforeach
		 </select>
	</div>
	<div class="form-group">
		<label for="body">Content: </label>
		<textarea name="body" id="body" class="form-control" rows=15></textarea>
	</div>
	<div class="form-group">		
		<button type="submit" class="btn btn-default">Submit Article</button>
	</div>
