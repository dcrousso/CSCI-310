<?php

$time = microtime(TRUE);

require_once("API.php");
require_once("Util.php");

$a =     isset($_GET["a"])     ? $_GET["a"]     : [];
$w =     isset($_GET["w"])     ? $_GET["w"]     : "";
$debug = isset($_GET["debug"]) ? $_GET["debug"] : "";

$tracks = API::getTrackSearch($a);

$lyrics = array_map(function($artist) {
	return API::getTrackLyricsGet(array_map(function($track) {
		return $track["track_id"];
	}, $artist));
}, $tracks);

$word = strtolower($w);

$songs = array();
for ($artist = 0; $artist < count($tracks); ++$artist) {
	for ($song = 0; $song < count($tracks[$artist]); ++$song) {
		$lowercase = strtolower($lyrics[$artist][$song]["lyrics"]);
		if (strpos($lowercase, $word) === FALSE)
			continue;

		$count = preg_match_all("/\b" . $word . "\b/", $lowercase);
		if (!$count)
			continue;

		$tracks[$artist][$song]["occurrence_count"] = $count;

		array_push($songs, $tracks[$artist][$song]);
	}
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
		<title><?php echo $w; ?></title>
	</head>
	<body>
		<main>
			<h1><?php echo $w; ?></h1>
			<table>
				<tbody>
<?php foreach ($songs as $song) { ?>
					<tr>
						<td><?php echo $song["occurrence_count"]; ?></td>
						<td><a href="lyrics.php?a[]=<?php echo $song["artist_name"]; ?>&s=<?php echo $song["track_name"]; ?>&w=<?php echo $word; ?>&id=<?php echo $song["track_id"]; ?>"><?php echo $song["track_name"]; ?></a></td>
						<td><?php echo $song["artist_name"]; ?></td>
					</tr>
<?php } ?>
				</tbody>
			</table>
			<?php if ($debug === "true") echo $time . "s\n"; ?>
		</main>
		<nav>
			<a href="artist.php?<?php echo Util::generateArtistsQuery($a); ?>"><button><?php echo implode(", ", $a); ?></button></a>
		</nav>
	</body>
</html>
