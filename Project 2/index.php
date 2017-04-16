<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" href="common.css">
	<style>
		body {
			text-align: center;
			margin-top: 10%;
		}

	</style>
</head>
<body>
	<main>
		<img src="Cloudify-logo-w-text.png" width=400>
		<form action="cloud.php">
		<input name="q" type="search" placeholder="Keywords, Authors, Conferences" style="width:30%;" autofocus required>
			<input name="n" type="number" min="10" placeholder="Top X Papers" required>
			<button>Search</button>
		</form>
	</main>
</body>
</html>
