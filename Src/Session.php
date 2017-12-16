<?php 
	class Session
	{

		static function write($nameSession, $array)
		{

			foreach ($array as $key => $value)
			 {
			 	$_SESSION[$nameSession][$key]=$value;
			 }

		}

		static function read($nameSession, $key)
		{
			if (isset($_SESSION[$nameSession])) {
				return $_SESSION[$nameSession][$key];
			}
			
		}

		static function delete($nameSession)
		{
			unset($_SESSION[$nameSession]);
		}

		static function update ($nameSession, $key, $value)
		{
			$_SESSION[$nameSession][$key]=$value;
		}

	}


?>