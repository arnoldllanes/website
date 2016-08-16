<form>
	<div class="form-group">
		<label for="title">Title:</label>
			<input class="form-control" type="text" name="title" id="title">
	</div>
	<div class="form-group">
		<label for="published_at">Published article on: </label>
		<input class="form-control" type="date" name="published_at" id="published_at">
	</div>
	<div class="form-group">
		<label for="body">Content: </label>
		<textarea name="body" id="body" class="form-control"></textarea>
	</div>
	
	<div class="form-group">
		<label for="tag">Tags: </label>
		 <select class="js-example-basic-multiple js-states form-control" name="tag_list" id="tag_list" multiple="multiple">
		 	@foreach($tags as $tag)
		 		<option name="{{ $tag->name }}" id="{{ $tag->name }}">{{ $tag->name }}</option>
		 	@endforeach
		 </select>
	</div>
	<div class="form-group">		
		<button type="submit" class="btn btn-default"></button>
	</div>
