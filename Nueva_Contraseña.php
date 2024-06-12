<?php
session_start();
if (!isset($_SESSION['ID'])) {
    header("location: Index.php");
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/Nueva_Contra.css">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">

    <title>Nueva contraseña</title>
</head>
<body>
    <div class="container">
        <div class="form-container">
            <div class="sign-in">
                <div class="icon">
                    <span>
                        <i class="bi bi-key-fill"></i>
                    </span>
                </div>
                <form action="include/insert_newpass.php" method="post" class="sign-in-form">
                    <h1>Ingresa tu nueva contraseña<br> en ambos campos:</h1>
                    <div class="input-field">
                        <i class="bi bi-lock-fill"></i>
                        <input ID="txtPassword" name="password1" type="Password" placeholder="Contraseña" required />

                        <button id="show_password" class="btn btn-primary" type="button" onclick="mostrarPassword('txtPassword', 'show_password')">
                            <i class="bi bi-eye-slash"></i>
                        </button>

                        <script type="text/javascript">
                            function mostrarPassword(txtPassword, show_password) {
                                var password = document.getElementById(txtPassword);
                                var button = document.getElementById(show_password);
                                if (password.type === "password") {
                                    password.type = "text";
                                    button.innerHTML = '<i class="bi bi-eye"></i>';
                                } else {
                                    password.type = "password";
                                    button.innerHTML = '<i class="bi bi-eye-slash"></i>';
                                }
                            }
                        </script>
                    </div>
                    <div class="input-field">
                        <i class="bi bi-lock-fill"></i>
                        <input ID="txtPassword2" name="password2" type="Password" placeholder="Contraseña" required />

                        <button id="show_password2" class="btn btn-primary" type="button" onclick="mostrarPassword2('txtPassword2','show_password2')">
                            <i class="bi bi-eye-slash"></i>
                        </button>

                        <script type="text/javascript">
                            function mostrarPassword2(txtPassword2, show_password2) {
                                var password = document.getElementById(txtPassword2);
                                var button = document.getElementById(show_password2);
                                if (password.type === "password") {
                                    password.type = "text";
                                    button.innerHTML = '<i class="bi bi-eye"></i>';
                                } else {
                                    password.type = "password";
                                    button.innerHTML = '<i class="bi bi-eye-slash"></i>';
                                }
                            }
                        </script>
                    </div>
                    <button class="btn solid" name="change" type="submit"><a>Cambiar contraseña</a></button>
                </form>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
</body>
</html>