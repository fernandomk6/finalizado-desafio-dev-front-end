<?php

session_start();
include_once("../process/classUsuario.php");
include_once("../process/conn.php");
include_once("../process/url.php");

if(isset($_POST) && isset($_POST['editarSim'])){

    // capturar as variaveis
    $id = $_POST['editarSim'];
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $senha = $_POST['senha'];
    $confSenha = $_POST['confSenha'];
    $tipo = $_POST['tipo'];

    // validações de cadastro
    $errosEdit = [];

    if($nome == ""){
        $errosEdit[] = "Nome em branco";
    }

    if($email == ""){
        $errosEdit[] = "Email em branco";
    }

    if(!($senha == $confSenha && $senha <> "" && $confSenha <> "")){
        $errosEdit[] = "Senhas diferentes ou em branco";
    }

    if($errosEdit <> []){
        // possui erros de validação

        $_SESSION["ListaErrosEdit"] = $errosEdit;

        $_SESSION['editar'] = $id;
        $_SESSION['nome'] = $nome;
        $_SESSION['email'] = $email;

        header("Location:" . $url . "/usuarios.php");
        exit;
        

    }else{
        // passou pelas validações executar update no banco
        

        // instanciar objeto usuario passado a conexão como parametro
        $usuario = new Usuarios($conn);

        // verificando se realmente fez o update
        if($usuario->alterar($id, $nome, $email, $senha, $tipo)){
            $_SESSION['msg'] = "Alterado com sucesso!!!";
            header("Location:" . $url . "/usuarios.php");
            exit;
        }else{
            $_SESSION['msg'] = "Ocorreu um erro ao alterar";
            header("Location:" . $url . "/usuarios.php");
            exit;
        }

        
    }



   

}else{
    unset($_POST);
    header("Location:" . $url . "/usuarios.php");
}