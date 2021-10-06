<?php
    include_once("templates/header.php");
    // armazena o id do usuario
    if(isset($_SESSION['usuario']) && $_SESSION['usuario'] <> ""){
       $nome = $_SESSION['usuario'][0]['NOME'];
    }else{
        // redireciona para a home caso tente acessar sem ter logado
        header("Location:" . $url);
    }
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
                <img class="logoMenuImg" src="img/logoMenu.png" alt="">
                
            </p>

            <nav>
                <ul>
                    <a href="<?=$url?>/home.php"><li id="btnHome">Home</li></a>
                    <a href="<?=$url?>/usuarios.php"><li id="btnUsuarios">Usuarios</li></a>
                    <a href="<?=$url?>/cadastros.php"><li id="btnCadastros">Cadastros</li></a>
                    <a><li id="logOut">Sair</li></a>

                </ul>
            </nav>
        </aside>
        
        <section>
            <div class="mainContent">
                
                <div class="welcomeBox">
                    <p>Olá <?=$nome?></p>
                </div> 
                

                <div class="paragraphBox">
                    <p class="paragraphBoxTitle">Lorem ipsum dolor sit amet consectetur</p><br><br> 
                    <p class="paragraphBoxTxt">
                        Adipisicing elit. Dignissimos, perspiciatis vero ducimus voluptatibus quisquam suscipit repellendus tenetur qui esse in ab magni dolor mollitia, recusandae consectetur, voluptatum commodi! Aliquid, impedit.
                        Adipisicing elit. 
                    </p>
                    </div>

                
                
            </div>
            <article>
                <div class="cards">
                    <div class="cardBox">
                        <div class="imgCard card1">
                            <p class="cardTitleBox">Desing UX/UI</p>
                        </div>
                        <p class="cardTitle t1">Lorem ipsum</p>
                        <p class="cardsText">Lorem ipsum dolor sit amet consectetur adipisicing elit. <br>
                            Earum dolores vitae neque.</p>
                    </div>
                    <div class="cardBox">
                        <div class="imgCard card2">
                            <p class="cardTitleBox">Desenvolvimento</p>
                        </div>
                        <p class="cardTitle t2">Lorem ipsum</p>
                        <p class="cardsText">Lorem ipsum dolor sit amet consectetur adipisicing elit. <br> 
                            Earum dolores vitae neque.</p>
                    </div>
                    <div class="cardBox">
                        <div class="imgCard card3">
                            <p class="cardTitleBox">Projetos</p>
                        </div>
                        <p class="cardTitle t3">Lorem ipsum</p>
                        <p class="cardsText" >Lorem ipsum dolor sit amet consectetur adipisicing elit. <br>
                            Earum dolores vitae neque.</p>
                    </div>
                </div>
            </article>

            <article>
                <div class="footer">
                    <div class="footerBox">
                        <div class="footerImg">
                            <img class="iconSocial" src="img/fb.png" alt="">
                            <img class="iconSocial" src="img/zap.png" alt="">
                            <img class="iconSocial" src="img/inst.png" alt="">
                            <img class="iconSocial" src="img/twi.png" alt="">
                        </div>
                    </div>
                </div>
            </article>
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