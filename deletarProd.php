<?php

require __DIR__.'/vendor/autoload.php';

use \App\Entity\Logar;
use \App\Entity\Produtos;

//Obriga o usuario a estar logado
Logar::requireLogin();


//Captura o tipo de usuario
$usuarioLogado = Logar::getUsuarioLogado();
$tipo = $usuarioLogado['tipo'];

//Obriga o usuario a ser um ADM
if ($tipo != 'adm'){
    header('location: readProd.php');
            exit;
}

   //Validaçãao do ID
if(!isset($_GET['id']) or !is_numeric($_GET['id'])){
    header('location: readProd.php');
    exit;
} 

//Busca todos os produtos disponíveis
$produto = Produtos::getProduto($_GET['id']);

$id = $produto->id;
$img = $produto->caminho;

//Validação do produto
if(!$produto instanceof Produtos){
    header('location: readProd.php');
    exit;
}

//VALIDAÇÃO DO POST
if(isset($_POST['cancelar'])){
    header('location: readProd.php');
    exit;
  }
//VALIDAÇÃO DO POST
if(isset($_POST['excluir'])){
    if(file_exists($img)){
        unlink($img);
    }
    $produto->id = $id;
    $produto->excluir();
    header('location: readProd.php');
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
                <li><a href="cadastraProd.php">CADASTRAR</a></li>
                <li><a href="readProd.php">VISUALIZAR</a></li>
                <li><a href="logout.php">SAIR</a></li> 
            </ul>
        </li>
        </ul>
</div>
</header>
        <div class="box1">
            <form action="deletarProd.php?id=<?=$id?>" method="POST">
                    <legend>Deletar Produtos</legend>
                    <br><br>
                    <p class="subtitle">Você está prestes a <strong>EXCLUIR</strong> este produto!</p>
                    <div class="botao">
                        <input type="submit" name="cancelar" class="submit cancelar" value="CANCELAR">
                        <input type="submit" name="excluir" class="submit excluir" value="EXCLUIR">
                    </div>
            </form>
        </div>
    </body>
</html>