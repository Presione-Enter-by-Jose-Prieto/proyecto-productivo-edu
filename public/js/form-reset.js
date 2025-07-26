// Función para manejar el reset del formulario
document.addEventListener('DOMContentLoaded', function() {
    // Agregar manejador de eventos para el botón de reset
    const resetButtons = document.querySelectorAll('button[type="reset"]');
    
    resetButtons.forEach(button => {
        button.addEventListener('click', function() {
            // Esperar a que el reset estándar del formulario se complete
            setTimeout(() => {
                const form = button.closest('form');
                if (form) {
                    // Limpiar inputs de archivo
                    const fileInputs = form.querySelectorAll('input[type="file"]');
                    fileInputs.forEach(input => {
                        // Limpiar el valor del input file
                        input.value = '';
                        
                        // Limpiar la previsualización de la imagen si existe
                        const preview = document.getElementById('image-preview');
                        if (preview) {
                            preview.style.display = 'none';
                            preview.src = '#';
                        }
                        
                        // Disparar evento de cambio
                        input.dispatchEvent(new Event('change'));
                    });
                }
            }, 0);
        });
    });
});
