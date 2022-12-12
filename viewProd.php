<?php
require __DIR__.'/vendor/autoload.php';

use \App\Entity\Logar;
use \App\Entity\Produtos;


//Verifica se o usuario a esta logado
$usuarioLogado = Logar::getUsuarioLogado();
$usuario = $usuarioLogado ? $usuarioLogado['nome'] : '';

//Captura o tipo de usuario
$usuarioLogado = Logar::getUsuarioLogado();
$tipo = $usuarioLogado['tipo'];

//Busca todos o prudot disponivel com esse ID
$produto = Produtos::getProduto($_GET['id']);
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
    <body>
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
            <i class="fas fa-search" id="search-icon"></i>
            
            <?php if(Logar::isLogged() && $tipo != 'adm'){?>
            <ul>
                <li><a href="#" class="fas fa-users"></a>
                    <ul>
                        <li><a href="editar.php">EDITAR</a></li>
                        <li><a href="deletar.php">EXCLUIR</a></li>
                        <li><a href="logout.php">SAIR</a></li> 
                    </ul>
                </li>
            </ul>
            <?php } else if(!Logar::isLogged()){?>
                <ul>
                <li><a href="#" class="fas fa-users"></a>
                    <ul>
                        <li><a href="login.php">ENTRAR</a></li>
                        <li><a href="registrar.php">REGISTRAR</a></li>
                    </ul>
                </li>
            </ul>
            <?php } else if(Logar::isLogged() && $tipo == 'adm'){?>
                <ul>
                <li><a href="#" class="fas fa-users"></a>
                    <ul>
                        <li><a href="cadastraProd.php">CADASTRAR</a></li>
                        <li><a href="readProd.php">VISUALIZAR</a></li>
                        <li><a href="logout.php">SAIR</a></li> 
                    </ul>
                </li>
            </ul>
            <?php }?>
        </div>
        </header>

        <Section>
            <div class="">
                <div class="img">
                <img height="450" src="<?=$produto->caminho?>" alt="">
                </div>
                <div class="name">
                    <h1><?=$produto->nome?></h1>
                </div>
                <div class="desc">
                    <strong>Processador</strong>
                    <p><?=$produto->processador?></p>
                    <br>
                    <?php if($produto->video){?>
                    <strong>Placa de Vídeo</strong>
                    <p><?=$produto->video?></p>
                    <br>
                    <?php } ?>
                    
                    <strong>Processador</strong>
                    <p><?=$produto->processador?></p>
                    <br>
                    <strong>Placa Mãe</strong>
                    <p><?=$produto->placamae?></p>
                    <br>
                    <strong>Memória</strong>
                    <p><?=$produto->memoria?></p>
                    <br>
                    <strong>Armazenamento</strong>
                    <p><?=$produto->armazenamento?></p>
                    <br>
                    <strong>Fonte</strong>
                    <p><?=$produto->fonte?></p>
                    <br>
                    <strong>Gabinete</strong>
                    <p><?=$produto->gabinete?></p>
                    <br>
                    <strong>Cabo HDMI</strong>
                    <p><?=$produto->cabohdmi?></p>
                    <br>
                    <strong>Cabo de Força</strong>
                    <p><?=$produto->caboforca?></p>
                </div>
                <a href="<?=$produto->url?>" class="viewBtn">ir para o pc</a>
                <span class="viewPrice"><?=$produto->valor?></span>
            </div>
        </Section>
    </body>
</html>