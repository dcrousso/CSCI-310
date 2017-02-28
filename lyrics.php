<?php

$time = microtime(TRUE);

require_once("API.php");
require_once("Util.php");

$artistsQuery = Util::generateArtistsQuery($_GET["a"]);
$artistsString = implode(", ", $_GET["a"]);

$data = API::getTrackLyricsGet([$_GET["id"]])[0];
$lyrics = str_replace("\n", "<br>", $data["lyrics"]);
$lyrics = preg_replace("/\b(" . $_GET["w"] . ")\b/i", "<mark>$1</mark>", $lyrics); 

$time = microtime(TRUE) - $time;

?>
<!DOCTYPE html>
<html>
	<head>
		<link rel="stylesheet" href="common.css">
		<title><?php echo $_GET["s"]; ?></title>
	</head>
	<body>
		<main>
			<h1><?php echo $_GET["s"]; ?></h1>
			<h2>by <?php echo $artistsString; ?></h2>
			<p>
<?php echo $lyrics; ?>
			</p>
			<?php if ($_GET["debug"] === "true") echo $time . "s\n"; ?>
		</main>
		<nav>
			<a href="artist.php?<?php echo $artistsQuery; ?>"><button><?php echo $artistsString; ?></button></a>
			<a href="word.php?<?php echo $artistsQuery; ?>&w=<?php echo $_GET["w"]; ?>"><button><?php echo $_GET["w"]; ?></button></a>
		</nav>
		<script src="<?php echo $data["script_tracking_url"]; ?>"></script>
	</body>
</html>
