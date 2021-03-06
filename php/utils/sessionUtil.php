<?php
	/* Questo File contiene funzioni per la gestione della sessione. */

	// Setta la variabile _SESSION
	function setupSession($userID, $username, $name, $surname) {
		if(!isset($_SESSION))
			session_start();
		
		$_SESSION['userID'] = $userID;
		$_SESSION['username'] = $username;
		$_SESSION['name'] = $name;
		$_SESSION['surname'] = $surname;
	}

	// Verifica se l'utente è loggato
	function isLogged() {
		return isset($_SESSION['userID']);
	}

?>