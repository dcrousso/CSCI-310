<!DOCTYPE html>
<html>
	<head>
		<link rel="stylesheet" href="common.css">
		<style>
body {
	margin-top: 10%;
}
    </style>

    <!-- Forgive me father for I have sinned -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha256-k2WSCIexGzOj3Euiig+TlR8gA0EmPjuc79OEeY5L45g=" crossorigin="anonymous"></script>
	</head>
	<body>
		<main>
			<img src="Cloudify-logo-w-text.png" width=400>
			<form action="cloud.php">
				<input id="searchbar" name="q" type="search" placeholder="Search" autofocus required>
				<input name="n" type="number" placeholder="Count" min="10" value="10" required>
				<button id="search">Search</button>
			</form>
		</main>
	</body>
</html>
