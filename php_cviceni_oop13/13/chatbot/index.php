<?php
	session_start();
?>

<!DOCTYPE html>

<html lang="cs-cz">
<head>
	<meta charset="utf-8" />
	<title>Chatbot</title>
</head>
<body>

	<div style="width: 640px; margin: 0 auto;">
		<?php
			// Autoloader
			function nactiTridu($trida)
			{
				require("tridy/$trida.php");
			}
			spl_autoload_register("nactiTridu");
			mb_internal_encoding("UTF-8");

			Databaze::pripoj('localhost', 'root', '', 'db_chatbot');

			$chatBot = new ChatBot('Chatbot');

			// Reakce na odeslání formuláře
			if ($_POST)
				$chatBot->zpracujVetu($_POST['otazka']);

			$chatBot->vypisHistorii();
		?>

		<form method="post">
			Ty: <input type="text" name="otazka" /><br />
			<input type="submit" value="odeslat" />
		</form>

	</div>
	

<body>
</html>