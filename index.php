<?php
    include_once("templates/header.php");
?>
<body class="backLogin">
    
    
    <div class="containerLogin">
        <div>
            <p class="titleLogin">Login</p>
                
                <p class="discripLogin">Seja bem-vindo ao FreeeWheeel
                
                
            </p>
            <img src="img/logoMenu.png" alt="">
        </div>
        <div class="formLogin">
            <form autocomplete="off" action="<?=$url?>/process/login.php" method="POST">
                <input autocomplete="off" type="text" name="email" placeholder="Email">
                <input autocomplete="off" type="password" name="senha" placeholder="Senha">
                <button type="submit" name="entrar">Entrar</button>
            </form>
           
        </div>

         <?php
            if(isset($_SESSION["ListaErrosLogin"]) && $_SESSION["ListaErrosLogin"] <> []){
                foreach ($_SESSION["ListaErrosLogin"] as $erro) {
                    echo "<p class='msgError'>" . $erro . "</p>";
                }
                session_unset();
            }
        ?> 

        <?php if(isset($_SESSION["msgSucess"]) && $_SESSION["msgSucess"] <> []): ?>
             
            <p class="msgSucess"><?=$_SESSION["msgSucess"]?></p>
                
        <?php 
        session_unset();
        endif; ?> 
        
        <p class="link"><a href="<?=$url?>/cadastrar.php">Click aqui para cadastrar-se</a></p>
    </div>

    
</body>
</html>