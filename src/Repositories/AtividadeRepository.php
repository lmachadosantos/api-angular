<?php
namespace API\Repositories;

use stdClass;
use Respect\Rest\Routable;
use API\Entities\Atividade;
use API\Repositories\ModuloRepository;

class AtividadeRepository implements Routable
{

    public function get($id = null)
    {    
        /*
        if ($id) {
            $stmt = $this->mapper->atividade(array(
                'id' => "{$id}",
                'excluido' => 0
            ));
            
            if(isset($_GET['include'])) {
                $include = $_GET['include'];
                $atividade = $stmt->$include->fetch();
            }else{
                $atividade = $stmt->fetch();
            }
            
        } else {
            $stmt = $this->mapper->atividade(array(
                'excluido' => 0
            ));
            
            if(isset($_GET['include'])) {
                $include = $_GET['include'];
                $atividade = $stmt->$include->fetchAll();
            }else{
                $atividade = $stmt->fetchAll();
            }
        }
        */
        
        return $article = $entityManager->find('CMS\Article', 1234);
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