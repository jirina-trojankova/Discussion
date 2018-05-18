<?php
	// Autoloader
	function nactiTridu($trida)
	{
		require("tridy/$trida.php");
	}
	spl_autoload_register("nactiTridu");

	Databaze::pripoj('localhost', 'root', '', 'db_clanky');

	$spravceClanku = new SpravceClanku();

	// Zpracování odeslání formuláře
	if ($_POST)
	{
		if (!$_POST['clanek_id'])
			$spravceClanku->pridej($_POST['url'], $_POST['titulek'], $_POST['popisek'], $_POST['obsah']);
		else
			$spravceClanku->uloz($_POST['url'], $_POST['titulek'], $_POST['popisek'], $_POST['obsah'], $_POST['clanek_id']);
	}

	// Výchozí hodnoty polí jsou prázdné
	$clanek = array(
		'clanek_id' => '',
		'url' => '',
		'titulek' => '',
		'popisek' => '',
		'obsah' => '',
	);
	// Otevření článku z URL
	if (isset($_GET['url']))
	{
		$nactenyClanek = $spravceClanku->nacti($_GET['url']);
		if ($nactenyClanek)
			$clanek = $nactenyClanek;
	}
?>

<!DOCTYPE html>

<html lang="cs-cz">
<head>
	<meta charset="utf-8" />
	<title>Administrace</title>
</head>
<body>

	<div style="width: 640px; margin: 0 auto;">

		<form method="post">
			<input type="hidden" name="clanek_id" value="<?= htmlspecialchars($clanek['clanek_id']) ?>" /><br />
			Titulek<br />
			<input type="text" name="titulek" value="<?= htmlspecialchars($clanek['titulek']) ?>" /><br />
			URL<br />
			<input type="text" name="url" value="<?= htmlspecialchars($clanek['url']) ?>" /><br />
			Popisek<br />
			<input type="text" name="popisek" value="<?= htmlspecialchars($clanek['popisek']) ?>" /><br />
			<textarea name="obsah" style="width: 100%; height: 360px;"><?= htmlspecialchars($clanek['obsah']) ?></textarea>
			<input type="submit" value="Odeslat" />
		</form>

		<h2>Seznam článků</h2>
		<?php
			$spravceClanku->vypisSeznam();
		?>
		<a href="administrace.php">Vytvořit nový</a>

	</div>

<body>
</html>