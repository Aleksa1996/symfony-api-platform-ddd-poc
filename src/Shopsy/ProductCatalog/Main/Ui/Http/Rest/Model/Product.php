<?php

namespace App\Shopsy\ProductCatalog\Main\Ui\Http\Rest\Model;

use ApiPlatform\Core\Annotation\ApiProperty;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Validator\Constraints as Assert;


#[ApiResource]
class Product
{
    /**
     * @var string
     */
    #[ApiProperty(identifier: true)]
    public ?string $id = null;

    /**
     * @var string
     */
    #[Assert\NotBlank]
    public string $name = '';

    /**
     * @var string
     */
    #[Assert\NotBlank]
    public string $description = '';

    public function __construct(?string $id, string $name, string $description)
    {
        $this->id = $id;
        $this->name = $name;
        $this->description = $description;
    }
}
