<?php

require_once("API/ACM.php");
require_once("API/IEEE.php");
require_once("API/Util.php");

$q = isset($_GET["q"]) ? urldecode($_GET["q"]) : "";
$n = isset($_GET["n"]) ? $_GET["n"]            : "10";
$w = isset($_GET["w"]) ? $_GET["w"]            : "";

$acm = API_ACM::query($q);
$ieee = API_IEEE::queryText($q, $n);

?>
<!DOCTYPE html>
<html>
	<head>
		<link rel="stylesheet" href="common.css">
		<style>
		</style>
	</head>
	<body>
		<nav>
			<a href="cloud.php?q=<?php echo $q; ?>&n=<?php echo $n; ?>"><button><?php echo $q; ?></button></a>
		</nav>
		<main>
			<h1><?php echo $w ?></h1>
			<progress max="100" value="0"></progress>
		</main>
		<script>
"use strict";

const main = document.querySelector("main");
const progress = document.querySelector("progress");

const ACM  = <?php echo json_encode(array_splice($acm, 0, min(intval($n), count($acm))), JSON_PRETTY_PRINT); ?>;
const IEEE = <?php echo json_encode($ieee, JSON_PRETTY_PRINT); ?>;

let requestWords = item => {
	return fetch(`API/Util.php?pdf=${encodeURIComponent(item["pdf"])}`)
	.then(response => {
		progress.setAttribute("value", parseInt(progress.getAttribute("value")) + (100 / (ACM.length + IEEE.length)));

		return response.text()
		.then(text => {
			if (!response.ok)
				return;

			let json = null;
			try {
				json = JSON.parse(text);
			} catch (e) {}
			if (!json || !("<?php echo $w; ?>" in json))
				return;

			let section = main.appendChild(document.createElement("section"));

			section.appendChild(document.createElement("h2")).textContent = item["title"];

			section.appendChild(document.createElement("h3")).textContent = item["authors"].join(", ");

			section.appendChild(document.createElement("h4")).textContent = item["conference"];

			section.appendChild(document.createElement("p")).textContent = item["abstract"];

			let nav = section.appendChild(document.createElement("nav"));

			let download = nav.appendChild(document.createElement("a"));
			download.setAttribute("href", item["pdf"]);
			download.textContent = "Download";

			let search = nav.appendChild(document.createElement("a"));
			search.setAttribute("href", `cloud.php?q=${encodeURIComponent(item["conference"])}&n=<?php echo $n; ?>`);
			search.setAttribute("target", "_blank");
			search.textContent = "Search";
		});
	});
};
Promise.all([].concat(ACM.map(requestWords), IEEE.forEach(requestWords)))
.then(results => {
	progress.remove();
});
		</script>
	</body>
</html>
