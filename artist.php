<?php

$time = microtime(TRUE);

require_once("API.php");
require_once("Util.php");

$a     = isset($_GET["a"])     ? $_GET["a"]     : [];
$debug = isset($_GET["debug"]) ? $_GET["debug"] : "";

// Search for the tracks by an artist $a
$tracks = API::getTrackSearch($a);

// Obtain lyrics for each of the artists' songs
$lyrics = array_map(function($artist) {
	return API::getTrackLyricsGet(array_map(function($track) {
		return $track["track_id"];
	}, $artist));
}, $tracks);

// Parse the lyrics and split the words/obtain frequencies
$words = Util::splitWords(array_reduce($lyrics, function($carryTotal, $artist) {
	return $carryTotal . " " . array_reduce($artist, function($carryArtist, $song) {
		return $carryArtist . " " . $song["lyrics"];
	}, " ");
}, " "));

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
			<h1><?php echo implode(", ", $a); ?></h1>
			<svg id="wordcloud" width="900px" height="500px"></svg>
			<form action="artist.php">
				<?php foreach ($a as $artist) { ?>
				<input name="a[]" type="hidden" value="<?php echo $artist; ?>">
				<?php } ?>
				<div>
					<input name="a[]" type="search" placeholder="Enter Artist" autofocus>
				</div>
				<div>
					<button class="search">Search</button>
					<button class="merge">Merge</button>
					<button class="share" type="button">Share</button>
				</div>
			</form>
			<?php if ($debug === "true") echo $time . "s\n"; ?>
		</main>
		<div id="fb-root"></div>
		<script src="d3.min.js"></script>
		<script src="d3.layout.cloud.js"></script>
		<script src="rgb-color.min.js"></script>
		<script src="stackblur.min.js"></script>
		<script src="canvg.min.js"></script>
		<script>
"use strict";

const WORDS = [
<?php $i = 0; foreach (array_keys($words) as $word) { if ($i++ < 250) { ?>
	{text: "<?php echo $word; ?>", count: <?php echo $words[$word]; ?>}<?php echo (($i === count($words) || $i === 250) ? "" : ",") . "\n"; ?>
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
			.attr("href", d => `word.php?<?php echo Util::generateArtistsQuery($a); ?>&w=${d.text}`)
			.append("text")
				.style("font-size", d => `${d.size}px`)
				.attr("text-anchor", "middle")
				.attr("transform", d => `translate(${d.x}, ${d.y})`)
				.attr("fill", () => `hsl(${Math.floor(Math.random() * 360)}, 100%, 50%)`)
				.text(d => d.text);
})
.start();

Array.from(document.getElementsByClassName("search")).forEach(element => {
	element.addEventListener("click", event => {
		Array.from(document.getElementsByTagName("input")).forEach(input => {
			if (input.type === "hidden")
				input.remove();
		});
	});
});

function decodeBase64(input) {
	const BASE64 = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/=";

	let bytes = (input.length / 4) * 3;
	if (BASE64.indexOf(input.charAt(input.length - 1)) === 64)
		--bytes;
	if (BASE64.indexOf(input.charAt(input.length - 2)) === 64)
		--bytes;

	let ui8Array = new Uint8Array(bytes);

	input = input.replace(/[^A-Za-z0-9\+\/\=]/g, "");

	let j = 0;
	for (let i = 0; i < bytes; i += 3) {
		let enc1 = BASE64.indexOf(input.charAt(j++));
		let enc2 = BASE64.indexOf(input.charAt(j++));
		let enc3 = BASE64.indexOf(input.charAt(j++));
		let enc4 = BASE64.indexOf(input.charAt(j++));

		ui8Array[i] = (enc1 << 2) | (enc2 >> 4);
		if (enc3 !== 64)
			ui8Array[i + 1] = ((enc2 & 15) << 4) | (enc3 >> 2);
		if (enc4 !== 64)
			ui8Array[i + 2] = ((enc3 & 3) << 6) | enc4;
	}

	return ui8Array;
}

function postImageToFacebook(authToken, filename, imageData) {
	const boundary = "-----CloudifyFormBoundary-----";

	let formData = ""
	+ `--${boundary}\n`
	+ `Content-Disposition: form-data; name="source"; filename="${filename}"\n`
	+ "Content-Type: image/png\n\n"
	+ imageData.reduce((accumulator, currentValue) => accumulator + String.fromCharCode(currentValue & 0xff), "") + "\n"
	+ `--${boundary}\n`;

	let ui8Array = new Uint8Array(formData.length);
	for (let i = 0; i < formData.length; ++i)
		ui8Array[i] = formData.charCodeAt(i) & 0xff;

	fetch(`https://graph.facebook.com/me/photos?access_token=${authToken}`, {
		method: "POST",
		headers: new Headers({
			"Content-Type": `multipart/form-data; boundary=${boundary}`,
		}),
		body: ui8Array,
	});
};

Array.from(document.getElementsByClassName("share")).forEach(element => {
	element.addEventListener("click", event => {
		let canvas = document.createElement("canvas");
		canvg(canvas, cloudContainer.node().outerHTML);

		let data = canvas.toDataURL("image/png");
		let png = decodeBase64(data.substring(data.indexOf(",") + 1, data.length));

		FB.login(response => {
			if (response.authResponse)
				postImageToFacebook(response.authResponse.accessToken, "Cloudify", png);
		}, {scope: "publish_actions"});
	});
});

window.fbAsyncInit = function() {
	FB.init({
		appId: "1099427986832639",
		status: true,
		version: 2.8,
		cookie: true,
	});
};
		</script>
		<script src="dropdown.js"></script>
		<script src="http://connect.facebook.net/en_US/all.js"></script>
	</body>
</html>
