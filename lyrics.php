<?php

$time = microtime(TRUE);

require_once("API.php");

$data = API::getTrackLyricsGet([$_GET["id"]])[0];
$lyrics = str_replace("\n", "<br>", $data["lyrics"]);
$lyrics = preg_replace("/\b(" . $_GET["w"] . ")\b/i", "<mark>$1</mark>", $lyrics); 

$time = microtime(TRUE) - $time;

?>
<!DOCTYPE html>
<html>
	<head>
		<link rel="stylesheet" href="common.css">
		<title>by <?php echo $_GET["s"]; ?></title>
	</head>
	<body>
		<main>
			<h1><?php echo $_GET["s"]; ?></h1>
			<h2><?php echo $_GET["a"]; ?></h2>
			<p>
<?php echo $lyrics; ?>
			</p>
			<?php if ($_GET["debug"] === "true") echo $time . "s\n"; ?>
		</main>
		<nav>
			<a href="artist.php?a=<?php echo $_GET["a"]; ?>"><button><?php echo $_GET["a"]; ?></button></a>
			<a href="word.php?a=<?php echo $_GET["a"]; ?>&w=<?php echo $_GET["w"]; ?>"><button><?php echo $_GET["w"]; ?></button></a>
		</nav>
		<script src="<?php echo $data["script_tracking_url"]; ?>"></script>
	</body>
</html>
