<div class="login-container">
    <div class="container">
        <img src="https://www.designevo.com/res/templates/thumb_small/unique-blue-cross-and-capsule.webp" alt="Logo">
    </div>
    <form method="POST">
        <div class="form-group">
            <label for="user">Usuario:</label>
            <input type="text" id="user" name="user" required>
        </div>
        <div class="form-group">
            <label for="password">Contraseña:</label>
            <input type="password" id="password" name="password" required>
        </div>
        <button type="submit" class="login-button">Ingresar</button>
    </form>
    <a href="#" class="forgot-password">Olvidé mi contraseña</a>
    <script defer src="https://app.embed.im/snow.js"></script>
</div>
<?php
if (isset($_POST['user']) && isset($_POST['password'])) {
    require_once "./controller/logincontroller.php";
    $login = new loginController();
    echo $login->iniciarSesionC();
}
?>