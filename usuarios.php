<?php
    include_once("templates/header.php");
    include_once("process/classUsuario.php");

    if(isset($_SESSION['usuario'])){
        $nome = $_SESSION['usuario'][0]['NOME'];
     }else{
        header("Location:" . $url);
     }

    // instanciando o objeto Usuarios
    $usuariosObj = new Usuarios($conn);

    // armazenando arrays de usuarios
    if(isset($_SESSION['srcUser'])){
        $usuarios = $_SESSION['srcUser'];
        unset($_SESSION['srcUser']);
    }else{
        $usuarios = $usuariosObj->exibirTodos();
    }
    

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
            <div class="mainContent userBack">

                <div class="srcUserBox">
                    <form action="<?=$url?>/process/srcUser.php" method="POST">

                        <input name="srcUserName" class="inputSrc" type="text" placeholder="Pesquisar">
                        <button type="submit" name="srcUser" class="btnSrc">Buscar</button>
                    </form>
                </div>


            <?php if(isset($usuarios) && $usuarios <> []){ ?>
                    <!--codigo html caso exista usuarios -->

                    <!-- mensagem de sucesso retorno modal-->
                    <?php if(isset($_SESSION['msg'])): ?>
                        <p class="msgBack"><?=$_SESSION['msg']?><a class="msgClose" href="<?=$url?>/usuarios.php">X</a></p>
                    <?php 
                    unset($_SESSION['msg']);
                    endif;
                    ?>
                    <div class="boxTable">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Nome</th>
                                    <th>Email</th>
                                    <th>Tipo</th>
                                    <th>Ações</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($usuarios as $usuario): ?>
                                    <tr>
                                        <td data-label="ID"><?=$usuario['ID']?></td>
                                        <td data-label="Nome"><?=$usuario['NOME']?></td>
                                        <td data-label="Email"><?=$usuario['EMAIL']?></td>
                                        <td data-label="Tipo"><?=$usuario['tipo']?></td>
                                        <td data-label="Ações">

                                            <form action="" id="formDelEd" method="POST">

                                                <input type="hidden" name="id" value="<?=$usuario['ID']?>">
                                                <input type="hidden" name="nome" value="<?=$usuario['NOME']?>">
                                                <input type="hidden" name="email" value="<?=$usuario['EMAIL']?>">

                                                <!-- icone de deletar usuario -->
                                                <button type="submit" id="btnDel" class="btnDelete" name="excluir" value="<?=$usuario["ID"]?>">
                                                    <img src="img/deleteIcon.png" alt="deleteIcon" width="25px" height="25px">
                                                </button>

                                                <!-- icone de alterar usuario -->
                                                <button type="submit" id="btnEd" class="btnEdit" name="editar" value="<?=$usuario["ID"]?>">
                                                    <img src="img/editIcon.png" alt="editIcon" width="25px" height="25px">
                                                </button>

                                            </form>

                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>

                        </table>
                    </div>

                <?php }else{?>
                        <!-- codigo html caso não exista usuarios cadastrados -->
                        <p class="msgBack">Nenhum usuario cadastrado</p>
                    <?php }
                    
                ?>

                <!-- modal de edição -->
                <?php if(isset($_POST['editar'])): ?>

                <div class="modalDeleteEdit showModal">
                    <p class="modalHeader">Mensagem do sistema</p>
                    <p class="modalMsg">Alterando o usuario <?=$_POST['nome']?></p>

                    <!-- form de edição de usuario -->
                    <form autocomplete="off" class="formLoginEdit" action="process/editUsuario.php" method="POST">

                        <input type="text" name="nome" placeholder="Nome" value="<?=$_POST['nome']?>">
                        <input type="text" name="email" placeholder="Email" value="<?=$_POST['email']?>">

                        <div class="boxSelect left withML">
                        <select class="fontf5" id="tipo" name="tipo">
                            <option value="">Selecione o tipo de usuario</option>
                                <option value="ADM">ADM</option>
                                <option value="CLIENT">CLIENT</option>
                            </select>
                        </div>

                        <input type="password" name="senha" placeholder="Senha">
                        <input type="password" name="confSenha" placeholder="Confirme a senha">
                        <!-- erros de validação serão exibido aqui -->
                        <?php if(isset($_SESSION["ListaErrosEdit"]) && $_SESSION["ListaErrosEdit"] <> []){
                        foreach ($_SESSION["ListaErrosEdit"] as $erro) {
                            echo "<p class='msgErrorEdit'>" . $erro . "</p>";
                        }
                        session_unset();
                        } 
                        ?>
                        <button type="submit" name="editarSim" value="<?=$_POST['editar']?>" id="delete" >Salvar</button>
                        <button type="submit" name="editarNao" value="nao" id="closeModal" value="<?=$usuario['ID']?>">Cancelar</button>
                    </form>
                    
                </div>
                <?php endif; ?>

                <!-- modal que é exibida caso volte erro do back -->
                <?php if(isset($_SESSION['editar'])): ?>
                

                <div class="modalDeleteEdit showModal">
                    <p class="modalHeader">Mensagem do sistema</p>
                    <p class="modalMsg">Alterando o usuario <?=$_SESSION['nome']?></p>

                    <!-- form de edição de usuario -->
                    <form class="formLoginEdit" action="process/editUsuario.php" method="POST">

                        <input type="text" name="nome" placeholder="Nome" value="<?=$_SESSION['nome']?>">
                        <input type="text" name="email" placeholder="Email" value="<?=$_SESSION['email']?>">

                        <div class="boxSelect left withML">
                        <select class="fontf5 withML" id="tipo" name="tipo">
                            <option value="">Selecione o tipo de usuario</option>
                                <option value="ADM">ADM</option>
                                <option value="CLIENT">CLIENT</option>
                            </select>
                        </div>

                        <input type="password" name="senha" placeholder="Senha">
                        <input type="password" name="confSenha" placeholder="Confirme a senha">
                        <!-- erros de validação serão exibido aqui -->
                        <?php if(isset($_SESSION["ListaErrosEdit"]) && $_SESSION["ListaErrosEdit"] <> []){
                        foreach ($_SESSION["ListaErrosEdit"] as $erro) {
                            echo "<p class='msgErrorEdit'>" . $erro . "</p>";
                        }
                        session_unset();
                        } 
                        ?>
                        <button type="submit" name="editarSim" value="" id="delete">Salvar</button>
                        <button type="submit" name="editarNao" value="nao" id="closeModal" value="<?=$usuario['ID']?>">Cancelar</button>
                    </form>

                    
                </div>
                <?php endif; ?>

                <!-- modal de exclusão -->
                <?php if(isset($_POST['excluir'])): ?>
                <div class="modalDelete showModal">
                    <p class="modalHeader">Mensagem do sistema</p>
                    <p class="modalMsg">Deseja realmente excluir o usuario <?=$_POST['nome']?>?</p>

                    <form action="process/deleteUsuario.php" method="POST">
                        <button type="submit" name="excluirSim" value="<?=$_POST['excluir']?>" id="delete" >Sim</button>
                        <button type="submit" name="excluirNao" value="nao" id="closeModal" value="<?=$usuario['ID']?>">Não</button>
                    </form>
                    
                </div>
                <?php endif; ?>
                
            </div>
        </section>

        <!-- modal de logOut -->

        <div id="modLogOut" class="modalDelete dispNone">
            <p class="modalHeader">Mensagem do sistema</p>
            <p class="modalMsg">Deseja realmente sair do sistema?</p>

            <button id="logOutSim">Sim</button>
            <button id="logOutNao">Não</button>
                        
        </div>

        <script src="events.js"></script> 
    </div>   
</body>
</html>