<?php

// Lots of ternary operators to see if various fields/query parameters have been set
$q     = isset($_GET["q"])     ? $_GET["q"]     : [];
$w     = isset($_GET["w"])     ? $_GET["w"]     : [];
$n     = isset($_GET["n"])     ? $_GET["n"]     : [];

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
