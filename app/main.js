
fetch('usuarios.php')
    .then(function (respuesta) {
        console.log("Se completo la solicitud")
        console.log(respuesta)
        return respuesta.json()
    })
    .then(function (respuesta) {
        console.info(respuesta);
    })