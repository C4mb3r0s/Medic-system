<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/styles_index.css">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">

    <title>Recepcion y médico</title>
</head>

<body>
    <div class="container">
        <div class="form-container">
            <div class="sign-in">
                <div class="icon">
                    <span>
                        <i class="bi bi-person-fill"></i>
                    </span>
                </div>
                <form action="include/login.php" method="post" class="sign-in-form">
                    <h1 class="title">Iniciar sesión</h1>
                    <div class="input-field">
                        <i class="bi bi-person-fill"></i>
                        <input name="Usuario" type="text" placeholder="Usuario" required />
                    </div>
                    <div class="input-field dos">
                        <i class="bi bi-lock-fill"></i>
                        <input id="txtPassword" name="Password" type="password" placeholder="Contraseña" required />

                        <button id="show_password" class="btn btn-primary" type="button" onclick="mostrarPassword('txtPassword','show_password')">
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

                    <span><a class="restablecer" href="Send_mail.php" style="color: blue;">¿Olvidaste tu contraseña?</a></span>

                    <button class="btn solid" name="login" type="submit"><a>Iniciar Sesión</a></button>

                </form>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
</body>

</html>