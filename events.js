/* Menu hamburguer show */
let btnHam = document.querySelector("#btnHam");
let menu = document.querySelector("#menu");

function showMenu(){
    menu.classList.toggle("showMenu");
    btnHam.classList.toggle("attHam");
}

btnHam.addEventListener("click", showMenu);

// evento de modal logOut confirmação
let btnLogOut = document.querySelector("#logOut");
let divLogOut = document.querySelector("#modLogOut");
let logOutSim = document.querySelector("#logOutSim");
let logOutNao = document.querySelector("#logOutNao");


function modLogOut(){
    divLogOut.classList.toggle("dispShow");

}


logOutSim.addEventListener("click", function(){
    // local
    // window.location.href = "http://localhost/public_html/process/logOut.php"; //

    
    window.location.href = "http://bixozo.com.br/process/logOut.php";
    
});

logOutNao.addEventListener("click", function(){
    divLogOut.classList.toggle("dispShow");
});

btnLogOut.addEventListener("click", modLogOut);








