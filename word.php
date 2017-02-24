<?php

require_once("API.php");

?>
<!DOCTYPE html>
<html>
	<head>
		<link rel="stylesheet" href="common.css">
		<title><?php echo $_GET["w"]; ?></title>
	</head>
	<body>
		<main>
			<h1><?php echo $_GET["w"]; ?></h1>
			<table>
				<tbody>
					<tr>
						<td>24</td>
						<td><a href="lyrics.php?a=<?php echo $_GET["a"]; ?>&s=Harder%2C%20Better%2C%20Faster%2C%20Stronger&w=<?php echo $_GET["w"]; ?>">Harder, Better, Faster, Stronger</a></td>
						<td><?php echo $_GET["a"]; ?></td>
					</tr>
					<tr>
						<td>8</td>
						<td><a href="lyrics.php?a=<?php echo $_GET["a"]; ?>&s=Technologic&w=<?php echo $_GET["w"]; ?>">Technologic</a></td>
						<td><?php echo $_GET["a"]; ?></td>
					</tr>
				</tbody>
			</table>
		</main>
		<nav>
			<a href="artist.php?a=<?php echo $_GET["a"]; ?>"><button><?php echo $_GET["a"]; ?></button></a>
		</nav>
	</body>
</html>
