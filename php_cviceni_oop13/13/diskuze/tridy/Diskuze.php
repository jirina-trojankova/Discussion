<?php

/*  _____ _______         _                      _
 * |_   _|__   __|       | |                    | |
 *   | |    | |_ __   ___| |___      _____  _ __| | __  ___ ____
 *   | |    | | '_ \ / _ \ __\ \ /\ / / _ \| '__| |/ / / __|_  /
 *  _| |_   | | | | |  __/ |_ \ V  V / (_) | |  |   < | (__ / /
 * |_____|  |_|_| |_|\___|\__| \_/\_/ \___/|_|  |_|\_(_)___/___|
 *
 * IT ZPRAVODAJSTVÍ  <>  PROGRAMOVÁNÍ  <>  HW A SW  <>  KOMUNITA
 *
 * Tento zdrojový kód je součástí výukových seriálů na
 * IT sociální síti WWW.ITNETWORK.CZ
 *
 * Kód spadá pod licenci prémiového obsahu a vznikl díky podpoře
 * našich členů. Je určen pouze pro osobní užití a nesmí být šířen.
 */

/**
 * Reprezentuje diskuzi
 */
class Diskuze
{

	/**
	 * @var array Slovník se smajlíky
	 */
	private $smajlici = array(
		':-)' => '<img src = "obrazky/smajlici/smile.png">',
		':)' => '<img src = "obrazky/smajlici/smile.png">',
		':-(' => '<img src = "obrazky/smajlici/unhappy.png">',
		':(' => '<img src = "obrazky/smajlici/unhappy.png">',
		':-D' => '<img src = "obrazky/smajlici/grin.png">',
		':D' => '<img src = "obrazky/smajlici/grin.png">',
		':-P' => '<img src = "obrazky/smajlici/tongue.png">',
		':P' => '<img src = "obrazky/smajlici/tongue.png">',
		':-O' => '<img src = "obrazky/smajlici/suprised.png">',
		':O' => '<img src = "obrazky/smajlici/suprised.png">',
		';-D' => '<img src = "obrazky/smajlici/wink.png">',
		';D' => '<img src = "obrazky/smajlici/wink.png">',
	);

	/**
	 * Přidá novou zprávu do databáze
	 * @param string $prezdivka Přezdívka autora zprávy
	 * @param string $zprava Zpráva
	 */
	public function pridejZpravu($prezdivka, $zprava)
	{
		Databaze::dotaz('INSERT INTO zprava (prezdivka, obsah, odeslano) VALUES (?, ?, NOW())', array($prezdivka, $zprava));
	}

	/**
	 * Zformátuje danou zprávu na HTML (smajlíci, br a podobně)
	 * @param string $zprava Zpráva k zformátování
	 * @return string Zformátovaná zpráva
	 */
	private function zformatujZpravu($zprava)
	{
		// Nahrazení rezervovaných HTML znaků na entity
		$zprava = htmlspecialchars($zprava);
		// Nahrazení smajlíků
		$zprava = strtr($zprava, $this->smajlici);
		// Nahrazení konců řádku z <br />
		$zprava = nl2br($zprava);
		return $zprava;
	}

	/**
	 * Vypíše diskuzi
	 */
	public function vypis()
	{
		$vysledek = Databaze::dotaz('SELECT * FROM zprava ORDER BY odeslano DESC LIMIT 10');
		$zpravy = $vysledek->fetchAll();
		foreach ($zpravy as $zprava)
		{
			echo('<p><img src="obrazky/avatar.png" alt="avatar" style="float: left;"><strong>' . htmlspecialchars($zprava['prezdivka']) . '</strong><br />');
			echo($this->zformatujZpravu($zprava['obsah']) . '<br /><br />');
			echo('<p style="text-align: right;"><small>' . date("j.m.Y", strtotime($zprava['odeslano'])) . '</small></p>');
			echo('</p><div style="clear: both;"></div>');
		}
	}


}