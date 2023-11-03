document.addEventListener('DOMContentLoaded', () => {
    const itemForm = document.getElementById('itemForm');

    if (itemForm) {
        itemForm.addEventListener('submit', (event) => {
            event.preventDefault();

            const nombre = document.getElementById('nombre').value;
            const descripcion = document.getElementById('descripcion').value;

            // Crear un objeto que contenga los datos a enviar
            const formData = {
                nombre: nombre,
                descripcion: descripcion
            };

            // Mostrar una carga o indicador de procesamiento
            mostrarCarga();

            // Realizar una solicitud POST utilizando Fetch API
            fetch('/tu_ruta_de_api', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify(formData)
            })
            .then(response => {
                if (response.ok) {
                    return response.json();
                }
                throw new Error('Error en la solicitud.');
            })
            .then(data => {
                // Ocultar la carga
                ocultarCarga();

                // Realizar acciones basadas en la respuesta del servidor
                console.log('Respuesta del servidor:', data);

                // Limpiar el formulario después de un registro exitoso
                itemForm.reset();

                // Puedes redirigir al usuario a otra página si es necesario
                // window.location.href = '/otra_pagina.html';

                // Mostrar un mensaje de éxito al usuario
                mostrarMensaje('Registro exitoso');
            })
            .catch(error => {
                // Ocultar la carga en caso de error
                ocultarCarga();

                console.error('Error:', error);

                // Mostrar un mensaje de error al usuario
                mostrarMensaje('Error al procesar la solicitud');
            });
        });
    }
});

function mostrarCarga() {
    // Implementa la lógica para mostrar una carga o indicador de procesamiento
    // Puedes mostrar una animación, un mensaje o cualquier otra indicación visual
}

function ocultarCarga() {
    // Implementa la lógica para ocultar la carga después de completar la solicitud
}

function mostrarMensaje(mensaje) {
    // Implementa la lógica para mostrar un mensaje al usuario
    // Puedes usar un elemento HTML para mostrar el mensaje o una ventana modal
}
