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
 * Reprezentuje chatbota
 */
class Chatbot
{
	/**
	 * @var string Jméno
	 */
	public $jmeno;

	/**
	 * Inicializuje instanci
	 * @param string $jmeno Jméno chatbota
	 */
	public function __construct($jmeno)
	{
		$this->jmeno = $jmeno;
	}

	/**
	 * Uloží větu do historie konverzace
	 * @param string $veta Věta
	 */
	private function ulozDoHistorie($veta)
	{
		if (isset($_SESSION['historie']))
			$_SESSION['historie'][] = $veta;
		else
			$_SESSION['historie'] = array($veta);
	}

	/**
	 * Vrátí historii konverzace
	 * @return array Historie konverzace
	 */
	private function vratHistorii()
	{
		if (isset($_SESSION['historie']))
			return $_SESSION['historie'];
		return array();
	}

	/**
	 * Zpracuje větu od uživatele a to buď jako odpověď na otázku nebo jako otázku
	 * @param string $veta Věta od uživatele
	 */
	public function zpracujVetu($veta)
	{
		$this->ulozDoHistorie('Ty: ' . $veta);
		if (isset($_SESSION['otazka_k_nauceni']))
			$this->nauc($veta);
		else
			$this->odpovez($veta);
	}

	/**
	 * Odpoví uživateli na otázku
	 * @param string $otazka Otázka od uživatele
	 */
	private function odpovez($otazka)
	{
		$vysledek = Databaze::dotaz('SELECT odpoved FROM otazka WHERE obsah=?', array($otazka));
		$data = $vysledek->fetch();
		// Zná odpověď
		if ($data)
			$this->ulozDoHistorie($this->jmeno . ': ' . $data['odpoved']);
		else // Nezná odpověď
		{
			$this->ulozDoHistorie($this->jmeno . ': Na tuto otázku neznám odpověď. Nauč mě ji prosím:');
			$_SESSION['otazka_k_nauceni'] = $otazka; // Uloží si otázku a čeká na naučení
		}
	}

	/**
	 * Naučí se odpověď od uživatele na původní otázku od něj
	 * @param string $odpoved Odpověď od uživatele
	 */
	private function nauc($odpoved)
	{
		Databaze::dotaz('INSERT INTO otazka (obsah, odpoved) VALUES (?, ?)', array($_SESSION['otazka_k_nauceni'], $odpoved));
		unset($_SESSION['otazka_k_nauceni']);
	}

	/**
	 * Vypíše historii konverzace
	 */
	public function vypisHistorii()
	{
		$historie = $this->vratHistorii();
		foreach ($historie as $veta)
		{
			if (mb_strpos($veta, 'Ty:') !== false)
			{
				$obrazek = 'clovek.png';
				$float = 'right';
			}
			else
			{
				$obrazek = 'robot.png';
				$float = 'left';
			}
			echo('<div style="text-align: ' . $float .'"><img src="obrazky/' . $obrazek . '" alt="avatar" style="float: ' . $float . ';"/><br />');
			echo($veta);
			echo('</div><div style="clear: both;">');
		}
	}
} 