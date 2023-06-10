(function () {
    // Obtener la referencia a la tabla
    var tablaUsuarios = document.getElementById("table_usuarios");

    // Agregar evento de clic a los botones "ver"
    tablaUsuarios.addEventListener("click", function (event) {
        if (event.target.classList.contains("accion-ver_usuarios")) {
            var fila = event.target.closest("tr");
            var dataId = fila.getAttribute("data-id");
            obtenerDetalles(dataId);
        }
    });

    // Función para obtener los datos del usuario mediante AJAX
    function obtenerDetalles(id) {
        const xhr = new XMLHttpRequest();

        // Mostrar el spinner antes de enviar la petición
        mostrarSpinner();

        xhr.open('POST', '../view/ajax/gestion.php', true);
        xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        xhr.onreadystatechange = function () {
            if (xhr.readyState === 4 && xhr.status === 200) {
                const datos = JSON.parse(xhr.responseText);
                mostrarUsuarioModal(datos);
                // Ocultar el spinner después de recibir la respuesta
                ocultarSpinner();
            }
        };
        // Construir los datos a enviar
        const data = 'id=' + id + '&action=' + encodeURIComponent('viewUser');

        xhr.send(data);
    }


    // Función para mostrar los datos del usuario en el modal
    function mostrarUsuarioModal(user) {
        // Crear el elemento 'div' con la clase 'modal'
        var modalDiv = document.createElement('div');
        modalDiv.classList.add('modal');

        // Crear el elemento 'div' con la clase 'modal-content'
        var modalContentDiv = document.createElement('div');
        modalContentDiv.classList.add('modal-content');

        // Crear el elemento 'div' con la clase 'modal-header'
        var modalHeaderDiv = document.createElement('div');
        modalHeaderDiv.classList.add('modal-header');

        // Crear el elemento 'h3' con la clase 'modal-title' y agregar el texto 'Visualizar Usuario'
        var modalTitle = document.createElement('h3');
        modalTitle.classList.add('modal-title');
        modalTitle.textContent = 'Visualizar Usuario';

        // Crear el elemento 'button' con la clase 'modal-close' y agregar el texto 'X'
        var modalCloseButton = document.createElement('button');
        modalCloseButton.classList.add('modal-close');
        modalCloseButton.textContent = 'X';

        // Agregar un controlador de eventos para cerrar el modal y reiniciar los valores
        modalCloseButton.addEventListener('click', function () {
            // Eliminar el modal del DOM
            modalDiv.remove();

            // Reiniciar los valores de los campos de entrada
            modalInputID.value = '';
            modalInputRol.value = '';
            modalInputNombreUsuario.value = '';
            modalInputTipoDocumento.value = '';
            modalInputNumeroDocumento.value = '';
            modalInputNombre.value = '';
            modalInputApellido.value = '';
            modalInputCorreo.value = '';
            modalInputTelefono.value = '';
        });

        // Agregar el elemento 'h3' y el elemento 'button' al elemento 'div' con la clase 'modal-header'
        modalHeaderDiv.appendChild(modalTitle);
        modalHeaderDiv.appendChild(modalCloseButton);

        // Crear el elemento 'div' con la clase 'modal-body'
        var modalBodyDiv = document.createElement('div');
        modalBodyDiv.classList.add('modal-body');

        // Crear los elementos de contenido y etiquetas para el cuerpo del modal
        var modalBodyContentDiv1 = document.createElement('div');
        modalBodyContentDiv1.classList.add('modal-body-content');

        var modalBodyInputDiv1 = document.createElement('div');
        modalBodyInputDiv1.classList.add('modal-body-input');

        var modalLabelFoto = document.createElement('label');
        modalLabelFoto.classList.add('modal-label', 'modal-label-foto');
        modalLabelFoto.textContent = 'Foto';

        var modalImgPerfilDiv = document.createElement('div');
        modalImgPerfilDiv.classList.add('modal-img-perfil');

        var modalImg = document.createElement('img');
        modalImg.src = 'https://avatars.githubusercontent.com/u/90335295?v=4';
        modalImg.alt = '';
        modalImg.classList.add('modal-img');

        var modalInputHidden = document.createElement('input');
        modalInputHidden.value = user[0].id;
        modalInputHidden.type = 'hidden';
        modalInputHidden.classList.add('modal-input');
        modalInputHidden.readOnly = true;

        modalImgPerfilDiv.appendChild(modalImg);
        modalBodyInputDiv1.appendChild(modalLabelFoto);
        modalBodyInputDiv1.appendChild(modalImgPerfilDiv);
        modalBodyInputDiv1.appendChild(modalInputHidden);
        modalBodyContentDiv1.appendChild(modalBodyInputDiv1);

        var modalBodyInputGrid = document.createElement('div');
        modalBodyInputGrid.classList.add('modal-body-input');

        var modalBodyInputDiv2 = document.createElement('div');
        modalBodyInputDiv2.classList.add('modal-body-input');

        var modalLabelID = document.createElement('label');
        modalLabelID.classList.add('modal-label');
        modalLabelID.textContent = 'ID';

        var modalInputID = document.createElement('input');
        modalInputID.value = user[0].id;
        modalInputID.type = 'text';
        modalInputID.classList.add('modal-input');
        modalInputID.readOnly = true;

        modalBodyInputDiv2.appendChild(modalLabelID);
        modalBodyInputDiv2.appendChild(modalInputID);
        modalBodyInputGrid.appendChild(modalBodyInputDiv2);

        var modalBodyInputDiv3 = document.createElement('div');
        modalBodyInputDiv3.classList.add('modal-body-input');

        var modalLabelRol = document.createElement('label');
        modalLabelRol.classList.add('modal-label');
        modalLabelRol.textContent = 'Rol';

        var modalInputRol = document.createElement('input');
        modalInputRol.value = user[0].rol;
        modalInputRol.type = 'text';
        modalInputRol.classList.add('modal-input');
        modalInputRol.readOnly = true;

        modalBodyInputDiv3.appendChild(modalLabelRol);
        modalBodyInputDiv3.appendChild(modalInputRol);
        modalBodyInputGrid.appendChild(modalBodyInputDiv3);

        var modalBodyInputDiv4 = document.createElement('div');
        modalBodyInputDiv4.classList.add('modal-body-input');

        var modalLabelNombreUsuario = document.createElement('label');
        modalLabelNombreUsuario.classList.add('modal-label');
        modalLabelNombreUsuario.textContent = 'Nombre de usuario';

        var modalInputNombreUsuario = document.createElement('input');
        modalInputNombreUsuario.value = user[0].userName;
        modalInputNombreUsuario.type = 'text';
        modalInputNombreUsuario.classList.add('modal-input');
        modalInputNombreUsuario.readOnly = true;

        modalBodyInputDiv4.appendChild(modalLabelNombreUsuario);
        modalBodyInputDiv4.appendChild(modalInputNombreUsuario);
        modalBodyInputGrid.appendChild(modalBodyInputDiv4);

        modalBodyContentDiv1.appendChild(modalBodyInputGrid);
        modalBodyDiv.appendChild(modalBodyContentDiv1);

        var modalBodyContentDiv2 = document.createElement('div');
        modalBodyContentDiv2.classList.add('modal-body-content');

        var modalBodyInputDiv5 = document.createElement('div');
        modalBodyInputDiv5.classList.add('modal-body-input');

        var modalLabelTipoDocumento = document.createElement('label');
        modalLabelTipoDocumento.classList.add('modal-label');
        modalLabelTipoDocumento.textContent = 'Tipo de documento';

        var modalInputTipoDocumento = document.createElement('input');
        modalInputTipoDocumento.value = user[0].typeDoc + ' (' + user[0].abbreviation + ')';
        modalInputTipoDocumento.type = 'text';
        modalInputTipoDocumento.classList.add('modal-input');
        modalInputTipoDocumento.readOnly = true;

        modalBodyInputDiv5.appendChild(modalLabelTipoDocumento);
        modalBodyInputDiv5.appendChild(modalInputTipoDocumento);
        modalBodyContentDiv2.appendChild(modalBodyInputDiv5);

        var modalBodyInputDiv6 = document.createElement('div');
        modalBodyInputDiv6.classList.add('modal-body-input');

        var modalLabelNumeroDocumento = document.createElement('label');
        modalLabelNumeroDocumento.classList.add('modal-label');
        modalLabelNumeroDocumento.textContent = 'Número de documento';

        var modalInputNumeroDocumento = document.createElement('input');
        modalInputNumeroDocumento.value = user[0].numDoc;
        modalInputNumeroDocumento.type = 'text';
        modalInputNumeroDocumento.classList.add('modal-input');
        modalInputNumeroDocumento.readOnly = true;

        modalBodyInputDiv6.appendChild(modalLabelNumeroDocumento);
        modalBodyInputDiv6.appendChild(modalInputNumeroDocumento);
        modalBodyContentDiv2.appendChild(modalBodyInputDiv6);

        modalBodyDiv.appendChild(modalBodyContentDiv2);

        var modalBodyContentDiv3 = document.createElement('div');
        modalBodyContentDiv3.classList.add('modal-body-content');

        var modalBodyInputDiv7 = document.createElement('div');
        modalBodyInputDiv7.classList.add('modal-body-input');

        var modalLabelNombre = document.createElement('label');
        modalLabelNombre.classList.add('modal-label');
        modalLabelNombre.textContent = 'Nombre';

        var modalInputNombre = document.createElement('input');
        modalInputNombre.value = user[0].name;
        modalInputNombre.type = 'text';
        modalInputNombre.classList.add('modal-input');
        modalInputNombre.readOnly = true;

        modalBodyInputDiv7.appendChild(modalLabelNombre);
        modalBodyInputDiv7.appendChild(modalInputNombre);
        modalBodyContentDiv3.appendChild(modalBodyInputDiv7);

        var modalBodyInputDiv8 = document.createElement('div');
        modalBodyInputDiv8.classList.add('modal-body-input');

        var modalLabelApellido = document.createElement('label');
        modalLabelApellido.classList.add('modal-label');
        modalLabelApellido.textContent = 'Apellido';

        var modalInputApellido = document.createElement('input');
        modalInputApellido.value = user[0].lastName;
        modalInputApellido.type = 'text';
        modalInputApellido.classList.add('modal-input');
        modalInputApellido.readOnly = true;

        modalBodyInputDiv8.appendChild(modalLabelApellido);
        modalBodyInputDiv8.appendChild(modalInputApellido);
        modalBodyContentDiv3.appendChild(modalBodyInputDiv8);

        modalBodyDiv.appendChild(modalBodyContentDiv3);

        var modalBodyContentDiv4 = document.createElement('div');
        modalBodyContentDiv4.classList.add('modal-body-content');

        var modalBodyInputDiv9 = document.createElement('div');
        modalBodyInputDiv9.classList.add('modal-body-input');

        var modalLabelCorreo = document.createElement('label');
        modalLabelCorreo.classList.add('modal-label');
        modalLabelCorreo.textContent = 'Correo';

        var modalInputCorreo = document.createElement('input');
        modalInputCorreo.value = user[0].email;
        modalInputCorreo.type = 'text';
        modalInputCorreo.classList.add('modal-input');
        modalInputCorreo.readOnly = true;

        modalBodyInputDiv9.appendChild(modalLabelCorreo);
        modalBodyInputDiv9.appendChild(modalInputCorreo);
        modalBodyContentDiv4.appendChild(modalBodyInputDiv9);

        var modalBodyInputDiv10 = document.createElement('div');
        modalBodyInputDiv10.classList.add('modal-body-input');

        var modalLabelTelefono = document.createElement('label');
        modalLabelTelefono.classList.add('modal-label');
        modalLabelTelefono.textContent = 'Teléfono';

        var modalInputTelefono = document.createElement('input');
        modalInputTelefono.value = user[0].telephone;
        modalInputTelefono.type = 'text';
        modalInputTelefono.classList.add('modal-input');
        modalInputTelefono.readOnly = true;

        modalBodyInputDiv10.appendChild(modalLabelTelefono);
        modalBodyInputDiv10.appendChild(modalInputTelefono);
        modalBodyContentDiv4.appendChild(modalBodyInputDiv10);

        modalBodyDiv.appendChild(modalBodyContentDiv4);

        // Agregar el elemento 'div' con la clase 'modal-header' al elemento 'div' con la clase 'modal-content'
        modalContentDiv.appendChild(modalHeaderDiv);

        // Agregar el elemento 'div' con la clase 'modal-body' al elemento 'div' con la clase 'modal-content'
        modalContentDiv.appendChild(modalBodyDiv);

        // Agregar el elemento 'div' con la clase 'modal-content' al elemento 'div' con la clase 'modal'
        modalDiv.appendChild(modalContentDiv);

        // Agregar el elemento 'div' con la clase 'modal' al documento
        document.body.appendChild(modalDiv);

    }

    function mostrarSpinner() {
        const spinnerOverlay = document.createElement('div');
        spinnerOverlay.id = 'loading-spinner';
        spinnerOverlay.className = 'spinner-overlay';

        const spinner = document.createElement('div');
        spinner.id = 'spinner';
        spinner.className = 'spinner';

        spinnerOverlay.appendChild(spinner);
        document.body.appendChild(spinnerOverlay);
    }

    function ocultarSpinner() {
        const spinnerOverlay = document.getElementById('loading-spinner');
        document.body.removeChild(spinnerOverlay);
    }

})();