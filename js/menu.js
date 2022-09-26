
let imagenHamburguesa = document.getElementById("imagenHamburguesa");
let contenidoHamburguesa = document.getElementById("contenidoHamburguesa");
let contenedorGeneral = document.getElementById("contenedorGeneral");

window.addEventListener("load", () => {
    abrirMenuHamburguesa();
    setInterval(() => {
        cerrarMenuHamburguesa();
    },500)
})


function abrirMenuHamburguesa() {
    imagenHamburguesa.addEventListener("click", () => {
        if (contenidoHamburguesa.style.display == "none") {
            contenidoHamburguesa.style.display = "flex";
            contenidoHamburguesa.style.flexWrap = "wrap";
            contenidoHamburguesa.style.flexDirection = "column";
            contenidoHamburguesa.style.justifyContent = "center";
            contenidoHamburguesa.style.alignItems  = "center";
        }else{
            contenidoHamburguesa.style.display = "none";
        }
    })
}


function cerrarMenuHamburguesa() {
    if (contenedorGeneral.offsetWidth >=540) {
        contenidoHamburguesa.style.display = "none";
    }
}