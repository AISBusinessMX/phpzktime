<?php
#AIS Business México SA de CV	
#dev@aisbusiness.mx
#Creado por: Hector Valdivia
#Fecha: 17/10/2015 10:58 AM

//error_reporting(E_ALL);
//ini_set('display_errors', '1');

class PDOConnection
{
	static function Conect($Mode,$Query)
	{

		try
		{
			$options = array(
				PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
			);
			$DBH = new PDO("mysql:host=".$HOSTBD.";dbname=".$DB.";charset=utf8", $URS, $PSD,$options);
			$DBH->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
			$STH = $DBH->query($Query);
			$STH->setFetchMode(PDO::FETCH_ASSOC);

			switch ($Mode)
			{
				case 'rowCount':
					$Result = $STH->rowCount();
					return $Result;
					break;

				case 'normalMode':
					$Result = $STH->fetch();
					return $Result;
					break;

				case 'While':
					while($Result = $STH->fetch())
					{
						$data[] = $Result;
					}
					return $data;
					break;
			}
		}
		catch(PDOException $e)
		{
			return $e;
		}
	}
}
