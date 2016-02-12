<?php
namespace API\Repositories;

use stdClass;
use Respect\Rest\Routable;
use Respect\Relational\Mapper;
use API\Entities\Atividade;
use API\Repositories\ModuloRepository;

class AtividadeRepository implements Routable
{

    private $mapper;

    public function __construct(Mapper $mapper)
    {
        $this->mapper = $mapper;
    }

    public function get($id = null)
    {
        $resposta = new stdClass();
        
        if ($id) {
            $atividade = $this->mapper->atividade(array(
                'id' => "{$id}",
                'excluido' => 0
            ))->fetch();
        } else {
            $atividade = $this->mapper->atividade(array(
                'excluido' => 0
            ))->fetchAll();
        }
        
        $resposta->atividade = $atividade;
        
        return $resposta;
    }

    public function post()
    {
        $titulo = (empty($_POST['titulo'])) ? null : $_POST['titulo'];
        $descricao = (empty($_POST['descricao'])) ? null : $_POST['descricao'];
        $moduloId = (empty($_POST['moduloId'])) ? null : $_POST['moduloId'];
        
        $resposta = new stdClass();
        $resposta->success = false;
        
        if ($titulo && $moduloId) {
            
            $moduloRepository = new ModuloRepository($this->mapper);
            $modulo = $moduloRepository->get($moduloId);
            
            $atividade = new Atividade();
            
            $atividade->defineTitulo($titulo);
            $atividade->defineDescricao($descricao);
            $atividade->defineModuloId($modulo->obtemId());
            $atividade->defineAtivo(1);
            
            $this->mapper->atividade->persist($atividade);
            $this->mapper->flush();
            
            $resposta->success = true;
        }
        return $resposta;
    }
}