function iniciarApp(){buscador()}function buscador(){document.querySelector("#fecha").addEventListener("input",(function(n){const t=n.target.value;window.location="?fecha="+t}))}document.addEventListener("DOMContentLoaded",(function(){iniciarApp()}));