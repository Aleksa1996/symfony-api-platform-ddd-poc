<?php

namespace App\Common\Domain;


use Verraes\ClassFunctions\ClassFunctions;

trait Projects
{
    /**
     * @param array $domainEvents
     *
     * @return void
     */
    public function project(array $domainEvents): void
    {
        foreach ($domainEvents as $domainEvent) {
            $projectMethod = 'project' . ClassFunctions::short($domainEvent);
            $this->$projectMethod($domainEvent);
        }
    }
}
