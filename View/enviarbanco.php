<?php

$conn = new PDO("mysql: host=localhost;port=3306;dbname=TesteZenith","root","");
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

while(True)
{
	$valor = rand(5,35);
	$sql = "INSERT INTO ExemploOutro(id, valor) VALUES(null, $valor)";
	$resultado = $conn->exec($sql);
	sleep(3);
}
?>