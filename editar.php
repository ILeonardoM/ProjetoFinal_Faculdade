<?php

require __DIR__.'/vendor/autoload.php';

use \App\Entity\Logar;
use \App\Entity\Usuario;

//Obriga o usuario a estar logado
Logar::requireLogin();

//Captura o id do usuario
$usuarioLogado = Logar::getUsuarioLogado();

//Captura o tipo de usuario
$tipo = $usuarioLogado['tipo'];

//Obriga o usuario a não ser um ADM
if ($tipo == 'adm'){
    header('location: index.php');
            exit;
}

$usuario = $usuarioLogado['id'];

$nome = $usuarioLogado['nome'];
$sobrenome = $usuarioLogado['sobrenome'];
$email = $usuarioLogado['email'];
$nascimento = $usuarioLogado['nascimento'];
$celular = $usuarioLogado['celular'];

//VALIDAÇÃO DO POST
if(isset($_POST['submit'])){

    $obUsuario = new Usuario();
    $obUsuario->id    = $usuario;
    $obUsuario->nome    = $_POST['nome'];
    $obUsuario->sobrenome = $_POST['sobrenome'];
    $obUsuario->email = $_POST['email'];
    $obUsuario->nascimento = $_POST['nascimento'];
    $obUsuario->celular = $_POST['celular'];
    $obUsuario->senha = password_hash($_POST['senha'], PASSWORD_BCRYPT);
    $obUsuario->atualizar();
    Logar::login($obUsuario);
    header('location: index.php?status=success');
    exit;
  }
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
                <li><a href="editar.php">EDITAR</a></li>
                <li><a href="deletar.php">EXCLUIR</a></li>
                <li><a href="logout.php">SAIR</a></li> 
            </ul>
        </li>
    </ul>
</div>
</header>
        <div class="box1">
            <form action="editar.php" method="POST">
                    <legend>Editar</legend>
                    <br>
                    <div class="inputbox">
                        <input type="text" name="nome" id="nome" class="inputnome" autocomplete="off" value="<?=$nome?>" required>
                        <label for="nome" class="labelinput">Nome: </label>
                    </div>
                    <br><br>
                    <div class="inputbox">
                        <input type="text" name="sobrenome" id="sobrenome" class="inputnome" autocomplete="off" value="<?=$sobrenome?>" required>
                        <label for="sobrenome" class="labelinput">Sobrenome: </label>
                    </div>
                    <br><br>
                    <div class="inputbox">
                        <input type="email" name="email" id="email" class="inputnome" autocomplete="off" value="<?=$email?>" required>
                        <label for="user" class="labelinput">E-mail: </label>
                    </div>
                    <br><br>
                    <div class="inputbox">
                        <input type="date" name="nascimento" id="nascimento" class="inputnome" autocomplete="off" value="<?=$nascimento?>" required>
                        <label for="user" class="labelinput">Data de Nascimento: </label>
                    </div>
                    <br><br>
                    <div class="inputbox">
                        <input type="number" name="celular" id="celular" class="inputnome" autocomplete="off" value="<?=$celular?>" pattern="[0-9]{5}-[0-9]{4}" required>
                        <label for="user" class="labelinput">Celular: </label>
                    </div>
                    <br><br>
                    <div class="inputbox">
                        <input type="password" name="senha" id="senha" class="inputnome" autocomplete="off" required>
                        <label for="pass" class="labelinput">Senha: </label>
                    </div>
                    <br><br>
                    <div>
                        <input type="submit" name="submit" class="submit" id="submit" value="Editar">
                    </div>
            </form>
        </div>
    </body>
</html>