<?php

session_start();
include_once "../process/url.php";
include_once "../process/conn.php";
include_once "../process/classLogin.php";

// validações de login
if (isset($_POST["entrar"])) {
    $email = trim($_POST["email"]);
    $senha = trim($_POST["senha"]);

    $errosLogin = [];

    // verificando se email está em branco
    if ($email == "") {

        $errosLogin[] = "Email em branco";
    
    }

    if ($senha == "") {
        $errosLogin[] = "Senha em branco";
    }


    // verificando se existem erros
    if($errosLogin == []){

        $usuario = new Login($conn, $email, $senha);

        $resultado = $usuario->logar();

        if(!$resultado == false){

            //captura os dados do usuario que logou
            $_SESSION['usuario'] = $resultado;
            header("Location:" . $url . "/home.php");
        } else {
            $errosLogin[] = "Cadastro não encontrado";
            $_SESSION["ListaErrosLogin"] = $errosLogin;
            header("Location:" . $url);
        }

        
       

    } else {
        $_SESSION["ListaErrosLogin"] = $errosLogin;
        header("Location:" . $url);
    }

    
    
} else{
    // tentou acessar sem fazer login
    header("Location:" . $url);
}