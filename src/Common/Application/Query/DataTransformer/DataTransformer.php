<?php

namespace App\Common\Application\Query\DataTransformer;

interface DataTransformer
{
    /**
     * @param mixed $entity
     *
     * @return void
     */
    public function write($entity);

    /**
     * @return mixed
     */
    public function read();
}
