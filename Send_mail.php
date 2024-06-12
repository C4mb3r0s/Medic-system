<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/Send_mail.css">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">

    <title>Correo de Verificación</title>
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
                <form action="include/dash_token.php" method="post" class="sign-in-form">
                    <h1 class="title">Recuperación de contraseña</h1>
                    <h2 class="subtitle">Ingresa tu correo proporcionado</h2>
                    <div class="input-field">
                        <i class="bi bi-person-fill"></i>
                        <input name="email" type="email" placeholder="Correo Electrónico" required />
                    </div>
                    <button class="btn solid" name="send" type="submit"><a>Enviar Token</a></button>
                </form>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
</body>
</html>