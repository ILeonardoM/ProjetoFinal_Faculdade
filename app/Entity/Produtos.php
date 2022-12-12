<?php
namespace App\Entity;

use \App\Db\Database;
use \PDO;

class Produtos{

    /**
     * Identificador unico do cadastro
     * @var integer
     */
    public $id;

    /**
     * Nome do produto
     * @var string
     */
    public $nome;

    /**
     * Valor do produto
     * @var string
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
     * Caminho da imagem
     * @var string
     */
    public $caminho;

    /**
     * Metodo responsavel por retornar todos os produtos disponíveis
     * @var string
     * @return Produtos
     */
    public static function produtos($where = null, $order = null, $limit = null){
        return(new Database('produtos'))->select($where,$order,$limit)->fetchAll(PDO::FETCH_CLASS,self::class);
    }

    /**
     * Metodo responsavel por retornar todos os produtos disponíveis
     * @var integer $id
     * @return Produto
     */
    public static function getProduto($id){
        return(new Database('produtos'))->select('id = '.$id)->fetchObject(self::class);
    }

    /**
    * Método responsável por atualizar produtos no banco de dados
    * @return boolean
    */
    public function atualizar(){
        return (new Database('produtos'))->update('id = '.$this->id,['nome'=>$this->nome,'valor'=>$this->valor,'processador'=>$this->processador,'video'=>$this->video,'placamae'=>$this->placamae,'memoria'=>$this->memoria,'armazenamento'=>$this->armazenamento,'fonte'=>$this->fonte,'gabinete'=>$this->gabinete,'cabohdmi'=>$this->cabohdmi,'caboforca'=>$this->caboforca,'url'=>$this->url,'destaque'=>$this->destaque]);
      }

      /**
   * Método responsável por excluir produtos do banco de dados
   * @return boolean
   */
  public function excluir(){
    return (new Database('produtos'))->delete('id = '.$this->id);
  }
}