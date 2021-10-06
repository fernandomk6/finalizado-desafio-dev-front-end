<?php
    session_start();
    include_once("classUsuario.php");
    include_once("conn.php");
    include_once("url.php");

    if(isset($_POST) && isset($_POST['excluirSim'])){

        $usuario = new Usuarios($conn);

        if($usuario->deletar($_POST['excluirSim'])){
            $_SESSION['msg'] = "Excluido com sucesso!!!";
            header("Location:" . $url . "/usuarios.php");
        }else{
            $_SESSION['msg'] = "Ocorreu algum erro ao excluir";
            header("Location:" . $url . "/usuarios.php");
        }
        

    }else{
        unset($_POST);
        header("Location:" . $url . "/usuarios.php");
    }