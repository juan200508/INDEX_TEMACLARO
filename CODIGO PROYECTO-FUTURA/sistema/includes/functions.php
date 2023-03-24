<?php
date_default_timezone_set('America/Lima');

function fechaPeru()
{
	$mes = array(
		"", "Enero",
		"Febrero",
		"Marzo",
		"Abril",
		"Mayo",
		"Junio",
		"Julio",
		"Agosto",
		"Septiembre",
		"Octubre",
		"Noviembre",
		"Diciembre"
	);
	return date('d') . " de " . $mes[date('n')] . " de " . date('Y');
}

/*Validar Contraseña
function validar_clave($clave, $error_clave)
{
	if (strlen($clave) < 6) {
		$error_clave = '<span style="color: red">La clave debe contener al menos 6 caracteres</span>';
	}
	if (strlen($clave) > 16) {
		$error_clave = '<span style="color: red">La clave no debe contener mas de 16 caracteres</span>';
	}
	if (!preg_match('`[a-z]`', $clave)) {
		$error_clave = '<span style="color: red">La clave debe contener al menos una letra minúscula</span>';
	}
	if (!preg_match('`[A-Z]`', $clave)) {
		$error_clave = '<span style="color: red">La clave debe contener al menos una letra mayúscula</span>';
	}
	if (!preg_match('`[0-9]`', $clave)) {
		$error_clave = '<span style="color: red">La clave debe contener al menos un número</span>';
	}
	return true;
}
if ($_POST) {
	$error = "";
	if (validar_clave($_POST['clave'], $error)) {
		echo '<span style="color: red">Contraseña </span>';
	} else {
		echo '<span style="color: red">' . $error . '</span>';
	}
}
*/