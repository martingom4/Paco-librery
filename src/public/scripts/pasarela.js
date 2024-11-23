// JavaScript para validaciones y formateo
document.addEventListener('DOMContentLoaded', () => {
    const form = document.getElementById('payment-form');
    const cardNumberInput = document.getElementById('card-number');
    const expiryInput = document.getElementById('card-expiry');
    const cvcInput = document.getElementById('card-cvc');

    // Validación y formateo
    cardNumberInput.addEventListener('input', () => {
        cardNumberInput.value = cardNumberInput.value
            .replace(/\D/g, '') // Solo números
            .replace(/(\d{4})/g, '$1 ') // Espacios cada 4 dígitos
            .trim();
    });

    form.addEventListener('submit', (e) => {
        e.preventDefault();

        // Validación simple de formato
        const expiryRegex = /^(0[1-9]|1[0-2])\/\d{2}$/;
        if (!expiryRegex.test(expiryInput.value)) {
            alert('Fecha de expiración inválida. Use el formato MM/AA.');
            return;
        }

        if (!/^\d{3}$/.test(cvcInput.value)) {
            alert('CVC inválido. Debe contener 3 dígitos.');
            return;
        }

        // Aquí puedes agregar la lógica para enviar los datos al servidor
        form.submit();
    });
});
