<?php

$time = microtime(TRUE);

require_once("API.php");
require_once("Util.php");

$a     = isset($_GET["a"])     ? $_GET["a"]     : [];
$debug = isset($_GET["debug"]) ? $_GET["debug"] : "";

$tracks = API::getTrackSearch($a);

$lyrics = array_map(function($artist) {
	return API::getTrackLyricsGet(array_map(function($track) {
		return $track["track_id"];
	}, $artist));
}, $tracks);

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
	<div id="fb-root"></div>

	<script>
		window.fbAsyncInit = function() {
			FB.init({
				appId: '170884526750360',
				status: true,
				version: 2.8,
				cookie: true,
			});
		};
        // Load the SDK asynchronously
        (function(d){
        	var js, id = 'facebook-jssdk', ref = d.getElementsByTagName('script')[0];
        	if (d.getElementById(id)) {return;}
        	js = d.createElement('script'); js.id = id; js.async = true;
        	js.src = "//connect.facebook.net/en_US/all.js";
        	ref.parentNode.insertBefore(js, ref);
        }(document));
    </script>


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
    			<button type="button" id="shareButton" class="share">Share</button>
    		</div>
    	</form>
    	<?php if ($debug === "true") echo $time . "s\n"; ?>
    </main>
    <script src="d3.min.js"></script>
    <script src="d3.layout.cloud.js"></script>
    <script src="common.js"></script>
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
    			.attr("href", d => `word.php?<?php echo Util::generateArtistsQuery($a); ?>&w=${d.text}`)
    			.append("text")
    			.style("font-size", d => `${d.size}px`)
    			.attr("text-anchor", "middle")
    			.attr("transform", d => `translate(${d.x}, ${d.y})`)
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
    		})

    	</script>

    	<canvas id="canvas" hidden=true width="900px" height="500px"></canvas>

    	<script type="text/javascript" src="http://canvg.github.io/canvg/rgbcolor.js"></script> 
    	<script type="text/javascript" src="http://canvg.github.io/canvg/StackBlur.js"></script>
    	<script type="text/javascript" src="http://canvg.github.io/canvg/canvg.js"></script> 

    	<script src="facebook.js" type="text/javascript"> </script>

    </body>
    </html>
