<?php

$time = microtime(TRUE);

require_once("API.php");

$tracks = API::getTrackSearch($_GET["a"]);

$lyrics = API::getTrackLyricsGet(array_map(function($track) {
	return $track["track_id"];
}, $tracks));

$word = strtolower($_GET["w"]);

$songs = array();
for ($i = 0; $i < count($tracks); ++$i) {
	$lowercase = strtolower($lyrics[$i]["lyrics"]);
	if (strpos($lowercase, $word) === FALSE)
		continue;

	$count = preg_match_all("/\b" . $word . "\b/", $lowercase);
	if (!$count)
		continue;

	$tracks[$i]["occurrence_count"] = $count;

	array_push($songs, $tracks[$i]);
}

usort($songs, function($a, $b) {
	return $b["occurrence_count"] - $a["occurrence_count"];
});

$time = microtime(TRUE) - $time;

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
<?php foreach ($songs as $song) { ?>
					<tr>
						<td><?php echo $song["occurrence_count"]; ?></td>
						<td><a href="lyrics.php?a=<?php echo $song["artist_name"]; ?>&s=<?php echo $song["track_name"]; ?>&w=<?php echo $word; ?>&id=<?php echo $song["track_id"]; ?>"><?php echo $song["track_name"]; ?></a></td>
						<td><?php echo $song["artist_name"]; ?></td>
					</tr>
<?php } ?>
				</tbody>
			</table>
			<?php if ($_GET["debug"] === "true") echo $time . "s\n"; ?>
		</main>
		<nav>
			<a href="artist.php?a=<?php echo $_GET["a"]; ?>"><button><?php echo $_GET["a"]; ?></button></a>
		</nav>
	</body>
</html>
