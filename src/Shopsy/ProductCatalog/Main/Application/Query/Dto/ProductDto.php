<?php

namespace App\Shopsy\ProductCatalog\Main\Application\Query\Dto;

use App\Common\Application\Query\Dto\Dto;

class ProductDto extends Dto
{
    /**
     * @var string
     */
    private string $id;

    /**
     * @var string
     */
    private string $name;

    /**
     * @var string
     */
    private string $description;

    /**
     * @param string $id
     * @param string $name
     * @param string $description
     */
    public function __construct($id, $name,  $description)
    {
        $this->id = $id;
        $this->name = $name;
        $this->description = $description;
    }

    /**
     * @return  string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return  string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return  string
     */
    public function getDescription()
    {
        return $this->description;
    }
}
