

<nav class="navbar">
    <a href="index.php" class="navbar-brand">ERSports</a>
    <button class="navbar-toggle btn light-btn" data-type="button">-</button>

    <div class="navbar-collapse">
        <ul class="navbar-nav">

            <?php 
                //Verificar que el usuario esté loggeado

                if(array_key_exists("nombre_usuario", $_SESSION) && $_SESSION["tipo_rol"] == "normal"){
                    echo 
                    '
                    <li class="nav-item ml-3">
                        <a href="#" class="nav-link btn light-btn user">'
                            . ucfirst($_SESSION["nombre_usuario"]) .
                        '</a>
                    </li>

                    <li class="nav-item dropdown ml-3">
                        <a href="#" class="nav-link dropdown-toggle btn light-btn">
                            Opciones
                        </a>

                        <ul class="dropdown-menu">
                            <li>
                                <a href="editar_perfil.php?id=' . $_SESSION["id"] . '"class="dropdown-item">Editar perfil</a>
                            </li>

                            <li>
                                <a href="crear_post.php?id=' . $_SESSION["id"] . '" class="dropdown-item">Crear post</a>
                            </li>

                            <li>
                                <a href="editar_post.php?usuario_id=' . $_SESSION["id"] . '" class="dropdown-item">Editar post</a>
                            </li>
                        </ul>
                    </li>

                    <li class="nav-item ml-3">
                        <form action="../controllers/loginController.php" method="post">
                            <input type="hidden" name="_method" value="DELETE">
                            <input type="submit" value="Cerrar sesión" class="btn danger-btn">
                        </form>
                    </li>';
                }
                else if(array_key_exists("nombre_usuario", $_SESSION) && $_SESSION["tipo_rol"] == "administrador"){
                    echo 
                    '
                    <li class="nav-item ml-3">
                        <a href="#" class="nav-link btn light-btn user">'
                            . ucfirst($_SESSION["nombre_usuario"]) .
                        '</a>
                    </li>

                    <li class="nav-item dropdown ml-3">
                        <a href="#" class="nav-link dropdown-toggle btn light-btn">
                            Opciones
                        </a>

                        <ul class="dropdown-menu">
                            <li>
                                <a href="lista_usuarios.php" class="dropdown-item">Lista de usuarios</a>
                            </li>

                            <li>
                                <a href="editar_perfil.php?id=' . $_SESSION["id"] . '"class="dropdown-item">Editar perfil</a>
                            </li>

                            <li>
                                <a href="crear_post.php?id=' . $_SESSION["id"] . '" class="dropdown-item">Crear post</a>
                            </li>

                            <li>
                                <a href="editar_post.php?usuario_id=' . $_SESSION["id"] . '" class="dropdown-item">Editar post</a>
                            </li>
                        </ul>
                    </li>

                    <li class="nav-item ml-3">
                        <form action="../controllers/loginController.php" method="post">
                            <input type="hidden" name="_method" value="DELETE">
                            <input type="submit" value="Cerrar sesión" class="btn danger-btn">
                        </form>
                    </li>';
                }
                else{
                    echo
                    '<li class="nav-item">
                        <button class="btn secondary-btn" data-toggle="modal" data-target="#modal_test">Inicia Sesión</button>
                    </li>';
                }
            ?>
        </ul>
    </div>


</nav>