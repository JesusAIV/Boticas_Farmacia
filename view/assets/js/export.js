
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

function showAlertModal(title, mensaje, icon, button, timeout = 0, callback = null) {

    var logoIcon = "";
    var color = "";

    if (icon == 'warning') {
        logoIcon = '!';
        color = '#F1C40F';
    } else if (icon == 'error') {
        logoIcon = '✖';
        color= '#E74C3C';
    } else if (icon == 'success') {
        logoIcon = '✔';
        color = '#2ECC71';
    }

    // Crear el elemento div con la clase "modal-alert-content"
    var modalAlertContent = document.createElement("div");
    modalAlertContent.className = "modal-alert-content";

    // Crear el elemento div con la clase "modal-alert"
    var modalAlert = document.createElement("div");
    modalAlert.className = "modal-alert";

    // Crear el elemento div con la clase "modal-alert-icon"
    var modalAlertIcon = document.createElement("div");
    modalAlertIcon.className = "modal-alert-icon";
    modalAlertIcon.style.borderColor = color;

    // Crear el elemento div con la clase "alert-icon"
    var alertIcon = document.createElement("div");
    alertIcon.className = "alert-icon";

    // Crear el elemento div con la clase "alert-icon-content" y agregar el texto "!"
    var alertIconContent = document.createElement("div");
    alertIconContent.className = "alert-icon-content";
    alertIconContent.textContent = logoIcon;
    alertIconContent.style.color = color;

    // Agregar el elemento alertIconContent como hijo de alertIcon
    alertIcon.appendChild(alertIconContent);

    // Agregar el elemento alertIcon como hijo de modalAlertIcon
    modalAlertIcon.appendChild(alertIcon);

    // Crear el elemento div con la clase "modal-alert-title"
    var modalAlertTitle = document.createElement("div");
    modalAlertTitle.className = "modal-alert-title";
    modalAlertTitle.textContent = title;

    // Crear el elemento div con la clase "modal-alert-subtitle"
    var modalAlertSubtitle = document.createElement("div");
    modalAlertSubtitle.className = "modal-alert-subtitle";
    modalAlertSubtitle.textContent = mensaje;

    // Crear el elemento div con la clase "modal-alert-accion"
    var modalAlertAccion = document.createElement("div");
    modalAlertAccion.className = "modal-alert-accion";

    // Crear el botón con la clase "modal-alert-button alert-cancel" y el texto "Cancelar"
    var cancelButton = document.createElement("button");
    cancelButton.className = "modal-alert-button alert-cancel";
    cancelButton.textContent = "Cancelar";
    cancelButton.addEventListener('click', closeModal);

    // Crear el botón con la clase "modal-alert-button alert-confirm" y el texto "Confirmar"
    var confirmButton = document.createElement("button");
    confirmButton.className = "modal-alert-button alert-confirm";
    confirmButton.textContent = "Confirmar";

    if (button == true) {
        // Agregar los botones como hijos de modalAlertAccion
        modalAlertAccion.appendChild(cancelButton);
        modalAlertAccion.appendChild(confirmButton);
    }


    // Agregar todos los elementos al DOM
    modalAlert.appendChild(modalAlertIcon);
    modalAlert.appendChild(modalAlertTitle);
    modalAlert.appendChild(modalAlertSubtitle);
    if (button == true) {
        modalAlert.appendChild(modalAlertAccion);
    }
    modalAlertContent.appendChild(modalAlert);

    // Función para cerrar el modal
    function closeModal() {
        var parentElement = modalAlertContent.parentNode;
        if (parentElement) {
            parentElement.removeChild(modalAlertContent);
        }
    }

    // Asignar eventos a los botones
    if (callback) {
        confirmButton.addEventListener('click', function () {
            closeModal();
            callback(true);
        });

        cancelButton.addEventListener('click', function () {
            closeModal();
            callback(false);
        });
    }

    document.body.appendChild(modalAlertContent);

    if (timeout > 0) {
        setTimeout(closeModal, timeout);
    }
}

function obtenerDatosRol(idRol) {
    return $.ajax({
        url: '../view/ajax/gestion.php',
        method: 'POST',
        data: { idRol: idRol, action: 'rolSelect' },
    }).then(function (response) {
        return JSON.parse(response);
    });
}

function obtenerDatosTypeDoc(idTypeDoc) {
    return $.ajax({
        url: '../view/ajax/gestion.php',
        method: 'POST',
        data: { idTypeDoc: idTypeDoc, action: 'TypeDocSelect' },
    }).then(function (response) {
        return JSON.parse(response);
    });
}

function crudProducto() {
    $('.SolicitudAjax').submit(function (e) {
        e.preventDefault();

        var form = $(this);

        var tipo = form.attr('data-form');
        var accion = form.attr('action');
        var metodo = form.attr('method');
        var respuesta = form.children('.RespuestaAjax');

        var formdata = new FormData(this);

        var titleAlerta;
        var textoAlerta;
        if (tipo === "add") {
            titleAlerta = "¿Seguro que desea editar?";
            textoAlerta = "Verifique bien los datos antes de confirmar";
        } else if (tipo == "delete") {
            titleAlerta = "¿Seguro que desea eliminar?";
            textoAlerta = "Verifique bien los datos antes de confirmar";
        } else if (tipo === "update") {
            titleAlerta = "¿Seguro que desea actualizar?";
            textoAlerta = "Verifique bien los datos antes de confirmar";
        } else {
            titleAlerta = "¿Seguro que desea realizar la solicitud?";
            textoAlerta = "Verifique bien los datos antes de confirmar";
        }

        showAlertModal(
            titleAlerta,
            textoAlerta,
            'warning',
            true,
            0,
            function (confirmado) {
                if (confirmado) {
                    mostrarSpinner()
                    $.ajax({
                        type: metodo,
                        url: accion,
                        data: formdata ? formdata : form.serialize(),
                        cache: false,
                        contentType: false,
                        processData: false,
                        success: function (data) {
                            ocultarSpinner()
                            respuesta.html(data);
                        }
                    });
                }
            }
        );
    });
}
