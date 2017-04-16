<?php

$q = isset($_GET["q"]) ? $_GET["q"] : "";
$n = isset($_GET["n"]) ? $_GET["n"] : "10";
$w = isset($_GET["w"]) ? $_GET["w"] : "";

?>
<!DOCTYPE html>
<html>
	<head>
		<link rel="stylesheet" href="common.css">
		<style>
main {
	padding-top: 1%;
	padding-right: 20%;
	padding-left: 20%;
	font-family: "HelveticaNeue-Light", "Helvetica Neue Light", "Helvetica Neue", Helvetica, Arial, "Lucida Grande", sans-serif;
	text-align: center;
}
		</style>
		<title><?php echo $q; ?></title>
	</head>
	<body>
		<nav>
			<a href="cloud.php?q=<?php echo $q; ?>&n=<?php echo $n; ?>"><button><?php echo $q; ?></button></a>
			<a href="word.php?q=<?php echo $q; ?>&n=<?php echo $n; ?>&w=<?php echo $w; ?>"><button><?php echo $w; ?></button></a>
		</nav>
		<main>
			<h1>TITLE</h1>
			<h2>AUTHORS</h2>
			<h3><a href="#">CONFERENCE</a></h3>
			<p><a href="#">Download</a></p>
			<p>
				Lorem ipsum dolor sit amet, tale expetendis cu duo. Ut sit magna dicam deleniti. Ludus tollit dissentiet vix an, eum nibh solum inermis in. Te has oblique atomorum. Sonet laboramus at quo, suscipit platonem ius ex.

				Inani insolens maiestatis cum an, affert labore noluisse ex pro. Sed ne primis nemore interpretaris, duo ne habeo iracundia. No eam vero rationibus, vel ex veniam scaevola. Eos essent recteque ei. Id paulo prompta vim, dolore omnium cu sit, vis modo quando iracundia ei. Cu dicat molestie pri, cu qui homero omittantur persequeris.

				Has atqui elitr aliquam ea, te probo accusam accusata quo. Dicam eirmod expetendis et vis. Omnes affert virtute ei est, no quo habemus necessitatibus. Primis placerat nominati mei ex, latine indoctum usu ex.

				Cu ludus efficiendi vix, ex sale nullam theophrastus eum. Eu per sint facilisis, in mel debet affert. Ex stet etiam nihil sea, at mei simul fastidii patrioque. At vix paulo intellegam. Ex his soluta bonorum lobortis. Ad vocibus persecuti usu, an prompta equidem democritum est. Viris conclusionemque nec ex, ei per exerci semper, cu audiam propriae convenire est.

				Has nemore eripuit ut, ex mei dicam voluptua. Mundi nobis fabulas nam in, pro mutat officiis te. Sit no idque corpora rationibus. Qui an fugit electram facilisis, regione disputationi eu mei. An stet populo intellegat cum.
			</p>
		</main>
	</body>
</html>
