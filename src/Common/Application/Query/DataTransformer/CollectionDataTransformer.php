<?php

namespace App\Common\Application\Query\DataTransformer;

interface CollectionDataTransformer
{
    /**
     * @param array $entities
     *
     * @return void
     */
    public function write($entities);

    /**
     * @return array
     */
    public function read(): array;
}
