<?php

require __DIR__.'/vendor/autoload.php';

use \App\Entity\Logar;
use \App\Entity\Cadastrar;

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

if(isset($_POST['submit'])){

    switch('submit'){
        case 'submit':
                //Tratamento de imagem para envio
                $img = $_FILES['img'];
                if($img['size'] > 4194304){
                    $alertaImg = 'Tamanho da imagem maior que 4MB';
                    $class = 'vermelho';
                    break;
                }
                $pasta = "imgProd/";
                $imgNome = $img['name'];
                $imgNomeid = uniqid();
                $ext = strtolower(pathinfo($imgNome, PATHINFO_EXTENSION));
                if($ext != 'jpg' && $ext != 'png'){
                    $alertaImg = 'Formato de arquivo invalido';
                    $class = 'vermelho';
                    break;
                }
                $caminho = $pasta . $imgNomeid . "." . $ext;
                $envio = move_uploaded_file($img["tmp_name"], $caminho);
                    
                //Instanciamento da classe CadastrarProd para realizar o cadastro
                $obCadastrarProd = new Cadastrar();
                $obCadastrarProd->nome = $_POST['nome'];
                $obCadastrarProd->valor = $_POST['valor'];
                $obCadastrarProd->processador = $_POST['processador'];
                $obCadastrarProd->video = $_POST['video'];
                $obCadastrarProd->placamae = $_POST['placamae'];
                $obCadastrarProd->memoria = $_POST['memoria'];
                $obCadastrarProd->armazenamento = $_POST['armazenamento'];
                $obCadastrarProd->fonte = $_POST['fonte'];
                $obCadastrarProd->gabinete = $_POST['gabinete'];
                $obCadastrarProd->cabohdmi = $_POST['cabohdmi'];
                $obCadastrarProd->caboforca = $_POST['caboforca'];
                $obCadastrarProd->url = $_POST['url'];
                $obCadastrarProd->destaque = $_POST['destaque'];
                $obCadastrarProd->caminho = $caminho;
                $obCadastrarProd->cadastrarProd();

                header('location: readProd.php');
            exit;
            break;
    }
}

$alertaImg = strlen($alertaImg) ? '<div class="'.$class.'">'.$alertaImg.'</div>' : '';
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
            <form enctype="multipart/form-data" action="cadastraProd.php" method="POST">
                    <legend>Cadastrar Produtos</legend>
                    <br>
                    <div class="inputbox">
                        <input type="text" name="nome" id="nome" class="inputnome" autocomplete="off" required>
                        <label for="nome" class="labelinput">Nome do Produto*: </label>
                    </div>
                    <br><br>
                    <div class="inputbox">
                        <input type="text" name="valor" id="valor" class="inputnome" autocomplete="off" required>
                        <label for="valor" class="labelinput">Valor*: </label>
                    </div>
                    <br><br>
                    <div class="inputbox">
                        <input type="text" name="processador" id="processador" class="inputnome" autocomplete="off" required>
                        <label for="processador" class="labelinput">Processador*: </label>
                    </div>
                    <br><br>
                    <div class="inputbox">
                        <input type="text" name="video" id="video" class="inputnome" autocomplete="off">
                        <label for="video" class="labelinput">Placa de Vídeo: </label>
                    </div>
                    <br><br>
                    <div class="inputbox">
                        <input type="text" name="placamae" id="placamae" class="inputnome" autocomplete="off" required>
                        <label for="placamae" class="labelinput">Placa Mãe*: </label>
                    </div>
                    <br><br>
                    <div class="inputbox">
                        <input type="text" name="memoria" id="memoria" class="inputnome" autocomplete="off" required>
                        <label for="memoria" class="labelinput">Memória*: </label>
                    </div>
                    <br><br>
                    <div class="inputbox">
                        <input type="text" name="armazenamento" id="armazenamento" class="inputnome" autocomplete="off" required>
                        <label for="armazenamento" class="labelinput">Armazenamento*: </label>
                    </div>
                    <br><br>
                    <div class="inputbox">
                        <input type="text" name="fonte" id="fonte" class="inputnome" autocomplete="off" required>
                        <label for="fonte" class="labelinput">Fonte*: </label>
                    </div>
                    <br><br>
                    <div class="inputbox">
                        <input type="text" name="gabinete" id="gabinete" class="inputnome" autocomplete="off" required>
                        <label for="gabinete" class="labelinput">Gabinete*: </label>
                    </div>
                    <br><br>
                    <div class="inputbox">
                        <input type="text" name="cabohdmi" id="cabohdmi" class="inputnome" autocomplete="off" required>
                        <label for="cabohdmi" class="labelinput">Cabo HDMI*: </label>
                    </div>
                    <br><br>
                    <div class="inputbox">
                        <input type="text" name="caboforca" id="caboforca" class="inputnome" autocomplete="off" required>
                        <label for="caboforca" class="labelinput">Cabo de Força*: </label>
                    </div>
                    <br><br>
                    <div class="inputbox">
                        <input type="text" name="url" id="url" class="inputnome" autocomplete="off" required>
                        <label for="url" class="labelinput">URL*: </label>
                    </div>
                    <br><br>
                    <div class="inputbox">
                        <label for="caboforca" class="labelinput">Destaque da Semana</label>
                        <br>
                        <label> <input type="radio" name="destaque" class="inputradio" value="sim">Sim</label>
                        <br>
                        <label> <input type="radio" name="destaque" class="inputradio" value="nao" checked>Não</label>
                    </div>
                    <br><br>
                    <div class="inputbox">
                        <input type="file" name="img" id="img" class="inputnome" autocomplete="off">
                        <label for="img" class="labelinput"></label>
                    </div>
                    <div class="vermelho">Selecione uma imagem. (MAXIMO 4MB)</div>
                    <?=$alertaImg?>
                    <br><br>
                    <div>
                        <input type="submit" name="submit" class="submit" id="submit" value="Cadastrar">
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