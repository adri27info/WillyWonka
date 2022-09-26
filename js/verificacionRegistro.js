let formularioRegistro = document.getElementById("formularioRegistro");
let usuario = formularioRegistro.usuario;
let correo = formularioRegistro.correo;
let password = formularioRegistro.password;
let inputs = document.getElementsByTagName("input");
let expresiones = {
    usuario: /^[a-zA-ZÀ-ÿ\s]{1,30}$/,
    correo: /^[a-zA-Z0-9_.+-]+@[a-zA-Z0-9-]+\.[a-zA-Z0-9-.]+$/,
    password: /^[a-zA-Z0-9]{4,10}$/
};
let campos = {usuario: false, correo: false, password: false};

window.addEventListener("load", () => {
    asignarEventosInputs();
    formularioRegistro.addEventListener("submit", validarFormularioRegistro);
})


function asignarEventosInputs() {
    for (let input of inputs) {
        input.addEventListener("keyup", validarFormulario);
        input.addEventListener("blur", validarFormulario);
    }
}

function validarFormulario(e) {
    switch(e.target.name) {
        case "usuario":
            validarCampo(expresiones.usuario, e.target.value, "usuario");
            break;
        case "correo":
            validarCampo(expresiones.correo, e.target.value, "correo");
            break;
        case "password":
            validarCampo(expresiones.password, e.target.value, "password");
            break;
    }
}

function validarCampo(expresion, valorInput, campo) {
    let cadena = "contenedor_icono_";
    if (expresion.test(valorInput)) {
        cadena+=campo;
        document.getElementById(""+cadena).style.display = "none";
        cadena = "contenedor_icono_";
        campos[campo] = true;
    }else{
        cadena+=campo;
        document.getElementById(""+cadena).style.display = "block";
        cadena = "contenedor_icono_";
    }
}


function validarFormularioRegistro(e) {
    if (campos.usuario == true && campos.correo == true && campos.password == true) {
        formularioRegistro.submit();
    }else{
        e.preventDefault();
        for (let index = 0; index < formularioRegistro.length; index++) {
            if(formularioRegistro[index].value == "") {
                let nombre = formularioRegistro[index].name;
                document.getElementById("contenedor_icono_"+nombre).style.display = "block";
            }
        }
    }
}