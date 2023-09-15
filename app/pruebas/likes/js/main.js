function publicaciones() {
	const query =
		"SELECT * FROM t_publicaciones INNER JOIN t_usuarios ON t_publicaciones.id_usuario = t_usuarios.id_usuario ORDER BY id_publicacion DESC";

	const formData = new FormData();
	formData.append("query", query);
	return fetch("./php/traerPublicaciones.php", {
		method: "POST",
		body: formData,
	})
		.then((response) => response.text())
		.then((data) => {
			document.querySelector(".publicacion").innerHTML = data;
		})
		.catch((error) => {
			console.error("Error:", error);
		});
}

function seleccionarBotonesLike() {
	const botonesLike = document.querySelectorAll(".btn-like");
	console.log(botonesLike);
	botonesLike.forEach((boton) => {
		boton.addEventListener("click", function () {
			const publicacion = this.closest(".publicacion");
			const idPublicacion = publicacion.getAttribute("data-id");
			const liked = publicacion.getAttribute("data-liked") === "true";
			// Hacemos la solicitud al servidor para dar/quitar el like
			fetch("./php/like.php", {
				// metodo POST
				method: "POST",
				// en el cuerpo le pasamos el id de la publicacion
				// y el like negado
				// osea que si ya tenia like se lo sacamos y si no, le damos like
				body: JSON.stringify({
					id: idPublicacion,
					liked: !liked,
				}),
				headers: {
					"Content-Type": "application/json",
				},
			})
				.then((response) => response.json())
				.then((data) => {
					// Actualizamos la "pagina" según la respuesta
					if (data.success) {
						console.log(data);
						publicacion.setAttribute("data-liked", data.liked);
						const conteoLikes = publicacion.querySelector(".conteo-likes");
						conteoLikes.textContent = data.likes;
					} else {
						alert("Error al procesar la solicitud");
					}
				})
				.catch((error) => {
					console.error("Error:", error);
				});
		});
	});
}

document.addEventListener("DOMContentLoaded", function () {
	publicaciones().then(() => {
		seleccionarBotonesLike();
	});
});
