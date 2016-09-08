<!DOCTYPE html>
<html>
<head>
	<title>SDLUG</title>
</head>
<body>
	<h1>Rejected Post title: {{ $title }}</h1>
	<p>Submitted On: {{ Carbon\Carbon::parse($submitted_on)->toFormattedDateString() }} </p>
	<p>Reason: {{ $reason }}</p>
	<p>Submitted Post: {{ $body }}</p>
</body>
</html>