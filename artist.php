<?php

$time = microtime(TRUE);

require_once("API.php");
require_once("Util.php");

$tracks = API::getTrackSearch($_GET["a"]);

$lyrics = API::getTrackLyricsGet(array_map(function($track) {
	return $track["track_id"];
}, $tracks));

$words = array();
foreach ($lyrics as $lyric) {
	$counts = Util::splitWords($lyric["lyrics"]);
	foreach (array_keys($counts) as $word) {
		if (!array_key_exists($word, $words))
			$words[$word] = 0;

		$words[$word] += $counts[$word];
	}
}

arsort($words);

$time = microtime(TRUE) - $time;

?>
<!DOCTYPE html>
<html>
	<head>
		<link rel="stylesheet" href="common.css">
		<style>
main {
	text-align: center;
}

#wordcloud {
	background-color: white;
}

button.share {
	background-color: blue;
}
		</style>
	</head>
	<body>
		<main>
			<h1><?php echo $_GET["a"]; ?></h1>
			<svg id="wordcloud" width="900px" height="500px"></svg>
			<form action="artist.php">
				<div>
					<input name="a" type="search" placeholder="Enter Artist">
				</div>
				<div>
					<button>Search</button>
					<button>Merge</button>
					<button type="button" class="share">Share</button>
				</div>
			</form>
			<?php if ($_GET["debug"] === "true") echo $time . "s\n"; ?>
		</main>
		<script src="d3.min.js"></script>
		<script src="d3.layout.cloud.js"></script>
		<script>

"use strict";

const WORDS = [
<?php foreach (array_keys($words) as $word) { ?>
	{text: "<?php echo $word; ?>", count: <?php echo $words[$word]; ?>}<?php echo $word === key(array_slice($words, -1, 1, TRUE)) ? "\n" : ",\n"; ?>
<?php } ?>
];

const cloudContainer = d3.select("#wordcloud");
const cloudSize = [parseInt(cloudContainer.attr("width").slice(0, -2)), parseInt(cloudContainer.attr("height").slice(0, -2))];
const scale = d3.scaleLog().range([8, 80]).domain([WORDS[WORDS.length - 1].count, WORDS[0].count]);

d3.layout.cloud()
	.size(cloudSize)
	.words(WORDS)
	.padding(5)
	.rotate(() => 0)
	.fontSize(d => scale(d.count))
	.on("end", data => {
		cloudContainer
		.append("g")
			.attr("transform", `translate(${cloudSize[0] / 2}, ${cloudSize[1] / 2})`)
		.selectAll()
		.data(data)
		.enter()
		.append("a")
			.attr("href", d => `word.php?a=<?php echo $_GET["a"]; ?>&w=${d.text}`)
		.append("text")
			.style("font-size", d => `${d.size}px`)
			.attr("text-anchor", "middle")
			.attr("transform", d => `translate(${d.x}, ${d.y})`)
			.text(d => d.text);
	})
	.start();

		</script>
	</body>
</html>
