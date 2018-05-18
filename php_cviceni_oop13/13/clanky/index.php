<?php
	// Autoloader
	function nactiTridu($trida)
	{
		require("tridy/$trida.php");
	}
	spl_autoload_register("nactiTridu");

	Databaze::pripoj('localhost', 'root', '', 'db_clanky');

	// Nastavení článku z URL nebo výchozího
	$url = isset($_GET['clanek']) ? $_GET['clanek'] : 'uvodnik';
	$spravceClanku = new SpravceClanku();
	$clanek = $spravceClanku->nacti($url);
	
	if (!$clanek)
		echo('Článek s URL ' . htmlspecialchars($url) . ' nebyl nenalezen.');
?>

<!DOCTYPE html>

<html lang="cs-cz">
<head>
	<meta charset="utf-8" />
	<meta name="description" content="<?= htmlspecialchars($clanek['popisek']) ?>" />	
	<title><?= htmlspecialchars($clanek['titulek']) ?></title>
</head>
<body>

	<h1><?= htmlspecialchars($clanek['titulek']) ?></h1>
	
	<?= $clanek['obsah'] ?>

	<p><a href="administrace.php">Administrace</a></p>
<body>
</html>