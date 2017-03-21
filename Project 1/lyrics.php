<?php

$time = microtime(TRUE);

require_once("API.php");
require_once("Util.php");

// Lots of ternary operators to see if various fields/query parameters have been set
$a     = isset($_GET["a"])     ? $_GET["a"]     : [];
$s     = isset($_GET["s"])     ? $_GET["s"]     : "";
$w     = isset($_GET["w"])     ? $_GET["w"]     : "";
$id    = isset($_GET["id"])    ? $_GET["id"]    : "";
$debug = isset($_GET["debug"]) ? $_GET["debug"] : "";

// implode search queries together
$artistsQuery = Util::generateArtistsQuery($a);
$artistsString = implode(", ", $a);

// obtain lyrics from aritsts via API.php function calls
$data = API::getTrackLyricsGet([$id])[0];
$lyrics = str_replace("\n", "<br>", $data["lyrics"]);
$lyrics = preg_replace("/\b(" . $w . ")\b/i", "<mark id=\"occurrence\">$1</mark>", $lyrics); 

$time = microtime(TRUE) - $time;

?>
<!DOCTYPE html>
<html>
	<head>
		<link rel="stylesheet" href="common.css">
		<title><?php echo $s; ?></title>
	</head>
	<body>
		<main>
			<h1><?php echo $s; ?></h1>
			<h2>by <?php echo $artistsString; ?></h2>
			<p id="lyrics">
<?php echo $lyrics; ?>
			</p>
			<?php if ($debug === "true") echo $time . "s\n"; ?>
		</main>
		<nav>
			<a id="artist" href="artist.php?<?php echo $artistsQuery; ?>"><button><?php echo $artistsString; ?></button></a>
			<a id="keyword" href="word.php?<?php echo $artistsQuery; ?>&w=<?php echo $w; ?>"><button><?php echo $w; ?></button></a>
		</nav>
		<script src="<?php echo $data["script_tracking_url"]; ?>"></script>
	</body>
</html>
