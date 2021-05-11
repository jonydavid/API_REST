<?php

include 'bd/BD.php';

header('Access-Control-Allow-Origin: *');

if($_SERVER['REQUEST_METHOD']=='GET')
{
    if(isset($_GET['id'])){
        $query="SELECT * FROM marcas WHERE id_marca=".$_GET['id_marca'];
        $resultado=metodoGet($query);
        echo json_encode($resultado->fetch(PDO::FETCH_ASSOC));
    }else{
        $query="SELECT * FROM marcas";
        $resultado=metodoGet($query);
        echo json_encode($resultado->fetchAll()); 
    }
    header("HTTP/1.1 200 OK");
    exit();
}

if($_POST['METHOD']=='POST')
{
    unset($_POST['METHOD']);
    $descripcion=$_POST['descripcion'];
    $estado=$_POST['estado'];
    $query="INSERT INTO marcas(descripcion, estado) values ('$descripcion', '$estado')";
    $queryAutoIncrement="SELECT MAX(id_marca) as id_marca FROM marcas";
    $resultado=metodoPost($query, $queryAutoIncrement);
    echo json_encode($resultado);
    header("HTTP/1.1 200 OK");
    exit();
}

if($_POST['METHOD']=='PUT')
{
    unset($_POST['METHOD']);
    $id=$_GET['id_marca'];
    $descripcion=$_POST['descripcion'];
    $estado=$_POST['estado'];
    $query="UPDATE marcas SET descripcion='$descripcion', estado='$estado' WHERE id_marca='$id'";
    $resultado=metodoPut($query);
    echo json_encode($resultado);
    header("HTTP/1.1 200 OK");
    exit();
}

if($_POST['METHOD']=='DELETE')
{
    unset($_POST['METHOD']);
    $id=$_GET['id_marca'];
    $query="DELETE FROM marcas WHERE id_marca='$id'";
    $resultado=metodoDelete($query);
    echo json_encode($resultado);
    header("HTTP/1.1 200 OK");
    exit();
}

header("HTTP/1.1 400 Bad Request");


?>