function agregarFila() {
    var tabla = document.getElementById("tabla_productos");
    var fila = tabla.insertRow(tabla.rows.length);
    
    var celdaProducto = fila.insertCell(0);
    var celdaCantidad = fila.insertCell(1);
    var celdaPrecio = fila.insertCell(2);
    var celdaSubtotal = fila.insertCell(3);
    
    celdaProducto.innerHTML = '<input type="text" class="producto">';
    celdaCantidad.innerHTML = '<input type="number" class="cantidad">';
    celdaPrecio.innerHTML = '<input type="number" class="precio">';
    celdaSubtotal.innerHTML = '<input type="number" class="subtotal" readonly>';
    
    // Asignar evento para calcular el subtotal al cambiar la cantidad o el precio
    celdaCantidad.firstChild.addEventListener("change", calcularSubtotal);
    celdaPrecio.firstChild.addEventListener("change", calcularSubtotal);
}

function calcularSubtotal() {
    var fila = this.parentNode.parentNode;
    var cantidad = fila.querySelector(".cantidad").value;
    var precio = fila.querySelector(".precio").value;
    var subtotal = cantidad * precio;
    
    fila.querySelector(".subtotal").value = subtotal;
    calcularTotal();
}

function calcularTotal() {
    var subtotales = document.getElementsByClassName("subtotal");
    var total = 0;
    
    for (var i = 0; i < subtotales.length; i++) {
        total += parseFloat(subtotales[i].value);
    }
    
    document.getElementById("total").value = total;
}

function generarFactura() {
    var nombreCliente = document.getElementById("nombre_cliente").value;
    var total = document.getElementById("total").value;
    
    // Aquí se realizaría la lógica para generar la factura electrónica
    
    // Mostrar la factura generada
    document.getElementById("factura_generada").style.display = "block";
    document.getElementById("factura_generada").innerHTML = "<h2>Fact
