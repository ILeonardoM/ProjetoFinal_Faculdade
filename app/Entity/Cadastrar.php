<?php
namespace App\Entity;

use \App\Db\Database;

class Cadastrar{

    /**
     * Identificador unico do cadastro
     * @var integer
     */
    public $id;

    /**
     * Nome da pessoa/produto
     * @var string
     */
    public $nome;

    /**
     * Sobrenome da pessoa
     * @var string
     */
    public $sobrenome;

    /**
     * Email da pessoa
     * @var string
     */
    public $email;

    /**
     * Data de nascimento da pessoa
     * @var Date
     */
    public $nascimento;

    /**
     * Telefone do cliente
     * @var integer
     */
    public $celular;

    /**
     * Senha da pessoa
     * @var string
     */
    public $senha;

    /**
     * Tipo de pessoa
     * @var string
     */
    public $tipo = 'cliente';

    /**
     * Valor do produto
     * @var integer
     */
    public $valor;

    /**
     * Processador
     * @var string
     */
    public $processador;

    /**
     * Placa de vídeo
     * @var string
     */
    public $video;

    /**
     * Placa Mãe
     * @var string
     */
    public $placamae;

    /**
     * Memória RAM
     * @var string
     */
    public $memoria;

    /**
     * Armazenamento (SSD/HD)
     * @var string
     */
    public $armazenamento;

    /**
     * Fonte
     * @var string
     */
    public $fonte;

    /**
     * Gabinete
     * @var string
     */
    public $gabinete;

    /**
     * Cabo HDMI
     * @var string
     */
    public $cabohdmi;

    /**
     * Cabo de Força
     * @var string
     */
    public $caboforca;

    /**
     * URL
     * @var string
     */
    public $url;

    /**
     * Destaque da semana
     * @var string
     */
    public $destaque;

    /**
     * Caminho da imagem
     * @var string
     */
    public $caminho;

    /**
     * Metodo responsavel por cadastrar uma pessoa no banco
     * @return boolean
     */
    public function cadastrar(){
        //Inserir o cadastro no bando de dados
        $obDatabase = new Database('clientes');
        $this->id = $obDatabase->insert([
            'nome' => $this->nome,
            'sobrenome' => $this->sobrenome,
            'email' => $this->email,
            'nascimento' => $this->nascimento,
            'celular' => $this->celular,
            'senha' => $this->senha,
            'tipo' => $this->tipo
        ]);
        
        //Retornar sucesso
        return true;
    }

    /**
     * Metodo responsavel por cadastrar produtos no banco
     * @return boolean
     */
    public function cadastrarProd(){
        //Inserir o cadastro no bando de dados
        $obDatabase = new Database('produtos');
        $this->id = $obDatabase->insert([
            'nome' => $this->nome,
            'valor' => $this->valor,
            'processador' => $this->processador,
            'video' => $this->video,
            'placamae' => $this->placamae,
            'memoria' => $this->memoria,
            'armazenamento' => $this->armazenamento,
            'fonte' => $this->fonte,
            'gabinete' => $this->gabinete,
            'cabohdmi' => $this->cabohdmi,
            'caboforca' => $this->caboforca,
            'caminho' => $this->caminho,
            'url' => $this->url,
            'destaque' => $this->destaque
        ]);

        //Retornar sucesso
        return true;
    }
}