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
			<h1><?php echo $w; ?></h1>
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

			let details = section.appendChild(document.createElement("details"));

			details.appendChild(document.createElement("summary")).textContent = item["title"];

			details.appendChild(document.createElement("p")).innerHTML = item["abstract"].replace(/<?php echo $w; ?>/gi, "<mark><?php echo $w; ?></mark>");

			let highlighted = details.appendChild(document.createElement("p")).appendChild(document.createElement("a"));
			highlighted.setAttribute("href", `API/Util.php?pdf=${encodeURIComponent(item["pdf"])}&w=<?php echo $w; ?>`);
			highlighted.appendChild(document.createElement("button")).textContent = "Highlighted";

			let authors = section.appendChild(document.createElement("p"));

			for (let author of item["authors"]) {
				if (author !== item["authors"][0])
					authors.appendChild(document.createTextNode(", "));

				let link = authors.appendChild(document.createElement("a"));
				link.setAttribute("href", `cloud.php?q=${encodeURIComponent(author)}&n=<?php echo $n; ?>`);
				link.textContent = author;
			}

			let conference = section.appendChild(document.createElement("p")).appendChild(document.createElement("a"));
			conference.setAttribute("href", `cloud.php?q=${encodeURIComponent(item["conference"])}&n=<?php echo $n; ?>`);
			conference.textContent = item["conference"];

			let download = section.appendChild(document.createElement("p")).appendChild(document.createElement("a"));
			download.setAttribute("href", item["pdf"]);
			download.appendChild(document.createElement("button")).textContent = "Download";
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
