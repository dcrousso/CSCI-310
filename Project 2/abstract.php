<?php

// Lots of ternary operators to see if various fields/query parameters have been set
$q     = isset($_GET["q"])     ? $_GET["q"]     : [];
$w     = isset($_GET["w"])     ? $_GET["w"]     : [];
$n     = isset($_GET["n"])     ? $_GET["n"]     : [];

?>
<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" href="common.css">
	<style>
	main {
		text-align: center;
		font-family: "HelveticaNeue-Light", "Helvetica Neue Light", "Helvetica Neue", Helvetica, Arial, "Lucida Grande", sans-serif;
		padding-top: 1%;
		padding-left: 20%;
		padding-right: 20%;
	}
	</style>
	<title><?php echo $q; ?></title>
</head>
<body style="align: center">
	<nav>
		<div><a><button><?php echo $q; ?></button></a></div>
		<div><a><button><?php echo $w; ?></button></a></div>
	</nav>
	<main>
		<h1 id="title"> Title of Paper </h1>
		<h2 id="authors"> Authors of Paper </h2>
		<a id="conference" href="www.google.com">Conference</a> </br> </br>
		<a id="download" href="www.google.com">Download Link</a>
		<p id="paper">
			Lorem ipsum dolor sit amet, tale expetendis cu duo. Ut sit magna dicam deleniti. Ludus tollit dissentiet vix an, eum nibh solum inermis in. Te has oblique atomorum. Sonet laboramus at quo, suscipit platonem ius ex.

			Inani insolens maiestatis cum an, affert labore noluisse ex pro. Sed ne primis nemore interpretaris, duo ne habeo iracundia. No eam vero rationibus, vel ex veniam scaevola. Eos essent recteque ei. Id paulo prompta vim, dolore omnium cu sit, vis modo quando iracundia ei. Cu dicat molestie pri, cu qui homero omittantur persequeris.

			Has atqui elitr aliquam ea, te probo accusam accusata quo. Dicam eirmod expetendis et vis. Omnes affert virtute ei est, no quo habemus necessitatibus. Primis placerat nominati mei ex, latine indoctum usu ex.

			Cu ludus efficiendi vix, ex sale nullam theophrastus eum. Eu per sint facilisis, in mel debet affert. Ex stet etiam nihil sea, at mei simul fastidii patrioque. At vix paulo intellegam. Ex his soluta bonorum lobortis. Ad vocibus persecuti usu, an prompta equidem democritum est. Viris conclusionemque nec ex, ei per exerci semper, cu audiam propriae convenire est.

			Has nemore eripuit ut, ex mei dicam voluptua. Mundi nobis fabulas nam in, pro mutat officiis te. Sit no idque corpora rationibus. Qui an fugit electram facilisis, regione disputationi eu mei. An stet populo intellegat cum.
		</p>
	</main>
	<script src="<?php echo $data["script_tracking_url"]; ?>"></script>
</body>
</html>
