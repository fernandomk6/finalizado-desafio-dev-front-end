<?php

class Login {
    private $conn;
    private $email;
    private $senha;

    function __CONSTRUCT($conexao, $pEmail, $pSenha){
        $this->conn = $conexao;
        $this->email = $pEmail;
        $this->senha = $pSenha;
    }

    function logar(){
        $sql = "SELECT * FROM usuarios WHERE EMAIL = '$this->email' AND SENHA = '$this->senha'";

        $stmt = $this->conn->prepare($sql);
        
        $result = $this->conn->query($sql);

        $result = $result->fetch_all(MYSQLI_ASSOC);

        if(count($result) > 0){
            return $result;
        }else{
            return false;
        }
    }

    function cadastrar($nome, $email, $senha, $tipo){



        // verificando se email ja esta cadastrado
        $sql = "SELECT * FROM usuarios WHERE EMAIL = '$this->email'";

        $stmt = $this->conn->prepare($sql);
        
        $result = $this->conn->query($sql);

        $result = $result->fetch_all(MYSQLI_ASSOC);

        if(count($result) > 0){
            // caso exista esse email ja cadastrado retornar a mensagem a baixo
            return false;
        }else{
            // como não encontrou o email, inicia o insert
            $sql = "INSERT INTO `usuarios`(`NOME`, `EMAIL`, `SENHA`, `tipo`) VALUES ('$nome', '$email', '$senha', '$tipo')";

            $stmt = $this->conn->prepare($sql);
        
            if($stmt->execute()){
                // inserido com sucesso
                return true;
            }else{
                // algum erro ocorreu ao inserir
                return false;
            }   

        }
        
    }
}