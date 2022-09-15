<?php 
// Creamos la clase "session"
class session 
{
	// Le damos un constructor por defecto que crea una sesión
	function __construct(argument)
	{
		session_start();
	}
	// Guarda el nombre en una variable
	public function set($nombre, $valor)
	{
		$_SESSION[$nombre] = $valor;
	}
	// Si el usuario tiene nombre lo devuelve, sino devuelve false 
	public function get($nombre){
		if (isset($_SESSION [$nombre])) {
			return $_SESSION [$nombre];
		}else{
			return false;
		}
	}
	// Función que termina la sesión
	public function endSession()
	{
		$_SESSION =array();
		session_destroy();
	}
}
 ?>