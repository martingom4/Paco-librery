// Esperar a que el DOM esté completamente cargado antes de ejecutar el código
document.addEventListener("DOMContentLoaded", () => {
    // Delegación de eventos para los botones "+" y "-"
    document.addEventListener("click", function (e) {
        // Verificar si el clic fue en un botón con la clase "quantity-btn"
        if (e.target.classList.contains("quantity-btn")) {
            // Buscar el input asociado en el mismo contenedor
            const input = e.target.closest(".quantity-wrapper").querySelector(".quantity-input");
            if (!input) {
                console.error("No se encontró el input dentro del wrapper.");
                return;
            }

            // Obtener el valor actual del input
            let currentValue = parseInt(input.value) || 1;

            // Incrementar o decrementar según el botón presionado
            if (e.target.classList.contains("plus")) {
                input.value = currentValue + 1; // Incrementar
            }

            if (e.target.classList.contains("minus")) {
                if (currentValue > 1) {
                    input.value = currentValue - 1; // Decrementar (mínimo 1)
                }
            }
        }
    });
});



