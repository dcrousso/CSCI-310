<?php

require_once("API.php");

$tracks = API::getTrackSearch($_GET["a"]);

$lyrics = API::getTrackLyricsGet(array_map(function($track) {
	return $track["track_id"];
}, $tracks));

$songs = array();
for ($i = 0; $i < count($tracks); ++$i) {
	if (strpos($lyrics[$i]["lyrics"], $_GET["w"]) === FALSE)
		continue;

	array_push($songs, $tracks[$i]);
}

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
						<td><?php echo "24"; ?></td>
						<td><a href="lyrics.php?a=<?php echo $song["artist_name"]; ?>&s=<?php echo $song["track_name"]; ?>&w=<?php echo $_GET["w"]; ?>&id=<?php echo $song["track_id"]; ?>"><?php echo $song["track_name"]; ?></a></td>
						<td><?php echo $song["artist_name"]; ?></td>
					</tr>
<?php } ?>
				</tbody>
			</table>
		</main>
		<nav>
			<a href="artist.php?a=<?php echo $_GET["a"]; ?>"><button><?php echo $_GET["a"]; ?></button></a>
		</nav>
	</body>
</html>
