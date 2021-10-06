<?php

session_start();
include_once "../process/url.php";
include_once "../process/conn.php";
include_once "../process/classUsuario.php";

if(isset($_POST['srcUser'])){
    $src = new Usuarios($conn);

    $usuarios = $src->exibirSrc($_POST['srcUserName']);

    $_SESSION['srcUser'] = $usuarios;
    header("Location:" . $url . "/usuarios.php");
}else{
    echo "oi";
}