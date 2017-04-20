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
progress + select {
	display: none;
}
		</style>
	</head>
	<body>
		<nav>
			<a href="cloud.php?q=<?php echo $q; ?>&n=<?php echo $n; ?>"><button><?php echo $q; ?></button></a>
		</nav>
		<main>
			<h1><?php echo $w; ?></h1>
			<progress max="100" value="0"></progress>
			<select>
				<option value="r" selected>Result Order</option>
				<option value="f+">Frequency (ascending)</option>
				<option value="f-">Frequency (descending)</option>
				<option value="a+">Alphabetical (ascending)</option>
				<option value="a-">Alphabetical (descending)</option>
			</select>
		</main>
		<script>
"use strict";

const main = document.querySelector("main");
const progress = document.querySelector("progress");
const select = document.querySelector("select");

const ACM  = <?php echo json_encode(array_splice($acm, 0, min(intval($n), count($acm))), JSON_PRETTY_PRINT); ?>;
const IEEE = <?php echo json_encode($ieee, JSON_PRETTY_PRINT); ?>;

let results = [];

let requestWords = item => {
	return fetch(`API/Util.php?pdf=${encodeURIComponent(item["pdf"])}`)
	.then(response => {
		progress.setAttribute("value", parseInt(progress.getAttribute("value")) + (100 / (ACM.length + IEEE.length)));

		return response.text()
		.then(text => {
			if (!response.ok)
				return;

			let json = {};
			try {
				json = JSON.parse(text);
			} catch (e) {}
			if (!("<?php echo $w; ?>" in json) && !/\b<?php echo $w; ?>\b/i.test(item["abstract"]))
				return;

			item["frequency"] = Math.max(json["<?php echo $w; ?>"] || 0, (item["abstract"].match(/\b<?php echo $w; ?>\b/gi) || []).length);

			let section = main.appendChild(document.createElement("section"));

			let details = section.appendChild(document.createElement("details"));

			details.appendChild(document.createElement("summary")).textContent = item["title"];

			details.appendChild(document.createElement("p")).innerHTML = item["abstract"].replace(/\b<?php echo $w; ?>\b/gi, "<mark><?php echo $w; ?></mark>");

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

			section.appendChild(document.createElement("p")).textContent = item["frequency"];

			let download = section.appendChild(document.createElement("p")).appendChild(document.createElement("a"));
			download.setAttribute("href", item["pdf"]);
			download.appendChild(document.createElement("button")).textContent = "Download";

			item["element"] = section;
			results.push(item);
		});
	});
};
let promise = Promise.all([].concat(ACM.map(requestWords), IEEE.forEach(requestWords)))
.then(results => {
	progress.remove();
});

select.selectedIndex = 0;
select.addEventListener("change", event => {
	promise = promise
	.then(result => {
		for (let item of results)
			item["element"].remove();

		let copy = results.slice();

		switch (select.value) {
		case "f+":
			copy.sort((a, b) => a["frequency"] - b["frequency"]);
			break;
		case "f-":
			copy.sort((a, b) => b["frequency"] - a["frequency"]);
			break;
		case "a+":
			copy.sort((a, b) => a["title"].localeCompare(b["title"]));
			break;
		case "a-":
			copy.sort((a, b) => b["title"].localeCompare(a["title"]));
			break;
		}

		for (let item of copy)
			main.appendChild(item["element"]);
	});
});
		</script>
	</body>
</html>
