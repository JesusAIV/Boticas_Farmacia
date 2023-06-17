<?php
$roles = json_decode($gestion->ListRolC());
$typeDoc = json_decode($gestion->ListTypeDocC());
?>


<!--  -->
<div class="container-table">
    <form method="POST" action="../view/ajax/gestion.php" class="SolicitudAjax" data-form="update" enctype="multipart/form-data">
        <div class="RespuestaAjax"></div>
        <div class="modal-body">
            <div class="modal-body-content">
                <div class="modal-body-input">
                    <div class="modal-body-input">
                        <label class="modal-label">Rol</label>
                        <select class="modal-input" name="idRol" id="selectModal">
                            <?php foreach ($roles as $rol){ ?>
                                <option value="<?php echo $rol->id ?>"><?php echo $rol->rol ?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
            </div>
            <div class="modal-body-content">
                <div class="modal-body-input">
                    <label class="modal-label">Tipo de documento</label>
                    <select class="modal-input" name="idTypeDoc" id="selectModaltypeDoc">
                        <?php foreach ($typeDoc as $doc){ ?>
                            <option value="<?php echo $doc->id ?>"><?php echo $doc->typeDoc ?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="modal-body-input">
                    <label class="modal-label">Número de documento</label>
                    <input name="numDoc" type="text" class="modal-input">
                </div>
            </div>
            <div class="modal-body-content">
                <div class="modal-body-input">
                    <label class="modal-label">Nombre</label>
                    <input name="name" type="text" class="modal-input">
                </div>
                <div class="modal-body-input">
                    <label class="modal-label">Apellido</label>
                    <input name="lastName" type="text" class="modal-input">
                </div>
            </div>
            <div class="modal-body-content">
                <div class="modal-body-input">
                    <label class="modal-label">Correo</label>
                    <input name="email" type="text" class="modal-input">
                </div>
                <div class="modal-body-input">
                    <label class="modal-label">Teléfono</label>
                    <input name="telephone" type="text" class="modal-input">
                </div>
            </div>
        </div>
        <div class="modal-footer save-usuarios"><button class="btn-save-user">Guardar</button></div>
    </form>
</div>