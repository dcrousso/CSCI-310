<?php

require_once("API.php");

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
			<svg id="wordcloud" width="500px" height="500px"></svg>
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

var STRING = "Work it.\nMake it\nDo it\nMake us\nHarder\nBetter\nFaster\nStronger\nMore than\nHour\nOur\nNever\nEver\nAfter\nWork is\nOver\nWork it\nMake it\nDo it\nMake us\nHarder\nBetter\nFaster\nStronger\nWork it harder\nMake it better\nDo it faster\nMakes us stronger\nMore than ever\nHour after\nOur work is\nNever over\nWork it harder\nMake it better\nDo it faster\nMakes us stronger\nWork it harder\nMake it better\nDo it faster\nMakes us stronger\nWork it harder\nMake it better\nDo it faster\nMakes us stronger\nWork it harder\nMake it better\nDo it faster\nMakes us stronger\nWork it harder\nMake it better\nDo it faster\nMakes us stronger\nWork it harder\nMake it better\nDo it faster\nMakes us stronger\nWork it harder make it\nDo it faster makes us\nMore than ever hour\nOur work is\nWork it harder make it\nDo it faster makes us\nMore than ever hour\nOur work is never over\nWork it harder\nMake it better\nDo it faster\nMakes us stronger\nWork it harder make it\nDo it faster makes us\nMore than ever hour\nOur work is\nWork it harder make it\nDo it faster makes us\nMore than ever hour\nOur work is never over\nWork it harder\nMake it better\nDo it faster\nMakes us stronger\nWork it harder\nDo it faster\nMore than ever\nOur work is never over\nWork it harder\nMake it better\nDo it faster\nMakes us stronger";

var WORDS = [
	{text: "after", count: 2},
	{text: "better", count: 12},
	{text: "do", count: 17},
	{text: "ever", count: 7},
	{text: "faster", count: 17},
	{text: "harder", count: 17},
	{text: "hour", count: 6},
	{text: "is", count: 57},
	{text: "make", count: 18},
	{text: "makes", count: 14},
	{text: "more", count: 7},
	{text: "never", count: 5},
	{text: "our", count: 7},
	{text: "over", count: 5},
	{text: "stronger", count: 12},
	{text: "than", count: 7},
	{text: "us", count: 16},
	{text: "work", count: 24},
];

var cloudContainer = d3.select("#wordcloud");
var cloudSize = [parseInt(cloudContainer.attr("width").slice(0, -2)), parseInt(cloudContainer.attr("height").slice(0, -2))];

d3.layout.cloud()
	.size(cloudSize)
	.words(WORDS)
	.padding(5)
	.rotate((function() { return 0; }))
	.fontSize(function(d) { return 8 + (d.count * 2); })
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
