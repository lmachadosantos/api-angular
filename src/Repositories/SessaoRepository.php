<?php
namespace API\Repositories;

use stdClass;
use Respect\Rest\Routable;
use Respect\Relational\Mapper;
use API\Entities\Sessao;
use API\Repositories\UsuarioRepository;

class SessaoRepository implements Routable
{

    private $mapper;

    public function __construct(Mapper $mapper)
    {
        $this->mapper = $mapper;
    }

    public function get()
    {
        $headers = apache_request_headers();
        $token = null;
        $bearer = null;
        
        $resposta = new stdClass();
        $resposta->success = false;
        
        if (! isset($headers['Authorization']))
            return $resposta;
        
        $authorization = (string) $headers['Authorization'];
        $sessao = new Sessao($this->mapper);
        
        if ($sessao->validaFormatoDoToken($authorization))
            list ($bearer, $token) = explode(" ", $authorization);
        
        $registro = $this->mapper->sessao(array(
            'id' => "{$token}",
            'excluido' => 0,
            'dataHoraFim >=' => date('Y-m-d H:i:s')
        ))->fetch();
        
        if (! $registro)
            return $resposta;
        
        $resposta->success = true;
        
        return $resposta;
    }

    public function post()
    {
        $login = (empty($_POST['login'])) ? null : $_POST['login'];
        $senha = (empty($_POST['senha'])) ? null : $_POST['senha'];
        
        $usuarioRepository = new UsuarioRepository($this->mapper);
        $usuario = $usuarioRepository->getPorLogin($login);
        
        $resposta = new stdClass();
        $resposta->success = false;
        
        if ($usuario && $usuario->autentica($senha)) {
            
            $sessao = new Sessao();
            
            $sessao->defineUsuarioId($usuario->obtemId());
            $sessao->defineDataHoraInicio(date('Y-m-d H:i:s'));
            $sessao->defineDataHoraFim($sessao->calculaDataHoraFim());
            $tokenAcesso = $sessao->geraTokenAcesso();
            
            $sessao->defineId($tokenAcesso);
            
            $this->mapper->sessao->persist($sessao);
            $this->mapper->flush();
            
            $resposta->success = true;
            $resposta->sessao = array(
                'tokenAcesso' => "bearer {$tokenAcesso}"
            );
        }
        return $resposta;
    }
}