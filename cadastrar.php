<?php
    include_once("templates/header.php");
?>
<body class="backLogin">
    
    
    <div class="containerLogin">
        <div>
            <p class="titleLogin">Cadastrar</p>
            <p class="discripLogin">Preencha os seus dados</p>
        </div>

        <div class="formLogin">
            <form autocomplete="off" action="<?=$url?>/process/cadastro.php" method="POST">
                <input type="text" name="nome" placeholder="Nome">
                <input type="email" name="email" placeholder="Email"> 

                    <div class="boxSelect left">
                        <select class="fontf5" id="tipo" name="tipo">
                            <option value="">Selecione o tipo de usuario</option>
                            <option value="ADM">ADM</option>
                            <option value="CLIENT">CLIENT</option>
                        </select>
                    </div>
                    
                <input type="password" name="senha" placeholder="Senha">
                <input type="password" name="confSenha" placeholder="Confirme a senha">
                <button type="submit" name="cadastrar">Cadastrar</button>
            </form>
           
        </div>

        <?php
            if(isset($_SESSION["ListaErrosCad"]) && $_SESSION["ListaErrosCad"] <> []){
                foreach ($_SESSION["ListaErrosCad"] as $erro) {
                    echo "<p class='msgError'>" . $erro . "</p>";
                }
                session_unset();
            }
        ?> 
        
        <p class="link"><a href="<?=$url?>">Cancelar</a></p>
    </div>

    
</body>
</html>