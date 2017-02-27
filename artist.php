<?php

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
					<input type="search" placeholder="Enter Artist">
				</div>
				<div>
					<button>Search</button>
					<button>Merge</button>
					<button type="button" class="share">Share</button>
				</div>
			</form>
		</main>
		<script src="d3.min.js"></script>
		<script src="d3.layout.cloud.js"></script>
		<script>

"use strict";

var WORDS = [
<?php foreach (array_keys($words) as $word) { ?>
	{text: "<?php echo $word; ?>", count: <?php echo $words[$word]; ?>}<?php echo $word === key(array_slice($words, -1, 1, TRUE)) ? "\n" : ",\n"; ?>
<?php } ?>
];

var cloudContainer = d3.select("#wordcloud");
var cloudSize = [parseInt(cloudContainer.attr("width").slice(0, -2)), parseInt(cloudContainer.attr("height").slice(0, -2))];
var scale = d3.scaleLog().range([8, 80]).domain([WORDS[WORDS.length - 1].count, WORDS[0].count]);

d3.layout.cloud()
	.size(cloudSize)
	.words(WORDS)
	.padding(5)
	.rotate((function() { return 0; }))
	.fontSize(function(d) { return scale(d.count); })
	.on("end", function(data) {
		cloudContainer
		.append("g")
			.attr("transform", "translate(" + cloudSize[0] / 2 + "," + cloudSize[1] / 2 + ")")
		.selectAll()
		.data(data)
		.enter()
		.append("a")
			.attr("href", function(d) { return "word.php?a=<?php echo $_GET["a"]; ?>&w=" + d.text; })
		.append("text")
			.style("font-size", function(d) { return d.size + "px"; })
			.attr("text-anchor", "middle")
			.attr("transform", function(d) { return "translate(" + [d.x, d.y] + ")"; })
			.text(function(d) { return d.text; });
	})
	.start();

		</script>
	</body>
</html>
