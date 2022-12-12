<?php
namespace App\Entity;

class Logar{

    /**
     * Metodo responsavel por iniciar uma sessão
     */
    private static function init(){

        //verifica o status da sessão
        if(session_status() !== PHP_SESSION_ACTIVE){
            session_start();
        }
    }

    /**
     * Metodo responsavel por retornar os dados dos usuarios logados
     * @return array
     */
    public static function getUsuarioLogado(){

        //inicia a sessão
        self::init();

        return self::isLogged() ? $_SESSION['usuario'] : null;
    }

    /**
     * Metodo responsavel por deslogar o usuario 
     */
    public static function logout(){
        //inicia a sessão
        self::init();

        //Remove a sessão do usuario
        unset($_SESSION['usuario']);

        //Retorna o usuario para login
        header('location: login.php');
            exit;
    }

    /**
     * Metodo responsavel por logar o usuario
     * @param Usuario $obUsuario
     */
    public static function login($obUsuario){

        //inicia a sessão
        self::init();

        //sessão de usuario
        $_SESSION['usuario'] = [
            'id' => $obUsuario->id,
            'nome' => $obUsuario->nome,
            'sobrenome' => $obUsuario->sobrenome,
            'email' => $obUsuario->email,
            'nascimento' => $obUsuario->nascimento,
            'celular' => $obUsuario->celular,
            'tipo' => $obUsuario->tipo
        ];

        $logged = true;

        //Redireciona usuario para o index
        header('location: index.php');
        exit;
    }

    /**
     * Metodo responsavel por verificar se o usuario está logado
     * @var string
     */
    public static function isLogged(){
        //inicia a sessão
        self::init();

        //validação da sessão
        return isset($_SESSION['usuario']['id']);
    }

    /**
     * Metodo responsavel por obrigar o usuario e estar logado para acessar uma pagina
     * @var string
     */
    public static function requireLogin(){

        if(!self::isLogged()){
            header('location: login.php');
            exit;
        }
    }

    /**
     * Metodo responsavel por obrigar o usuario e estar deslogado para acessar uma pagina
     * @var string
     */
    public static function requireLogout(){

        if(self::isLogged()){
            header('location: index.php');
            exit;
        }
    }
}