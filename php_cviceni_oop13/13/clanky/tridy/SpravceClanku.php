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
 * Reprezentuje správce článků v redakčním systému
 */
class SpravceClanku
{

	/**
	 * Vrátí článek podle jeho URL adresy
	 * @param string $url URL adresa článku
	 * @return mixed Pole s článkem nebo false při neúspěchu
	 */
	public function nacti($url)
	{
		$vysledek = Databaze::dotaz('SELECT * FROM clanek WHERE url=?', array($url));
		return $vysledek->fetch();
	}

	/**
	 * Přidá nový článek
	 * @param string $url URL adresa článku
	 * @param string $titulek Titulek
	 * @param string $popisek Popisek
	 * @param string $obsah Obsah
	 */
	public function pridej($url, $titulek, $popisek, $obsah)
	{
		Databaze::dotaz('INSERT INTO clanek (url, titulek, popisek, obsah) VALUES (?, ?, ?, ?)', array($url, $titulek, $popisek, $obsah));
	}

	/**
	 * Uloží změny v existujícím článku
	 * @param string $url URL adresa článku
	 * @param string $titulek Titulek
	 * @param string $popisek Popisek
	 * @param string $obsah Obsah
	 * @param $clanekId Id článku, který editujeme
	 */
	public function uloz($url, $titulek, $popisek, $obsah, $clanekId)
	{
		Databaze::dotaz('UPDATE clanek SET url=?, titulek=?, popisek=?, obsah=? WHERE clanek_id=?', array($url, $titulek, $popisek, $obsah, $clanekId));
	}

	/**
	 * Vypíše HTML seznam s články a odkazy k jejich administraci
	 */
	public function vypisSeznam()
	{
		$vysledek = Databaze::dotaz('SELECT url, titulek FROM clanek');
		$clanky = $vysledek->fetchAll();
		echo('<ul>');
		foreach ($clanky as $clanek)
		{
			echo('<li><a href=administrace.php?url=' . htmlspecialchars($clanek['url']) . '>' . htmlspecialchars($clanek['titulek']) . '</a>');
		}
		echo('</ul>');
	}

}