<?php

session_start();
include_once "../process/url.php";
include_once "../process/conn.php";
include_once "../process/classLogin.php";

if(isset($_POST['cadastrar'])){

    $nome = trim($_POST['nome']);
    $email = trim($_POST['email']);
    $senha = trim($_POST['senha']);
    $confSenha = trim($_POST['confSenha']);
    $tipo = $_POST['tipo'];

    // validações de cadastro
    $errosCadastro = [];

    if($nome == ""){
        $errosCadastro[] = "Nome em branco";
    }

    if($email == ""){
        $errosCadastro[] = "Email em branco";
    }

    if(!($senha == $confSenha && $senha <> "" && $confSenha <> "")){
        $errosCadastro[] = "Senhas diferentes ou em branco";
    }

    if($errosCadastro <> []){
        // possui erros de validação
        $_SESSION["ListaErrosCad"] = $errosCadastro;
        header("Location:" . $url . "/cadastros.php");
    }else{
        // passou pelas validações executar insert no banco
        $usuarioCad = new Login($conn, $email, $senha);

        // tentando inserir do banco
        if($usuarioCad->cadastrar($nome, $email, $senha, $tipo)){
            $_SESSION["msgSucess"] = "Cadastrado com sucesso";
            header("Location:" . $url . "/cadastros.php");
        }else{
            // algum erro ocorreu na inserção no banco
            $errosCadastro[] = "Email ja utilizado";
            $_SESSION["ListaErrosCad"] = $errosCadastro;
            header("Location:" . $url . "/cadastros.php");
        }

        
    }





}else{
    // manda para a home pois tentou acessar sem clicar em cadastrar
    header("Location:" . $url . "/cadastros.php");
}