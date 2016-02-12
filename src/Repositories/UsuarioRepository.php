<?php
namespace API\Repositories;

use stdClass;
use Respect\Rest\Routable;
use Respect\Relational\Mapper;
use API\Entities\Criptografia;
use API\Entities\Usuario;

class UsuarioRepository implements Routable
{

    private $mapper;

    public function __construct(Mapper $mapper)
    {
        $this->mapper = $mapper;
    }

    public function get($id = null)
    {        
        if ($id) {
            $usuario = $this->mapper->usuario(array(
                'id' => "{$id}",
                'excluido' => 0
            ))->fetch();
        } else {
            $usuario = $this->mapper->usuario(array(
                'excluido' => 0
            ))->fetchAll();
        }        
        return $usuario;
    }

    public function post()
    {
        $login = (empty($_POST['login'])) ? null : $_POST['login'];
        $senha = (empty($_POST['senha'])) ? null : $_POST['senha'];
        
        $resposta = new stdClass();
        $resposta->success = false;
        
        if ($login && $senha) {
            $usuario = new Usuario();
            $criptografia = new Criptografia($senha);
            
            $usuario->defineLogin($login);
            $usuario->defineSenha($criptografia->run());
            $usuario->defineAtivo(1);
            
            $this->mapper->usuario->persist($usuario);
            $this->mapper->flush();
            
            $resposta->success = true;
        }
        return $resposta;
    }

    public function getPorLogin($login)
    {
        $usuario = $this->mapper->usuario(array(
            'login' => "{$login}",
            'excluido' => 0
        ))->fetch();
        
        return $usuario;
    }
}