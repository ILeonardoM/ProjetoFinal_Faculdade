<?php
namespace App\Entity;

use \App\Db\Database;
use \PDO;

class Usuario{

    /**
     * Identificar o id do usuario
     * @var string
     */
    public $id;

    /**
     * Identificar o nome do usuario
     * @var string
     */
    public $nome;

    /**
     * Identificar o sobrenome do usuario
     * @var string
     */
    public $sobrenome;

    /**
     * Identificar o email do usuario
     * @var string
     */
    public $email;

    /**
     * Data de nascimento da pessoa
     * @var Date
     */
    public $nascimento;

    /**
     * Teledone do cliente
     * @var integer
     */
    public $celular;

    /**
     * Identificar o senha do usuario
     * @var string
     */
    public $senha;


    /**
     * Metodo responsavel por retornar uma instancia de usuario com base em seu email
     * @var string
     * @return Usuario
     */
    public static function usuarioPorEmail($email){
        return(new Database('clientes'))->select('email = "'.$email.'"')->fetchObject(self::class);
    }

    /**
    * Método responsável por atualizar usuario no banco de dados
    * @return boolean
    */
    public function atualizar(){
    return (new Database('clientes'))->update('id = '.$this->id,['nome'=>$this->nome,'sobrenome'=>$this->sobrenome,'email'=>$this->email,'nascimento'=>$this->nascimento,'celular'=>$this->celular,'senha'=>$this->senha]);
  }

  /**
   * Método responsável por excluir usuario do banco de dados
   * @return boolean
   */
  public function excluir(){
    return (new Database('clientes'))->delete('id = '.$this->id);
  }
}