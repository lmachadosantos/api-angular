<?php
namespace API;

use Respect\Relational\Mapper;
use SplObjectStorage;

class MyMapper extends Mapper
{

    protected function postHydrate(SplObjectStorage $entities)
    {
        $entitiesClone = clone $entities;
        
        foreach ($entities as $instance) {
            foreach ($this->getAllProperties($instance) as $field => $v) {
                if (! $this->getStyle()->isRemoteIdentifier($field)) {
                    continue;
                }
                
                foreach ($entitiesClone as $sub) {
                    $this->tryHydration($entities, $sub, $field, $v);
                }
                
                $field = substr($field, 0, - 2);
                
                $this->inferSet($instance, $field, $v);
            }
        }
    }
}