<?php

require_once("API/ACM.php");
require_once("API/IEEE.php");
require_once("API/Util.php");

$q = isset($_GET["q"]) ? urldecode($_GET["q"]) : "";
$n = isset($_GET["n"]) ? $_GET["n"]            : "10";
$s = isset($_GET["s"]) ? true                  : false;

$acm = API_ACM::query($q);
$ieee = API_IEEE::queryText($q, $n);

?>
<!DOCTYPE html>
<html>
	<head>
		<link rel="stylesheet" href="common.css">
		<style>
#wordcloud {
	display: block;
	margin: 0 auto;
}
		</style>
	</head>
	<body>
		<main>
			<h1><?php echo $q ?></h1>
			<progress id="progress" max="100" value="0"></progress>
			<svg id="wordcloud" width="900px" height="500px"></svg>
			<a class="download png" href="" download="<?php echo $q; ?>.png"><button id="download">Download</button></a>
		</main>
		<script src="d3.min.js"></script>
		<script src="d3.layout.cloud.js"></script>
		<script>
"use strict";

const progress    = document.querySelector("progress");
const downloadPNG = document.querySelector(".download.png");

const ACM  = <?php echo json_encode(array_splice($acm, 0, min(intval($n), count($acm))), JSON_PRETTY_PRINT); ?>;
const IEEE = <?php echo json_encode($ieee, JSON_PRETTY_PRINT); ?>;

<?php if ($s) { ?>
const selected = localStorage.getItem("<?php echo $q; ?>");
<?php } ?>

let requestWords = item => {
<?php if ($s) { ?>
	if (selected && !JSON.parse(selected).includes(item["title"]))
		return Promise.resolve({});
<?php } ?>

	return fetch(`API/Util.php?pdf=${encodeURIComponent(item["pdf"])}`)
	.then(response => {
		progress.setAttribute("value", parseInt(progress.getAttribute("value")) + (100 / (ACM.length + IEEE.length)));

		return response.text()
		.then(text => {
			if (response.ok) {
				try {
					return JSON.parse(text);
				} catch (e) {}
			}

			return {};
		});
	});
};
Promise.all([].concat(ACM.map(requestWords), IEEE.map(requestWords)))
.then(results => {
	progress.remove();

	let totals = new Map;
	results.forEach(result => {
		for (let word in result) {
			if (!totals.has(word))
				totals.set(word, 0);

			totals.set(word, totals.get(word) + result[word]);
		}
	});

	let words = Array.from(totals).map(item => { return {text: item[0], count: item[1]}; }).sort((a, b) => b.count - a.count).slice(0, 250);

	const cloudContainer = d3.select("#wordcloud");
	const cloudSize = [parseInt(cloudContainer.attr("width").slice(0, -2)), parseInt(cloudContainer.attr("height").slice(0, -2))];
	const scale = d3.scaleLog().range([8, 80]).domain([words[words.length - 1].count, words[0].count]);

	d3.layout.cloud()
	.size(cloudSize)
	.words(words)
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
				.attr("id", "wordcloud-link")
				.append("text")
					.style("font-size", d => `${d.size}px`)
					.attr("text-anchor", "middle")
					.attr("transform", d => `translate(${d.x}, ${d.y})`)
					.attr("fill", () => `hsl(${Math.floor(Math.random() * 360)}, 100%, 50%)`)
					.text(d => d.text);

		let image = new Image(cloudSize[0], cloudSize[1]);
		image.addEventListener("load", event => {
			let canvas = document.createElement("canvas");
			canvas.setAttribute("width", cloudSize[0]);
			canvas.setAttribute("height", cloudSize[1]);

			let context = canvas.getContext("2d");

			context.fillStyle = "white";
			context.fillRect(0, 0, cloudSize[0], cloudSize[1]);

			context.drawImage(image, 0, 0);

			canvas.toBlob(blob => {
				downloadPNG.setAttribute("href", URL.createObjectURL(blob));

				URL.revokeObjectURL(image.getAttribute("src"));
			});
		});
		image.setAttribute("src", URL.createObjectURL(new Blob([(new XMLSerializer).serializeToString(cloudContainer.node())], {type: "image/svg+xml;charset=utf-8"})));
	})
	.start();
});
		</script>
	</body>
</html>
