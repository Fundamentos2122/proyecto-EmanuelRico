<div class="modal" id="modal_test">
    <div class="modal-content">
        <div class="modal-header">
            <h5>Inicia Sesión</h5>
            <button class="btn danger-btn" data-dismiss="#modal_test">X</button>
        </div>

        <div class="modal-body">
            <form action="../controllers/loginController.php" method="POST">
                <input type="hidden" name="_method" value="POST">

                <?php 
                    if(array_key_exists("error", $_GET)){
                        echo '<div class="alert danger-alert" style="display: block;">' . $_GET["error"] . '</div>';
                    }
                ?>
                <div class="form-group">
                    <label for="nombre_usuario">Nombre de Usuario</label>
                    <input type="text" name="nombre_usuario" class="form-control" autocomplete="off" required>
                </div>
                        
                <div class="form-group">
                    <label for="contrasena">Contraseña</label>
                    <input type="password" name="contrasena" class="form-control" required>
                </div>
                        
                <div>
                    <input type="checkbox" name="conditions">
                    <label for="conditions">Recordar usuario</label>
                </div>

                <div class="modal-footer">
                    <a href='registrarse.php' class="btn primary-btn m-1">Crear cuenta</a>
                    <input type="submit" value="Iniciar sesión" class="btn success-btn m-1">
                </div>
            </form>
        </div>

    </div>
</div>