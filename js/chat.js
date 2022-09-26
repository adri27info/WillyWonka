let iconoChat = document.getElementById("iconoChat");
let chat = document.getElementById("chat");
let contenedorChat = document.getElementById("contenedorChat");
let mensajeChat = document.getElementById("mensajeChat");
let btnEnviar = document.getElementById("btnEnviar");
let selectorEstado = document.getElementById("selectorEstado");
let imagenPerfil = document.getElementById("imagenPerfil");
let spanMensajeChat = document.getElementById("spanMensajeChat");


window.addEventListener("load", () => {
    selectorEstado.addEventListener("change", actualizarEstadoUsuario);
    iconoChat.addEventListener("click", abrirChat);
    btnEnviar.addEventListener("click", enviarMensaje);
    cerrarContenedorCookie();
})

function cerrarContenedorCookie() {
    if (document.body.contains(document.getElementById("imagenCruzCookie"))) {
        let imagenCruzCookie = document.getElementById("imagenCruzCookie");
        imagenCruzCookie.addEventListener("click", () => {
            let cookie = document.getElementById("cookie");
            cookie.style.display = "none";
        })
    }
}

function comprobarMensajeChat() {
    let comandos = { 
        "!ayuda" : '!ayuda',
        "!ajustes" : '!ajustes',
        "!puntos" : "!puntos",
        "!chocolates" : "!chocolates",
        "!golosinas" : "!golosinas",
        "!caramelos" : "!caramelos",
        "!nubes" : "!nubes",
        "!regalizes" : "!regalizes",
        "!chicles" : "!chicles",
        "!aperitivos" : "!aperitivos",
    };
    let semaforo = false;
    for (const key in comandos) {
        if (mensajeChat.value == comandos[key]) {
            semaforo = true;
            break;
        }
    }
    return semaforo;
}

async function actualizarEstadoUsuario() {
    let location = JSON.stringify(window.location);
    let cadena = location.search("paginas");
    try{
        let pagina = "";
        let url = cadena != -1 ? pagina = "../" : pagina = "";
        const res = await fetch(pagina + 'recursos/api.php?actualizar', {
            method: 'POST',
            body: JSON.stringify({ valor: selectorEstado.value }),
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json'
            }
        });
        const data = await res.json();
        if (data.update == "Conectado") {
            selectorEstado.value = "Conectado";
            imagenPerfil.style.border = "3px solid green";
        }else if (data.update == "Desconectado") {
            selectorEstado.value = "Desconectado";
            imagenPerfil.style.border = "3px solid silver";
        }
    }catch(error){
        console.log(error)
    }
}

async function enviarMensaje() {
    let location = JSON.stringify(window.location);
    let cadena = location.search("paginas");
    let valorSelect = selectorEstado.value;
    if (valorSelect == "Conectado") {
        spanMensajeChat.style.display = "none";
        if (comprobarMensajeChat()){
            const comando = mensajeChat.value.replace(/!/gi, "");
            try{
                let pagina = "";
                let url = cadena != -1 ? pagina = "../" : pagina = "";
                const res = await fetch(pagina +'recursos/api.php?mensajeChat', {
                    method: 'POST',
                    body: JSON.stringify({comando : "!"+comando}),
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json'
                    }
                });
                const data = await res.json();
                contenedorChat.value = "Ratchet: Debes hacer click en " + data.comando;
            }catch(error){
                console.log(error)
            }
        }
    }else{
        spanMensajeChat.style.display = "block";
    }
    mensajeChat.value = "";
}

async function abrirChat() {
    let location = JSON.stringify(window.location);
    let cadena = location.search("paginas");
    if (chat.style.display == "none") {
        chat.style.display = "block";
        try{
            let pagina = "";
            let url = cadena != -1 ? pagina = "../" : pagina = "";
            const res = await fetch(pagina + 'recursos/api.php?mensajeChatBienvenida', {
                method: 'GET',
                headers: {'Accept': 'application/json'}
            });
            const data = await res.json();
            contenedorChat.value = "Ratchet: " + data.comandoAyuda;
        }catch(error){
            console.log(error)
        }
    }else{
        chat.style.display = "none";
        contenedorChat.value = "";
    }
}

