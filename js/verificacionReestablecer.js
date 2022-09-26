let formularioReestablecer = document.getElementById("formularioReestablecer");
let correo = formularioReestablecer.correo;
let inputs = document.getElementsByTagName("input");
let expresiones = {
    correo: /^[a-zA-Z0-9_.+-]+@[a-zA-Z0-9-]+\.[a-zA-Z0-9-.]+$/
};
let campos = {correo: false};

window.addEventListener("load", () => {
    asignarEventosInputs();
    formularioReestablecer.addEventListener("submit", validarFormularioReestablecer);
})


function asignarEventosInputs() {
    for (let input of inputs) {
        input.addEventListener("keyup", validarFormulario);
        input.addEventListener("blur", validarFormulario);
    }
}

function validarFormulario(e) {
    switch(e.target.name) {
        case "correo":
            validarCampo(expresiones.correo, e.target.value, "correo");
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


function validarFormularioReestablecer(e) {
    if (campos.correo == true) {
        formularioReestablecer.submit();
    }else{
        e.preventDefault();
        for (let index = 0; index < formularioReestablecer.length; index++) {
            if(formularioReestablecer[index].value == "") {
                let nombre = formularioReestablecer[index].name;
                document.getElementById("contenedor_icono_"+nombre).style.display = "block";
            }
        }
    }
}