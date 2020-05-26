<?php
include_once "../bd/conexion.php";
$objeto = new Conexion();
$conexion = $objeto->Conectar();
  

$nombre = (isset($_POST['nombre'])) ? $_POST['nombre'] : '';
$cedula = (isset($_POST['cedula'])) ? $_POST['cedula'] : '';
$telefono = (isset($_POST['telefono'])) ? $_POST['telefono'] : '';
$genero = (isset($_POST['genero'])) ? $_POST['genero'] : '';
$cliente = (isset($_POST['cliente'])) ? $_POST['cliente'] : '';
$sede = (isset($_POST['sede'])) ? $_POST['sede'] : '';
$opcion = (isset($_POST['opcion'])) ? $_POST['opcion'] : '';
$id = (isset($_POST['id'])) ? $_POST['id'] : '';

switch($opcion){
    case 1: //registrar
        $consulta = "INSERT INTO asesor (nombre, cedula, telefono , genero, cliente, sede) VALUES('$nombre', '$cedula', '$telefono' ,'$genero','$cliente','$sede') ";			
        $resultado = $conexion->prepare($consulta);
        $resultado->execute(); 

        $consulta = "SELECT id, nombre, cedula, telefono, genero, cliente, sede FROM asesor ORDER BY id DESC LIMIT 1";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        break;
    case 2: //editar
        $consulta = "UPDATE asesor SET nombre='$nombre', cedula='$cedula', telefono='$telefono', genero= '$genero', cliente='$cliente', sede= '$sede' WHERE id='$id' ";		
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();        
        
        $consulta = "SELECT id, nombre, cedula, telefono , genero, cliente, sede FROM asesor WHERE id='$id' ";       
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        break;        
    case 3://eliminar
        $consulta = "DELETE FROM asesor WHERE id='$id' ";		
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();                           
        break;        
}

print json_encode($data, JSON_UNESCAPED_UNICODE);
$conexion = NULL;
