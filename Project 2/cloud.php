<?php

require_once("API/ACM.php");
require_once("API/IEEE.php");
require_once("API/Util.php");

$q = isset($_GET["q"]) ? $_GET["q"] : "";
$n = isset($_GET["n"]) ? $_GET["n"] : "10";

$acm = API_ACM::query($q);
$ieee = API_IEEE::queryText($q, $n);
$words = Util::splitWords(Util::getString(array_splice($acm, 0, min(intval($n), count($acm)))) . " " . Util::getString($ieee));

?>
<!DOCTYPE html>
<html>
	<body>
		<main>
			<h1><?php echo $q ?></h1>
			<svg id="wordcloud" width="900px" height="500px"></svg>
		</main>
		<script src="d3.min.js"></script>
		<script src="d3.layout.cloud.js"></script>
		<script>
"use strict";
const WORDS = [
<?php $i = 0; foreach ($words as $word => $count) { if ($i++ < 250) { ?>
	{text: "<?php echo $word; ?>", count: <?php echo $count; ?>}<?php echo (($i === count($words) || $i === 250) ? "" : ",") . "\n"; ?>
<?php } } ?>
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
			.attr("href", d => `word.php?q=<?php echo $q; ?>&n=<?php echo $n; ?>&w=${d.text}`)
			.append("text")
				.style("font-size", d => `${d.size}px`)
				.attr("text-anchor", "middle")
				.attr("transform", d => `translate(${d.x}, ${d.y})`)
				.attr("fill", () => `hsl(${Math.floor(Math.random() * 360)}, 100%, 50%)`)
				.text(d => d.text);
})
.start();
		</script>
	</body>
</html>
