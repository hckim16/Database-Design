<?php


$host		= "localhost";
$username	= "root";
$password	= "root";
$dbname		= "term_project";
$dsn		= "mysql:host=$host;dbname=$dbname";
$options	= array(
				PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
			  );