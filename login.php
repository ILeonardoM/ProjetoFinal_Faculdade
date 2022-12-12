<?php

require __DIR__.'/vendor/autoload.php';

use \App\Entity\Logar;
use \App\Entity\Usuario;

//Obriga o usuario a não estar logado
Logar::requireLogout();

//mensagem de alerta do login
$alertaLogin = '';

if(isset($_POST['submit'])){

    switch('submit'){
        case 'submit':
            $obUsuario = new Usuario();

            //busca usuario por email
            $obUsuario = Usuario::usuarioPorEmail($_POST['email']);

            //valida a instancia e a senha
            if(!$obUsuario instanceof Usuario || !password_verify($_POST['senha'],$obUsuario->senha)){
                $alertaLogin = 'Email ou senha inválidos';
                break;
            }

            Logar::login($obUsuario);
        break;
    }
}

$alertaLogin = strlen($alertaLogin) ? '<div class="alert alert-danger">'.$alertaLogin.'</div>' : '';
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Site Blade</title>
    <!--link do arquivo SWIPER(tela)-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.css"/>

    <!--fonte do cdnjs link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">

    <!--arquivo css personalizado-->
    <link rel="stylesheet" href="css/style.css">
</head>
    <body class="reg">
        <div class="box1">
            <form action="login.php" method="POST">
                    <legend>Login</legend>
                    <br>
                    <?=$alertaLogin?>
                    <div class="inputbox">
                        <input type="email" name="email" id="email" class="inputnome" autocomplete="off" required>
                        <label for="user" class="labelinput">E-mail: </label>
                    </div>
                    <br><br>
                    <div class="inputbox">
                        <input type="password" name="senha" id="senha" class="inputnome" autocomplete="off" required>
                        <label for="pass" class="labelinput">Senha: </label>
                    </div>
                    <br><br>
                    <div>
                        <input type="submit" name="submit" class="submit" id="submit" value="Entrar">
                    </div>
            </form>
        </div>
        <header>

<a href="#" class="logo"><i class="fas fa-tv"></i>BLADE.</a>

<nav class="navbar">
<a class="active"href="index.php#home">home</a>
    <a href="index.php#destaques">destaques</a>
    <a href="index.php#sobre">sobre</a>
    <a href="index.php#produtos">produtos</a>
    <a href="index.php#avaliacao">avaliações</a>
</nav>


<div class="icons">
    <i class="fas fa-bars" id="menu-bars"></i>
        <ul>
        <li><a href="#" class="fas fa-users"></a>
            <ul>
                <li><a href="login.php">ENTRAR</a></li>
                <li><a href="registrar.php">REGISTRAR</a></li>
            </ul>
        </li>
    </ul>
</div>
</header>
    </body>
</html>