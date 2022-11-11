<?php

class conexion
{
	function __destruct()
	{
		Consulting::CloseInstance();
	}
}

class Consulting
{
	public static $Instance = null;
	private static $ClassConexion = null;
	static function CloseInstance()
	{
		mysqli_close(self::$Instance);
	}
	
	static function connect()
	{
		self::$Instance = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME) or die("No se pudo connect a la base de datos");
		
		/* check connection */
		if (mysqli_connect_errno()) {
			printf("Connect failed: %s\n", mysqli_connect_error());
			exit();
		}
		self::$ClassConexion = new conexion();
	}
	
	static function getCon()
	{
		self::checkConexion();
		return self::$Instance;
	}
	
	static function checkConexion()
	{
		
		if(self::$Instance==null)
		{
			
			self::connect();
		}
	}
	
	static function query($sql, $parametros = array())
	{
		self::checkConexion();
		
		$resultado = mysqli_query(self::$Instance, $sql);
		return $resultado;
	}
	
}