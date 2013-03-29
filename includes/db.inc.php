<?php

function _construct() {
		$this->pdo = new pdo('mysql:host=localhost;dbname=ribbit', 'root', 'albania1');
		$this->$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$this->$pdo->exec('SET NAMES "utf-8"');
	} 