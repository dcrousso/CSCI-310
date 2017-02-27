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
						<td><a href="lyrics.php?a=<?php echo $_GET["a"]; ?>&s=<?php echo "Harder Better Faster Stronger"; ?>&w=<?php echo $_GET["w"]; ?>&id=<?php echo "84534570"; ?>">Harder Better Faster Stronger</a></td>
						<td><?php echo $_GET["a"]; ?></td>
					</tr>
					<tr>
						<td>8</td>
						<td><a href="lyrics.php?a=<?php echo $_GET["a"]; ?>&s=<?php "Technologic"; ?>&w=<?php echo $_GET["w"]; ?>&id=<?php echo "30604858"; ?>">Technologic</a></td>
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
