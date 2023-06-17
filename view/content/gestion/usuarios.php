<div class="content-btn-accion">
    <button class="btn-accion btn-accion-add" id="btn-accion-addU">Agregar usuario</button>
</div>

<div class="container-table">
    <?php echo $gestion->paginationUsers($_SESSION['id']); ?>
</div>