<?php
namespace API;

use Respect\Data\Styles\Standard;

class MyStyle extends Standard
{    
    
    public function realName($name)
    {
        return strtolower($name);
    }
    
    public function styledName($name)
    {
        return ucfirst($name);
    }
            
    public function remoteIdentifier($name)
    {
        return $name . 'Id';
    }

    public function isRemoteIdentifier($name)
    {
        return (strlen($name) - 2 === strrpos($name, 'Id'));
    }

    public function remoteFromIdentifier($name)
    {
        if ($this->isRemoteIdentifier($name)) {
            return substr($name, 0, - 2);
        }
    }
}