<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    
    <link rel="shortcut icon" type="image/png" href="./images/favicon.ico" />
    <title>Bienvenido</title>

    <link rel="stylesheet" type="text/css" href="./Views/css/welcome.css" />
    <script type="text/javascript" src="Views/js/welcome.js"></script>
</head>
<body>
    <h1>Bienvenido al Catálogo de Películas</h1>
    
    <table class="login">
        <tr>
            <td>
                <a class="login-link pointer">Ingresar</a>
            </td>
            <td>
                <a class="signin-link pointer">Crear una cuenta</a>
            </td>
        </tr>
        <tr>
            <td colspan="2">
                <input id="firstName" type="text" placeholder="Nombre"/>
                <p class="create-account-validation-name" hidden>* Campo requerido</p>
            </td>
        </tr>
        <tr>
            <td colspan="2">
                <input id="lastName" type="text" placeholder="Apellido"/>
                <p class="create-account-validation-lastName" hidden>* Campo requerido</p>
            </td>
        </tr>
        <tr>
            <td colspan="2">
                <input id="email" type="email" placeholder="Email"/>
                <p class="create-account-validation-email" hidden>* Email inválido</p>
            </td>
        </tr>
        <tr>
            <td colspan="2">
                <input type="password" id="password" placeholder="Password"/>
                <p class="create-account-validation-password" hidden>* Campo requerido</p>
            </td>
        </tr>
        <tr>
            <td colspan="2">
                <button id="button-accept" onclick="Login()">Aceptar</button>
            </td>
        </tr>
    </table>
</body>
</html>