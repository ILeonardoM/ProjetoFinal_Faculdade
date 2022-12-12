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

//Busca todos os produtos disponíveis
$produtos = Produtos::produtos();


$resultado = '';
foreach($produtos as $produto){
    $resultado .='
    <div class="box">
        <div class="image">
            <img height="191" src="'.$produto->caminho.'" alt"">
        </div>
        <div class="content">
            <div class="stars">
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star-half-alt"></i>
            </div>
            <h3>'.$produto->nome.'</h3>
            <a href="viewProd.php?id='.$produto->id.'" class="btn">ir para o pc</a>
            <span class="price">'.$produto->valor.'</span>
        </div>
    </div>';
}

$where = 'destaque = \'sim\'';
$destaques = Produtos::produtos($where);
$resultado2 = '';
foreach($destaques as $destaque){
    $resultado2 .='<div class="swiper-slide slide">
    <div class="content">
        <span>computadores da semana</span>
        <h3>'.$destaque->valor.'</h3>
        <a href="viewProd.php?id='.$destaque->id.'" class="btn">veja agora</a>
    </div>
    <div class="image">
        <img src="'.$destaque->caminho.'" alt="">
    </div>
    </div>';
}

$resultado3 = '';
foreach($destaques as $destaque2){
    $resultado3 .='
    <div class="box">
        <div class="image">
            <img height="191" src="'.$destaque2->caminho.'" alt"">
        </div>
        <div class="content">
            <div class="stars">
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star-half-alt"></i>
            </div>
            <h3>'.$destaque2->nome.'</h3>
            <a href="viewProd.php?id='.$destaque2->id.'" class="btn">ir para o pc</a>
            <span class="price">'.$destaque2->valor.'</span>
        </div>
    </div>';
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
<body>
    
 <!--inicio do cabeçalho-->

<header>

<a href="#" class="logo"><i class="fas fa-tv"></i>BLADE.</a>

<nav class="navbar">
    <a class="active"href="#home">home</a>
    <a href="#destaques">destaques</a>
    <a href="#sobre">sobre</a>
    <a href="#produtos">produtos</a>
    <a href="#avaliacao">avaliações</a>
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

<!--final do cabeçalho-->

<!--formulario de pesquisa -->

<form action="" id="search-form">
    <input type="search" placeholder="pesquise aqui..." name="" id="search-box">
    <label for="search-box" class="fas fa-search"></label>
    <i class="fas fa-times" id="close"></i>
</form>

<!--inicio da sessão home-->

<section class="home" id="home">

    <div class="swiper mySwiper home-slider">

        <div class="swiper-wrapper wrapper">

            <?=$resultado2?>

        </div>

        <div class="swiper-pagination"></div>

    </div>

</section>
<!--fim da sessão home-->

<!--inicio da sessão destaques-->

<section class="produtos" id="produtos">

    <h3 class="sub-heading"> Principais computadores</h3>
    <h1 class="heading"> computadores populares</h1>


    <div class="box-container">

    <?=$resultado3?>
        
    </div>

</section>
<!--fim da sessão destaques-->

<!--INICIO da sessão SOBRE NÓS-->

<section class="sobre" id="sobre">

    <h3 class="sub-heading"> Sobre nós</h3>
    <h1 class="heading"> Porque escolher-nos?</h1>

    <div class="row">

        <div class="=image">
            <img src="images/about-us.png" alt="">
        </div>
    
        <div class="content">
            <h3>Melhor Site de procura para o seu computador dos sonhos</h3>
            <p>Nós viemos com o intuito de te auxiliar a terem mais condução de suas escolhas 
            para o computador do seu jeito.
            Desde sua criação, a empresa é formada por histórias e conquistas de um time obcecado por agilidade, qualidade de atendimento e respeito pelo consumidor, buscando sempre o melhor preço.
            Com preços imbatíveis e mais novidades de produtos em seu catálogo, a BLADE! está sempre à frente e traz em primeira mão os melhores lançamentos do mercado mundial. São mais de 8 milhões de pessoas redirecionadas  ao produto desejado. 
            é um dos sites mais acessados do país e lidera o ranking mais recomendadas pelos consumidores brasileiros, no segmento de tecnologia*, com os principais índices de avaliação e selos de qualidade da internet.</p>
            <div class="icons-container">
                <div class="icons">
                    <i class="fas fa-globe"></i>
                    <span>Líder Global</span>
                </div>
                <div class="icons">
                    <i class="fas fa-headset"></i>
                    <span>Duvidas? ligue:(11)4638-5564</span>
                </div>
            </div>
            <a href="#" class="btn">siga nossos desenvolvedores</a>
        </div>
    
    
    </div>

</section>
<!--FIM  da sessão SOBRE NÓS-->

<!--INICIO  da sessão PRODUTOS-->

<section class="produtos" id="produtos">

    <h3 class="sub-heading"> Nossos Produtos </h3>
    <h1 class="heading"> Computadores Gamers </h1>

    <div class="box-container">
        <?=$resultado?>
    </div>

</section>
<!--FIM  da sessão PRODUTOS-->

<!--INICIO  da sessão AVALIAÇÃO-->

<section class="avaliacao" id="avaliacao">

    <h3 class="sub-heading"> Comentarios de Alguns Usuários</h3>
    <h1 class="heading">O que eles dizem </h1>

    <div class="swiper-container avaliacao-slider">

        <div class="swiper-wrapper">

            <div class="swiper-slide slide">
                <div class="user">
                    <img src="images/pic-2.png" alt="">
                    <div class="user-info">
                        <h3>Helena.A</h3>
                        <div class="stars">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star-half-alt"></i>
                        </div>
                    </div>
                </div>
                <p> me ajudou demais alem de  ter os links confiaveis</p>
            </div>

            <div class="swiper-slide slide">
                <div class="user">
                    <img src="images/pic-3.png" alt="">
                    <div class="user-info">
                        <h3>Brayan.H</h3>
                        <div class="stars">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star-half-alt"></i>
                        </div>
                    </div>
                </div>
                <p>Gostei do site e do desconto que ganho .</p>
            </div>

            <div class="swiper-slide slide">
                <div class="user">
                    <img src="images/pic-1.png" alt="">
                    <div class="user-info">
                        <h3> Henrique.L</h3>
                        <div class="stars">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star-half-alt"></i>
                        </div>
                    </div>
                </div>
                <p> o PC que estava procurando achei rapido com esse site.</p>
            </div>

            <div class="swiper-slide slide">
                <div class="user">
                    <img src="images/pic-4.png" alt="">
                    <div class="user-info">
                        <h3>Larissa.S</h3>
                        <div class="stars">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star-half-alt"></i>
                        </div>
                    </div>
                </div>
                <p> me ajudou demais a encontrar o PC que estava procurando ameiiiiii dms.</p>
            </div>

        </div>
    </div>
    
</section>
<!--FIM  da sessão AVALIAÇÃO-->

<!--INICIO  da sessão RODAPÉ-->


<section class="footer">

    <div class="box-container">

        <div class="box">
            <h3>locações</h3>
            <a href="#">india</a>
            <a href="#">japao</a>
            <a href="#">Brasil</a>
            <a href="#">USA</a>
            <a href="#">frança</a>
        </div>

        

        <div class="box">
            <h3>Contatos</h3>
            <a href="#">+123-456-7890</a>
            <a href="#">+111-222-3333</a>
            <a href="#">xblade@gmail.com</a>
            <a href="#">xblade@gmail.com</a>
            <a href="#">Mogi das Cruzes, São Paulo</a>
        </div>

        <div class="box">
            <h3> Redes Sociais</h3>
            <a href="#">facebook</a>
            <a href="#">twitter</a>
            <a href="#">instagram</a>
            <a href="#">linkedin</a>
        </div>

    </div>

    <div class="credit"> copyright @ 2022 by <span>BLADE</span> </div>

</section>



<!--FIM  da sessão RODAPÉ-->

















<!--link do arquivo SWIPER-->
<script src="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.js"></script>

 <!--link do arquivo js-->
<script src="js/script.js"></script>

</body>
</html>