<?php
namespace API\Entities;

use Exception;

class Sessao
{

    public $id;

    public $usuarioId;

    public $dataHoraInicio;

    public $dataHoraFim;

    public $criadoEm;

    public $atualizadoEm;

    public $excluido;

    public function __construct()
    {
        $this->criadoEm = date('Y-m-d H:i:s');
        $this->excluido = 0;
    }

    public function obtemId()
    {
        return $this->id;
    }

    public function defineId($id)
    {
        $this->id = $id;
    }

    public function obtemUsuarioId()
    {
        return $this->usuarioId;
    }

    public function defineUsuarioId($usuarioId)
    {
        $this->usuarioId = $usuarioId;
    }

    public function obtemDataHoraInicio()
    {
        return $this->dataHoraInicio;
    }

    public function defineDataHoraInicio($dataHoraInicio)
    {
        $this->dataHoraInicio = $dataHoraInicio;
    }

    public function obtemDataHoraFim()
    {
        return $this->dataHoraFim;
    }

    public function defineDataHoraFim($dataHoraFim)
    {
        $this->dataHoraFim = $dataHoraFim;
    }

    public function defineAtualizadoEm($atualizadoEm)
    {
        $this->atualizadoEm = $atualizadoEm;
    }

    public function geraTokenAcesso()
    {
        $tokenAcesso = null;
        $chave = "CHAVE";
        
        if (! $this->dataHoraInicio && ! $this->dataHoraFim)
            throw new Exception('Data e Hora do Inicio e do Fim, deve ser definida antes da geracao do token.');
        
        $tokenAcesso = md5($this->dataHoraInicio . $chave . $this->dataHoraFim);
        
        return $tokenAcesso;
    }

    public function calculaDataHoraFim()
    {
        $dataHoraFim = null;
        
        if (! $this->dataHoraInicio)
            throw new Exception('Data e Hora do Inicio, deve ser definida antes da geracao da Data e Hora do Fim');
        
        $dataHoraFim = date('Y-m-d H:i:s', strtotime('+30 minute', strtotime($this->dataHoraInicio)));
        
        return $dataHoraFim;
    }

    public function validaFormatoDoToken($tokenAcesso)
    {
        $validaToken = strpos($tokenAcesso, 'bearer');
        
        if ($validaToken === false)
            throw new Exception('O token está em um formato invalido!');
        
        return true;
    }
}