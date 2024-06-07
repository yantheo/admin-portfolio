<?php

abstract class Model
{
	private static $pdo;

	private static function setBdd()
	{
		try {
			//self::$pdo = new PDO("mysql:host=localhost; dbname=yanickpyanick; charset=utf8", "root", "");

			self::$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
		} catch (PDOException $e) {
			print "Error: " . $e->getMessage();
		}
	}

	protected function getBdd()
	{
		if (self::$pdo === null) {
			self::setBdd();
		}
		return self::$pdo;
	}

	public static function sendJSON($info)
	{
		// This allows any origin
		header('Access-Control-Allow-Origin: *');
		// Other headers to allow different types of requests
		header('Access-Control-Allow-Methods: GET');
		header('Access-Control-Allow-Headers: Content-Type');
		header('content-type: application/json; charset=utf-8');
		echo json_encode($info);
	}
}
