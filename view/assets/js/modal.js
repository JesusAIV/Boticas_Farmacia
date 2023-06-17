var dtos = {
    url: '../view/ajax/gestion.php',
    dataform: 'add',
    titulo: 'Editar usuario',
    inputs: [
        { label: false, name: 'updateUId', type: 'hidden' },
        { label: 'Seleccionar imagen', name: 'rol', type: 'file' },
        { label: 'Nombre de usuario', name: 'userName', type: 'text' },
        { label: 'Número de documento', name: 'numDoc', type: 'text' },
        { label: 'Nombre', name: 'name', type: 'text' },
        { label: 'Apellido', name: 'lastName', type: 'text' },
        { label: 'Correo', name: 'email', type: 'text' },
        { label: 'Teléfono', name: 'telephone', type: 'text' }
    ],
    select: [
        { label: 'Rol', name: 'idRol', id: 'selectModal' },
        { label: 'Tipo de documento', name: 'idTypeDoc', id: 'selectModaltypeDoc' }
    ]
}

// CreateModal(dtos)

function CreateModal(datos) {

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
    modalTitle.textContent = datos['titulo'];

    // Crear el elemento 'button' con la clase 'modal-close' y agregar el texto 'X'
    var modalCloseButton = document.createElement('button');
    modalCloseButton.classList.add('modal-close');
    modalCloseButton.textContent = 'X';

    // Agregar el elemento 'h3' y el elemento 'button' al elemento 'div' con la clase 'modal-header'
    modalHeaderDiv.appendChild(modalTitle);
    modalHeaderDiv.appendChild(modalCloseButton);

    var modalForm = document.createElement('form');
    modalForm.setAttribute('method', 'POST');
    modalForm.setAttribute('action', datos.url);
    modalForm.classList.add('SolicitudAjax');
    modalForm.setAttribute('data-form', datos.dataform);
    modalForm.setAttribute('enctype', 'multipart/form-data');

    // Crear el elemento 'div' con la clase 'modal-body'
    var modalBodyDiv = document.createElement('div');
    modalBodyDiv.classList.add('modal-body');

    for (let i = 0; i < dtos.inputs.length; i += 2) {

        // Crear los elementos de contenido y etiquetas para el cuerpo del modal
        var modalBodyContentDiv1 = document.createElement('div');
        modalBodyContentDiv1.classList.add('modal-body-content');

        var modalBodyInputDiv1 = document.createElement('div');
        modalBodyInputDiv1.classList.add('modal-body-input');

        if (datos.inputs[i].label !== false) {
            var modalLabel1 = document.createElement('label');
            modalLabel1.classList.add('modal-label', 'modal-label-foto');
            modalLabel1.textContent = datos.inputs[i].label;
        }

        var modalInput1 = document.createElement('input');
        modalInput1.setAttribute('name', datos.inputs[i].name);
        modalInput1.value = '';
        modalInput1.type = datos.inputs[i].type;
        modalInput1.classList.add('modal-input');

        if (datos.inputs[i].label !== false) {
            modalBodyInputDiv1.appendChild(modalLabel1)
        }

        modalBodyInputDiv1.appendChild(modalInput1)
        modalBodyContentDiv1.appendChild(modalBodyInputDiv1)

        if (i + 1 < dtos.inputs.length) {

            var modalBodyInputDiv1 = document.createElement('div');
            modalBodyInputDiv1.classList.add('modal-body-input');

            var modalLabel2 = document.createElement('label');
            modalLabel2.classList.add('modal-label', 'modal-label-foto');
            modalLabel2.textContent = datos.inputs[i + 1].label;

            var modalInput2 = document.createElement('input');
            modalInput2.setAttribute('name', datos.inputs[i + 1].name);
            modalInput2.value = '';
            modalInput2.type = datos.inputs[i + 1].type;
            modalInput2.classList.add('modal-input');

            modalBodyInputDiv1.appendChild(modalLabel2)
            modalBodyInputDiv1.appendChild(modalInput2)

            modalBodyContentDiv1.appendChild(modalBodyInputDiv1)

        } else {
            modalBodyContentDiv1.appendChild(modalBodyInputDiv1)
        }

        modalBodyDiv.appendChild(modalBodyContentDiv1)

    }

    modalForm.appendChild(modalBodyDiv)

    modalContentDiv.appendChild(modalHeaderDiv)
    modalContentDiv.appendChild(modalForm)

    modalDiv.appendChild(modalContentDiv)

    document.body.appendChild(modalDiv)

}