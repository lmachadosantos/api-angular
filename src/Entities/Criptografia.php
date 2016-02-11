<?php
namespace API\Entities;

class Criptografia
{
    private $senha;
    private $chave;
    
    public function __construct($senha, $chave = 'respostaparaavidaouniversoetudomais')
    {
        $this->senha = $senha;
        $this->chave = $chave;
    }
    
    public function run()
    {
        $senhaCriptografada = sha1($this->senha . $this->chave);
        
        return $senhaCriptografada;
    }
}