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

if ($tipo == 'adm'){
    header('location: index.php');
            exit;
}

$usuario = $usuarioLogado['id'];

//VALIDAÇÃO DO POST
if(isset($_POST['cancelar'])){
    header('location: index.php');
    exit;
  }
//VALIDAÇÃO DO POST
if(isset($_POST['excluir'])){

    $obUsuario = new Usuario();
    $obUsuario->id    = $usuario;
    $obUsuario->excluir();
    header('location: logout.php');
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
            <form action="deletar.php" method="POST">
                    <legend>Deletar</legend>
                    <br><br>
                    <p class="subtitle">Você está prestes a <strong>EXCLUIR</strong> sua conta!</p>
                    <div class="botao">
                        <input type="submit" name="cancelar" class="submit cancelar" value="CANCELAR">
                        <input type="submit" name="excluir" class="submit excluir" value="EXCLUIR">
                    </div>
            </form>
        </div>
    </body>
</html>