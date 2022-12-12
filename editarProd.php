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

//Busca todos o prudot disponivel com esse ID
$produto = Produtos::getProduto($_GET['id']);

$id = $produto->id;

//Validação do produto
if(!$produto instanceof Produtos){
    header('location: readProd.php');
    exit;
}

if(isset($_POST['submit'])){
                $produto->id = $id;
                $produto->nome = $_POST['nome'];
                $produto->valor = $_POST['valor'];
                $produto->processador = $_POST['processador'];
                $produto->video = $_POST['video'];
                $produto->placamae = $_POST['placamae'];
                $produto->memoria = $_POST['memoria'];
                $produto->armazenamento = $_POST['armazenamento'];
                $produto->fonte = $_POST['fonte'];
                $produto->gabinete = $_POST['gabinete'];
                $produto->cabohdmi = $_POST['cabohdmi'];
                $produto->caboforca = $_POST['caboforca'];
                $produto->url = $_POST['url'];
                $produto->destaque = $_POST['destaque'];
                $produto->atualizar();

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
        <div class="box2">
            <form action="editarProd.php?id=<?=$id?>" method="POST">
                    <legend>Editar Produto</legend>
                    <br>
                    <div class="inputbox">
                        <input type="text" name="nome" id="nome" class="inputnome" autocomplete="off" value="<?=$produto->nome;?>" required>
                        <label for="nome" class="labelinput">Nome do Produto*: </label>
                    </div>
                    <br><br>
                    <div class="inputbox">
                        <input type="text" name="valor" id="valor" class="inputnome" autocomplete="off" value="<?=$produto->valor;?>" required>
                        <label for="valor" class="labelinput">Valor*: </label>
                    </div>
                    <br><br>
                    <div class="inputbox">
                        <input type="text" name="processador" id="processador" class="inputnome" autocomplete="off" value="<?=$produto->processador;?>" required>
                        <label for="processador" class="labelinput">Processador*: </label>
                    </div>
                    <br><br>
                    <div class="inputbox">
                        <input type="text" name="video" id="video" class="inputnome" autocomplete="off" value="<?=$produto->video;?>">
                        <label for="video" class="labelinput">Placa de Vídeo: </label>
                    </div>
                    <br><br>
                    <div class="inputbox">
                        <input type="text" name="placamae" id="placamae" class="inputnome" autocomplete="off" value="<?=$produto->placamae;?>" required>
                        <label for="placamae" class="labelinput">Placa Mãe*: </label>
                    </div>
                    <br><br>
                    <div class="inputbox">
                        <input type="text" name="memoria" id="memoria" class="inputnome" autocomplete="off" value="<?=$produto->memoria;?>" required>
                        <label for="memoria" class="labelinput">Memória*: </label>
                    </div>
                    <br><br>
                    <div class="inputbox">
                        <input type="text" name="armazenamento" id="armazenamento" class="inputnome" autocomplete="off" value="<?=$produto->armazenamento;?>" required>
                        <label for="armazenamento" class="labelinput">Armazenamento*: </label>
                    </div>
                    <br><br>
                    <div class="inputbox">
                        <input type="text" name="fonte" id="fonte" class="inputnome" autocomplete="off" value="<?=$produto->fonte;?>" required>
                        <label for="fonte" class="labelinput">Fonte*: </label>
                    </div>
                    <br><br>
                    <div class="inputbox">
                        <input type="text" name="gabinete" id="gabinete" class="inputnome" autocomplete="off" value="<?=$produto->gabinete;?>" required>
                        <label for="gabinete" class="labelinput">Gabinete*: </label>
                    </div>
                    <br><br>
                    <div class="inputbox">
                        <input type="text" name="cabohdmi" id="cabohdmi" class="inputnome" autocomplete="off" value="<?=$produto->cabohdmi;?>" required>
                        <label for="cabohdmi" class="labelinput">Cabo HDMI*: </label>
                    </div>
                    <br><br>
                    <div class="inputbox">
                        <input type="text" name="caboforca" id="caboforca" class="inputnome" autocomplete="off" value="<?=$produto->caboforca;?>" required>
                        <label for="caboforca" class="labelinput">Cabo de Força*: </label>
                    </div>
                    <br><br>
                    <div class="inputbox">
                        <input type="text" name="url" id="url" class="inputnome" autocomplete="off" value="<?=$produto->url;?>" required>
                        <label for="url" class="labelinput">URL*: </label>
                    </div>
                    <br><br>
                    <div class="inputbox">
                        <label for="caboforca" class="labelinput">Destaque da Semana</label>
                        <br>
                        <label> <input type="radio" name="destaque" class="inputradio" value="sim" <?php if($produto->destaque == 'sim'){ ?>checked<?php } ?>>Sim</label>
                        <br>
                        <label> <input type="radio" name="destaque" class="inputradio" value="nao" <?php if($produto->destaque == 'nao'){ ?>checked<?php } ?>>Não</label>
                    </div>
                    <br><br>
                    <div>
                        <input type="submit" name="submit" class="submit" id="submit" value="Editar">
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
                <li><a href="cadastraProd.php">CADASTRAR</a></li>
                <li><a href="readProd.php">VISUALIZAR</a></li>
                <li><a href="logout.php">SAIR</a></li> 
            </ul>
        </li>
        </ul>
</div>
</header>
</body>
</html>