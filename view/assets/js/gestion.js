(function () {

    let accion;


    // Obtener la referencia a la tabla
    var tablaUsuarios = document.getElementById("table_usuarios");

    $(document).ready(function () {
        imagenPrevia();

        document.querySelector('.btn-accion-add').addEventListener("click", () => {
            accion = '';
            accion = 'agregar';
            dataId = null
            obtenerDetalles(dataId, accion);
        })

    });

    if (tablaUsuarios != null) {
        tablaUsuarios.addEventListener("click", function (event) {
            if (event.target.classList.contains("accion-ver_usuarios")) {
                var fila = event.target.closest("tr");
                var dataId = fila.getAttribute("data-id");
                accion = '';
                accion = 'ver';
                obtenerDetalles(dataId, accion);
            } else if (event.target.classList.contains("accion-editar_usuarios")) {
                var fila = event.target.closest("tr");
                var dataId = fila.getAttribute("data-id");
                accion = '';
                accion = 'editar';
                obtenerDetalles(dataId, accion);
            } else if (event.target.classList.contains("accion-eliminar_usuarios")) {
                var fila = event.target.closest("tr");
                var dataId = fila.getAttribute("data-id");
                accion = '';
                deleteUser(dataId);
            }
        });
    }

    // Función para obtener los datos del usuario mediante AJAX
    function obtenerDetalles(id, accion) {
        const xhr = new XMLHttpRequest();

        // Mostrar el spinner antes de enviar la petición
        mostrarSpinner();

        xhr.open('POST', '../view/ajax/gestion.php', true);
        xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        xhr.onreadystatechange = function () {
            if (xhr.readyState === 4 && xhr.status === 200) {
                const datos = JSON.parse(xhr.responseText);
                mostrarUsuarioModal(datos, accion);
                crudProducto();
                // Ocultar el spinner después de recibir la respuesta
                ocultarSpinner();
            }
        };
        // Construir los datos a enviar
        const data = 'id=' + id + '&action=' + encodeURIComponent('viewUser');

        xhr.send(data);
    }

    // Función para mostrar los datos del usuario en el modal
    function mostrarUsuarioModal(user, accion) {

        var inputReadonly;
        var titulo;

        if (accion == 'editar') {
            inputReadonly = false;
            titulo = 'Editar usuario';
        } else if (accion == 'ver') {
            inputReadonly = true;
            titulo = 'Visualizar usuario';
        } else if (accion == 'agregar') {
            inputReadonly = false;
            titulo = 'Agregar usuario';
        }

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
        modalTitle.textContent = titulo;

        // Crear el elemento 'button' con la clase 'modal-close' y agregar el texto 'X'
        var modalCloseButton = document.createElement('button');
        modalCloseButton.classList.add('modal-close');
        modalCloseButton.textContent = 'X';

        // Agregar el elemento 'h3' y el elemento 'button' al elemento 'div' con la clase 'modal-header'
        modalHeaderDiv.appendChild(modalTitle);
        modalHeaderDiv.appendChild(modalCloseButton);

        var modalForm = document.createElement('form');
        modalForm.setAttribute('method', 'POST');
        modalForm.setAttribute('action', '../view/ajax/gestion.php');
        modalForm.classList.add('SolicitudAjax');
        modalForm.id = 'formDatos';

        if (accion == 'agregar') {
            modalForm.setAttribute('data-form', 'add');
        } else if (accion == 'editar') {
            modalForm.setAttribute('data-form', 'update');
        }

        modalForm.setAttribute('enctype', 'multipart/form-data');

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
        modalImg.id = 'viewImg';

        if (accion != 'agregar') {
            var rutaImagen = user[0].image;
            var urlPhp = "../view/";
            var rutaCompleta = urlPhp ? urlPhp + rutaImagen : rutaImagen;
            modalImg.src = rutaCompleta;
        } else {
            $(document).ready(function () {
                imagenPrevia();
            });
            modalImg.src = '../view/assets/img/perfil/sin-fotografia.png';
        }


        modalImg.alt = '';
        modalImg.classList.add('modal-img');

        var modalImgEditContainer = document.createElement('div');
        modalImgEditContainer.classList.add('modal-img-editContainer');

        var labelImgEdit = document.createElement('label');
        labelImgEdit.classList.add('modal-img-btnEdit');
        labelImgEdit.textContent = "Seleccionar imagen";
        labelImgEdit.setAttribute('for', 'inputEditImg');

        var modalImgBtnEdit = document.createElement('input');
        modalImgBtnEdit.setAttribute('name', 'image');
        modalImgBtnEdit.id = accion == 'inputEditImg';
        modalImgBtnEdit.type = 'file';
        modalImgBtnEdit.style.display = 'none';

        var modalInputHidden = document.createElement('input');
        modalInputHidden.setAttribute('name', 'id');
        modalInputHidden.value = user[0].id;
        modalInputHidden.type = 'hidden';
        modalInputHidden.classList.add('modal-input');
        modalInputHidden.readOnly = true;

        modalImgPerfilDiv.appendChild(modalImg);
        if (accion == 'editar' || accion == 'agregar') {
            modalImgEditContainer.appendChild(labelImgEdit);
            modalImgEditContainer.appendChild(modalImgBtnEdit);
            modalImgPerfilDiv.appendChild(modalImgEditContainer);
        }
        modalBodyInputDiv1.appendChild(modalLabelFoto);
        modalBodyInputDiv1.appendChild(modalImgPerfilDiv);
        modalBodyInputDiv1.appendChild(modalInputHidden);
        if (accion == 'ver') {
            modalBodyContentDiv1.appendChild(modalBodyInputDiv1);
        }

        var modalBodyInputGrid = document.createElement('div');
        modalBodyInputGrid.classList.add('modal-body-input');

        if (accion != 'agregar') {
            var modalBodyInputDiv2 = document.createElement('div');
            modalBodyInputDiv2.classList.add('modal-body-input');

            var modalLabelID = document.createElement('label');
            modalLabelID.classList.add('modal-label');
            modalLabelID.textContent = 'ID';

            var modalInputID = document.createElement('input');
            modalInputID.setAttribute('name', 'updateUId');
            modalInputID.value = user[0].id;
            modalInputID.type = 'text';
            modalInputID.classList.add('modal-input');
            modalInputID.readOnly = true;

            modalBodyInputDiv2.appendChild(modalLabelID);
            modalBodyInputDiv2.appendChild(modalInputID);
            modalBodyInputGrid.appendChild(modalBodyInputDiv2);
        }

        var modalBodyInputDiv3 = document.createElement('div');
        modalBodyInputDiv3.classList.add('modal-body-input');

        var modalLabelRol = document.createElement('label');
        modalLabelRol.classList.add('modal-label');
        modalLabelRol.textContent = 'Rol';

        // Crear el elemento select
        let selectRol = document.createElement('select');
        selectRol.classList.add('modal-input');
        selectRol.setAttribute('name', 'idRol');
        selectRol.id = "selectModal";
        selectRol.disabled = inputReadonly;

        if (accion == 'editar' || accion == 'ver') {
            idRol = user[0].idRol;
        }

        fetch('../view/ajax/gestion.php', {
            method: 'POST',
            body: new URLSearchParams({
                action: 'listRol'
            })
        })
            .then(response => response.json())
            .then(data => {
                // Generar las opciones del select
                data.forEach(opcion => {
                    let optionRol = document.createElement('option');
                    optionRol.textContent = opcion.rol;
                    optionRol.value = opcion.id;
                    selectRol.appendChild(optionRol);
                });

                if (accion == 'editar' || accion == 'ver') {
                    obtenerDatosRol(idRol).then(function (datosRol) {
                        let selectElement = document.getElementById('selectModal');
                        for (let i = 0; i < selectElement.options.length; i++) {
                            if (selectElement.options[i].value == datosRol[0].id) {
                                selectElement.selectedIndex = i;
                                break;
                            }
                        }
                    });
                }
            })
            .catch(error => console.error(error));

            modalBodyInputDiv3.appendChild(modalLabelRol);
            modalBodyInputDiv3.appendChild(selectRol);
            modalBodyInputGrid.appendChild(modalBodyInputDiv3);

        if (accion != 'agregar') {

            var modalBodyInputDiv4 = document.createElement('div');
            modalBodyInputDiv4.classList.add('modal-body-input');

            var modalLabelNombreUsuario = document.createElement('label');
            modalLabelNombreUsuario.classList.add('modal-label');
            modalLabelNombreUsuario.textContent = 'Nombre de usuario';

            var modalInputNombreUsuario = document.createElement('input');
            modalInputNombreUsuario.setAttribute('name', 'userName');
            modalInputNombreUsuario.value = user[0].userName != null ? user[0].userName : '';
            modalInputNombreUsuario.type = 'text';
            modalInputNombreUsuario.classList.add('modal-input');
            modalInputNombreUsuario.readOnly = inputReadonly;

            modalBodyInputDiv4.appendChild(modalLabelNombreUsuario);
            modalBodyInputDiv4.appendChild(modalInputNombreUsuario);
            modalBodyInputGrid.appendChild(modalBodyInputDiv4);
        }

        modalBodyContentDiv1.appendChild(modalBodyInputGrid);
        modalBodyDiv.appendChild(modalBodyContentDiv1);

        var modalBodyContentDiv2 = document.createElement('div');
        modalBodyContentDiv2.classList.add('modal-body-content');

        var modalBodyInputDiv5 = document.createElement('div');
        modalBodyInputDiv5.classList.add('modal-body-input');

        var modalLabelTipoDocumento = document.createElement('label');
        modalLabelTipoDocumento.classList.add('modal-label');
        modalLabelTipoDocumento.textContent = 'Tipo de documento';

        // Crear el elemento select
        let selectTypeDoc = document.createElement('select');
        selectTypeDoc.classList.add('modal-input');
        selectTypeDoc.setAttribute('name', 'idTypeDoc');
        selectTypeDoc.id = "selectModaltypeDoc";
        selectTypeDoc.disabled = inputReadonly;

        if (accion == 'editar' || accion == 'ver') {
            idTypeDoc = user[0].idTypeDoc;
        }

        fetch('../view/ajax/gestion.php', {
            method: 'POST',
            body: new URLSearchParams({
                action: 'listTypeDoc'
            })
        })
            .then(response => response.json())
            .then(data => {
                // Generar las opciones del select
                data.forEach(opcion => {
                    let optiontypeDoc = document.createElement('option');
                    optiontypeDoc.textContent = opcion.typeDoc;
                    optiontypeDoc.value = opcion.id;
                    selectTypeDoc.appendChild(optiontypeDoc);
                });

                if (accion == 'editar' || accion == 'ver') {
                    obtenerDatosTypeDoc(idTypeDoc).then(function (datostypeDoc) {
                        let selectElement = document.getElementById('selectModaltypeDoc');
                        for (let i = 0; i < selectElement.options.length; i++) {
                            if (selectElement.options[i].value == datostypeDoc[0].id) {
                                selectElement.selectedIndex = i;
                                break;
                            }
                        }
                    });
                }
            })
            .catch(error => console.error(error));

        modalBodyInputDiv5.appendChild(modalLabelTipoDocumento);
        modalBodyInputDiv5.appendChild(selectTypeDoc);
        modalBodyContentDiv2.appendChild(modalBodyInputDiv5);

        var modalBodyInputDiv6 = document.createElement('div');
        modalBodyInputDiv6.classList.add('modal-body-input');

        var modalLabelNumeroDocumento = document.createElement('label');
        modalLabelNumeroDocumento.classList.add('modal-label');
        modalLabelNumeroDocumento.textContent = 'Número de documento';

        var modalInputNumeroDocumento = document.createElement('input');
        modalInputNumeroDocumento.setAttribute('name', 'numDoc');
        modalInputNumeroDocumento.value = user[0].numDoc != null ? user[0].numDoc : '';
        modalInputNumeroDocumento.type = 'text';
        modalInputNumeroDocumento.classList.add('modal-input');
        modalInputNumeroDocumento.readOnly = inputReadonly;
        modalInputNumeroDocumento.id = 'numDoc';

        modalBodyInputDiv6.appendChild(modalLabelNumeroDocumento);
        modalBodyInputDiv6.appendChild(modalInputNumeroDocumento);

        if (accion == 'agregar' || accion == 'editar') {
            var modalLupa = document.createElement('div');
            modalLupa.classList.add('lupa');
            modalLupa.id = 'verifyNumDoc';

            var modalIconLupa = document.createElement('i');
            modalIconLupa.classList.add('fa-solid', 'fa-magnifying-glass');

            var respuestaNumDoc = document.createElement('div')
            respuestaNumDoc.id = 'respuestaNumDoc';

            modalLupa.appendChild(modalIconLupa);
            modalBodyInputDiv6.appendChild(respuestaNumDoc);
            modalBodyInputDiv6.appendChild(modalLupa);

        }

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
        modalInputNombre.setAttribute('name', 'name');
        modalInputNombre.value = user[0].name != null ? user[0].name : '';
        modalInputNombre.type = 'text';
        modalInputNombre.classList.add('modal-input');
        modalInputNombre.readOnly = 'true';
        modalInputNombre.id = 'nameInput'

        modalBodyInputDiv7.appendChild(modalLabelNombre);
        modalBodyInputDiv7.appendChild(modalInputNombre);
        modalBodyContentDiv3.appendChild(modalBodyInputDiv7);

        var modalBodyInputDiv8 = document.createElement('div');
        modalBodyInputDiv8.classList.add('modal-body-input');

        var modalLabelApellido = document.createElement('label');
        modalLabelApellido.classList.add('modal-label');
        modalLabelApellido.textContent = 'Apellido';

        var modalInputApellido = document.createElement('input');
        modalInputApellido.setAttribute('name', 'lastName');
        modalInputApellido.value = user[0].lastName != null ? user[0].lastName : '';
        modalInputApellido.type = 'text';
        modalInputApellido.classList.add('modal-input');
        modalInputApellido.readOnly = 'true';
        modalInputApellido.id = 'lastnameInput'

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
        modalInputCorreo.setAttribute('name', 'email');
        modalInputCorreo.value = user[0].email != null ? user[0].email : '';
        modalInputCorreo.type = 'text';
        modalInputCorreo.classList.add('modal-input');
        modalInputCorreo.readOnly = inputReadonly;

        modalBodyInputDiv9.appendChild(modalLabelCorreo);
        modalBodyInputDiv9.appendChild(modalInputCorreo);
        modalBodyContentDiv4.appendChild(modalBodyInputDiv9);

        var modalBodyInputDiv10 = document.createElement('div');
        modalBodyInputDiv10.classList.add('modal-body-input');

        var modalLabelTelefono = document.createElement('label');
        modalLabelTelefono.classList.add('modal-label');
        modalLabelTelefono.textContent = 'Teléfono';

        var modalInputTelefono = document.createElement('input');
        modalInputTelefono.setAttribute('name', 'telephone');
        modalInputTelefono.value = user[0].telephone != null ? user[0].telephone : '';
        modalInputTelefono.type = 'text';
        modalInputTelefono.classList.add('modal-input');
        modalInputTelefono.readOnly = inputReadonly;

        modalBodyInputDiv10.appendChild(modalLabelTelefono);
        modalBodyInputDiv10.appendChild(modalInputTelefono);
        modalBodyContentDiv4.appendChild(modalBodyInputDiv10);

        modalBodyDiv.appendChild(modalBodyContentDiv4);

        var respuestaAjax = document.createElement('div');
        respuestaAjax.classList.add('RespuestaAjax');

        // Crear el elemento 'div' con la clase 'modal-footer'
        var modalFooterDiv = document.createElement('div');
        modalFooterDiv.classList.add('modal-footer');

        // Crear elemento 'button' con la clase 'btn-save-user'
        var modalFooterButton = document.createElement('button');
        modalFooterButton.classList.add('btn-save-user');
        modalFooterButton.textContent = "Guardar";

        // Agregar el elemento 'button' con la clase 'btn-save-user' al elemento 'div' con la clase 'modal-footer'
        modalFooterDiv.appendChild(modalFooterButton);

        // Agregar el elemento 'div' con la clase 'modal-header' al elemento 'div' con la clase 'modal-content'
        modalContentDiv.appendChild(modalHeaderDiv);

        if (accion == 'agregar') {
            var inputAccion = document.createElement('input');
            inputAccion.setAttribute('name', 'adduser')
            inputAccion.type = 'hidden'

            modalForm.appendChild(inputAccion)
        }

        // Agregar el elemento 'div' con la clase 'modal-body' al elemento 'div' con la clase 'modal-content'
        modalForm.appendChild(respuestaAjax);
        modalForm.appendChild(modalBodyDiv);

        if (accion == 'editar' || accion == 'agregar') {
            // Agregar el elemento 'div' con la clase 'modal-footer' al elemento 'div' con la clase 'modal-content'
            modalForm.appendChild(modalFooterDiv);
        }
        modalContentDiv.appendChild(modalForm);
        // Agregar el elemento 'div' con la clase 'modal-content' al elemento 'div' con la clase 'modal'
        modalDiv.appendChild(modalContentDiv);

        // Agregar el elemento 'div' con la clase 'modal' al documento
        document.body.appendChild(modalDiv);

        var verifyNumDocC = document.getElementById('verifyNumDoc');

        if (verifyNumDocC != null) {
            verifyNumDocC.addEventListener('click', () => {
                var inputNumDoc = document.getElementById("numDoc");
                var nameInput = document.getElementById("nameInput");
                var lastnameInput = document.getElementById("lastnameInput");
                var respuestaNumDoc = $('.RespuestaAjax');
                var numDoc = inputNumDoc.value;
                mostrarSpinner()
                $.ajax({
                    type: "POST",
                    url: "../view/ajax/gestion.php",
                    data: {
                        numDoc: numDoc,
                        action: 'verifyNumDoc'
                    },
                    success: function (data) {
                        ocultarSpinner()
                        try {
                            var dato = JSON.parse(data);
                            if (dato.nombres != undefined) {
                                nameInput.value = capitalizeWords(dato.nombres)
                                lastnameInput.value = capitalizeWords(dato.apellidoPaterno + ' ' + dato.apellidoMaterno)
                            } else {
                                nameInput.value = ''
                                lastnameInput.value = ''
                            }
                        } catch (error) {
                            respuestaNumDoc.html(data);
                            console.log(data)
                            nameInput.value = ''
                            lastnameInput.value = ''
                        }
                    }
                });
            })
        }

        // Agregar un controlador de eventos para cerrar el modal y reiniciar los valores
        modalCloseButton.addEventListener('click', function () {
            document.getElementById('formDatos').reset();
            // Eliminar el modal del DOM
            modalDiv.remove();
        });

    }

    function capitalizeWords(texto) {
        return texto.toLowerCase().replace(/(?:^|\s)\S/g, function (letra) {
            return letra.toUpperCase();
        });
    }

    //
    function deleteUser(idUser) {
        var respuesta = document.querySelector('.respuestaDelete');
        showAlertModal(
            '¿Seguro que desea eliminar?',
            'Verifique bien los datos antes de confirmar',
            'warning',
            true,
            0,
            function (confirmado) {
                if (confirmado) {
                    mostrarSpinner()
                    $.ajax({
                        type: "POST",
                        url: "../view/ajax/gestion.php",
                        data: {
                            id: idUser,
                            action: 'deleteUser'
                        },
                        success: function (data) {
                            ocultarSpinner()
                            respuesta.innerHTML = data;
                        }
                    });
                }
            }
        );
    }

})();
