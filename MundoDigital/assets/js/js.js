// ------------------Mostrar o carinho de compras-------------------
let carinho = document.querySelector(".carinho");
document.querySelector("#cart").onclick = () => {
carinho.classList.toggle('active');

login.classList.remove('active');
favorito.classList.remove('active');
}


// ------------------Mostrar o login-------------------
let login = document.querySelector(".login-form");
document.querySelector("#login").onclick = () =>{
login.classList.toggle('active');

carinho.classList.remove('active');
favorito.classList.remove('active');

  } 

  // ------------------Mostrar os favoritos-------------------
let favorito = document.querySelector(".favoritos");
document.querySelector("#favorito").onclick = () =>{
  favorito.classList.toggle('active');
  login.classList.remove('active');
  carinho.classList.remove('active');

  } 
