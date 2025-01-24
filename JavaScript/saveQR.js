"use strict";

document.getElementById('save').addEventListener('click', function() {
    // Obtener la imagen generada
    var qrImage = document.querySelector('#qrImage img');
    
    // Crear un enlace temporal para descargar la imagen
    var link = document.createElement('a');
    link.href = qrImage.src;  // Usar la src de la imagen
    link.download = 'codigo_qr.png';  // Nombre del archivo
    link.click();  // Activar la descarga
});
