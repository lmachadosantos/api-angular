<?php
namespace API\Entities;

class Atividade
{

    public $id;

    private $moduloId;

    public $titulo;

    public $descricao;

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

    public function obtemModuloId()
    {
        return $this->moduloId;
    }

    public function defineModuloId($moduloId)
    {
        $this->moduloId = $moduloId;
    }

    public function obtemTitulo()
    {
        return $this->titulo;
    }

    public function defineTitulo($titulo)
    {
        $this->titulo = $titulo;
    }

    public function obtemDescricao()
    {
        return $this->descricao;
    }

    public function defineDescricao($descricao)
    {
        $this->descricao = $descricao;
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
}