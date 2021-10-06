<?php


class Usuarios{
    private $id;
    private $nome;
    private $email;
    private $senha;
    private $conn;

    function __CONSTRUCT($conexao){
        $this->conn = $conexao;
    }

    function exibirTodos(){

        $sql = "SELECT * FROM usuarios ORDER BY ID DESC";

        $result = $this->conn->query($sql);

        $usuarios = $result->fetch_all(MYSQLI_ASSOC);

        if(count($usuarios) > 0){
            return $usuarios;
        } else{
            return [];
        }
        
    }

    function exibirSrc($nome){

        $sql = "SELECT * FROM usuarios WHERE NOME LIKE '%$nome%' ORDER BY ID DESC";

        $result = $this->conn->query($sql);

        $usuarios = $result->fetch_all(MYSQLI_ASSOC);

        if(count($usuarios) > 0){
            return $usuarios;
        } else{
            return [];
        }
        
    }

    function deletar($id){
        $sql = "DELETE FROM usuarios WHERE ID = $id";

        $stmt = $this->conn->prepare($sql);
        
        if($stmt->execute()){
            return true;
        }else{
            return false;
        }  
    }

    function alterar($id, $nome, $email, $senha, $tipo){
        $sql = "UPDATE `usuarios` SET `NOME`='$nome',`EMAIL`='$email',`SENHA`='$senha',`tipo`='$tipo' WHERE `ID` = '$id'";

        $stmt = $this->conn->prepare($sql);
        
        if($stmt->execute()){
            return true;
        }else{
            return false;
        }  
    }

}









