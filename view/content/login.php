<div class="login-container">
    <div class="logo">
        <img src="ruta_al_logo.png" alt="Logo">
    </div>
    <form class="" action="" method="POST">
        <div class="form-group">
            <label for="user">Usuario:</label>
            <input type="text" id="user" name="user" required>
        </div>
        <div class="form-group">
            <label for="password">Contraseña:</label>
            <input type="password" id="password" name="password" required>
        </div>
        <!-- <div class="form-group">
            <div class="captcha-container">
                <input type="text" class="captcha-input" id="captcha" name="captcha" required>
            </div>
        </div> -->
        <button type="submit" class="login-button">Ingresar</button>
    </form>
    <a href="#" class="forgot-password">Olvidé mi contraseña</a>
</div>
<?php
if (isset($_POST['user']) && isset($_POST['password'])){
    require_once "./controller/logincontroller.php";
    $login = new loginController();
    echo $login->iniciarSesionC();
}
?>