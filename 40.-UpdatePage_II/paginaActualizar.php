<?php

$busqueda = $_GET['buscar'];
/*
    * Using mysqli_fetch_array function. Working with associative array
    * Query, with wildcard characters in MySQL
    */

    $unitName = $_GET["unitName"];
    $unitAias = $_GET["unitAlias"];
    $unitFechaAlta = $_GET["unitFechaAlta"];
    $unitVin = $_GET["unitVin"];
    $unitPlaca = $_GET["unitVin"];

require('./connection.php');


$conProd = mysqli_connect($hostProd, $userNameProd, $passProd);
if ($conProd->connect_errno) {
    echo "Fallo la conexion a MySQL: (" . $conProd->errno . ") " . $conProd->connect_errno;
    exit();
}
//Validando la base de datos que se esta usando
mysqli_select_db($conProd, $dbNameProd) or die ("No se encontro las Base de datos");
//Setiando la codificacion de caracteres
mysqli_set_charset($conProd, "utf8");

$queryProd = "SELECT c_unidad_nombre, c_unidad_alias, d_unidad_fechaalta, c_unidad_vin, c_unidad_placa 
              FROM dat_Unidad WHERE n_estatus_id = 1 AND c_unidad_nombre LIKE '$busqueda%'";

//Ejecutamos la consulta usando la funcion mysqli_query(conexion, sql);
//Con esto acabamos de ejecutar la consulta y cargamos en memoria los datos
$resultQueryProd = mysqli_query($conProd, $queryProd);
//Using an associative array mysqli_fetch_array
while ($fila = mysqli_fetch_array($resultQueryProd, MYSQLI_ASSOC)) {

    //Usando  caracteres comodin
    // % cadena de caracteres
    // _ un unico caracter
    //echo "<table><tr><td>";
    echo "<form action='Actualizar.php' method='get' >";

    echo "<input type='text' name='unitName' value='" . $fila['c_unidad_nombre'] .  "'><br>";
    echo "<input type='text' name='unitAlias' value='" . $fila['c_unidad_alias'] .  "'><br>";
    echo "<input type='text' name='unitFechaAlta' value='" . $fila['d_unidad_fechaalta'] .  "'><br>";
    echo "<input type='text' name='unitVin' value='" . $fila['c_unidad_vin'] .  "'><br>";
    echo "<input type='text' name='unitPlaca' value='" . $fila['c_unidad_placa'] .  "'><br>";

    echo "<input type='submit' name='enviado' value='Actualizar !!!'>";

    echo "</form>";

    /*
    echo $fila['c_unidad_nombre'] . "</td><td>";
    echo $fila['c_unidad_alias'] . "</td><td>";
    echo $fila['d_unidad_fechaalta'] . "</td><td>";
    echo $fila['c_unidad_vin'] . "</td><td>";
    echo $fila['c_unidad_placa'] . "</td><td></tr></table>";*/
}


?>