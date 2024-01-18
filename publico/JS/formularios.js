 // Función para cambiar la visibilidad del formulario y agregar/quitar clase active
 function toggleForm(formId) {
    var form = document.getElementById(formId);
    
    // Cambia la clase active basándose en el estado actual de visibilidad del formulario
    if (form.style.display === 'none' || form.style.display === '') {
        form.style.display = 'block';
        document.querySelector("h6[onclick='toggleForm(\"" + formId + "\")']").classList.add('active');
    } else {
        form.style.display = 'none';
        document.querySelector("h6[onclick='toggleForm(\"" + formId + "\")']").classList.remove('active');
    }
}