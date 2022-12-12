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
    header('location: index.php');
            exit;
}

//Busca todos os produtos disponíveis
$produtos = Produtos::produtos();

$resultado = '';
foreach($produtos as $produto){
    $resultado .='<tr>
                    <td><img height="50" src="'.$produto->caminho.'" alt""></td>
                    <td>'.$produto->id.'</td>
                    <td>'.$produto->nome.'</td>
                    <td>'.$produto->valor.'</td>
                    <td>
                        <a href="editarProd.php?id='.$produto->id.'">
                        <button type="button" class="fas fa-edit"></button>
                        </a>
                        <a href="deletarProd.php?id='.$produto->id.'">
                        <button type="button" class="fas fa-trash"></button>
                        </a>
                    </td>
                  </tr>';
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

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
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

<section class="produtos" id="produtos"></section>
<div class="box3">
            <table class="table bg-light mt-3">
                <thead>
                    <tr>
                        <th>Preview</th>
                        <th>Id</th>
                        <th>Nome do Produto</th>
                        <th>Valor</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?=$resultado?>
                </tbody>
            </table>
        </div>
    </body>
</html>