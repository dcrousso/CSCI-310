<?php

require_once("API/ACM.php");
require_once("API/IEEE.php");
require_once("API/Util.php");

$q = isset($_GET["q"]) ? urldecode($_GET["q"]) : "";
$n = isset($_GET["n"]) ? $_GET["n"]            : "10";
$w = isset($_GET["w"]) ? $_GET["w"]            : "";
$s = isset($_GET["s"]) ? true                  : false;

$acm = API_ACM::query($q);
$ieee = API_IEEE::queryText($q, $n);

?>
<!DOCTYPE html>
<html>
	<head>
		<link rel="stylesheet" href="common.css">
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
			<a class="download text" href="" download="<?php echo $w; ?>.txt"><button>Text</button></a>
			<a class="download pdf" href="#" download="<?php echo $w; ?>.pdf"><button>PDF</button></a>
			<a class="subset" href="cloud.php?q=<?php echo $q; ?>&n=<?php echo $n; ?>&s" disabled><button>Subset</button></a>
		</main>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.4/jspdf.min.js"></script>
		<script>
"use strict";

const main         = document.querySelector("main");
const progress     = document.querySelector("progress");
const select       = document.querySelector("select");
const downloadText = document.querySelector(".download.text");
const downloadPDF  = document.querySelector(".download.pdf");
const subset       = document.querySelector(".subset");

let pdf = null;

function createDownloads(articles) {
	URL.revokeObjectURL(downloadText.getAttribute("href"));

	let data = articles.map(item => [item["title"], item["authors"].join(", "), item["conference"], item["frequency"]].join("\t") + "\n");
	let blob = new Blob(data, {type: "text/plain"});

	downloadText.setAttribute("href", URL.createObjectURL(blob));

	pdf = new jsPDF;
	pdf.setFontSize(12);
	articles.forEach((item, index) => {
		pdf.text(5, 10 + (index * 28), item["title"]);
		pdf.text(5, 16 + (index * 28), item["authors"].join(", "));
		pdf.text(5, 22 + (index * 28), item["conference"]);
		pdf.text(5, 28 + (index * 28), item["frequency"]);
	});

}

const ACM  = <?php echo json_encode(array_splice($acm, 0, min(intval($n), count($acm))), JSON_PRETTY_PRINT); ?>;
const IEEE = <?php echo json_encode($ieee, JSON_PRETTY_PRINT); ?>;

let results = [];

<?php if ($s) { ?>
const selected = localStorage.getItem("<?php echo $q; ?>");
<?php } ?>

function requestWords(item) {
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

<?php if ($s) { ?>
			if (selected && !JSON.parse(selected).includes(item["title"]))
				return;
<?php } ?>

			item["frequency"] = Math.max(json["<?php echo $w; ?>"] || 0, (item["abstract"].match(/\b<?php echo $w; ?>\b/gi) || []).length).toLocaleString();

			item["element"] = main.appendChild(document.createElement("section"));

			let details = item["element"].appendChild(document.createElement("details"));

			let title = details.appendChild(document.createElement("summary"));

			item["checkbox"] = title.appendChild(document.createElement("input"));
			item["checkbox"].setAttribute("type", "checkbox");
			item["checkbox"].addEventListener("change", event => {
				if (results.some(result => result["checkbox"].checked))
					subset.removeAttribute("disabled");
				else
					subset.setAttribute("disabled", true);
			});

			title.appendChild(document.createTextNode(item["title"]));

			details.appendChild(document.createElement("p")).innerHTML = item["abstract"].replace(/\b<?php echo $w; ?>\b/gi, "<mark><?php echo $w; ?></mark>");

			let highlighted = details.appendChild(document.createElement("p")).appendChild(document.createElement("a"));
			highlighted.setAttribute("href", `API/Util.php?pdf=${encodeURIComponent(item["pdf"])}&w=<?php echo $w; ?>`);
			highlighted.appendChild(document.createElement("button")).textContent = "Highlighted";

			let authors = item["element"].appendChild(document.createElement("p"));

			for (let author of item["authors"]) {
				if (author !== item["authors"][0])
					authors.appendChild(document.createTextNode(", "));

				let link = authors.appendChild(document.createElement("a"));
				link.setAttribute("href", `cloud.php?q=${encodeURIComponent(author)}&n=<?php echo $n; ?>`);
				link.textContent = author;
			}

			let conference = item["element"].appendChild(document.createElement("p")).appendChild(document.createElement("a"));
			conference.setAttribute("href", `cloud.php?q=${encodeURIComponent(item["conference"])}&n=<?php echo $n; ?>`);
			conference.textContent = item["conference"];

			item["element"].appendChild(document.createElement("p")).textContent = item["frequency"];

			let download = item["element"].appendChild(document.createElement("p")).appendChild(document.createElement("a"));
			download.setAttribute("href", item["pdf"]);
			download.appendChild(document.createElement("button")).textContent = "Download";

			results.push(item);
		});
	});
}
let promise = Promise.all([].concat(ACM.map(requestWords), IEEE.forEach(requestWords)))
.then(result => {
	progress.remove();

	createDownloads(results);
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

		createDownloads(copy);
	});
});

downloadPDF.addEventListener("click", event => {
	event.preventDefault();

	pdf.save(downloadPDF.getAttribute("download"));
});

subset.addEventListener("click", event => {
	localStorage.setItem("<?php echo $q; ?>", JSON.stringify(results.filter(item => item["checkbox"].checked).map(item => item["title"])));
});
		</script>
	</body>
</html>
