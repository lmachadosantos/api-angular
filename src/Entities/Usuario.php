<?php
namespace API\Entities;

class Usuario
{

    private $id;

    public $login;

    private $senha;

    public $ativo;

    private $criadoEm;

    private $atualizadoEm;

    private $excluido;

    public function __construct()
    {
        $this->criadoEm = date('Y-m-d H:i:s');
        $this->excluido = 0;
    }

    public function obtemId()
    {
        return $this->id;
    }

    public function obtemLogin()
    {
        return $this->login;
    }

    public function defineLogin($login)
    {
        $this->login = $login;
    }

    public function defineSenha($senha)
    {
        $this->senha = $senha;
    }

    public function obtemAtivo()
    {
        return $this->ativo;
    }

    public function defineAtivo($ativo)
    {
        $this->ativo = $ativo;
    }

    public function defineAtualizadoEm($atualizadoEm)
    {
        $this->atualizadoEm = $atualizadoEm;
    }
    
    public function autentica($senha)
    {
        $criptografia = new Criptografia($senha);
        
        if($this->senha == $criptografia->run())
            return true;
    }
}