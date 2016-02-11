<?php
namespace API\Repositories;

use stdClass;
use Respect\Rest\Routable;
use Respect\Relational\Mapper;
use API\Entities\Modulo;

class ModuloRepository implements Routable
{

    private $mapper;

    public function __construct(Mapper $mapper)
    {
        $this->mapper = $mapper;
    }

    public function get($id = null)
    {
        if ($id) {
            $modulo = $this->mapper->modulo(array(
                'id' => "{$id}",
                'excluido' => 0
            ))->fetch();
        } else {
            $modulo = $this->mapper->modulo(array(
                'excluido' => 0
            ))->fetchAll();
        }
        
        return $modulo;
    }

    public function post()
    {
        $titulo = (empty($_POST['titulo'])) ? null : $_POST['titulo'];
        $descricao = (empty($_POST['descricao'])) ? null : $_POST['descricao'];
        
        $resposta = new stdClass();
        $resposta->success = false;
        
        if ($titulo) {
                        
            $modulo = new Modulo();
            
            $modulo->defineTitulo($titulo);
            $modulo->defineDescricao($descricao);
            $modulo->defineAtivo(1);
            
            $this->mapper->modulo->persist($modulo);
            $this->mapper->flush();
            
            $resposta->success = true;
        }
        return $resposta;
    }
}