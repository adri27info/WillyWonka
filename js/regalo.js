let container = document.getElementById("container");
let contenedorRegalo = document.getElementById("contenedorRegalo");
let btnConfirmar = document.getElementById("btnConfirmar");
let contenedorPadre =  document.getElementById("contenedorGeneral");

window.addEventListener("load", () => {
    moverContenedorRegalo();
    btnConfirmar.addEventListener("click", cerrarContenedorRegalo);
})


function moverContenedorRegalo() {
    if (document.body.contains(document.getElementById("container"))) {
        contenedorPadre.style.opacity = 0.2;
        $(contenedorRegalo).animate({
            left: $(contenedorRegalo).parent().width() / 2 - $(contenedorRegalo).width() / 2
        }, 2000);
    } 
}


function cerrarContenedorRegalo() {
    container.style.display = "none";
    contenedorPadre.style.opacity = 1;
}

