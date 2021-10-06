<?php
    include_once("templates/header.php");
    include_once("process/classUsuario.php");

    if(isset($_SESSION['usuario'])){
        $nome = $_SESSION['usuario'][0]['NOME'];
     }else{
         $nome = "";
         header("Location:" . $url);
     }

    // instanciando o objeto Usuarios
    $usuariosObj = new Usuarios($conn);

    // armazenando arrays de usuarios
    $usuarios = $usuariosObj->exibirTodos();

    // liberando objeto da memoria
    unset($usuariosObj);

?>
<body>
    <div id="mainContainer">
        <header class="headerBar">
            <p class="headerBarText">FreeeWheeel
                <img class="logoMenuImg"src="img/logoMenu.png"> 
            </p>

            <div class="btnHamburguer" id="btnHam">
                <img id="hamImg" src="img/hamb.png">   
            </div>

        </header>
        
        <aside class="menu" id="menu">

            <p class="logoMenu">
                <a href="<?=$url?>/home.php">
                    <img class="logoMenuImg" src="img/logoMenu.png" alt="">
                </a>
            </p>

            <nav>
                <ul>
                    <a href="<?=$url?>/home.php"><li id="btnHome">Home</li></a>
                    <a href="<?=$url?>/usuarios.php"><li id="btnUsuarios">Usuarios</li></a>
                    <a  href="<?=$url?>/cadastros.php"><li id="btnCadastros">Cadastros</li></a>
                    <a><li id="logOut">Sair</li></a>
                </ul>
            </nav>
        </aside>
        
        <section>
            <div class="mainContent cadBack">
                <div class="cadastrar">
                    <p class="titleCadastrar">Cadastrar novo Usuario</p>
                    <div class="formCadastrar">
                        <form autocomplete="off" action="<?=$url?>/process/cadastroMenu.php" method="POST">
                            <input type="text" name="nome" placeholder="Nome">
                            <input type="text" name="email" placeholder="Email">

                            <div class="boxSelect left">
                                <select class="fontf5 noML" id="tipo" name="tipo">
                                    <option value="">Selecione o tipo de usuario</option>
                                    <option value="ADM">ADM</option>
                                    <option value="CLIENT">CLIENT</option>
                                </select>
                            </div>

                            <input type="password" name="senha" placeholder="Senha">
                            <input type="password" name="confSenha" placeholder="Confirme a senha">

                            <!-- mensagem de erro -->
                            <?php
                            if(isset($_SESSION["ListaErrosCad"]) && $_SESSION["ListaErrosCad"] <> []){
                                foreach ($_SESSION["ListaErrosCad"] as $erro) {
                                echo "<p class='msgError left'>" . $erro . "</p>";
                                }
                            unset($_SESSION["ListaErrosCad"]);
                            }
                            ?> 

                            <button class="btnCadastrar" type="submit" name="cadastrar">Cadastrar</button>
                        </form>
                        
                        <!-- mensagem de sucesso -->
                        <?php if(isset($_SESSION["msgSucess"]) && $_SESSION["msgSucess"] <> []): ?>
             
                            <p class="msgSucess"><?=$_SESSION["msgSucess"]?></p>
                 
                        <?php 
                        unset($_SESSION["msgSucess"]);
                        endif; ?>

                    </div>
                </div>

            </div>
        
        <!-- modal de logOut -->

            <div id="modLogOut" class="modalDelete dispNone">
                <p class="modalHeader">Mensagem do sistema</p>
                <p class="modalMsg">Deseja realmente sair do sistema?</p>

                <button id="logOutSim">Sim</button>
                <button id="logOutNao">Não</button>
                            
            </div>

            <footer>
                <div class="footerMenuBar">
                    <div class="footerMenu">
                        <ul>
                            <li><a href="<?=$url?>/usuarios.php">Usuarios</a></li>
                            <li><a href="<?=$url?>/cadastros.php">Cadastros</a></li>
                        </ul>
                        <div class="footerTextBox">
                            <p class="footerText">© 2021  DesingUXUI S.A - Instituição.  18.236.120/0001-58 <br>
                                Rua Capote Valente, 39 - São Paulo, SP - 05409-000</p>
                        </div>
                    </div>
                </div>
            </footer>

        </section>

        <script src="events.js"></script> 
    </div>   
</body>
</html>